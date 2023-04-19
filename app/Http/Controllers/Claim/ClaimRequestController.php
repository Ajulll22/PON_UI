<?php

namespace App\Http\Controllers\Claim;

use App\Http\Controllers\Controller;
use App\Http\Controllers\GatewayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ClaimRequestController extends Controller
{
    public function __construct()
    {
        $this->menu     = "claim";
        $this->sub_menu = "claim-request";
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

        $currentPeriod     = GatewayController::lead_to_be("GET", "rf-period/current-period", []);
	    $currency 	= GatewayController::lead_to_be("GET", "currency/data", []);
        $claim_category     = GatewayController::lead_to_be("GET", "claim-item-category/data", []);
        $pm_list     = GatewayController::lead_to_be("POST", "subgroup/user", [ "subgroup_name"=>"Project Management" ]);

        $data['claim_category'] = $claim_category['data'];
        $data['currency'] = $currency['data'];
        $data['current-period'] = $currentPeriod ['data'];
        $data['pm_list'] = $pm_list['data']["user_list"];

        return view('claim\claim-request')->with('data', $data);
    }

    public function get_all()
    {
        $data     = GatewayController::lead_to_be("GET", "claim-request/data", []);
        // dd($data);
        return $data['data'];
    }

    public function create(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $rf_name = $request->input('rf_name');
        $data['support_doc'] = [];
        $files = $request->file('support_doc');

        $path = "file/RF Period $rf_name/".Session::get('user_firstname')." ".Session::get('user_lastname') ;
        if(!File::isDirectory($path)){
            File::makeDirectory($path."/absensi", 0777, true, true);
        }

        if ($files) {
            foreach ($files as $key => $value) {
                $fileName = 'Absensi-'.time()."-". $key+1 . '.' . $value->extension();
                $value->move(public_path($path."/absensi"), $fileName);
                array_push( $data['support_doc'], $path. "/absensi"."/". $fileName );
            }
        }

        $nameFile = Session::get('user_firstname')." ".Session::get('user_lastname')."-".time();
        $nomor = 1;
        foreach ($data['claim_item_detail'] as $item) {
            
            if (file_exists(public_path('tmp/'.$item['claim_document'][0]))){
                $ext = File::extension('tmp/'.$item['claim_document'][0]);
                $file_name_last = "$path/".$nameFile."-".$nomor.".".$ext;
                File::copy(public_path(
                    'tmp/'.$item['claim_document'][0]),
                    $file_name_last
                );
                unlink(public_path('tmp/'.$item['claim_document'][0]));
                $data['claim_item_detail'][$nomor-1]['claim_document'][0] = $file_name_last;
            }

            
            $nomor++;
        }

        $result_data 	= GatewayController::lead_to_be("POST", "claim-request/initiate", $data);

        return $result_data;
    }

    public function update(Request $request)
    {
        $data_all = $request->all();
        $data = json_decode($data_all['data'], true);
        $rf_name = $data["rf_name"];
        $data['updated_by'] = Session::get('user_id');
        $nameFile = Session::get('user_firstname')." ".Session::get('user_lastname')."-".time();
        $path = "file/RF Period $rf_name/".Session::get('user_firstname')." ".Session::get('user_lastname') ;
        if(!File::isDirectory($path)){
            File::makeDirectory($path."/absensi", 0777, true, true);
        }
        if (array_key_exists("change_support_doc", $data_all)) {
            $changeSupportDoc = [];
            if (array_key_exists('support_doc', $data)) {
                foreach ($data["support_doc"] as $file_old) {
                    if (file_exists(public_path($file_old))) {
                        unlink(public_path($file_old));
                    }
                }
            }

            foreach ($data_all["change_support_doc"] as $key => $value) {
                $fileName = 'Absensi-'.time()."-". $key+1 . '.' . $value->extension();
                $value->move(public_path($path."/absensi"), $fileName);
                array_push( $changeSupportDoc, $path. "/absensi"."/". $fileName );
            }

            $data["support_doc"] = $changeSupportDoc;
        }
        $nomor = 1;
        foreach ($data['claim_item_detail'] as $key => $item) {
            $filename = $item['claim_document'][0]['filename'];
            $identy = explode("-", $filename);
            if ($identy[0] == "UploadTmp") {
                if (file_exists(public_path('tmp/'.$filename))){
                    $ext = File::extension('tmp/'.$filename);
                    $file_name_last = "$path/".$nameFile."-".$nomor.".".$ext;
                    File::copy(public_path(
                        'tmp/'.$filename),
                        $file_name_last
                    );
                    unlink(public_path('tmp/'.$filename));
                    $filename = $file_name_last;
                }
            }
            $data['claim_item_detail'][$key]['claim_document'] = [$filename];
        }
        $delete_document = $request->input('delete_document');
        if ($delete_document) {
            foreach ($delete_document as $file) {
                if (file_exists(public_path($file))){
                    unlink(public_path($file));
                }
            }
            unset($data['delete_document']);
        }
        $result_data 	= GatewayController::lead_to_be("POST", "claim-request/update", $data);

        return $result_data;
    }

    public function destroy(Request $request)
    {
        $data = $request->all();

        if (array_key_exists("delete_file_support", $data)) {
            foreach ($data["delete_file_support"] as $supportFile) {
                if (file_exists(public_path($supportFile["filename"]))) {
                    unlink(public_path($supportFile["filename"]));
                }
            }
        }
        if (array_key_exists("delete_file_claim", $data)) {
            foreach ($data["delete_file_claim"] as $claimFile) {
                if (file_exists(public_path($claimFile["claim_document"][0]["filename"]))) {
                    unlink(public_path($claimFile["claim_document"][0]["filename"]));
                }
            }
        }

        $result_data 	= GatewayController::lead_to_be("POST", "claim-request/delete", $data);

        return $result_data;
    }

    public function get_history(Request $request)
    {
        $data = $request->all();

        $result_data 	= GatewayController::lead_to_be("POST", "claim-request/history", $data);

        // dd($result_data);
        return $result_data;
    }
}
