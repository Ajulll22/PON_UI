<?php

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClaimRequestController extends Controller
{
    public function __construct(Request $request)
    {
        $this->menu     = "claim";
        $this->sub_menu = "claim-request";
    }

    public function index(Request $request)
    {
        $data['menu'] = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);

        $currentPeriod     = GatewayController::lead_to_be("GET", "rf-period/current-period", []);
	    $currency 	= GatewayController::lead_to_be("GET", "currency/data", []);
        $claim_category     = GatewayController::lead_to_be("GET", "claim-item-category/data", []);

        $data['claim_category'] = $claim_category['data'];
        $data['currency'] = $currency['data'];
        $data['current-period'] = $currentPeriod ['data'];
        
        $data['cost_centre_id'] = Session::get('cost_centre_id');
        $data['cost_centre_name'] = Session::get('cost_centre_name');

        return view('claim\claim-request')->with('data', $data);
    }

    public function get_all()
    {
        $data     = GatewayController::lead_to_be("GET", "claim-request/data", []);

        return $data['data'];
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "claim-request/initiate", $data);

        return $result_data;
    }
}
