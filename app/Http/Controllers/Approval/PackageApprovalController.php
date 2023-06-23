<?php

namespace App\Http\Controllers\Approval;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PackageApprovalController extends Controller
{
    public function __construct(){
		$this->menu     = "approval";
		$this->sub_menu = "package-approval";
	}

	public function package(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
		
	    $data["menu"]           			= $this->menu;
	    $data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	// $data['notification_list'] 			= $request->get('notification_list');
	  	// $data['notification_type'] 			= $request->get('notification_type');
	  	// $data['notification_data'] 			= $request->get('notification_data');
	  	// $data['notification_count']			= $request->get('notification_count');
	  	// $data['all_notification_length']	= count($data['notification_list']);

	    $method   	 			= 'GET';
	    $path     	 			= 'reason/list';
	    $param   	 			= array();
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"] 	= $result_data['reason_list'];

        Log::info(' ');
	    return view('Approval/package')->with('data',$data);
	}

	public function package_list(Request $request){
		$method   = 'GET';
		$path     = 'package/list/approval';
		$param    = array();

		$result_data = GatewayController::lead_to_be($method, $path, $param);
		return $result_data;
  	}

  	public function package_approval(Request $request){
	    $method       = 'POST';
	    $path         = 'package/approval';

	    $approval_package_by	= Session::get('user_name');
	    $package_name 			= $request->input('package_name');
	    $package_description 	= $request->input('package_description');
	    $request_type_name 		= $request->input('request_type_name');
	    $request_status_name 	= $request->input('request_status_name');
	    $reason 				= $request->input('reason');

	    if ($reason==null) {
	    	$reason="";
	    }

		$param['package_name']    		= $package_name;
		$param['package_description']	= $package_description;
		$param['approval_package_by']	= $approval_package_by;
		$param['request_type_name'] 	= $request_type_name;
		$param['request_status_name'] 	= $request_status_name;
		$param['reason'] 				= $reason;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
 
 	public function package_privilege(Request $request){
	    $method       			= 'POST';
		$path         			= 'package/privilege/request';
		$package_name 			= $request->input('package_name');
		$param['package_name'] 	= $package_name;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}
