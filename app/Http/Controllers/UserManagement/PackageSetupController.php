<?php

namespace App\Http\Controllers\UserManagement;

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

class PackageSetupController extends Controller
{
	public function __construct(){
		$this->menu     = "user-management";
		$this->sub_menu = "package-setup";
  	}

    public function package(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');

        // MENU AND SUBMENU SIGNAGE
    	$data["menu"]           			= $this->menu;
		$data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	// $data['notification_list'] 			= $request->get('notification_list');
	  	// $data['notification_type'] 			= $request->get('notification_type');
	  	// $data['notification_data'] 			= $request->get('notification_data');
	  	// $data['notification_count']			= $request->get('notification_count');
	  	// $data['all_notification_length']	= count($data['notification_list']);

	    // GET PACKAGE PRIVILEGE
		$method       			= 'POST';
		$path         			= 'package/privilege';
		$param['package_name']	= "";
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
		$data["privilege_list"] = $result_data['privilege_list'];

		// GET REASON LIST
	    $method   				= 'GET';
	    $path     				= 'reason/list';
	    $param    				= array();
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"]	= $result_data['reason_list'];
	    
        Log::info(' ');
		return view('UserManagement/package')->with('data', $data);
  	}

  	// GET PACKAGE LIST
 	public function package_list(Request $request){
		$method   = 'GET';
		$path     = 'package/list';
		$param    = array();

		$result_data = GatewayController::lead_to_be($method, $path, $param);
		return $result_data;
  	}

  	// GET PACKAGE PRIVILEGE
  	public function package_privilege(Request $request){
	    $method   		= 'POST';
	    $path     		= 'package/privilege';
		$package_name 	= $request->input('package_name');

	    if($package_name != null){
			$param['package_name'] 	= $package_name;
	    }
	    else{
			$param['package_name']	= '';
	    }

		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return response($result_data);
 	}

 	// ADD PACKAGE
  	public function package_add(Request $request){
		$method       					= 'POST';
    	$path							= 'package/request';
		
		$package_name 					= $request->input('package_name');
		$package_description 			= $request->input('package_description');
		$privilege_menu 				= $request->get('privilege_menu');
		$privilege_list  				= $request->input('privilege_list');

		$reason = $request->input('reason');

	    if($reason == null){
	    	$reason = "";
	    }

	    // REQUEST PARAMETER
		$param['package_name']   	 	= $package_name;
		$param['package_description'] 	= $package_description;
		$param['privilege_list']   		= $privilege_list;
		$param['request_type_name']		= 'ADD';
		$param['request_status_name']	= 'PENDING';
		$param['reason']				= $reason;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
		return $result_data;
  	}

  	// DELETE PACKAGE
  	public function package_delete(Request $request){
		$method                 = 'POST';
    	$path         			= 'package/request';
  		
	    $package_name 			= $request->input('package_name');
		$privilege_menu 		= $request->get('privilege_menu');
		
    	$privilege_list 	 	= $request->input('privilege_list');
    	$package_description 	= $request->input('package_description');
    	$reason  			 	= $request->input('reason');

	    if($reason == null){
    		$reason = "";
    	}

    	// REQUEST PARAMETER
		$param['package_name']  		= $package_name;
      	$param['package_description']	= $package_description;
		$param['request_type_name']		= 'DELETE';
		$param['request_status_name']	= 'PENDING';
		$param['privilege_list']		= $privilege_list;
		$param['reason']				= $reason;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
    	return $result_data;
  	}

  	// UPDATE PACKAGE
  	public function package_update(Request $request){
		$method		       				= 'POST';
    	$path   						= 'package/request';

	    $package_name 					= $request->input('package_name');
	    $package_description 			= $request->input('package_description');
	    $privilege_list  				= $request->input('privilege_list');
	    $privilege_menu 				= $request->get('privilege_menu');

    	$reason = $request->input('reason');

    	if($reason == null){
    		$reason = "";
    	}

    	// REQUEST PARAMETER
		$param['package_name']    		= $package_name;
		$param['package_description'] 	= $package_description;
		$param['privilege_list']   		= $privilege_list;
		$param['request_type_name']		= 'UPDATE';
		$param['request_status_name']	= 'PENDING';
		$param['reason']				= $reason;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}
