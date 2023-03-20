<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RFPeriodController extends Controller
{
    public function __construct()
    {
        $this->menu     = "settings";
        $this->sub_menu = "rf-period";
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

        $method       	= 'GET';
	    $path     		= 'rf-period/config/data';
        $param          = array();
	    $result_data 	= GatewayController::lead_to_be($method, $path, $param);

        $data['rf_period'] = $result_data['data'];

        return view('setting\rf-period', ['data' => $data]);
    }

    public function get_all()
    {
        $method       	= 'GET';
	    $path     		= 'rf-period/data';
        $param          = array();
	    $result_data 	= GatewayController::lead_to_be($method, $path, $param);

        return $result_data ;
    }

    public function create(Request $request)
    {
        $rules = [
            'rf_id' => 'required',
            'active' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "rf-period/insert", $data);

        return $result_data;
    }

    public function update(Request $request)
    {
        $rules = [
            'rf_id' => 'required',
            'active' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date'
        ];
        $data = $request->all();
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return [
                'result' => 'error_validate',
                'message' => $validator->errors()
            ];
        }

        $result_data 	= GatewayController::lead_to_be("POST", "rf-period/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "rf-period/delete", $data);

        return $result_data;
    }
}
