<?php

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClaimApprovalController extends Controller
{
    public function __construct()
    {
        $this->menu     = "claim";
        $this->sub_menu = "claim-approval";
    }

    public function index(Request $request)
    {
        $data['menu']                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        $claim_list = GatewayController::lead_to_be("GET", "claim-request/approval/list", []);
        $data['claim_list'] = [];
        if ($claim_list['result'] == "SUCCESS") {
            $data['claim_list'] = $claim_list['data'];
        }
        $claim_category     = GatewayController::lead_to_be("GET", "claim-item-category/data", []);

        $data['claim_category'] = $claim_category['data'];

        return view('claim\claim-approval')->with('data', $data);
    }

    public function get_all()
    {
        $claim_list = GatewayController::lead_to_be("GET", "claim-request/approval/list", []);
        
        return $claim_list;
    }

    public function claim_action(Request $request)
    {
        $action = $request->input("action");

        $data = [
            "claim_request_id" => $request->input("claim_request_id")
        ];
        if ($action == "reject") {
            $data["reason"] = $request->input("reason");
        }

        $res = GatewayController::lead_to_be("POST", "claim-request/$action", $data);

        return $res;
    }
}
