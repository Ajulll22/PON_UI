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
use Storage;
use Log;

class GroupSetupController extends Controller
{
    public function __construct(Request $request){
		$this->menu     = "user-management";
		$this->sub_menu = "group-setup";
  	}

    // VIEW
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

        // GET DATA FILTER
        $method                     = 'POST';
        $path                       = 'group/data-filter';
        $param['group_name']        = '';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        $data["data_filter"]        = $result_data['data_filter'];
        
        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

        // GET DATA FILTER TYPE
        $method                     = 'GET';
        $path                       = 'group/data-filter-type';
        $param                      = array();
        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        $data['data_filter_type']   = $result_data['data_filter_type'];
        
        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

        // GET PACKAGE LIST
        $path                       = 'package/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        $data['package_list']       = $result_data['package_list'];
        
        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

        // GET REASON LIST
        $path                       = 'reason/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        $data["reason_list"]        = $result_data['reason_list'];
        
        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }
        
        Log::info(' ');
        // VIEW WITH DATA
        return view('UserManagement/group')->with(
          'data', $data
        );
    }

    // GET GROUP LIST
    public function group_list(Request $request){
        $method         = 'GET';
        $path           = 'group/list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // GET GROUP DATA FILTER
    public function group_data_filter(Request $request){
        $group_name                 = $request->input('group_name');
        
        $method                     = 'POST';
        $path                       = 'group/data-filter';

        // $param['user_name']         = $user_name;
        
        if($group_name != ''){
            $param['group_name']    = $group_name;
        }
        else{
            $param['group_name']    = '';
        }

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // GET GROUP DATA FILTER FOR OPTION USER ADD
    public function group_data_filter_option(Request $request){
        $method                     = 'POST';
        $path                       = 'group/data-filter/option';
        $group_name                 = $request->input('group_name');
        
        if($group_name != ''){
            $param['group_name']    = $group_name;
        }
        else{
            $param['group_name']    = '';
        }

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // ADD GROUP
    public function group_add(Request $request){
        $method                         = 'POST';
        $path                           = 'group/request';

        $package_id                     = $request->input('package_id');
        $group_name                     = $request->input('group_name');
        $group_description              = $request->input('group_description');
        $group_active                   = 1;
        $data_filter                    = $request->input('data_filter');

        $privilege_menu                 = $request->get('privilege_menu');

        // REQUEST PARAMETER
        $param['package_id']            = $package_id;
        $param['group_name']            = $group_name;
        $param['group_description']     = $group_description;
        $param['group_active']          = $group_active;
        $param['data_filter']           = $data_filter;

        $reason         = $request->input('reason');
        if($reason == null){
            $reason = "";
        }

        // REQUEST PARAMETER
        $param['request_type_name']    = 'ADD';
        $param['request_status_name']  = 'PENDING';
        $param['reason']               = $reason;
        
        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // UPDATE GROUP
    public function group_update(Request $request){
        $method             = 'POST';
        $path               = 'group/request';

        $package_id         = $request->input('package_id');
        $group_name         = $request->input('group_name');
        $group_description  = $request->input('group_description');
        $group_active       = 1;
        $data_filter        = $request->input('data_filter');
        $reason             = $request->input('reason');
        
        // REQUEST PARAMETER
        $param['package_id']        = $package_id;
        $param['group_name']        = $group_name;
        $param['group_description'] = $group_description;
        $param['group_active']      = $group_active;
        $param['data_filter']       = $data_filter;

        // CHECK BYPASS PRIVILEGE

        if($reason == null){
            $reason = "";
        }

        // REQUEST PARAMETER
        $param['request_type_name']    = 'UPDATE';
        $param['request_status_name']  = 'PENDING';
        $param['reason']               = $reason;

        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // DELETE GROUP
    public function group_delete(Request $request){
        $method                     = 'POST';

        $group_name                 = $request->input('group_name');
        $privilege_menu             = $request->get('privilege_menu');

        // REQUEST PARAMETER
        $param['group_name']        = $group_name;

        $path               = 'group/request';
        $package_id         = $request->input('package_id');
        $group_description  = $request->input('group_description');
        $group_active       = 1;
        $data_filter        = $request->input('data_filter');
        $reason             = $request->input('reason');

        if($reason == null){
            $reason = "";
        }

        // REQUEST PARAMETER
        $param['package_id']            = $package_id;
        $param['group_description']     = $group_description;
        $param['group_active']          = $group_active;
        $param['request_type_name']     = 'DELETE';
        $param['request_status_name']   = 'PENDING';
        $param['data_filter']           = $data_filter;
        $param['reason']                = $reason;

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }
}