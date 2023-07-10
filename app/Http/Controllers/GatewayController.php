<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use GuzzleHttp\Psr7\Request;
use App\User;
use Session;
use Log;
use App\Http\Controllers\UtilityController;

Class GatewayController {

    public static function lead_to_be($method, $path, $param) {
        $log_feature = config('constants.log_feature');

        try {

            $client     = new \GuzzleHttp\Client();
            $clear_path = $path;
            $path       = config('constants.api_server').$path;

            if ($log_feature == true) {
                Log::debug('[PATH] '.$method.' '.$path);
            }

            $json = array();
            foreach ($param as $key => $value) {
                $json[$key] = $value;
                if ($value == null) {
                    $json[$key] = '';
                }
                if ($log_feature == true) {
                    if(!is_array($value)){
                        Log::debug('[DATA]['.$key.']'.$value);
                    }
                }
            }

            if ($clear_path == 'login' || $clear_path == 'forgot-password') {
                $headers = [
                        'headers' => [
                            'Content-Type' => 'application/json'
                        ],
                        'json' => $json
                    ];

                $req_backend = $client->request($method, $path , $headers); 
            }
            else if ($clear_path == 'user/set-password') {
                if ($method == 'POST') {
                    $jws = UtilityController::createJWS($json);
                    $headers = [
                            'headers' => [
                                'Content-Type'      => 'application/json',
                                'X-JWS-Signature'   => 'Bearer '.$jws
                            ],
                            'json' => $json
                        ];

                }
                else {
                    $headers = [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'json' => $json
                    ];
                }

                $req_backend = $client->request($method, $path ,$headers);
            }
            else {
                $token = Session::get(config('constants.token'));

                if ($method == 'POST') {
                    $jws = UtilityController::createJWS($json);
                    $headers = [
                            'headers' => [
                                'Content-Type'      => 'application/json',
                                'Authorization'     => 'Bearer '.$token,
                                'X-JWS-Signature'   => 'Bearer '.$jws
                            ],
                            'json' => $json
                        ];
                }
                else {
                    $headers = [
                        'headers' => [
                            'Content-Type'  => 'application/json',
                            'Authorization' => 'Bearer '.$token
                        ],
                        'json' => $json
                    ];
                }

                $req_backend = $client->request($method, $path ,$headers); 
            }

            if ($log_feature == true) {
                Log::debug($json); //Log Param
                Log::debug($headers); //Log Param
            }
            $result_data    = json_decode($req_backend->getBody(), true); 
            $result_data[config('constants.response_code')] = strval($result_data[config('constants.response_code')]);

            if ($log_feature == true) {
                Log::debug('[RESPONSE CODE] '.$result_data[config('constants.response_code')]); 
                Log::debug('[RESPONSE MESSAGE] '.$result_data[config('constants.message')]); 
                Log::debug('[RESPONSE DATA] '); 
                Log::debug($result_data); 
            }

            if ($result_data[config('constants.result')] == "SUCCESS") {
            if ($clear_path != 'user/set-password' && $clear_path != 'logout') {
                    Session::put(config('constants.token'), $result_data[config('constants.token')]);
                }
            }
        } catch (ClientErrorResponseException $e) {
            Log::debug($e->getResponse()->getBody(true));
            $result_data = $e->getResponse()->getBody(true);
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            //Catch the guzzle connection errors over here.These errors are something 
            // like the connection failed or some other network error
            Log::debug($e);
            $result_data['result']          = "FAILED";
            $result_data['message']         = "Server Unreachable";
            $result_data['response_code']   = '0';
            // try {
            //     Log::debug($e->getResponse()->getBody()->getContents());
            //     $result_data = json_encode((string)$e->getResponse()->getBody());
            // } catch (Exception $e) {
            //     Log::debug('errorrrrrrrrrrrrrrrrrrr');
            //     $result_data = "error";                
            // }
        } catch (\GuzzleHttp\Exception\ServerException $e){
            Log::debug($e);
            $response                       = json_decode($e->getResponse()->getBody(),true);
            $result_data['result']          = $response['result'];
            $result_data['message']         = $response['message'];
            $result_data['response_code']   = $response['response_code'];
            Log::debug('error 500');
            Log::debug($response);
        }

        return $result_data;
    }
}