<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserApprovalController extends Controller
{
    public function __construct(){
	  	$this->menu     = "approval";
	  	$this->sub_menu = "user-approval";
	}

	public function user(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
		
	    $data["menu"]           			= $this->menu;
	    $data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	// $data['notification_list'] 			= $request->get('notification_list');
	  	// $data['notification_type'] 			= $request->get('notification_type');
	  	// $data['notification_data'] 			= $request->get('notification_data');
	  	// $data['notification_count']			= $request->get('notification_count');
	  	// $data['all_notification_length']	= count($data['notification_list']);

	    $method   					= 'GET';
	    $path     					= 'reason/list';
        $param                      = array();

	    $result_data 				= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"] 		= $result_data['reason_list'];

        Log::info(' ');
	    return view('Approval/user')->with('data',$data);
	}

	// GET USER LIST
	public function user_list(Request $request){
		$method   					= 'GET';
		$path     					= 'user/list/approval';
        $param                      = array();

		$result_data 			= GatewayController::lead_to_be($method, $path, $param);
		return $result_data;
  	}

  	// USER APPROVAL
  	public function user_approval(Request $request){
	    $method       				= 'POST';
	    $path         				= 'user/approval';

	    $approval_user_by 			= Session::get('user_name');
	    $user_name 					= $request->input('user_name');
	    $user_firstname       		= $request->input('user_firstname');
	    $user_lastname        		= $request->input('user_lastname');
	    $user_fullname				= $user_firstname.$user_lastname;
	    $user_email 				= $request->input('user_email');

	    $user_description 			= $request->input('user_description');
	    $request_type_name 			= $request->input('request_type_name');
	    $request_status_name 		= $request->input('request_status_name');
	    $reason 					= $request->input('reason');

	    if($reason == null){
	    	$reason = "";
	    }

		$param['user_name']    			= $user_name;
		$param['user_email']    		= $user_email;
		$param['user_description']		= $user_description;
		$param['approval_user_by']		= $approval_user_by;
		$param['request_type_name'] 	= $request_type_name;
		$param['request_status_name'] 	= $request_status_name;
		$param['reason'] 				= $reason;
		
		$result_data 					= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data['result']=="SUCCESS") {
		    if ($request_type_name=="ADD" && $request_status_name=="APPROVED") {
		    	$user_password_clear = UtilityController::encrypt_decrypt('decrypt',$result_data['user_password']);
		    	return UtilityController::send_user_register($user_name, $user_fullname, $user_password_clear, $user_email , $result_data);
		    }
		    else{
		        return $result_data;
		    }
	    }
	    return $result_data;
  	}

  	// GET USER DATA FILTER
  	public function user_data_filter(Request $request){
	    $method       		= 'POST';
		$path         		= 'user/data-filter/request';
		
		$user_name			= $request->input('user_name');
		$param['user_name']	= $user_name;

		$result_data 		= GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}
