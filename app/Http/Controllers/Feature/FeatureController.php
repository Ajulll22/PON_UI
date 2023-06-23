<?php

namespace App\Http\Controllers\Feature;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\GatewayController;

class FeatureController extends Controller
{
    //
    public function __construct(){
	  $this->menu     = "settings";
	  $this->sub_menu = "feature";
	}

    public function index(Request $request)
    {
        Log::info('------------------ '.strtoupper($this->menu).' ------------------');

		$data["menu"]                       = $this->menu;
		$data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        Log::info(' ');
    	return view('Feature/feature')->with('data',$data);
    }

    public function feature_list(Request $request)
    {
        $method                 = 'GET';
        $path                   = 'feature/list';
        $param                  = array();
        $result_data            = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    public function feature_update(Request $request)
    {
        $method                 = 'POST';

        $feature_id             = $request->input('feature_id');
        $feature_name           = $request->input('feature_name');
        $feature_level          = $request->input('feature_level');
        // $privilege_menu         = $request->get('privilege_menu');
        
        // REQUEST PARAMETER
        $param['feature_id']    = $feature_id;
        $param['feature_name']  = $feature_name;
        $param['feature_level'] = $feature_level;

        // CHECK PRIVILEGE
        // if($privilege_menu['Package Setup - Bypass']){
            $path   = 'feature/set';
        // }
        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }
}
