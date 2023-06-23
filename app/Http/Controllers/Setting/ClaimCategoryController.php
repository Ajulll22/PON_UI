<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClaimCategoryController extends Controller
{
    public function __construct(){
        $this->menu     = "settings";
        $this->sub_menu = "claim-category";
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

        $method                     = 'GET';
        $param                      = array();
        $path                       = 'reason/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')]==config('constants.session_expired')){
            return redirect()->route('logout');
        }

        $approval_list = GatewayController::lead_to_be("GET", "claim-request-phase/approval-data", []);

        // dd($approval_list);

        $data["reason_list"]        = $result_data['reason_list'];
        $data["approval_list"]      = $approval_list['data'];

        return view('setting\claim-category', [ 'data' => $data ]);
    }
    
    public function create(Request $request) {
        $rules = [
            'name' => 'required|string',
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

        $result_data 	= GatewayController::lead_to_be("POST", "claim-item-category/insert", $data);

        return $result_data;
    }

    public function get_all(){
        $result_data 	= GatewayController::lead_to_be("GET", "claim-item-category/data", []);

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

        $result_data 	= GatewayController::lead_to_be("POST", "claim-item-category/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();
        $result_data 	= GatewayController::lead_to_be("POST", "claim-item-category/delete", $data);

        return $result_data;
    }

}