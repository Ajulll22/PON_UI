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
use Illuminate\Support\Facades\Session;

class PONRequestApprovalController extends Controller
{
    public function __construct(){
		$this->menu                 = "pon-request-approval";
		$this->sub_menu             = "";
	}

	public function pon_request_view(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        // GET REASON LIST
        $method                     = 'GET';
        $param                      = array();
	    $path     					= 'reason/list';
	    $result_data 				= GatewayController::lead_to_be($method, $path, $param);

        if ($result_data[config('constants.response_code')]==config('constants.session_expired')) {
            return redirect()->route('logout');
        }
	    
        $data["reason_list"] 		= $result_data['reason_list'];
        
	    return view('Approval/pon-request')->with(
            'data',$data
        );
	}

    // GET PON REQUEST LIST
    public function pon_request_list(Request $request){
        $method                     = 'GET';
        $path                       = 'pon-request/list/approval';
        $param                      = array();

        $result_data                = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    public function approve_pon(Request $request)
    {
        $data = $request->all();
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_approver_name = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_approver_name = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_approver_name = $user_firstname;
        }
        $data['user_approver_name']    = $user_approver_name;

        if (key_exists("claim_approval_note", $data)) {
            $data["claim_approval_note"] = json_decode($data["claim_approval_note"]);
            // return $data;
            $res = GatewayController::lead_to_be("POST", "pon-request-claim/approve", $data);
        } else {
            $res = GatewayController::lead_to_be("POST", "pon-request/approve", $data);
        }


        return $res;
    }

    // APPROVE BY APPROVER (TOP MANAGEMENT)
    public function approve_by_top_management(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/approval-by-top-management';

        // REQUEST PARAMETER
        $pon_request_id     = (int)$request->input('pon_request_id');
        $approval_type      = 1;
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_approver_name = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_approver_name = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_approver_name = $user_firstname;
        }

        // REQUEST PARAMETER
        $param['pon_request_id']        = $pon_request_id;
        $param['approval_type']         = $approval_type;
        $param['user_approver_name']    = $user_approver_name;
        $result_data                    = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // REJECT BY APPROVER (TOP MANAGEMENT)
    public function reject_by_top_management(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/approval-by-top-management';

        // REQUEST PARAMETER
        $pon_request_id     = (int)$request->input('pon_request_id');
        $rejection_reason   = $request->input('rejection_reason');
        $approval_type      = 2;
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_approver_name = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_approver_name = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_approver_name = $user_firstname;
        }

        // REQUEST PARAMETER
        $param['pon_request_id']        = $pon_request_id;
        $param['rejection_reason']      = $rejection_reason;
        $param['approval_type']         = $approval_type;
        $param['user_approver_name']    = $user_approver_name;
        $result_data                    = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }
}
