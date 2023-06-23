<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostCentreController extends Controller
{
    public function __construct(){
        $this->menu     = "settings";
        $this->sub_menu = "cost-centre";
    }

    public function index(Request $request) {
        $data['menu'] = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        $cost_centre_list 	= GatewayController::lead_to_be("GET", "cost-centre/data", []);
        // dd($cost_centre_list);

        $data["cost_centre_list"] = $cost_centre_list['data'];

        return view('setting\cost-centre', [ 'data' => $data ]);
    }

    public function get_all()
    {
        $cost_centre_list 	= GatewayController::lead_to_be("GET", "cost-centre/data", []);

        return $cost_centre_list ;
    }

    public function get_child(Request $request)
    {
        $cost_centre_child 	= GatewayController::lead_to_be("POST", "cost-centre/child-data", [
            "cost_centre_id" => $request->input("cost_centre_id")
        ]);

        return $cost_centre_child ;
    }

    public function create(Request $request)
    {
        $rules = [
            'cost_centre_name' => 'required',
            'cost_centre_number' => 'required',
            'cost_centre_code' => 'required',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "cost-centre/insert", $data);

        return $result_data;
    }

    public function update(Request $request)
    {
        $rules = [
            'cost_centre_name' => 'required',
            'cost_centre_number' => 'required',
            'cost_centre_code' => 'required',
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "cost-centre/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "cost-centre/delete", $data);

        return $result_data;
    }
}
