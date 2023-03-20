<?php

namespace App\Http\Controllers\Profile;

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

class ProfileController extends Controller
{
	public function __construct(){
		$this->menu     = "profile";
		$this->sub_menu = "";
  	}

    public function profile_view(Request $request){
        Log::info('------------------ '.strtoupper($this->menu).' ------------------');
        
    	$data["menu"]                       = $this->menu;
		$data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        $data['notification_list']          = $request->get('notification_list');
        $data['notification_type']          = $request->get('notification_type');
        $data['notification_data']          = $request->get('notification_data');
        $data['notification_count']         = $request->get('notification_count');
        $data['all_notification_length']    = count($data['notification_list']);

        $method       = 'POST';
        $path         = 'user/get-profile';

        $user_name   = Session::get('user_name');

        $bank_list            = GatewayController::lead_to_be("GET", "bank/data", []);
        $data['bank_list'] = $bank_list['data'];
        
        $param['user_name']     = $user_name;
        $result_data            = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.result')] == "SUCCESS"){
            $data['user_data'] = $result_data['user_data'];
            Log::info(' ');
        	return view('Profile/edit-profile')->with('data',$data);
        }
        else{
            Log::info(' ');
            return view('error/404');
        }
    }

    // UPDATE PROFILE
    public function update_profile(Request $request){
        $method             = 'POST';
        $path               = 'user/update-profile';

        $user_name          = $request->input('user_name');
        $user_firstname     = $request->input('user_firstname');
        $user_lastname      = $request->input('user_lastname');
        $user_description   = $request->input('user_description');
        $user_phone         = $request->input('user_phone');
        $user_address       = $request->input('user_address');
        $bank_id       = $request->input('bank_id');
        $account_name       = $request->input('account_name');
        $account_number       = $request->input('account_number');
        
        // REQUEST PARAMETER
        $param['user_name']         = $user_name;
        $param['user_firstname']    = $user_firstname;
        $param['user_lastname']     = $user_lastname;
        $param['user_description']  = $user_description;
        $param['user_phone']        = $user_phone;
        $param['user_address']      = $user_address;
        $param['bank_id']      = $bank_id;
        $param['account_name']      = $account_name;
        $param['account_number']      = $account_number;

        $result_data = GatewayController::lead_to_be($method, $path, $param);

        if($result_data[config('constants.result')] == "SUCCESS"){
            Session::put('user_name',           $user_name);
            Session::put('user_firstname',      $user_firstname);
            Session::put('user_lastname',       $user_lastname);

            return $result_data;
        }
        else{
            return $result_data;
        }
    }
}
