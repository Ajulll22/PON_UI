<?php

return [
    // SERVER
    'api_server'            => 'http://192.168.202.140:1112/',
    // 'sms_gateway_server'    => 'http://192.168.202.135:8090/',
    'sms_gateway_server'    => 'http://175.103.48.29/', // Backend SMS Gateway
    'local_url'         => 'http://192.168.7.40:4445/',

    // JWT
    'jwk'               =>'SUMV/uYzKMGe2jpKgH8ql40nYKq4IEDKG6e6X03JdaQ=',

    // APP DETAILS
    'version_app'       => '- version 1.0.0.0',           
    'app_name'          => 'Wirecard MCMS PADSS',
    'secret_key'        => 'ZSWa9XpLDLfHgScM1MQv2/wyCpfI9MyW',
    'secret_iv'         => '2y10iA8Gqt1tXQ1l',

    // EMAIL GATEWAY
    'sender'            => 'Wirecard',
    'mailusername'      => 'nacmonitoring.wdnet@gmail.com',
    'midtid_token'      => '$2y$10$TzZlS4mF/WAIKqPo5S.XYuEhWyYs9y1MA2Ifr3BveaSGOqVDK3Yzu',
    'midtid_user_id'    => '318',

    // LOGGING
    // TO USE ADVANCE LOG WITH ALL DATA, REPLACE log_feature VALUE WITH TRUE
    'log_feature'       => false,

    // SMS GATEWAY
    // TO USE SMS SENDER SERVICE, REPLACE sms_feature VALUE WITH TRUE
    'sms_feature'       => true,
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
    'invalid_token'   	=> '70205',
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

    // CARD MANAGEMENT - Privilege Code
    'CARD_VIEW'         => 'CARD_VIEW',
    'CARD_APR_VIEW'     => 'CARD_APR_VIEW',
    'CARD_ADD_MKR'      => 'CARD_ADD_MKR',
    'CARD_ADD_CKR'      => 'CARD_ADD_CKR',
    'CARD_ADD_APR'      => 'CARD_ADD_APR',
    'CARD_EDIT_MKR'     => 'CARD_EDIT_MKR',
    'CARD_EDIT_CKR'     => 'CARD_EDIT_CKR',
    'CARD_EDIT_APR'     => 'CARD_EDIT_APR',
    'CARD_DEL_MKR'      => 'CARD_DEL_MKR',
    'CARD_DEL_CKR'      => 'CARD_DEL_CKR',
    'CARD_DEL_APR'      => 'CARD_DEL_APR',

    // MERCHANT MANAGEMENT - Privilege Code
    'MERCHANT_VIEW'      => 'MERCHANT_VIEW',
    'MERCHANT_APR_VIEW'  => 'MERCHANT_APR_VIEW',
    'MERCHANT_ADD_MKR'   => 'MERCHANT_ADD_MKR',
    'MERCHANT_ADD_CKR'   => 'MERCHANT_ADD_CKR',
    'MERCHANT_ADD_APR'   => 'MERCHANT_ADD_APR',
    'MERCHANT_EDIT_MKR'  => 'MERCHANT_EDIT_MKR',
    'MERCHANT_EDIT_CKR'  => 'MERCHANT_EDIT_CKR',
    'MERCHANT_EDIT_APR'  => 'MERCHANT_EDIT_APR',
    'MERCHANT_DEL_MKR'   => 'MERCHANT_DEL_MKR',
    'MERCHANT_DEL_CKR'   => 'MERCHANT_DEL_CKR',
    'MERCHANT_DEL_APR'   => 'MERCHANT_DEL_APR',

    // MID GENERATION - Privilege Code
    'MID_VIEW'          => 'MID_VIEW',
    'MID_GEN'           => 'MID_GEN',
    'MID_DEACTIVATE'    => 'MID_DEACTIVATE',
    'MID_REACTIVATE'    => 'MID_REACTIVATE',

    // TID GENERATION - Privilege Code
    'TID_VIEW'          => 'TID_VIEW',
    'TID_GEN'           => 'TID_GEN',
    'TID_DEACTIVATE'    => 'TID_DEACTIVATE',
    'TID_REACTIVATE'    => 'TID_REACTIVATE',

    // TERMINAL MANAGEMENT - Privilege Code
    'TERMINAL_VIEW'      => 'TERMINAL_VIEW',
    'TERMINAL_APR_VIEW'  => 'TERMINAL_APR_VIEW',
    'TERMINAL_ADD_MKR'   => 'TERMINAL_ADD_MKR',
    'TERMINAL_ADD_CKR'   => 'TERMINAL_ADD_CKR',
    'TERMINAL_ADD_APR'   => 'TERMINAL_ADD_APR',
    'TERMINAL_EDIT_MKR'  => 'TERMINAL_EDIT_MKR',
    'TERMINAL_EDIT_CKR'  => 'TERMINAL_EDIT_CKR',
    'TERMINAL_EDIT_APR'  => 'TERMINAL_EDIT_APR',
    'TERMINAL_DEL_MKR'   => 'TERMINAL_DEL_MKR',
    'TERMINAL_DEL_CKR'   => 'TERMINAL_DEL_CKR',
    'TERMINAL_DEL_APR'   => 'TERMINAL_DEL_APR',
];

?>