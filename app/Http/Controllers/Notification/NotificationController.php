<?php

namespace App\Http\Controllers\Notification;

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

class NotificationController extends Controller
{
	public function __construct(){
		$this->menu     = "notification";
		$this->sub_menu = "";
  	}

    public function notification_view(Request $request){
        Log::info('------------------ '.strtoupper($this->menu).' ------------------');
        
    	$data["menu"]                       = $this->menu;
		$data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);
        
        Log::info(' ');
    	return view('Notification/notification-list')->with('data',$data);
    }

    // GET USER LIST
    public function notification_list(Request $request){
        $method                             = 'GET';
        $path                               = 'notification/list';
        $param                              = array();
        $result_data                        = GatewayController::lead_to_be($method, $path, $param);
        $result_data['notification_data']   = $request->get('notification_datatable');

        if ($result_data[config('constants.response_code')]==config('constants.session_expired')||
            $result_data[config('constants.response_code')]==config('constants.unauthorized_token')||
            $result_data[config('constants.response_code')]==config('constants.invalid_token')) {
            return redirect()->route('logout')->setStatusCode(401);
        }

        return $result_data;
    }
}
