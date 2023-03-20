<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GatewayController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Illuminate\Support\Facades\Session;
use Log;
use Mail;

class LoginController extends Controller
{

    public function __construct(){
        //$this->middleware('auth');
    }

    public function index()
    {
        Log::info('------------------ LOGIN ------------------');

        if(!empty(Session::get('user_name'))) {
            return redirect()->route('dashboard');
        }
        Log::info(' ');
        Session::flush();
    	return view('Login/login');
    }

    public function login_process(Request $request){
        try {
            $method     = 'POST';
            $path       = 'login';

            $user_ip    = $_SERVER['REMOTE_ADDR'];
            $user_email = $request->input('user_email');
            $password   = $request->input('password');
            $password   = hash('sha256', $user_email.$password);


            $param['user_name']     = $user_email; 
            $param['user_password'] = $password; 
            $param['user_ip']       = $user_ip;

            $result_data            = GatewayController::lead_to_be($method, $path, $param);

            if ($result_data[config('constants.result')] == "SUCCESS") {
                Session::put('cost_centre_id',          $result_data['user_data']['cost_centre_id']);
                Session::put('cost_centre_name',          $result_data['user_data']['cost_centre_name']);
                Session::put(config('constants.token'), $result_data[config('constants.token')]);
                Session::put('user_id',                 $result_data['user_data']['user_id']);
                Session::put('subgroup_id',             $result_data['user_data']['subgroup_id']);
                Session::put('subgroup_name',           $result_data['user_data']['subgroup_name']);
                Session::put('user_name',               $result_data['user_data']['user_name']);
                Session::put('user_email',              $result_data['user_data']['user_email']);
                Session::put('user_firstname',          $result_data['user_data']['user_firstname']);
                Session::put('user_lastname',           $result_data['user_data']['user_lastname']);
                Session::put('user_phone',              $result_data['user_data']['user_phone']);
                Session::put('user_first_login',        $result_data['user_data']['user_force_change_password']);
                Session::put('pw_expiry_tag',           $result_data['user_data']['is_expired']);
                Session::put('token',                   $result_data['token']);
                Session::put('user_ip_address',         $user_ip);

                if ($result_data['user_data']['user_force_change_password'] === true){
                    Session::put('granted_status',      2);
                }
                else {
                    Session::put('granted_status',      1);
                }

                $result_data['message'] = "Login as ".$result_data['user_data']['user_name'];
            }

            return $result_data;
        }
        catch(Exception $e) {
            $result_data[config('constants.result')] = 'FAILED';
            $result_data['message'] = 'Login failed, please contact administrator!';
        }
    }
	
    public function logout_process(Request $request){
        try {
            Session::flush();
            return redirect()->route('login')->with('alert','You\'ve been Logged Out');
        }
        catch(Exception $e) {
            $result_data[config('constants.result')] = 'FAILED';
            $result_data['message'] = 'Logout failed, please contact administrator!';
        }
    }

    public function loginCheck(Request $request) {
        $method                     = 'GET';
        $path                       = 'logout';
        $param                      = array();

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        
        return $result_data;
    }

    public function forbidden()
    {
        return view('error/403');
    }

    public function check_priv(Request $request)
    {
        $access_id    = array();
        $access       = array();

        $method                 = 'POST';
        $path                   = 'subgroup/privilege';
        $param['subgroup_name'] = '';
        $result_data            = GatewayController::lead_to_be($method, $path, $param, 'skip_log');

        if ($result_data[config('constants.response_code')]==config('constants.session_expired')||
            $result_data[config('constants.response_code')]==config('constants.unauthorized_token')
            ) {
            return redirect()->route('logout')->setStatusCode(401);
        }

        if ($result_data[config('constants.result')]=='SUCCESS') {
            foreach ($result_data['privilege_list'] as $key => $value) {
                $access[$value['privilege_code']]=false;
            }
        }

        $subgroup_name          = Session::get('subgroup_name');
        $method                 = 'POST';
        $path                   = 'subgroup/privilege';
        $param['subgroup_name'] = $subgroup_name;
        $result_data            = GatewayController::lead_to_be($method, $path, $param, 'skip_log');

        if ($result_data[config('constants.response_code')]==config('constants.session_expired') ||
            $result_data[config('constants.response_code')]==config('constants.unauthorized_token')) {
            return redirect()->route('logout')->setStatusCode(401);
        }

        if ($result_data[config('constants.result')]=='SUCCESS') {
            foreach ($result_data['privilege_list'] as $key => $value) {
                if (array_key_exists($value['privilege_code'],$access))
                {
                    $access[$value['privilege_code']]=true;
                    array_push($access_id, $value['privilege_code']);
                }
            }
        }

        return $access;
    }

    public function session_token(Request $request)
    {
        return $request->session()->all();
    }

    public function phpinfo()
    {
        return phpinfo();
    }

}
