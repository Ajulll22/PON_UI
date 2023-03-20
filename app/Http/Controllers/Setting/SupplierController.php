<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->menu     = "settings";
        $this->sub_menu = "supplier";
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

        return view('setting\supplier', ['data' => $data]);
    }

    public function get_all()
    {
        $method       	= 'GET';
	    $path     		= 'supplier/data';
        $param          = array();
	    $result_data 	= GatewayController::lead_to_be($method, $path, $param);

        return $result_data ;
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required',
            'active' => 'required'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "supplier/insert", $data);

        return $result_data;
    }

    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'active' => 'required'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "supplier/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "supplier/delete", $data);

        return $result_data;
    }
}
