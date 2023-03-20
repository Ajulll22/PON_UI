<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurrencyController extends Controller
{
    public function __construct(){
        $this->menu     = "settings";
        $this->sub_menu = "currency";
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
	    $path     		= 'currency/data';
        $param          = array();
	    $currency_list 	= GatewayController::lead_to_be($method, $path, $param);
        $data['currency_list'] = $currency_list['data'];

        return view('setting\currency', ['data' => $data]);
    }

    public function get_all()
    {
        $method       	= 'GET';
	    $path     		= 'currency/data';
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

        $result_data 	= GatewayController::lead_to_be("POST", "currency/insert", $data);

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

        $result_data 	= GatewayController::lead_to_be("POST", "currency/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "currency/delete", $data);

        return $result_data;
    }
}
