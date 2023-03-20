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
use Session;
use Log;

class GroupApprovalController extends Controller
{
    public function __construct(){
		$this->menu                 = "approval";
		$this->sub_menu             = "group-approval";
	}

	public function group(Request $request){
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
        
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
        if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
        $data['data_filter_type']   = $result_data['data_filter_type'];

        // GET PACKAGE LIST
        $path                       = 'package/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }
        $data['package_list']       = $result_data['package_list'];

        // GET REASON LIST
	    $path     					= 'reason/list';
	    $result_data 				= GatewayController::lead_to_be($method, $path, $param);
        if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    $data["reason_list"] 		= $result_data['reason_list'];
        
        Log::info(' ');
	    return view('Approval/group')->with('data',$data);
	}

    // GET GROUP LIST
    public function group_list(Request $request){
        $method                     = 'GET';
        $path                       = 'group/list/approval';
        $param                      = array();

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // GET GROUP DATA FILTER
    public function group_data_filter(Request $request){
        $method                     = 'POST';
        $path                       = 'group/data-filter/request';
        $param                      = array();

        $group_name                 = $request->input('group_name');
        
        if($group_name != ''){
            $param['group_name'] = $group_name;
        }
        else{
            $param['group_name'] = '';
        }

        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // Approval Group (Approve and Decline)
  	public function group_approval(Request $request){
	    $method       				= 'POST';
	    $path         				= 'group/approval';

	    $group_name 				= $request->input('group_name');
	    // $group_description 			= $request->input('group_description');

	    // $approval_group_by    		= Session::get('user_name');
	    $request_type_name 			= $request->input('request_type_name');
	    $request_status_name 		= $request->input('request_status_name');
	    $reason 					= $request->input('reason');

        if($reason == null){
            $reason = "";
        }

        $param['group_name']          = $group_name;
        // $param['group_description']   = $group_description;
        // $param['approval_group_by']   = $approval_group_by;
        $param['request_type_name']   = $request_type_name;
        $param['request_status_name'] = $request_status_name;
        $param['reason']              = $reason;
	    
        $result_data = GatewayController::lead_to_be($method, $path, $param);
	    return $result_data;
  	}
}
