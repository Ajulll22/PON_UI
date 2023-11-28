<?php

return [
    // SERVER
    'api_server'            => 'http://192.168.202.152:8110/',
    // 'api_server'            => 'http://10.240.205.88:92/',
    // 'api_server'            => 'http://192.168.202.121:8110/',
    'local_url'             => 'http://localhost:8502/',
    // 'sms_gateway_server'    => 'http://175.103.48.29/', // Backend SMS Gateway
    'com_gateway'           => "http://192.168.202.152:5555/",

    // JWT
    'jwk'               =>'SUMV/uYzKMGe2jpKgH8ql40nYKq4IEDKG6e6X03JdaQ=',

    // APP DETAILS
    'version_app'       => 'version 1.1.2.0',           
    'app_name'          => 'Finance PON',
    'secret_key'        => 'ZSWa9XpLDLfHgScM1MQv2/wyCpfI9MyW',
    'secret_iv'         => '2y10iA8Gqt1tXQ1l',

    // EMAIL GATEWAY
    'sender'            => 'PT Prima Vista Solusi',
    'mailusername'      => 'nacmonitoring.wdnet@gmail.com',
    'midtid_token'      => '$2y$10$TzZlS4mF/WAIKqPo5S.XYuEhWyYs9y1MA2Ifr3BveaSGOqVDK3Yzu',
    'midtid_user_id'    => '318',

    'X-CLIENT-SECRET'           => '50565320504f4e2052657175657374323032332d30352d32332031313a32383a',
    'X-CLIENT-ID'               => '9df59306-0e26-439e-8d97-c5d0cf42edd7', 
    'X-PURPOSE'                 => 'Notification',

    // LOGGING
    // TO USE ADVANCE LOG WITH ALL DATA, REPLACE log_feature VALUE WITH TRUE
    'log_feature'       => true,

    // SMS GATEWAY
    // TO USE SMS SENDER SERVICE, REPLACE sms_feature VALUE WITH TRUE
    'sms_feature'       => false,
    'sms_user_id'       => 'PrimaVista',
    'sms_password'      => 'Pwd6788wqR',
    'sms_sc'            => 'WD-PVS',
    'sms_service_id'    => '1000',
    'sms_type'          => '0',

    // USER PERSO
    'perso_login'       => 'mahbub.alfarisi@wirecard.com',
    'perso_password'    => '1fcef377b9bbd9f6aa01ea93505e01dd3ffb5f1728cb87807dc31f9ee8c1c7b0',
    
    // RESPONSE
    'unauthorized_token'=> '75405',
    'session_expired'   => '70080',
    // 'invalid_token'   	=> '70205',
    'invalid_token'   	=> '70401',
    'expired_token'     => '75403',
    'session_success'   => 'SUCCESS',
    'result'            => 'result',
    'feature_level'     => 'feature_level',
    'message'           => 'message',
    'response_code'     => 'response_code',
    'token'             => 'token',

    // PACKAGE - Privilege Code
    'PACKAGE_VIEW'      => 'PACKAGE_VIEW',
    'PACKAGE_APR_VIEW'  => 'PACKAGE_APR_VIEW',
    'PACKAGE_ADD_MKR'   => 'PACKAGE_ADD_MKR',
    'PACKAGE_ADD_CKR'   => 'PACKAGE_ADD_CKR',
    'PACKAGE_ADD_APR'   => 'PACKAGE_ADD_APR',
    'PACKAGE_EDIT_MKR'  => 'PACKAGE_EDIT_MKR',
    'PACKAGE_EDIT_CKR'  => 'PACKAGE_EDIT_CKR',
    'PACKAGE_EDIT_APR'  => 'PACKAGE_EDIT_APR',
    'PACKAGE_DEL_MKR'   => 'PACKAGE_DEL_MKR',
    'PACKAGE_DEL_CKR'   => 'PACKAGE_DEL_CKR',
    'PACKAGE_DEL_APR'   => 'PACKAGE_DEL_APR',

    //GROUP - Privilege Code 
    'GROUP_VIEW'        => 'GROUP_VIEW',
    'GROUP_APR_VIEW'    => 'GROUP_APR_VIEW',
    'GROUP_ADD_MKR'     => 'GROUP_ADD_MKR',
    'GROUP_ADD_CKR'     => 'GROUP_ADD_CKR',
    'GROUP_ADD_APR'     => 'GROUP_ADD_APR',
    'GROUP_EDIT_MKR'    => 'GROUP_EDIT_MKR',
    'GROUP_EDIT_CKR'    => 'GROUP_EDIT_CKR',
    'GROUP_EDIT_APR'    => 'GROUP_EDIT_APR',
    'GROUP_DEL_MKR'     => 'GROUP_DEL_MKR',
    'GROUP_DEL_CKR'     => 'GROUP_DEL_CKR',
    'GROUP_DEL_APR'     => 'GROUP_DEL_APR',

    //SUBGROUP - Privilege Code 
    'SUBGROUP_VIEW'     => 'SUBGROUP_VIEW',
    'SUBGROUP_APR_VIEW' => 'SUBGROUP_APR_VIEW',
    'SUBGROUP_ADD_MKR'  => 'SUBGROUP_ADD_MKR',
    'SUBGROUP_ADD_CKR'  => 'SUBGROUP_ADD_CKR',
    'SUBGROUP_ADD_APR'  => 'SUBGROUP_ADD_APR',
    'SUBGROUP_EDIT_MKR' => 'SUBGROUP_EDIT_MKR',
    'SUBGROUP_EDIT_CKR' => 'SUBGROUP_EDIT_CKR',
    'SUBGROUP_EDIT_APR' => 'SUBGROUP_EDIT_APR',
    'SUBGROUP_DEL_MKR'  => 'SUBGROUP_DEL_MKR',
    'SUBGROUP_DEL_CKR'  => 'SUBGROUP_DEL_CKR',
    'SUBGROUP_DEL_APR'  => 'SUBGROUP_DEL_APR',

    //USER - Privilege Code 
    'USER_VIEW'         => 'USER_VIEW',
    'USER_APR_VIEW'     => 'USER_APR_VIEW',
    'USER_ADD_MKR'      => 'USER_ADD_MKR',
    'USER_ADD_CKR'      => 'USER_ADD_CKR',
    'USER_ADD_APR'      => 'USER_ADD_APR',
    'USER_EDIT_MKR'     => 'USER_EDIT_MKR',
    'USER_EDIT_CKR'     => 'USER_EDIT_CKR',
    'USER_EDIT_APR'     => 'USER_EDIT_APR',
    'USER_DEL_MKR'      => 'USER_DEL_MKR',
    'USER_DEL_CKR'      => 'USER_DEL_CKR',
    'USER_DEL_APR'      => 'USER_DEL_APR',
    'USER_RSTPASS_MKR'  => 'USER_RSTPASS_MKR',

    // AUDIT - Privilege Code
    'AUDIT_VIEW'        =>'AUDIT_VIEW',
    'AUDIT_DOWNLOAD'    =>'AUDIT_DOWNLOAD',
    
    // FEATURE - Privilege Code 
    'FEATURE_VIEW'      => 'FEATURE_VIEW',
    'FEATURE_ADD'       => 'FEATURE_ADD',
    'FEATURE_UPDATE'    => 'FEATURE_UPDATE',
    'FEATURE_DELETE'    => 'FEATURE_DELETE',

    // PON REQUEST - Privilege Code
    'PON_REQUEST_VIEW'      => 'PON_REQUEST_VIEW',
    'PON_REQUEST_APR_VIEW'  => 'PON_REQUEST_APR_VIEW',
    'PON_REQUEST_ADD_MKR'   => 'PON_REQUEST_ADD_MKR',
    'PON_REQUEST_ADD_CKR'   => 'PON_REQUEST_ADD_CKR',
    'PON_REQUEST_ADD_APR'   => 'PON_REQUEST_ADD_APR',
    'PON_REQUEST_EDIT_MKR'  => 'PON_REQUEST_EDIT_MKR',
    'PON_REQUEST_EDIT_CKR'  => 'PON_REQUEST_EDIT_CKR',
    'PON_REQUEST_EDIT_APR'  => 'PON_REQUEST_EDIT_APR',
    'PON_REQUEST_DEL_MKR'   => 'PON_REQUEST_DEL_MKR',
    'PON_REQUEST_DEL_CKR'   => 'PON_REQUEST_DEL_CKR',
    'PON_REQUEST_DEL_APR'   => 'PON_REQUEST_DEL_APR',
];

?>