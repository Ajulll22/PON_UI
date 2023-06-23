<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckPrivilege{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public $attributes;

    public function handle($request, Closure $next, $privilege_code=""){   
        try{
            Log::debug('------------------ Middleware Check Privilege ------------------');
            $access_id    = array();
            $access       = array();

            $notification_type['USER']          = false;
            $notification_type['SUBGROUP']      = false;
            $notification_type['GROUP']         = false;
            $notification_type['PACKAGE']       = false;
            $notification_type['PON-REQUEST']   = false;

            $notification_data['USER']          = array();
            $notification_data['SUBGROUP']      = array();
            $notification_data['GROUP']         = array();
            $notification_data['PACKAGE']       = array();
            $notification_data['PON-REQUEST']   = array();

            $notification_datatable             = array();

            $notification_count['USER']         = 0;
            $notification_count['SUBGROUP']     = 0;
            $notification_count['GROUP']        = 0;
            $notification_count['PACKAGE']      = 0;
            $notification_count['PON-REQUEST']  = 0;

            if(Session::get('privilege_access')==null){
                $method                     = 'POST';
                $path                       = 'subgroup/privilege';
                $param['subgroup_name']     = '';
                $result_data                = GatewayController::lead_to_be($method, $path, $param, 'skip_log');

                if($result_data[config('constants.response_code')]==config('constants.expired_token')||
                    $result_data[config('constants.response_code')]==config('constants.unauthorized_token')||
                    $result_data[config('constants.response_code')]==config('constants.invalid_token')) {
                    return redirect()->route('logout')->setStatusCode(401);
                }

                if($result_data[config('constants.result')]=='SUCCESS'){
                    foreach($result_data['privilege_list'] as $key => $value){
                        $access[$value['privilege_code']]=false;
                    }
                    Session::put('privilege_access', $access);
                }
            }
            else{
                $access = Session::get('privilege_access');
            }

            $subgroup_name          = Session::get('subgroup_name');
            $method                 = 'POST';
            $path                   = 'subgroup/privilege';
            $param['subgroup_name'] = $subgroup_name;
            $result_data            = GatewayController::lead_to_be($method, $path, $param, 'skip_log');

            if($result_data[config('constants.response_code')] == config('constants.expired_token') ||
                $result_data[config('constants.response_code')] == config('constants.unauthorized_token') ||
                $result_data[config('constants.response_code')] == config('constants.invalid_token')){
                return redirect()->route('logout')->setStatusCode(401);
            }

            if($result_data[config('constants.result')] == 'SUCCESS'){
                foreach($result_data['privilege_list'] as $key => $value){
                    if(array_key_exists($value['privilege_code'], $access)){
                        $access[$value['privilege_code']] = true;
                        array_push($access_id, $value['privilege_code']);
                    }
                }
            }

            // // NOTIFICATION
            // $method         = 'GET';
            // $path           = 'notification/list';
            // $param          = array();
            // $result_data    = GatewayController::lead_to_be($method, $path, $param, 'skip_log');

            // if($result_data[config('constants.response_code')] == config('constants.expired_token') ||
            //     $result_data[config('constants.response_code')] == config('constants.unauthorized_token') ||
            //     $result_data[config('constants.response_code')] == config('constants.invalid_token')){
            //     return redirect()->route('logout')->setStatusCode(401);
            // }

            // if($result_data[config('constants.result')] == 'SUCCESS'){
            //     $notification = $result_data['notification_list'];
            //     foreach($result_data['notification_list'] as $key => $value) {
            //         if(in_array(config('constants.USER_APR_VIEW'), $access_id)){
            //             if($value['data_type'] == 'USER'){
            //                 // USER HAS USER ADD APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.USER_ADD_APR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS USER ADD CHECKER PRIVILEGE
            //                 if(in_array(config('constants.USER_ADD_CKR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS USER EDIT APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.USER_EDIT_APR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS USER EDIT CHECKER PRIVILEGE
            //                 if(in_array(config('constants.USER_EDIT_CKR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS USER DELETE APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.USER_DEL_APR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS USER DELETE CHECKER PRIVILEGE
            //                 if(in_array(config('constants.USER_DEL_CKR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['USER']          = true;
            //                             $notification_data['USER'][]        = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['USER']++;
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //         if(in_array(config('constants.SUBGROUP_APR_VIEW'), $access_id)){
            //             if($value['data_type'] == 'SUBGROUP'){
            //                 // USER HAS SUBGROUP ADD APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_ADD_APR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS SUBGROUP ADD CHECKER PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_ADD_CKR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS SUBGROUP EDIT APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_EDIT_APR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS SUBGROUP EDIT CHECKER PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_EDIT_CKR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS SUBGROUP DELETE APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_DEL_APR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS SUBGROUP DELETE CHECKER PRIVILEGE
            //                 if(in_array(config('constants.SUBGROUP_DEL_CKR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['SUBGROUP']      = true;
            //                             $notification_data['SUBGROUP'][]    = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['SUBGROUP']++;
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //         if(in_array(config('constants.GROUP_APR_VIEW'), $access_id)){
            //             if($value['data_type'] == 'GROUP'){
            //                 // USER HAS GROUP ADD APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.GROUP_ADD_APR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS GROUP ADD CHECKER PRIVILEGE
            //                 if(in_array(config('constants.GROUP_ADD_CKR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS GROUP EDIT APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.GROUP_EDIT_APR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS GROUP EDIT CHECKER PRIVILEGE
            //                 if(in_array(config('constants.GROUP_EDIT_CKR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS GROUP DELETE APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.GROUP_DEL_APR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS GROUP DELETE CHECKER PRIVILEGE
            //                 if(in_array(config('constants.GROUP_DEL_CKR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['GROUP']         = true;
            //                             $notification_data['GROUP'][]       = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['GROUP']++;
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //         if(in_array(config('constants.PACKAGE_APR_VIEW'), $access_id)){
            //             if($value['data_type'] == 'PACKAGE'){
            //                 // USER HAS PACKAGE ADD APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_ADD_APR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PACKAGE ADD CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_ADD_CKR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PACKAGE EDIT APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_EDIT_APR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PACKAGE EDIT CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_EDIT_CKR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PACKAGE DELETE APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_DEL_APR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PACKAGE DELETE CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PACKAGE_DEL_CKR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PACKAGE']       = true;
            //                             $notification_data['PACKAGE'][]     = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PACKAGE']++;
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //         if(in_array(config('constants.PON_REQUEST_APR_VIEW'), $access_id)){
            //             if($value['data_type'] == 'PON-REQUEST'){
            //                 // USER HAS PON REQUEST ADD APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_ADD_APR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PON REQUEST ADD CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_ADD_CKR'), $access_id) && $value['request_type_name'] == 'ADD'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PON REQUEST EDIT APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_EDIT_APR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PON REQUEST EDIT CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_EDIT_CKR'), $access_id) && $value['request_type_name'] == 'UPDATE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PON REQUEST DELETE APPROVAL PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_DEL_APR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'VERIFIED'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                     else if($value['feature_level'] == 2){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //                 // USER HAS PON REQUEST DELETE CHECKER PRIVILEGE
            //                 if(in_array(config('constants.PON_REQUEST_DEL_CKR'), $access_id) && $value['request_type_name'] == 'DELETE'){
            //                     if($value['feature_level'] == 3){                                    
            //                         if($value['data_status'] == 'PENDING'){
            //                             $notification_type['PON-REQUEST']   = true;
            //                             $notification_data['PON-REQUEST'][] = $value;
            //                             $notification_datatable['result'][] = $value;
            //                             $notification_count['PON-REQUEST']++;
            //                         }
            //                     }
            //                 }
            //             }
            //         }
            //     }
            // }
            // else{
            //     log::debug("Failed to fetch notification data");
            // }

            if(count($access)!=0){
                if($privilege_code == "dashboard" || $privilege_code == "notification"){
                    $request->attributes->add(['privilege_menu'         => $access]);
                    // $request->attributes->add(['notification_list'      => $notification]);
                    // $request->attributes->add(['notification_type'      => $notification_type]);
                    // $request->attributes->add(['notification_data'      => $notification_data]);
                    // $request->attributes->add(['notification_datatable' => $notification_datatable]);
                    // $request->attributes->add(['notification_count'     => $notification_count]);
                    return $next($request);
                }
                else if(in_array($privilege_code, $access_id)){
                    $request->attributes->add(['privilege_menu'         => $access]);
                    // $request->attributes->add(['notification_list'      => $notification]);
                    // $request->attributes->add(['notification_type'      => $notification_type]);
                    // $request->attributes->add(['notification_data'      => $notification_data]);
                    // $request->attributes->add(['notification_datatable' => $notification_datatable]);
                    // $request->attributes->add(['notification_count'     => $notification_count]);
                    return $next($request);
                }
                else{
                    $error_msg =    '<div class="alert alert-danger" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Warning!</strong> You don\'t have permission</span>
                                        </div>
                                    </div>';
                    return redirect()->back()->withErrors([$error_msg])->setStatusCode(401);
                }
            }
            else{
                $error_msg =    '<div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="icon ion-ios-close alert-icon tx-32 mg-t-5 mg-xs-t-0"></i>
                                        <span><strong>Warning!</strong> You don\'t have permission</span>
                                    </div>
                                </div>';
                return redirect()->route('logout')->withErrors([$error_msg])->setStatusCode(401);
            }
        }
        catch(Exception $e){        
            $result_gateway['result']   = 'FAILED';
            $result_gateway['message']  = 'Login failed, please contact administrator !';
        }
    }

    public function check_token($result_data){
        if($result_data[config('constants.response_code')] == config('constants.expired_token') ||
            $result_data[config('constants.response_code')] == config('constants.unauthorized_token') ||
            $result_data[config('constants.response_code')] == config('constants.invalid_token')){
            return redirect()->route('logout');
        }
    }
}
