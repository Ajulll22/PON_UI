<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Session;
use Mail;

class UserSetupController extends Controller
{
    public function __construct(Request $request){
      	$this->menu     = "user-management";
      	$this->sub_menu = "user-setup";
  	}

  	// VIEW
	public function user(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);

        // GET DATA FILTER TYPE
        $method                     = 'GET';
        $path                       = 'group/data-filter-type';
        $param                      = array();
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

        $data['data_filter_type']   = $result_data['data_filter_type'];

        // GET GROUP LIST
        $path                       = 'group/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

	    if(isset($result_data['group_list'])){
        	$data['group_list']		= $result_data['group_list'];
	    }
	    else{
	      	$data["group_list"] 	= "";
	    }

        // GET SUBGROUP LIST
        $path                       = 'subgroup/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

	    if(isset($result_data['subgroup_list'])){
        	$data['subgroup_list']	= $result_data['subgroup_list'];
	    }
	    else{
	      	$data["subgroup_list"] 	= "";
	    }

        // GET REASON LIST
        $path                       = 'reason/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')]==config('constants.session_expired')){
            return redirect()->route('logout');
        }

        $cost_centre_list 	= GatewayController::lead_to_be("GET", "cost-centre/data", []);
        $role_list 	= GatewayController::lead_to_be("GET", "user/role/data", []);

        $data["reason_list"]        = $result_data['reason_list'];
        $data["cost_centre_list"] = $cost_centre_list["data"];
        $data["role_list"] = $role_list["data"]['role'];
        $data["leader_list"] = $role_list["data"]["leader"];
        // VIEW WITH DATA;
        return view('UserManagement/user')->with(
          	'data', $data
        );
  	}

  	// USER LIST
  	public function user_list(Request $request){
	    $method       	= 'GET';
	    $path     		= 'user/list';
        $param          = array();
	    $result_data 	= GatewayController::lead_to_be($method, $path, $param);

	    return response($result_data);
  	}

    // GET USER DATA FILTER
    public function user_data_filter(Request $request){
        $user_name                  = $request->input('user_name');
        $user_group                 = $request->input('group_name');
        
        $method                     = 'POST';
        $path                       = 'user/data-filter';
        
        $param['user_name']         = $user_name;
        
        if($user_group != ''){
            $param['group_name']    = $user_group;
        }
        else{
            $param['group_name']    = '';
        }

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

  	// ADD USER
  	public function user_add(Request $request){
	    $method       							= 'POST';
        $path		                            = 'user/request';

	    $user_name            					= $request->input('user_name');
	    $user_firstname       					= $request->input('user_firstname');
	    $user_lastname        					= $request->input('user_lastname');
	    $user_fullname							= $user_firstname.' '.$user_lastname;
	    $user_description     					= $request->input('user_description');
	    $user_email           					= $request->input('user_email');
        $user_phone                             = $request->input('user_phone');
        $user_active                            = $request->input('user_active');
	    $user_address         					= $request->input('user_address');
	    $user_force_change_password 			= '1';
	    $subgroup_id     						= $request->input('subgroup_id');
	    $data_filter      						= $request->input('data_filter');
    	$reason 	                            = $request->input('reason');
    	$cost_centre_id 	                    = $request->input('cost_centre_id');
    	$role_id 	                            = $request->input('role_id');
    	$leader_user_id 	                    = $request->input('leader_user_id');

	    // REQUEST PARAMETER
        $param['user_name']            			= $user_name;
        $param['user_firstname']            	= $user_firstname;
		$param['user_lastname']               	= $user_lastname;
		$param['user_description']            	= $user_description;
		$param['user_email']                  	= $user_email;
		$param['user_phone']                  	= $user_phone;
		$param['user_address']                	= $user_address;
		$param['user_force_change_password']  	= $user_force_change_password;
		$param['user_active']                 	= $user_active;
		$param['subgroup_id']                 	= $subgroup_id;
		$param['data_filter']                 	= $data_filter;
		$param['cost_centre_id']                = $cost_centre_id;
		$param['role_id']                 	    = $role_id;
		$param['leader_user_id']                = $leader_user_id;

	    if($reason == null){
	    	$reason = "";
	    }

	    // REQUEST PARAMETER
		$param['request_type_name']     = 'ADD';
		$param['request_status_name']   = 'PENDING';
		$param['reason']               	= $reason;

    	$result_data    = GatewayController::lead_to_be($method, $path, $param);

	    if($result_data[config('constants.result')] == "SUCCESS"){    
            if ($result_data[config('constants.feature_level')]==1) {
                $user_password_clear = UtilityController::encrypt_decrypt('decrypt',$result_data['user_password']);

                $param       = array('username' => $user_name, 'fullname' => $user_fullname, 'password' => $user_password_clear, 'email' => $user_email);
                $html = view('Mail.user-register',$param)->render();
                $payload = [
                    "subject" => 'Welcome to ' . config('constants.app_name'),
                    "recipient" => [
                        ["email" => $user_email]
                    ],
                    "body" => $html
                ];
                PasswordController::sendMail($payload);
    	        
                return $result_data;
            }else{
                return $result_data;
            }     
	    }

	    return $result_data;
  	}

    // UPDATE USER
    public function user_update(Request $request){
        $method             = 'POST';
        $path               = 'user/request';

        $user_name          = $request->input('user_name');
        $subgroup_id        = $request->input('subgroup_id');
		$user_firstname     = $request->input('user_firstname');
        $user_lastname  	= $request->input('user_lastname');
        $user_description  	= $request->input('user_description');
        $user_email  		= $request->input('user_email');
        $user_phone  		= $request->input('user_phone');
        $user_active        = $request->input('user_active');
        $user_address  		= $request->input('user_address');
        $data_filter        = $request->input('data_filter');
        $reason             = $request->input('reason');
        $cost_centre_id 	= $request->input('cost_centre_id');
    	$role_id 	        = $request->input('role_id');
    	$leader_user_id 	= $request->input('leader_user_id');
        
        // REQUEST PARAMETER
        $param['user_name']         = $user_name;
        $param['subgroup_id']		= $subgroup_id;
        $param['user_firstname']    = $user_firstname;
        $param['user_lastname'] 	= $user_lastname;
        $param['user_description']	= $user_description;
        $param['user_email']       	= $user_email;
        $param['user_phone']       	= $user_phone;
        $param['user_active']       = $user_active;
        $param['user_address']      = $user_address;
        $param['data_filter']       = $data_filter;
        $param['cost_centre_id']       = $cost_centre_id;
        $param['role_id']       = $role_id;
        $param['leader_user_id']       = $leader_user_id;

        if($reason == null){
            $reason = "";
        }

        // REQUEST PARAMETER
        $param['request_type_name']    	= 'UPDATE';
        $param['request_status_name']  	= 'PENDING';
        $param['reason']               	= $reason;

        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

  	// DELETE USER
  	public function user_delete(Request $request){
	    $method       			  = 'POST';
        $path                     = 'user/request';

        $user_name                = $request->input('user_name');
		$privilege_menu 		  = $request->get('privilege_menu');

	    // REQUEST PARAMETER
        $param['user_name']		  = $user_name;

        $user_firstname             = $request->input('user_firstname');
        $user_lastname              = $request->input('user_lastname');
        $user_fullname              = $user_firstname.' '.$user_lastname;
        $user_email                 = $request->input('user_email');
        $user_phone                 = $request->input('user_phone');
        $user_active                = $request->input('user_active');
        $user_address               = $request->input('user_address');
        $user_force_change_password = '1';
        $subgroup_id                = $request->input('subgroup_id');
        $data_filter                = $request->input('data_filter');
        $reason             	    = $request->input('reason');
        $user_description           = $request->input('user_description');

        if($reason == null){
            $reason = "";
        }

        if($user_description == null){
            $user_description = "";
        }

	    // REQUEST PARAMETER
        $param['user_name']                     = $user_name;
        $param['user_firstname']                = $user_firstname;
        $param['user_lastname']                 = $user_lastname;
        $param['user_description']              = $user_description;
        $param['user_email']                    = $user_email;
        $param['user_phone']                    = $user_phone;
        $param['user_address']                  = $user_address;
        $param['user_force_change_password']    = $user_force_change_password;
        $param['user_active']                   = $user_active;
        $param['subgroup_id']                   = $subgroup_id;
        $param['data_filter']                   = $data_filter;

        $param['request_type_name']		        = 'DELETE';
        $param['request_status_name']	        = 'PENDING';
        $param['reason']				        = $reason;

	    $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
	}

    // RESET PASSWORD USER
    public function reset_password(Request $request){
        $method                 = 'POST';
        $path                   = 'user/reset-password';

        $user_name              = Session::get('user_name');
        $user_reset             = $request->input('user_reset');
        $user_email             = $request->input('user_email_reset');
        
        $privilege_menu         = $request->get('privilege_menu');

        // REQUEST PARAMETER
        $param['user_name']     = $user_reset;
        $param['user_email']    = $user_email;

        $result_data            = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.result')] == "SUCCESS"){
            // REQUEST PARAMETER
            $param['user_password'] = UtilityController::encrypt_decrypt('decrypt', $result_data['user_password']);
            
            if($this->sendResetPassword($param['user_name'], $param['user_email'], $param['user_password'])){
                return $result_data;
            }
        }
        else{
            return $result_data;         
        }
        
        return response($result_data);
    }


    public function sendResetPassword($user_name, $user_email, $user_password) {
        $data       = array(
                        'user_name'     => $user_name,
                        'user_email'    => $user_email,
                        'user_password' => $user_password
                    );
        $client = new Client();

        try{
            $html = view('Mail.reset-password',$data)->render();
            $payload = [
                "subject" => config('constants.app_name').' - Reset Password',
                "recipient" => [
                    ["email" => $user_email]
                ],
                "body" => $html
            ];

            $data = [
                'headers' => [
                    'Content-Type'      => 'application/json',
                    'X-CLIENT-SECRET'           => config('constants.X-CLIENT-SECRET'),
                    'X-CLIENT-ID'           => config('constants.X-CLIENT-ID'),
                    'X-PURPOSE'           => config('constants.X-PURPOSE')
                ],
                'json' => $payload
            ];
    
            $gateway_req = $client->request('POST', config('constants.com_gateway').'api/email-request', $data);
    
            return 'success';
        }
        catch(\Exception $e){
            return "error message: ".$e->getMessage();
        }
    }
}
