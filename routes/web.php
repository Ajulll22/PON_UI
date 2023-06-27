<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH

use App\Http\Controllers\Claim\ClaimApprovalController;
use App\Http\Controllers\Claim\ClaimProcessingController;
use App\Http\Controllers\Claim\ClaimRequestController;
use App\Http\Controllers\PONRequest\PONRequestController;
use App\Http\Controllers\Setting\ClaimCategoryController;
use App\Http\Controllers\Setting\CostCentreController;
use App\Http\Controllers\Setting\CurrencyController;
use App\Http\Controllers\Setting\RFPeriodController;
use App\Http\Controllers\Setting\SupplierController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

Route::get('/cobacoba', 'PasswordController@cobacoba');
Route::get('/',											'LoginController@index')->name('login');
Route::post('/login-process',							['uses' => 'LoginController@login_process'])->name('login-process');
Route::get('/logout',									['uses' => 'LoginController@logout_process'])->name('logout');
Route::get('/forbidden',								['uses' => 'LoginController@forbidden'])->name('forbidden');

// FORGOT PASSWORD
Route::get('/forgot-password',							['uses' => 'PasswordController@forgot_password'])->name('forgot-password');
Route::post('/forgot-password-process',					['uses' => 'PasswordController@forgot_password_process'])->name('forgot-password-process');

// Update

Route::group(["prefix" => "claim-request"],	function () {
	Route::get("/", 							[ClaimRequestController::class, 'index'])->middleware('privilege:CLAIM_REQUEST_PUSAT_VIEW')->name('claim_request');
	Route::get("/list", 							[ClaimRequestController::class, 'get_all'])->name('claim_request_list');
	Route::post("/", 							[ClaimRequestController::class, 'create'])->middleware('privilege:CLAIM_REQUEST_PUSAT_ADD')->name('claim_request_create');
	Route::post("/update", 							[ClaimRequestController::class, 'update'])->middleware('privilege:CLAIM_REQUEST_PUSAT_UPDATE')->name('claim_request_update');
	Route::post("/delete", 		[ClaimRequestController::class, 'destroy'])->middleware('privilege:CLAIM_REQUEST_PUSAT_DELETE')->name('claim_request_delete');
	Route::post("/history", 		[ClaimRequestController::class, 'get_history'])->name('claim_request_history');
	Route::post("/cancel", 		[ClaimRequestController::class, 'cancel_submit'])->name('claim_request_cancel');
});

Route::group(["prefix" => "claim-approval"],	function () {
	Route::get("/", 							[ClaimApprovalController::class, 'index'])->middleware('privilege:CLAIM_APPROVAL_PUSAT_VIEW')->name('claim_approval');
	Route::get("/list", 							[ClaimApprovalController::class, 'get_all'])->name('claim_approval_list');
	Route::post("/action", 							[ClaimApprovalController::class, 'claim_action'])->name('claim_approval_action');
});

Route::group(["prefix" => "claim-processing"],	function () {
	Route::get("/", 							[ClaimProcessingController::class, 'index'])->middleware('privilege:CLAIM_PROCESSING_VIEW')->name('claim_processing');
	Route::get("/list", 							[ClaimProcessingController::class, 'get_all'])->middleware('privilege:CLAIM_PROCESSING_VIEW')->name('claim_processing_list');
	Route::post("/initiate", 							[ClaimProcessingController::class, 'initiate_claim'])->middleware('privilege:CLAIM_PROCESSING_VIEW')->name('claim_processing_initiate');
	Route::post("/close", 							[ClaimProcessingController::class, 'close_claim'])->middleware('privilege:CLAIM_PROCESSING_VIEW')->name('claim_processing_close');
	Route::get("/generate-csv/{id}", 							[ClaimProcessingController::class, 'GenerateCSV'])->name('claim_processing_csv');
	Route::get("/generate-autopay/{id}", 							[ClaimProcessingController::class, 'GenerateAutoPay'])->name('claim_processing_autopay');
	Route::get("/generate-pp/{id}", 							[ClaimProcessingController::class, 'GeneratePP'])->name('claim_processing_pp');
	Route::get("/download-zip/{id}", 							[ClaimProcessingController::class, 'DownloadZip'])->name('claim_processing_zip');
});

// Setting
Route::get("/setting/cost-centre", 			[CostCentreController::class, 'index'])->middleware('privilege:COST_CENTRE_VIEW')->name('cost_centre');
Route::get("/setting/cost-centre-list", 		[CostCentreController::class, 'get_all'])->name('cost_centre_list');
Route::post("/setting/cost-centre-child", 		[CostCentreController::class, 'get_child'])->name('cost_centre_child');
Route::post("/setting/cost-centre", 		[CostCentreController::class, 'create'])->middleware('privilege:COST_CENTRE_ADD')->name('cost_centre_create');
Route::put("/setting/cost-centre", 		[CostCentreController::class, 'update'])->middleware('privilege:COST_CENTRE_UPDATE')->name('cost_centre_update');
Route::post("/setting/cost-centre-delete", 		[CostCentreController::class, 'destroy'])->middleware('privilege:COST_CENTRE_DELETE')->name('cost_centre_delete');

Route::get("/setting/claim-category", 		[ClaimCategoryController::class, 'index'])->middleware('privilege:CLAIM_CATEGORY_VIEW')->name('claim_category');
Route::get("/setting/claim-category-list", 		[ClaimCategoryController::class, 'get_all'])->name('claim_category_list');
Route::post("/setting/claim-category-delete", 		[ClaimCategoryController::class, 'destroy'])->middleware('privilege:CLAIM_CATEGORY_DELETE')->name('claim_category_delete');
Route::post("/setting/claim-category", 		[ClaimCategoryController::class, 'create'])->middleware('privilege:CLAIM_CATEGORY_ADD')->name('claim_category_create');
Route::put("/setting/claim-category", 		[ClaimCategoryController::class, 'update'])->middleware('privilege:CLAIM_CATEGORY_UPDATE')->name('claim_category_update');

Route::get("/setting/currency", 			[CurrencyController::class, 'index'])->middleware('privilege:CURRENCY_VIEW')->name('currency');
Route::get("/setting/currency-list", 		[CurrencyController::class, 'get_all'])->name('currency_list');
Route::post("/setting/currency-delete", 		[CurrencyController::class, 'destroy'])->middleware('privilege:CURRENCY_DELETE')->name('currency_delete');
Route::post("/setting/currency", 		[CurrencyController::class, 'create'])->middleware('privilege:CURRENCY_ADD')->name('currency_create');
Route::put("/setting/currency", 		[CurrencyController::class, 'update'])->middleware('privilege:CURRENCY_UPDATE')->name('currency_update');

Route::get("/setting/supplier", 			[SupplierController::class, 'index'])->middleware('privilege:SUPPLIER_VIEW')->name('supplier');
Route::get("/setting/supplier-list", 		[SupplierController::class, 'get_all'])->name('supplier_list');
Route::post("/setting/supplier-delete", 		[SupplierController::class, 'destroy'])->middleware('privilege:SUPPLIER_DELETE')->name('supplier_delete');
Route::post("/setting/supplier", 		[SupplierController::class, 'create'])->middleware('privilege:SUPPLIER_ADD')->name('supplier_create');
Route::put("/setting/supplier", 		[SupplierController::class, 'update'])->middleware('privilege:SUPPLIER_UPDATE')->name('supplier_update');

Route::get("/setting/rf-period", 			[RFPeriodController::class, 'index'])->middleware('privilege:RF_PERIOD_VIEW')->name('rf_period');
Route::post("/setting/rf-period-delete", 		[RFPeriodController::class, 'destroy'])->middleware('privilege:RF_PERIOD_DELETE')->name('rf_period_delete');
Route::post("/setting/rf-period", 		[RFPeriodController::class, 'create'])->middleware('privilege:RF_PERIOD_ADD')->name('rf_period_create');
Route::put("/setting/rf-period", 		[RFPeriodController::class, 'update'])->middleware('privilege:RF_PERIOD_UPDATE')->name('rf_period_update');
Route::get("/setting/rf-period-list", 		[RFPeriodController::class, 'get_all'])->name('rf_period_list');

// UTILITY
Route::post('/encrypt-decrypt',							['uses' => 'UtilityController@encrypt_decrypt'])->name('encrypt-decrypt');
Route::post("/upload-item",					'UtilityController@UploadToTemp')->name('upload_item');
Route::post("/delete-item",					'UtilityController@DeleteFromTemp')->name('delete_item');
Route::get("/generate",					[UtilityController::class, 'generate'])->name('generate');
Route::get("/generate-csv",					[UtilityController::class, 'GenerateCSV'])->name('generate_csv');
Route::get("/generate-autopay",					[UtilityController::class, 'GenerateAutoPay'])->name('generate_autopay');

// SET NEW PASSWORD AFTER FORGOT PASSWORD
Route::get('/set-new-password',							['uses' => 'PasswordController@set_new_password'])->middleware('privilege:dashboard')->name('set-password');
Route::post('/set-new-password-process',				['uses' => 'PasswordController@set_new_password_process'])->name('set-new-password-process');

// CHANGE PASSWORD
Route::get('/change-password',							['uses' => 'PasswordController@change_password'])->name('change-password');
Route::post('/change-password-process',					['uses' => 'PasswordController@change_password_process'])->name('change-password-process');

// RECOVER PASSWORD
Route::get('/recover-password',							['uses' => 'PasswordController@recover_password'])->name('recover-password');
Route::post('/recover-password-process',				['uses' => 'PasswordController@recover_password_process'])->name('recover-password-process');

Route::group(['middleware' => 'session'], function () {
	// PRIVILEGE SIDEBAR MENU
	Route::get('/privilege-menu',						['uses' => 'PrivilegeMenuController@get_privilege'])->name('get-privilege-menu');

	// RESET PASSWORD
	Route::post('/reset-password',						['uses' => 'UserManagement\UserSetupController@reset_password'])->middleware('privilege:USER_RSTPASS_MKR')->name('reset-password');

	// DASHBOARD
	Route::group(['prefix' => 'dashboard'], function () {
		Route::get('/',									'DashboardController@index')->middleware('privilege:dashboard')->name('dashboard');

		Route::get('/data', 							['uses' => 'DashboardController@data'])->middleware('privilege:dashboard')->name('dashboard-data');
	});

	// USER MANAGEMENT
	Route::group(["prefix" => "user-management"],		function () {
		// Package
		Route::group(["prefix" => "package-setup"],		function () {
			Route::get('/', 							['uses' => 'UserManagement\PackageSetupController@package'])->middleware('privilege:PACKAGE_VIEW')->name('package-setup');

			Route::get('/list', 						['uses' => 'UserManagement\PackageSetupController@package_list'])->middleware('privilege:PACKAGE_VIEW')->name('package-setup-list');

			Route::post('/privilege/{package_name?}', 	['uses' => 'UserManagement\PackageSetupController@package_privilege'])->name('list-privilege');

			Route::post('/add',				 			['uses' => 'UserManagement\PackageSetupController@package_add'])->middleware('privilege:PACKAGE_ADD_MKR')->name('package-setup-add');

			Route::post('/update',				 		['uses' => 'UserManagement\PackageSetupController@package_update'])->middleware('privilege:PACKAGE_EDIT_MKR')->name('package-setup-update');

			Route::post('/delete',				 		['uses' => 'UserManagement\PackageSetupController@package_delete'])->middleware('privilege:PACKAGE_DEL_MKR')->name('package-setup-delete');
		});

		// Group
		Route::group(["prefix" => "group-setup"],		function () {
			Route::get('/', 							['uses' => 'UserManagement\GroupSetupController@group'])->middleware('privilege:GROUP_VIEW')->name('group-setup');

			Route::get('/list', 						['uses' => 'UserManagement\GroupSetupController@group_list'])->middleware('privilege:GROUP_VIEW')->name('group-setup-list');

			Route::post('/data-filter', 				['uses' => 'UserManagement\GroupSetupController@group_data_filter'])->middleware('privilege:GROUP_VIEW')->name('group-data-filter');

			Route::post('/data-filter/option', 			['uses' => 'UserManagement\GroupSetupController@group_data_filter_option'])->name('group-data-filter-option');

			Route::post('/add',				 			['uses' => 'UserManagement\GroupSetupController@group_add'])->middleware('privilege:GROUP_ADD_MKR')->name('group-setup-add');

			Route::post('/update',				 		['uses' => 'UserManagement\GroupSetupController@group_update'])->middleware('privilege:GROUP_EDIT_MKR')->name('group-setup-update');

			Route::post('/delete',				 		['uses' => 'UserManagement\GroupSetupController@group_delete'])->middleware('privilege:GROUP_DEL_MKR')->name('group-setup-delete');
		});

		// Subgroup
		Route::group(["prefix" => "subgroup-setup"],	function () {
			Route::get('/', 							['uses' => 'UserManagement\SubgroupSetupController@subgroup'])->middleware('privilege:SUBGROUP_VIEW')->name('subgroup-setup');

			Route::get('/list', 						['uses' => 'UserManagement\SubgroupSetupController@subgroup_list'])->middleware('privilege:SUBGROUP_VIEW')->name('subgroup-setup-list');

			Route::post('/privilege/{package_name?}', 	['uses' => 'UserManagement\SubgroupSetupController@subgroup_privilege'])->middleware('privilege:SUBGROUP_VIEW')->name('list-subgroup-privilege');

			Route::post('/add', 						['uses' => 'UserManagement\SubgroupSetupController@subgroup_add'])->middleware('privilege:SUBGROUP_ADD_MKR')->name('subgroup-setup-add');

			Route::post('/update',				 		['uses' => 'UserManagement\SubgroupSetupController@subgroup_update'])->middleware('privilege:SUBGROUP_EDIT_MKR')->name('subgroup-setup-update');

			Route::post('/delete', 						['uses' => 'UserManagement\SubgroupSetupController@subgroup_delete'])->middleware('privilege:SUBGROUP_DEL_MKR')->name('subgroup-setup-delete');

			// Update
			Route::post('/privilage_list', 				['uses' => 'UserManagement\SubgroupSetupController@getPrivilageSelect'])->name('subgroup.privilage_list');
		});

		// User
		Route::group(['prefix' => 'user-setup'], 		function () {
			Route::get('/', 							['uses' => 'UserManagement\UserSetupController@user'])->middleware('privilege:USER_VIEW')->name('user-setup');

			Route::get('/list', 						['uses' => 'UserManagement\UserSetupController@user_list'])->middleware('privilege:USER_VIEW')->name('user-list');

			Route::post('/data-filter', 				['uses' => 'UserManagement\UserSetupController@user_data_filter'])->middleware('privilege:USER_VIEW')->name('user-data-filter');

			Route::post('/add', 						['uses' => 'UserManagement\UserSetupController@user_add'])->middleware('privilege:USER_ADD_MKR')->name('user-setup-add');

			Route::post('/update',				 		['uses' => 'UserManagement\UserSetupController@user_update'])->middleware('privilege:USER_EDIT_MKR')->name('user-setup-update');

			Route::post('/delete',				 		['uses'	=> 'UserManagement\UserSetupController@user_delete'])->middleware('privilege:USER_DEL_MKR')->name('user-setup-delete');
			Route::post('/check',				 		['uses'	=> 'UserManagement\UserSetupController@checkUser'])->middleware('privilege:USER_DEL_MKR')->name('user-setup-check');
		});
	});

	// PON REQUEST
	Route::group(["prefix" => "pon-request"],	function () {
		Route::group(["prefix" => "v2"],	function () {
			Route::get('/', 							[PONRequestController::class, "index"])->middleware('privilege:PON_REQUEST_VIEW')->name('pon-request-view_v2');
		});

		Route::get('/', 							['uses' => 'PONRequest\PONRequestController@pon_request_view'])->middleware('privilege:PON_REQUEST_VIEW')->name('pon-request-view');

		Route::get('/list', 						['uses' => 'PONRequest\PONRequestController@pon_request_list'])->middleware('privilege:PON_REQUEST_VIEW')->name('pon-request-list');

		Route::post('/list-by-status', 				['uses' => 'PONRequest\PONRequestController@pon_request_list_by_status'])->middleware('privilege:PON_REQUEST_VIEW')->name('pon-request-list-by-status');

		Route::post('/list-by-id', 					['uses' => 'PONRequest\PONRequestController@pon_request_list_by_id'])->middleware('privilege:PON_REQUEST_VIEW')->name('pon-request-list-by-id');

		Route::post('/list-by-id-approval', 		['uses' => 'PONRequest\PONRequestController@pon_request_list_by_id'])->middleware('privilege:PON_REQUEST_APR_VIEW')->name('pon-request-list-by-id-approval');

		Route::post('/add', 						['uses' => 'PONRequest\PONRequestController@pon_request_add'])->middleware('privilege:PON_REQUEST_ADD_MKR')->name('pon-request-add');

		Route::post('/update', 						['uses' => 'PONRequest\PONRequestController@pon_request_update'])->middleware('privilege:PON_REQUEST_EDIT_MKR')->name('pon-request-update');

		Route::post('/file-upload', 				'PONRequest\PONRequestController@fileUploadPost')->name('file_upload_post');
		Route::post('/file-upload-update',			'PONRequest\PONRequestController@fileUploadPostUpdate')->name('file_upload_post_update');
		Route::post('/file-get', 					'PONRequest\PONRequestController@fileUploadGet')->name('file_upload_get');

		Route::post('/delete', 						['uses' => 'PONRequest\PONRequestController@pon_request_delete'])->middleware('privilege:PON_REQUEST_DEL_MKR')->name('pon-request-delete');

		Route::get('/cost-centre-list', 			['uses' => 'PONRequest\PONRequestController@cost_centre_list'])->name('cost-centre-list');

		Route::get('/currency-list', 				['uses' => 'PONRequest\PONRequestController@currency_list'])->name('currency-list');

		Route::post('/item-list', 					['uses' => 'PONRequest\PONRequestController@item_list'])->name('item-list');

		Route::post('/attachment-list', 			['uses' => 'PONRequest\PONRequestController@attachment_list'])->name('attachment-list');

		Route::post('/approve-by-checker', 			['uses' => 'PONRequest\PONRequestController@approve_by_checker'])->middleware('privilege:PON_REQUEST_ADD_CKR')->name('approve-by-checker');

		Route::post('/reject-by-checker', 			['uses' => 'PONRequest\PONRequestController@reject_by_checker'])->middleware('privilege:PON_REQUEST_ADD_CKR')->name('reject-by-checker');

		Route::post('/forward-by-checker', 			['uses' => 'PONRequest\PONRequestController@forward_by_checker'])->middleware('privilege:PON_REQUEST_ADD_CKR')->name('forward-by-checker');

		Route::post('/approve-by-top-management', 	['uses' => 'Approval\PONRequestApprovalController@approve_by_top_management'])->middleware('privilege:PON_REQUEST_ADD_APR')->name('approve-by-top-management');

		Route::post('/reject-by-top-management', 	['uses' => 'Approval\PONRequestApprovalController@reject_by_top_management'])->middleware('privilege:PON_REQUEST_ADD_APR')->name('reject-by-top-management');
		Route::post('/approve', 	['uses' => 'Approval\PONRequestApprovalController@approve_pon'])->middleware('privilege:PON_REQUEST_ADD_APR')->name('pon_request_approve');
	});



	// APPROVAL USER MANAGEMENT
	Route::group(["prefix" => "approval"],				function () {
		// Package
		Route::group(["prefix" => "package"],			function () {
			Route::get('/', 							['uses' => 'Approval\PackageApprovalController@package'])->middleware('privilege:PACKAGE_APR_VIEW')->name('package-approval');

			Route::get('/list', 						['uses' => 'Approval\PackageApprovalController@package_list'])->middleware('privilege:PACKAGE_APR_VIEW')->name('package-request-list');

			Route::post('/approval', 					['uses' => 'Approval\PackageApprovalController@package_approval'])->name('package-request-approval');

			Route::post('/privilege', 					['uses' => 'Approval\PackageApprovalController@package_privilege'])->name('approval-package-privilege');
		});

		// Group
		Route::group(["prefix" => "group"],				function () {
			Route::get('/', 									['uses' => 'Approval\GroupApprovalController@group'])->middleware('privilege:GROUP_APR_VIEW')->name('group-approval');

			Route::get('/list', 								['uses' => 'Approval\GroupApprovalController@group_list'])->middleware('privilege:GROUP_APR_VIEW')->name('group-request-list');

			Route::post('/approval', 							['uses' => 'Approval\GroupApprovalController@group_approval'])->name('group-request-approval');

			Route::post('/data-filter/', 						['uses' => 'Approval\GroupApprovalController@group_data_filter'])->name('approval-group-data-filter');
		});

		// Subgroup
		Route::group(["prefix" => "subgroup"],			function () {
			Route::get('/',		 						['uses' => 'Approval\SubgroupApprovalController@sub_group'])->middleware('privilege:SUBGROUP_APR_VIEW')->name('subgroup-approval');

			Route::get('/list', 						['uses' => 'Approval\SubgroupApprovalController@subgroup_list'])->middleware('privilege:SUBGROUP_APR_VIEW')->name('subgroup-request-list');

			Route::post('/approval', 					['uses' => 'Approval\SubgroupApprovalController@subgroup_approval'])->name('subgroup-request-approval');

			Route::post('/privilege', 					['uses' => 'Approval\SubgroupApprovalController@subgroup_privilege'])->name('approval-subgroup-privilege');
		});

		// User
		Route::group(["prefix" => "user"],				function () {
			Route::get('/', 							['uses' => 'Approval\UserApprovalController@user'])->middleware('privilege:USER_APR_VIEW')->name('user-approval');

			Route::get('/list', 						['uses' => 'Approval\UserApprovalController@user_list'])->middleware('privilege:USER_APR_VIEW')->name('user-request-list');

			Route::post('/approval', 					['uses' => 'Approval\UserApprovalController@user_approval'])->name('user-request-approval');

			Route::post('/data-filter', 				['uses' => 'Approval\UserApprovalController@user_data_filter'])->name('approval-user-data-filter');
		});

		// PON REQUEST
		Route::group(["prefix" => "pon-request"],			function () {
			Route::get('/', 							['uses' => 'Approval\PONRequestApprovalController@pon_request_view'])->middleware('privilege:PON_REQUEST_APR_VIEW')->name('pon-request-approval');

			Route::get('/list', 						['uses' => 'Approval\PONRequestApprovalController@pon_request_list'])->middleware('privilege:PON_REQUEST_APR_VIEW')->name('pon-request-approval-list');

			// Route::post('/approval', 					['uses' => 'Approval\PONRequestApprovalController@pon_request_approval'])->name('pon-request-request-approval');
		});
	});

	// EDIT PROFILE
	Route::group(["prefix" => "profile"],				function () {
		Route::get('/',									['uses' => 'Profile\ProfileController@profile_view'])->middleware('privilege:notification')->name('profile-view');

		Route::post('/update-profile', 					['uses' => 'Profile\ProfileController@update_profile'])->middleware('privilege:notification')->name('update-profile');
	});

	// NOTIFICATION
	Route::group(["prefix" => "notification"],			function () {
		Route::get('/',									['uses' => 'Notification\NotificationController@notification_view'])->middleware('privilege:notification')->name('notification-view');

		Route::get('/list', 							['uses' => 'Notification\NotificationController@notification_list'])->middleware('privilege:notification')->name('notification-list');
	});

	// AUDIT TRAIL
	Route::group(["prefix" => "audit-trail"],			function () {
		Route::get('/',									['uses' => 'AuditTrail\AuditTrailController@audit_trail'])->middleware('privilege:AUDIT_VIEW')->name('audit-trail');

		Route::post('/search-audit-trail',				['uses' => 'AuditTrail\AuditTrailController@search_audit_trail'])->middleware('privilege:AUDIT_VIEW')->name('search-audit-trail');
	});


	// FEATURE LEVEL
	Route::group(["prefix" => "feature"],			function () {
		Route::get('/',									['uses' => 'Feature\FeatureController@index'])->middleware('privilege:FEATURE_VIEW')->name('feature');
		Route::get('/list',								['uses' => 'Feature\FeatureController@feature_list'])->middleware('privilege:FEATURE_VIEW')->name('feature-list');
		Route::post('/update',							['uses' => 'Feature\FeatureController@feature_update'])->name('feature-update');
	});
});

// Testing
// Route::group(['middleware' => 'privilege:hallo'], function() {
Route::get('/check_priv',						['uses' => 'LoginController@check_priv']);
Route::get('/session',							['uses' => 'LoginController@session_token'])->name('wow');
Route::get('/login-check',						['uses' => 'LoginController@loginCheck']);
// });