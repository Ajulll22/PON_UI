<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GatewayController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Session;
use Log;

class DashboardController extends Controller
{
	public function __construct(){
	  $this->menu     = "dashboard";
	  $this->sub_menu = "";
	}

    public function index(Request $request)
    {
        Log::info('------------------ '.strtoupper($this->menu).' ------------------');

		$data["menu"]           			= $this->menu;
		$data["sub_menu"]       			= $this->sub_menu;
	  	$data['privilege_menu'] 			= $request->get('privilege_menu');
	  	$data['notification_list'] 			= $request->get('notification_list');
	  	$data['notification_type'] 			= $request->get('notification_type');
	  	$data['notification_data'] 			= $request->get('notification_data');
	  	$data['notification_count']			= $request->get('notification_count');
	  	$data['all_notification_length']	= count($data['notification_list']);
	  	// return $data['notification_list'];
	  	// return $request->all();

        Log::info(' ');
        if(!empty(Session::get('user_name'))){
    		return view('Dashboard/dashboard')->with('data',$data);
        }
        return redirect()->route('login');
    }

    public function data(Request $request)
    {
        $method                 = 'GET';
        $path                   = 'dashboard/data';
        $param                  = array();
        $result_data            = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }
}
