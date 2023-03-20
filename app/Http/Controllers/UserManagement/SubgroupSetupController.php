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
use Session;
use Log;

class SubgroupSetupController extends Controller
{
    public function __construct(){
		$this->menu     	 = "user-management";
		$this->sub_menu 	 = "subgroup-setup";
  	}

  	// VIEW
  	public function subgroup(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
  		
	    $data["menu"]           			= $this->menu;
	    $data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	$data['notification_list'] 			= $request->get('notification_list');
	  	$data['notification_type'] 			= $request->get('notification_type');
	  	$data['notification_data'] 			= $request->get('notification_data');
	  	$data['notification_count']			= $request->get('notification_count');
	  	$data['all_notification_length']	= count($data['notification_list']);

	    // GET PACKAGE PRIVILEGE
	    $method       			= 'POST';
	    $path         			= 'package/privilege';
	    $param['package_name']	= "";
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')] == config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["privilege_list"] = $result_data['privilege_list'];

	    // GET GROUP LIST
	    $path     				= 'group/list';
	    $method   				= 'GET';
	    $param    				= array();
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')] == config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["group_list"] 	= $result_data['group_list'];

	    // GET SUBGROUP LIST
	    $path     				= 'subgroup/list';
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["subgroup_list"] 	= $result_data['subgroup_list'];

	    // GET REASON LIST
	   	$path     				= 'reason/list';
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"] 	= $result_data['reason_list'];
	    
        Log::info(' ');
	    return view('UserManagement/sub-group')->with('data',$data);
  	}

	// Get Privilage By Grup Select
	public function getPrivilageSelect(Request $request)
	{
		try {
			$package_name 			= $request->input('package_name');

			$method       			= 'POST';
			$path         			= 'package/privilege';
			$param['package_name']	= $package_name;
			$result_data 			= GatewayController::lead_to_be($method, $path, $param);
			if ($result_data[config('constants.response_code')] == config('constants.session_expired')) {
				return redirect()->route('logout');
			}
	
			return response($result_data['privilege_list']);
		} catch (\Throwable $th) {
			//throw $th;
		}
	}

  	// GET SUBGROUP LIST
  	public function subgroup_list(){
	    $method   		= 'GET';
	    $path     		= 'subgroup/list';
	    $param    		= array();
	    
	    $result_data 	= GatewayController::lead_to_be($method, $path, $param);
	    return response($result_data);
  	}

  	// GET SUBGROUP PRIVILEGE
  	public function subgroup_privilege(Request $request){
	    $method   		= 'POST';
		$path 	  		= 'subgroup/privilege';

	    $subgroup_name 	= $request->input('subgroup_name');
	    
	    if($subgroup_name != ''){
	      	$param['subgroup_name'] = $subgroup_name; 
	    }
	    else{
	      	$param['subgroup_name'] = ''; 
	    }

	    $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return response($result_data);
  	}

  	// ADD SUBGROUP
  	public function subgroup_add(Request $request){
	    $method       		  	= 'POST';

	    $group_id             	= $request->input('group_id');
	    $subgroup_name        	= $request->input('subgroup_name');
	    $subgroup_description 	= $request->input('subgroup_description');
	    $privilege_list       	= $request->input('privilege_list');
		$privilege_menu 	  	= $request->get('privilege_menu');

		// REQUEST PARAMETER
		$param['group_id']             = $group_id;
		$param['subgroup_name']        = $subgroup_name;
		$param['subgroup_description'] = $subgroup_description;
		$param['privilege_list']       = $privilege_list;

		// CHECK BYPASS PRIVILEGE
	    // if($privilege_menu['Subgroup Setup - Bypass']){
		   //  $path	= 'subgroup/add';
	    // }
	    // else{
	    	$path   = 'subgroup/request';
		    $reason = $request->input('reason');

			if($reason == null){
		    	$reason = "";
		    }

		    // REQUEST PARAMETER
			$param['request_type_name']		= 'ADD';
			$param['request_status_name']	= 'PENDING';
			$param['reason']				= $reason;
	    // }

	    $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}

  	// DELETE SUBGROUP
  	public function subgroup_delete(Request $request){
		$method         			= 'POST';
	    $subgroup_name  			= $request->input('subgroup_name');
	    $privilege_menu 			= $request->get('privilege_menu');

	    // REQUEST PARAMETER
		$param['subgroup_name'] 	= $subgroup_name;
	    
	    // CHECK BYPASS PRIVILEGE
	    // if($privilege_menu['Subgroup Setup - Bypass']){
		   //  $path           		= 'subgroup/delete';
	    // }
	    // else{
	    	$path         			= 'subgroup/request';
	   		$group_id  				= $request->input('group_id');
	    	$subgroup_description 	= $request->input('subgroup_description');
			$privilege_list 		= $request->input('privilege_list');
	    	$reason  				= $request->input('reason');

	    	if($reason == null){
	    		$reason = "";
	    	}

	    	// REQUEST PARAMETER
	      	$param['group_id']    			= $group_id;
	      	$param['subgroup_description']	= $subgroup_description;
			$param['request_type_name']		= 'DELETE';
			$param['request_status_name']	= 'PENDING';
			$param['privilege_list']		= $privilege_list;
			$param['reason']				= $reason;
	    // }

	    $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
 	}

 	// UPDATE SUBGROUP
  	public function subgroup_update(Request $request){
		$method       		  	= 'POST';

	    $group_id             	= $request->input('group_id');
	    $subgroup_name        	= $request->input('subgroup_name');
	    $subgroup_description 	= $request->input('subgroup_description');
	    $privilege_list       	= $request->input('privilege_list');
		$privilege_menu 	  	= $request->get('privilege_menu');
		
		// REQUEST PARAMETER
	    $param['group_id']            	= $group_id;
		$param['subgroup_name']       	= $subgroup_name;
		$param['subgroup_description']	= $subgroup_description;
		$param['privilege_list']      	= $privilege_list;
	    
	    // CHECK BYPASS PRIVILEGE
	    // if($privilege_menu['Subgroup Setup - Bypass']){
		   //  $path         			= 'subgroup/update';
	    // }
	    // else{
	    	$path         			= 'subgroup/request';
		    // $request_subgroup_by	= Session::get('user_name');
	    	$reason  	  			= $request->input('reason');

	    	if($reason == null){
	    		$reason = "";
	    	}
	    	
	    	// REQUEST PARAMETER
	    	// $param['request_subgroup_by']	= $request_subgroup_by;
			$param['request_type_name']		= 'UPDATE';
			$param['request_status_name']	= 'PENDING';
			$param['reason']				= $reason;
		// }

	    $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}