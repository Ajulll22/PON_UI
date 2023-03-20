<?php

namespace App\Http\Controllers\AuditTrail;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Session;
use Log;

class AuditTrailController extends Controller
{
	public function __construct(){
		$this->menu     = "settings";
		$this->sub_menu = "audit-trail";
  	}

    public function audit_trail(Request $request)
    {
        Log::info('------------------ '.strtoupper($this->sub_menu).' ------------------');
        
    	$data["menu"]                       = $this->menu;
		$data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);

        $method         = 'GET';
        $path           = 'user/list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.response_code')] == config('constants.session_expired')){
            return redirect()->route('logout');
        }

        $data['user_list']   = $result_data['user_list'];
        
        Log::info(' ');
    	return view('AuditTrail/audit-trail')->with('data',$data);
    }

    public function search_audit_trail(Request $request) 
    {
        $method                 = 'POST';
        $path                   = 'audit-trail/search';

        if ($request->input('date_time')!=null) {
            $year                   = substr($request->input('date_time'), 0,4);
            $month                  = substr($request->input('date_time'), 4,2);
            $day                    = substr($request->input('date_time'), 6,2);

            $param['date_time_real']= $request->input('date_time');
            $param['date_time']     = $year."-".$month."-".$day;
        }else{
            $param['date_time']     = '';
        }
        
        if ($request->input('user_name')!=null) {
            $param['user_name']     = $request->input('user_name');
        }else{
            $param['user_name']     = '';
        }

        if ($request->input('keyword')!=null) {
            $param['keyword']       = $request->input('keyword');
        }else{
            $param['keyword']       = '';
        }

        $result_gateway = GatewayController::lead_to_be($method, $path, $param);
        return response($result_gateway);        
    }
}
