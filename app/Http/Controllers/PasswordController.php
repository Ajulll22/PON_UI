<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Session;
use Mail;
use Log;

class PasswordController extends Controller
{    
    public function __construct(){
        $this->menu     = "";
        $this->sub_menu = "";
    }

    public function change_password(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');

        $user_first_login       = Session::get('user_first_login');

        if(!empty(Session::get('user_email'))){
            return view('Password/change-password')->with('data', $data);
        }
        return view('Login/login');
    }

    public function change_password_process(Request $request){
        $method                 = 'POST';
        $path                   = 'user/change-password';

        $user_name              = Session::get('user_name');
        $user_firstname         = Session::get('user_firstname');
        $user_lastname          = Session::get('user_lastname');
        $user_email             = Session::get('user_email');

        $user_password          = $request->input('user_password');
        $user_password_new      = $request->input('user_password_new');

        $user_password          = UtilityController::encrypt_decrypt('encrypt', $user_password);
        $user_password_new      = UtilityController::encrypt_decrypt('encrypt', $user_password_new);

        // REQUEST PARAMETER
        $param['user_name']         = $user_name;
        $param['user_email']        = $user_email;
        $param['user_password']     = $user_password;
        $param['user_password_new'] = $user_password_new;

        $result_data = GatewayController::lead_to_be($method, $path, $param);


        if($result_data[config('constants.result')] == "SUCCESS"){
            // REQUEST PARAMETER
            $param['user_email']        = $user_email;
            $param['user_fullname']     = $user_firstname.' '.$user_lastname;
            
            if($this->sendChangePassword($param['user_name'], $param['user_email'], $param['user_fullname'])){
                return $result_data;
            }
        }
        else{
            return $result_data;        
        }

        return response($result_data);
    }

    public function sendChangePassword($user_name, $user_email, $user_fullname) {
        $data       = array(
                        'user_name'         => $user_name,
                        'user_email'        => $user_email,
                        'user_fullname'     => $user_fullname
                    );

        $emailTo    = $user_email;

        try{
            Mail::send('Mail.change-password', $data, function($message)use($emailTo){
                // $message->from(env('MAIL_USERNAME'), config('constants.sender'));
                $message->from(config('constants.mailusername'), config('constants.sender'));                 
                $message->subject(config('constants.app_name').' - Password Changed');      
                $message->to($emailTo);
            });

            return "success";
        }
        catch(\Exception $e){
            Log::error('Email Sender Error');
            return "error message: ".$e->getMessage();
        }
    }

    // RECOVER PASSWORD
    public function recover_password(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);

        return view('Password/recover-password')->with('data', $data);
    }

    public function recover_password_process(Request $request){
        $method                 = 'POST';
        $path                   = 'user/recover-password';

        $user_name              = $request->input('user_name');
        $user_email             = $request->input('user_email');
        $user_password_new      = $request->input('user_password_new');

        $user_password_new      = UtilityController::encrypt_decrypt('encrypt', $user_password_new);

        // REQUEST PARAMETER
        $param['user_name']         = $user_name;
        $param['user_email']        = $user_email;
        $param['user_password_new'] = $user_password_new;

        $result_data = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.result')] == "SUCCESS"){
            // REQUEST PARAMETER
            $param['user_email']        = $user_email;
            $param['user_fullname']     = $user_name;
            
            if($this->sendChangePassword($param['user_name'], $param['user_email'], $param['user_fullname'])){
                return $result_data;
            }
        }
        else{
            return $result_data;        
        }

        return response($result_data);
    }

    public function forgot_password(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                   = $this->menu;
        $data["sub_menu"]               = $this->sub_menu;
        $data['privilege_menu']         = $request->get('privilege_menu');

        return view('Password/forgot-password')->with('data', $data);
    }

    // FORGOT PASSWORD USER
    public function forgot_password_process(Request $request){
        $method                 = 'POST';
        $path                   = 'recover-password';

        $user_email             = $request->input('user_email');
        $privilege_menu         = $request->get('privilege_menu');

        // REQUEST PARAMETER
        $param['user_email']    = $user_email;
        $result_data            = GatewayController::lead_to_be($method, $path, $param); 


        if($result_data[config('constants.result')] == "SUCCESS"){
            // REQUEST PARAMETER
            $param['user_password'] = UtilityController::encrypt_decrypt('decrypt', $result_data['user_password']);
            $user_firstname         = $result_data['user_firstname'];
            $user_lastname          = $result_data['user_lastname'];

            if ($result_data['user_lastname'] === null || $result_data['user_lastname'] === ''){
                $user_fullname = $user_firstname;
            }
            else {
                $user_fullname = $user_firstname.' '.$user_lastname;
            }

            $param['user_fullname'] = $user_fullname;

            if($this->sendMailGateway($param['user_fullname'], $param['user_email'], $param['user_password'])){
                return $result_data;
            }
        }
        else{
            return $result_data;
        }
        
        return response($result_data);
    }

    public function sendMailGateway($user_name, $user_email, $user_password)
    {
        $client = new Client();

        $data       = array(
            'user_name'     => $user_name,
            'user_email'    => $user_email,
            'user_password' => $user_password
        );

        $html = view('Mail.forgot-password',$data)->render();
        $json = [
            "subject" => config('constants.app_name').' - Forgot Password',
            "recipient" => [
                ["email" => $user_email]
            ],
            "body" => $html
        ];

        $headers = [
            'headers' => [
                'Content-Type'      => 'application/json',
                'X-CLIENT-SECRET'           => '50565320652d50726f6a656374323032322d31312d31372031343a33383a3332',
                'X-CLIENT-ID'               => '7a8fdf21-4dca-4c65-98b1-8b43f049b3db', 
                'X-PURPOSE'                 => 'Notification',
            ],
            'json' => $json
        ];

        $gateway_req = $client->request('POST', 'localhost:5555/api/email-request', $headers);

        return 'success';
    }

    public function sendForgotPassword($user_name, $user_email, $user_password) {
        $user_email = "ajulrizki@gmail.com";
        $data       = array(
                        'user_name'     => $user_name,
                        'user_email'    => $user_email,
                        'user_password' => $user_password
                    );

        $emailTo    = $user_email;

        try{
            Mail::send('Mail.forgot-password', $data, function($message)use($emailTo){
                $message->from(config('constants.mailusername'), config('constants.sender'));                 
                $message->subject(config('constants.app_name').' - Forgot Password');      
                $message->to($emailTo);
            });

            return "success";
        }
        catch(\Exception $e){
            return "error message: ".$e->getMessage();
        }
    }

    // SET NEW PASSWORD
    public function set_new_password(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);
        return view('Password/set-new-password')->with(['data' => $data]);
    }

    // SET NEW PASSWORD PROCESS
    public function set_new_password_process(Request $request){
        $method                 = 'POST';
        $path                   = 'user/set-password';

        $privilege_menu         = $request->get('privilege_menu');

        $user_name              = Session::get('user_name');
        $user_email             = Session::get('user_email');

        $user_password          = $request->input('user_password');
        $user_password          = UtilityController::encrypt_decrypt('encrypt', $user_password);
        
        $param['user_name']     = $user_name;
        $param['user_email']    = $user_email;
        $param['user_password'] = $user_password;
        $result_data            = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.result')] == "SUCCESS"){
            if($this->sendSetNewPassword($user_name, $user_email)){
                return $result_data;
            }
        }
        else{
            return $result_data;         
        }
        
        return response($result_data);
    }

    public function sendSetNewPassword($user_name, $user_email) {
        $data       = array(
                        'user_name'         => $user_name
                    );

        $emailTo    = $user_email;

        try{
            Mail::send('Mail.change-password', $data, function($message)use($emailTo){
                $message->from(config('constants.mailusername'), config('constants.sender'));                 
                $message->subject(config('constants.app_name').' - Password Changes');      
                $message->to($emailTo);
            });

            return "success";
        }
        catch(\Exception $e){
            return "error message: ".$e->getMessage();
        }
    }
}