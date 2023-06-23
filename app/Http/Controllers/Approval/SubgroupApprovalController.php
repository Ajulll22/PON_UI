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

class SubgroupApprovalController extends Controller
{
	public function __construct(){
		$this->menu     = "approval";
		$this->sub_menu = "subgroup-approval";
	}

    public function sub_group(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
    	
	    $data["menu"]           			= $this->menu;
	    $data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	// $data['notification_list'] 			= $request->get('notification_list');
	  	// $data['notification_type'] 			= $request->get('notification_type');
	  	// $data['notification_data'] 			= $request->get('notification_data');
	  	// $data['notification_count']			= $request->get('notification_count');
	  	// $data['all_notification_length']	= count($data['notification_list']);
	    
	    $method   				= 'GET';
	    $path     				= 'reason/list';
	    $param    				= array();
	    $result_data 			= GatewayController::lead_to_be($method, $path, $param);
	    if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"] 	= $result_data['reason_list'];
	    
        Log::info(' ');
	    return view('Approval/sub-group')->with('data',$data);
	}

	public function subgroup_list(Request $request){
		$method   = 'GET';
		$path     = 'subgroup/list/approval';
		$param    = array();

		$result_data = GatewayController::lead_to_be($method, $path, $param);
		return $result_data;
  	}

  	 public function subgroup_approval(Request $request){
	    $method      			= 'POST';
	    $path         			= 'subgroup/approval';

	    $group_id 				= $request->input('group_id');
	    $group_name 			= $request->input('group_name');
	    $subgroup_name 			= $request->input('subgroup_name');
	    $approval_subgroup_by 	= Session::get('user_name');
	    $request_type_name 		= $request->input('request_type_name');
	    $request_status_name 	= $request->input('request_status_name');
	    $reason 				= $request->input('reason');

	    if ($reason==null) {
	    	$reason="";
	    }
		$param['group_id']    			= $group_id;
		$param['group_name']    		= $group_name;
		$param['subgroup_name']    		= $subgroup_name;
		$param['approval_subgroup_by']	= $approval_subgroup_by;
		$param['request_type_name'] 	= $request_type_name;
		$param['request_status_name'] 	= $request_status_name;
		$param['reason'] 				= $reason;

		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}

  	public function subgroup_privilege(Request $request){
	    $method       			= 'POST';
		$path         			= 'subgroup/privilege/request';
		$subgroup_name 			= $request->input('subgroup_name');
		$param['subgroup_name'] = $subgroup_name;
		 
		$result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}
