<?php

namespace App\Http\Controllers\PONRequest;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Mail;

class PONRequestController extends Controller
{
    public function __construct(Request $request){
      	$this->menu     = "pon-request";
      	$this->sub_menu = "";
  	}

  	// PON REQUEST VIEW
	public function pon_request_view(Request $request){
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        // GET REASON LIST
        $method                     = 'GET';
        $param                      = array();
        $path                       = 'reason/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if ($result_data[config('constants.response_code')] == config('constants.session_expired')) {
            return redirect()->route('logout');
        }

        $cost_centre = GatewayController::lead_to_be("POST", "cost-centre/child-data", ["cost_centre_id" => ""]);
        // dd($cost_centre);
        $currency 	= GatewayController::lead_to_be("GET", "currency/data", []);
        $supplier = GatewayController::lead_to_be("GET", "supplier/data", []);

        $data["cost_centre_list"] = $cost_centre["data"];
        $data["currency_list"] = $currency["data"];
        $data["supplier_list"] = $supplier["data"];
        $data["reason_list"]        = $result_data['reason_list'];

        // VIEW WITH DATA;
        return view('PONRequest/_pon-request')->with(
          	'data', $data
        );
  	}

    // PON REQUEST LIST
    public function pon_request_list(Request $request){
        $method         = 'GET';
        $path           = 'pon-request/list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        return response($result_data);
    }

    // PON REQUEST LIST BY STATUS
    public function pon_request_list_by_status(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/list-by-status';

        $status_data        = (int)$request->input('status_data');
        $param['status_id'] = $status_data;

        $result_data        = GatewayController::lead_to_be($method, $path, $param);

        return response($result_data);
    }

    // PON REQUEST LIST BY ID
    public function pon_request_list_by_id(Request $request){
        $method                     = 'POST';
        $path                       = 'pon-request/list-by-id';

        $pon_request_id             = (int)$request->input('pon_request_id');
        $param['pon_request_id']    = $pon_request_id;

        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return response($result_data);
    }

    // ADD PON REQUEST
    public function pon_request_add(Request $request){
        $method         = 'POST';
        $path           = 'pon-request/add';

        $user_id        = Session::get('user_id');

        $currency                       = (int)$request->input('currency');
        $cost_centre                    = (int)$request->input('cost_centre');
        $supplier                       = $request->input('supplier');
        $estimated_invoice_date         = $request->input('estimated_invoice_date');
        $file_list                      = $request->input('file_list');
        $investment_expenditure_reason  = $request->input('investment_expenditure_reason');
        $item_list                      = $request->input('item_list');
        $total_price                    = 0;

        foreach ($item_list as $item){
            $total_price = $total_price + ((float)$item['quantity'] * (float)$item['unit_price']);
        }

        $pic = 'Head of Finance';
        if ($total_price > 10000000 && $total_price < 100000000) {
            $pic = "Owner Representative";
        } else if ($total_price > 100000000) {
            $pic = "Top Management";
        }

        // REQUEST PARAMETER
        $param['pic']                           = $pic;
        $param['user_id']                       = $user_id;
        $param['currency']                      = $currency;
        $param['supplier']                      = $supplier;
        $param['cost_centre']                   = $cost_centre;
        $param['estimated_invoice_date']        = $estimated_invoice_date;
        $param['item_list']                     = $item_list;
        $param['total_price']                   = $total_price;
        $param['investment_expenditure_reason'] = $investment_expenditure_reason;
        $param['file_list']                     = $file_list;

        $result_data = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // UPDATE PON REQUEST
    public function pon_request_update(Request $request){
        $method         = 'POST';
        $path           = 'pon-request/update';

        $user_id        = Session::get('user_id');

        $subgroup_name  = Session::get('subgroup_name');
        // $pic            = '';

        // if ($subgroup_name == 'Finance Staff' || $subgroup_name == 'Administrator'){
        //     $pic = 'Head of Finance';
        // }
        // else if ($subgroup_name == 'Head of Finance'){
        //     $pic = 'Top Management';
        // }

        $pon_request_id                 = (int)$request->input('pon_request_id');
        $currency                       = (int)$request->input('currency');
        $cost_centre                    = (int)$request->input('cost_centre');
        $supplier                       = $request->input('supplier');
        $estimated_invoice_date         = $request->input('estimated_invoice_date');
        $file_list                      = $request->input('file_list');
        $investment_expenditure_reason  = $request->input('investment_expenditure_reason');
        
        // REQUEST PARAMETER
        $param['pon_request_id']                = $pon_request_id;
        // $param['pic']                           = $pic;
        $param['user_id']                       = $user_id;
        $param['currency']                      = $currency;
        $param['supplier']                      = $supplier;
        $param['cost_centre']                   = $cost_centre;
        $param['estimated_invoice_date']        = $estimated_invoice_date;
        $param['investment_expenditure_reason'] = $investment_expenditure_reason;
        $param['file_list']                     = json_decode($file_list, true);
        
        if ($supplier == 1) {
            $param['item_list'] = json_decode($request->input('item_list'), true);
            $result_data = GatewayController::lead_to_be($method, "pon-request-claim/update", $param);
        } else {
            $item_list                      = $request->input('item_list');
            $total_price                    = 0;
    
            foreach ($item_list as $item){
                $total_price = $total_price + ((float)$item['quantity'] * (float)$item['unit_price']);
            }
            $param['total_price']                   = $total_price;
            $param['item_list']                     = $item_list;
            $result_data = GatewayController::lead_to_be($method, $path, $param);
        }

        
        return $result_data;
    }

    // UPLOAD ATTACHMENT UPDATE
    public function fileUploadPostUpdate(Request $request)
    {
        // PON REQUEST ID
        $pon_request_id = $request->input('pon_request_id');

        // COUNT FILE
        $total = count($_FILES['pon_request_file_update']['name']);

        if ($total>0) {
            $specific_dir       = $pon_request_id;
            $destinationPath    = public_path('\\storage\\uploaded\\');

            // MAKE NEW TEMP DIRECTORY IF DOESN'T EXIST YET
            if (is_dir(public_path('\\storage\\temp\\')) === false){
                mkdir(public_path('\\storage\\temp\\'));
            }

            // MAKE DESTINATION CATEGORY IF DOESN'T EXIST YET OR REMOVE FILES INSIDE IF EXIST
            if (is_dir(public_path('\\storage\\uploaded\\'.$specific_dir)) === false){
                mkdir(public_path('\\storage\\uploaded\\'.$specific_dir));
            }
            else {
                array_map('unlink', glob($destinationPath.'\\'.$specific_dir.'\\'."*"));
            }

            // LOOP THROUGH EACH FILE
            for($i=0;$i<$total;$i++) {
                // GET TEMP FILE PATH
                $tmpFilePath    = $_FILES['pon_request_file_update']['tmp_name'][$i];

                if ($tmpFilePath != ""){
                    // SET NEW FILE PATH
                    $newFilePath = $destinationPath.'\\'.$specific_dir.'\\'.$_FILES['pon_request_file_update']['name'][$i];

                    // UPLOAD FILE TO TEMP DIR
                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        echo 'Success';
                    }
                }
            }
        }
    }

    // UPLOAD ATTACHMENT
    public function fileUploadPost(Request $request)
    {
        // PON REQUEST ID
        $pon_request_id = $request->input('pon_request_id');

        // COUNT FILE
        $total = 0;

        if (isset($_FILES['pon_request_file']['name'])) {
            $total = count($_FILES['pon_request_file']['name']);
            // LOOP THROUGH EACH FILE
            for($i=0;$i<$total;$i++) {
                // GET TEMP FILE PATH
                $tmpFilePath    = $_FILES['pon_request_file']['tmp_name'][$i];
                $specific_dir   = $pon_request_id;

                // MAKE NEW DIRECTORY IF DOESN'T EXIST YET
                if (is_dir(public_path('\\storage\\temp\\')) === false){
                    mkdir(public_path('\\storage\\temp\\'), 0777, true);
                }
                if (is_dir(public_path('\\storage\\uploaded\\'.$specific_dir)) === false){
                    mkdir(public_path('\\storage\\uploaded\\'.$specific_dir), 0777, true);
                }

                $destinationPath    = public_path('\\storage\\uploaded\\');

                if ($tmpFilePath != ""){
                    // SET NEW FILE PATH
                    $newFilePath = $destinationPath.'\\'.$specific_dir.'\\'.$_FILES['pon_request_file']['name'][$i];

                    // UPLOAD FILE TO TEMP DIR
                    move_uploaded_file($tmpFilePath, $newFilePath);
                }
            }
        }

    }

    // GET ATTACHMENT
    public function fileUploadGet(Request $request)
    {
        $pon_request_id = $request->input('pon_request_id');

        if (is_dir(public_path('\\storage\\uploaded\\'.$pon_request_id)) === true){
            $directory              = public_path('\\storage\\uploaded\\'.$pon_request_id);
            $scanned_directory      = array_diff(scandir($directory), array('..', '.'));

            $result_data['result']  = 'SUCCESS';
            $result_data['path']    = '\\storage\\uploaded\\'.$pon_request_id.'\\';
            foreach($scanned_directory as $file_name){
                $object                     = new \stdClass();
                $object->file_name          = $file_name;
                $array_file[]               = $object;
                $result_data['file_list']   = $array_file;
            }
        }
        else {
            $result_data['result']      = 'SUCCESS';
            $result_data['path']        = '\\storage\\uploaded\\'.$pon_request_id.'\\';
            $result_data['file_list']   = [];
        }

        return $result_data;
    }

    // DELETE PON REQUEST
    public function pon_request_delete(Request $request){
        $method         = 'POST';
        $path           = 'pon-request/delete';

        // REQUEST PARAMETER
        $pon_request_id = $request->input('pon_request_id');
        $user_name      = $request->input('user_name');

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $param['user_name']         = $user_name;

        $param['request_type_name']             = 'DELETE';
        $param['request_status_name']           = 'PENDING';

        $result_data = GatewayController::lead_to_be($method, $path, $param);
        return $result_data;
    }

    // COST CENTRE LIST
    public function cost_centre_list(Request $request){
        $method         = 'GET';
        $path           = 'pon-request/cost-centre-list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // CURRENCY LIST
    public function currency_list(Request $request){
        $method         = 'GET';
        $path           = 'pon-request/currency-list';
        $param          = array();
        $result_data    = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // ITEM LIST
    public function item_list(Request $request){
        $method         = 'POST';
        $path           = 'pon-request/item-list';

        // REQUEST PARAMETER
        $pon_request_id = (int)$request->input('pon_request_id');

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // ATTACMENT LIST
    public function attachment_list(Request $request){
        $method         = 'POST';
        $path           = 'pon-request/attachment-list';

        // REQUEST PARAMETER
        $pon_request_id = $request->input('pon_request_id');

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // APPROVE BY CHECKER (HEAD OF FINANCE)
    public function approve_by_checker(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/approval-by-checker';

        // REQUEST PARAMETER
        $pon_request_id     = (int)$request->input('pon_request_id');
        $approval_type      = 1;
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_checker_name  = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_checker_name  = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_checker_name  = $user_firstname;
        }

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $param['approval_type']     = $approval_type;
        $param['user_checker_name'] = $user_checker_name;
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }

    // REJECT BY CHECKER (HEAD OF FINANCE)
    public function reject_by_checker(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/approval-by-checker';

        // REQUEST PARAMETER
        $pon_request_id     = (int)$request->input('pon_request_id');
        $rejection_reason   = $request->input('rejection_reason');
        $approval_type      = 2;
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_checker_name  = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_checker_name  = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_checker_name  = $user_firstname;
        }

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $param['rejection_reason']  = $rejection_reason;
        $param['approval_type']     = $approval_type;
        $param['user_checker_name'] = $user_checker_name;
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }
    
    // FORWARD TO TOP MANAGEMENT BY CHECKER (HEAD OF FINANCE)
    public function forward_by_checker(Request $request){
        $method             = 'POST';
        $path               = 'pon-request/approval-by-checker';

        // REQUEST PARAMETER
        $pon_request_id     = (int)$request->input('pon_request_id');
        $approval_type      = 3;
        $user_firstname     = Session::get('user_firstname');
        $user_lastname      = Session::get('user_lastname');

        $user_checker_name  = '';
        if ($user_lastname != null || $user_lastname != ''){
            $user_checker_name  = $user_firstname.' '.$user_lastname;
        }
        else {
            $user_checker_name  = $user_firstname;
        }

        // REQUEST PARAMETER
        $param['pon_request_id']    = $pon_request_id;
        $param['approval_type']     = $approval_type;
        $param['user_checker_name'] = $user_checker_name;
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        return $result_data;
    }




    public function index(Request $request)
    {
        // MENU AND SUBMENU SIGNAGE
        $data["menu"]                       = $this->menu;
        $data["sub_menu"]                   = $this->sub_menu;
        $data['privilege_menu']             = $request->get('privilege_menu');
        // $data['notification_list']          = $request->get('notification_list');
        // $data['notification_type']          = $request->get('notification_type');
        // $data['notification_data']          = $request->get('notification_data');
        // $data['notification_count']         = $request->get('notification_count');
        // $data['all_notification_length']    = count($data['notification_list']);

        // GET REASON LIST
        $method                     = 'GET';
        $param                      = array();
        $path                       = 'reason/list';
        $result_data                = GatewayController::lead_to_be($method, $path, $param);

        if ($result_data[config('constants.response_code')] == config('constants.session_expired')) {
            return redirect()->route('logout');
        }

        $pon_list = GatewayController::lead_to_be("GET", "pon-request/list", []);

        $data["pon_request_list"] = $pon_list["pon_request_list"];
        $data["reason_list"]        = $result_data['reason_list'];

        // VIEW WITH DATA;
        return view('PONRequest/pon-request')->with(
          	'data', $data
        );
    }

}
