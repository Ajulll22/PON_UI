<?php

namespace App\Http\Controllers\RegionalOps;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;

class JakartaOpsController extends Controller
{
    public function __construct(Request $request){
        $this->menu     = "regional-ops";
        $this->sub_menu = "ops-jakarta";
    }

    public function index(Request $request)
    {
        $data['menu'] = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        $method         = 'GET';
        $path           = 'pon-request/cost-centre-list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        $data['cost_centre_data'] = $result_data['cost_centre_list'];

        return view('claim\index')->with('data', $data);
    }
}
