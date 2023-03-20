<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Session;
use Mail;
use Log;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Redis;

use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\Converter\StandardConverter;
use Jose\Component\Core\JWK;
use Jose\Component\Signature\Algorithm\HS256;
use Jose\Component\Signature\JWSBuilder;
use Jose\Component\Signature\Serializer\CompactSerializer;
use Jose\Component\Signature\JWSVerifier;
use Jose\Component\Signature\Serializer\JWSSerializerManager;

use Jose\Component\Checker\ClaimCheckerManager;
use Jose\Component\Checker\ExpirationTimeChecker;
use Jose\Component\Checker\IssuedAtChecker;
use Jose\Component\Checker\NotBeforeChecker;
use Jose\Component\Core\Util\JsonConverter;

class UtilityController extends Controller
{

    public static function encrypt_decrypt($action, $string) 
    { 
        $output = false; 
        $encrypt_method = "AES-256-CBC"; 
        $secret_key = config('constants.secret_key'); 
        $secret_iv = config('constants.secret_iv'); 

        // key - must be exact 32 chars (256 bit) 
        $key = $secret_key; 
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
        $iv = strtoupper(substr(hash('sha256', $secret_iv), 0, 16)); 
        if ($action == 'encrypt') 
        { 
            $output = openssl_encrypt($string, $encrypt_method, $key, OPENSSL_RAW_DATA, $iv); 
            $output = base64_encode($output); 
        } 
        else if($action == 'decrypt') 
        { 
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, OPENSSL_RAW_DATA, $iv); 
        } 
        return $output; 
    }

    public static function send_user_register($username, $fullname, $password, $email, $result_data) {
        $data       = array('username'=>$username, 'fullname'=>$fullname, 'password'=>$password, 'email'=>$email);
        $emailTo    = $email;

        Log::debug($data);
        Log::debug($emailTo);
        Log::debug(config('constants.mailusername'));
        Log::debug(config('constants.sender'));
        Log::debug(config('constants.app_name'));
        try{
            Mail::send('Mail.user-register', $data, function($message) use($emailTo) {                   
                $message->from(config('constants.mailusername'), config('constants.sender'));                 
                $message->subject('Welcome to '.config('constants.app_name'));      
                $message->to($emailTo);            
            });

            return $result_data;
        }
        catch(\Exception $e){
            $result_data[config('constants.result')]  = "FAILED";
            $result_data['message'] = "EMAIL NOT SENT";
            $result_data['error']   = "error message: ".$e->getMessage();

            return $result_data;
        }
    }

    public static function check_token($result_data)
    {
        if ($result_data[config('constants.response_code')]=='B220000') {
            return redirect()->route('logout');
        }

        return $result_data;
    }

    public static function createJWS($json)
    {
        $json = str_replace('&quot;', '"', json_encode($json));
        $key = config('constants.jwk');

        // The algorithm manager with the HS256 algorithm.
        $algorithmManager = new AlgorithmManager([
            new HS256(),
        ]);

        // Our key.
        $jwk = new JWK([
            'kty' => 'oct',
            'k' => $key,
        ]);

        // Instantiate JWS Builder.
        $jwsBuilder = new JWSBuilder($algorithmManager);

        // The payload we want to sign. The payload MUST be a string hence we use our JSON Converter.
        // $payload = json_encode($json);

        $payload = JsonConverter::encode($json);

        $jws = $jwsBuilder
        ->create()                               // We want to create a new JWS
        ->withPayload($payload)                  // We set the payload
        // ->addSignature($jwk, ['alg' => 'HS256']) // We add a signature with a simple protected header
        ->addSignature($jwk, ['alg' => 'HS256', 'typ' => 'JWT']) // We add a signature with a simple protected header
        ->build();                               // We build it
        
        $serializer = new CompactSerializer(); // The serializer

        $token = $serializer->serialize($jws, 0); // We serialize the signature at index 0 (we only have one signature).
        // return (array)$token;

        // create detached payload JWS compact
        $data = explode(".", $token);
        unset($data[1]);
        $token = implode("..",$data);
        return $token;
    }

    public function UploadToTemp(Request $request)
    {
        try {
            $rules = [
                'upload_document' => 'required|mimes:jpg,png,jpeg,pdf'
            ];       
            $data = $request->all();
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return [
                    'result' => 'error_validate',
                    'message' => $validator->errors()
                ];
            }
            $file = $request->file('upload_document');
            $fileName = 'UploadTmp-' . time() . '.' . $file->extension();
    
            $file->move(public_path('tmp'), $fileName);     
    
            return [ 
                "result" => "SUCCESS",
                "message" => "Uploaded",
                "file_name" => $fileName
            ];
        } catch (\Throwable $th) {
            return [ 
                "result" => "FAILED",
                "message" => "Error Upload File"
            ];
        }
    }

    public function DeleteFromTemp(Request $request)
    {
        $file_name = $request->input('delete_document');
        if (file_exists(public_path('tmp/'.$file_name))){
            unlink(public_path('tmp/'.$file_name));
        }
        return;
    }

}
