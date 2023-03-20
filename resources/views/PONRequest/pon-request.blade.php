@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | PON Request</title>
@endsection

@section('css')
    <style type="text/css">
        .buttons-html5{
            cursor: pointer
        }
        tbody tr.clickable{
            cursor: pointer;
        }   
        .ui-datepicker .ui-datepicker-calendar td.ui-datepicker-unselectable .ui-state-default {
            color: #ccc !important;
        }
        td.details-control {
            background: url({{ asset('assets/img/iconfinder_arrow-down-01_186411.png') }}) no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url({{ asset('assets/img/iconfinder_arrow-up-01_186407.png') }}) no-repeat center center;
        }
        .dataTables_wrapper .dataTables_filter {
            visibility: hidden;
        }
        table.dataTable thead th.sorting::before,
        table.dataTable thead th.sorting::after,
        table.dataTable thead th.sorting_asc::before,
        table.dataTable thead th.sorting_desc::before,
        table.dataTable thead th.sorting_asc::after,
        table.dataTable thead th.sorting_desc::after {
            display: none;
        }
        table.dataTable thead > tr > th.sorting_asc,
        table.dataTable thead > tr > th.sorting_desc,
        table.dataTable thead > tr > th.sorting,
        table.dataTable thead > tr > td.sorting_asc,
        table.dataTable thead > tr > td.sorting_desc,
        table.dataTable thead > tr > td.sorting {
            padding-right: 12px;
        }
        #request_item_datatable tfoot > tr > th, #request_item_datatable_update tfoot > tr > th {
            border-top: 1px solid #dee2e6 !important;
        }
    </style>
@endsection

@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-paste"></i> PON Request List</h4>
@endsection

@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> PON Request List</h3>
            </div>
            @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_MKR')])
                <div class="col-md-6">
                    <button class='btn btn-outline-primary rounded-5 add-btn' onClick="$(this).add_pon_request()"><i class="fas fa-plus"></i> Add PON Request</button>
                </div>
            @endif
        </div>

        <div class="br-section-wrapper pd-b-50-force pd-t-15-force">
            <div class="row mg-b-15">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-control-label">Search Data by Keyword</label>
                        <input class="form-control" type="text" name="external_datatable_search" id="external_datatable_search" placeholder="Search...">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-control-label">Filter by Status</label>
                    <select class="form-control select2" id="data_status" name="data_status" style="width: 100%">
                        <option value="0" selected>All</option>
                        <option value="1">Open</option>
                        <option value="2">Approved</option>
                        <option value="3">Waiting for Approval</option>
                        <option value="4">Rejected</option>
                    </select>
                </div>
            </div>
            <div class="table-wrapper">
                <table id="pon_request_datatables" class="table display responsive tx-center" style="width: 100%;">
                    <thead>
                        <tr>
                            <th width="5%" class="wd-5p-force">No</th>
                            <th class="tx-center">Sorted</th>
                            <th width="10%" class="tx-center">Initial Date</th>
                            <th width="15%" class="tx-center">Cost Centre</th>
                            <th width="15%" class="tx-center">Supplier</th>
                            <th width="15%" class="tx-center">Total Price</th>
                            <th width="15%" class="tx-center">Current Phase</th>
                            <th width="15%" class="tx-center">PIC</th>
                            <th width="10%" class="tx-center">Status</th>
                            <th width="13%" class="tx-center">PON</th>
                            <th width="5%" class="tx-center">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- PON Request Detail Modal -->
    <div id="modal_pon_request_detail" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="icon ion-clipboard mg-r-10"></i> PON Request Details <span id="pon_number_title"></span></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form_pon_request_detail">
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-7">
                                    <label class="form-control-label">Summary</label>
                                    <hr class="mg-t-0">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <tr id="pon_view_row" style="display: hidden;">
                                                <th class="pd-5">Purchase Order Number</th>
                                                <td class="pd-5" id="pon_view"></td>
                                            </tr>
                                            <tr id="buffer_row" style="display: none;">
                                                <th class="pd-5"></th>
                                                <td class="pd-5"></td>
                                            </tr>
                                            <tr id="current_phase_row">
                                                <th class="pd-5">Current Phase</th>
                                                <td class="pd-5" id="current_phase"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-5">Cost Centre</th>
                                                <td class="pd-5" id="cost_centre"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-5">Supplier</th>
                                                <td class="pd-5" id="supplier"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-5">Total Price</th>
                                                <td class="pd-5" id="total_price"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-5">Reason for Investment/Expenditure</th>
                                                <td class="pd-5" id="request_reason"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-5">Estimated Invoice Date</th>
                                                <td class="pd-5" id="estimated_invoice_date"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-5">
                                    <label class="form-control-label">Document(s) Uploaded</label>
                                    <hr class="mg-t-0">
                                    <table class="table table-striped table-hover table-bordered" id="document-datatable">
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-control-label">Progress</label>
                                    <table class="table">
                                        <thead>
                                            <th class="tx-center">No</th>
                                            <th class="tx-center">Step</th>
                                            <th class="tx-center">Status</th>
                                            <th class="tx-center">Last Update</th>
                                            <th class="tx-center">Completed By</th>
                                            @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')] || $data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')])
                                                <th class="tx-center action_status">Action</th>
                                            @endif
                                        </thead>
                                        <tbody class="tx-bold">
                                            <tr id="detail_step_1" style="color: green">
                                                <td class="pd-4-force tx-center" id="number_1">1</td>
                                                <td class="pd-4-force" id="phase_1">PON Request Initiation</td>
                                                <td class="pd-4-force tx-center" id="phase_status_1">Completed</td>
                                                <td class="pd-4-force tx-center" id="updated_1"></td>
                                                <td class="pd-4-force tx-center" id="by_phase_1">-</td>
                                                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')] || $data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')])
                                                    <td class="pd-4-force tx-center action_status" id="action_1"></td>
                                                @endif
                                            </tr>
                                            <tr id="detail_step_2" style="color: gray">
                                                <td class="pd-4-force tx-center" id="number_2">2</td>
                                                <td class="pd-4-force" id="phase_2">Financial Approval</td>
                                                <td class="pd-4-force tx-center" id="phase_status_2">Not Completed</td>
                                                <td class="pd-4-force tx-center" id="updated_2">Not Updated</td>
                                                <td class="pd-4-force tx-center" id="by_phase_2">-</td>
                                                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')])
                                                    <td class="pd-4-force tx-center action_status" id="action_2" style="white-space:nowrap">
                                                        <div id="finance-head">
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                                
                                            <tr id="detail_step_3" style="color: gray">
                                                <td class="pd-4-force tx-center" id="number_3">3</td>
                                                <td class="pd-4-force" id="phase_3">Top Management Approval</td>
                                                <td class="pd-4-force tx-center" id="phase_status_3">-</td>
                                                <td class="pd-4-force tx-center" id="updated_3">-</td>
                                                <td class="pd-4-force tx-center" id="by_phase_3">-</td>
                                                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')])
                                                    <td class="pd-4-force tx-center action_status" id="action_3" style="white-space:nowrap">
                                                        <!-- <div id="top-mgmt"> -->
                                                            <div class="row mg-x-0">
                                                                <div class="col-xs-2" style="width: 100%;">
                                                                    <a href="/approval/pon-request">
                                                                        <button type="button" class="btn btn-outline-primary tx-12 mg-y-5" style="float: left; padding: 0.65rem 0.75rem; width: inherit;" data-toggle="tooltip" data-placement="right" title="Go to Approval Menu"><i class="fas fa-check-square"></i> Approval</button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <!-- </div> -->
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-layout">
                            <div class="row mg-t-7">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label class="form-control-label">Item Details</label>
                                    <table id="item_detail_datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="35%">Description</th>
                                                <th width="15%">Quantity</th>
                                                <th width="20%">Unit Price</th>
                                                <th width="20%">Total Price</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add PON Request Modal -->
    <div id="modal_add_pon_request" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> PON Request Form Initiation</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form_add_pon_request" enctype="multipart/form-data">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Main Details
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20" id="pon-request-detail-container">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 cost_centre" id="cost_centre_add" name="cost_centre_add" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 currency" id="currency_add" name="currency_add" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Estimated Invoice Date <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="datepicker" id="est_inv_date_add" placeholder="DD/MM/YYYY" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Supplier <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="supplier_add" id="supplier_add" placeholder="Enter Supplier Name" maxlength="1000" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Item Details
                    </div>
                    <div class="modal-body pd-t-10 pd-l-20-force pd-b-0">
                        <span>Note: All items below will have a supplier and currency as specified in the main details section.</span>
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20 pd-t-10-force">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        </select>
                                        <textarea list="description_item_list_add" class="form-control" type="text" name="description_add" id="description_add" placeholder="Enter Description" maxlength="3000" autocomplete></textarea>
                                        <datalist id="description_item_list_add">
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Qty</label>
                                        <input list="quantity_item_list_add" class="form-control" type="text" name="quantity_add" id="quantity_add" placeholder="Enter Quantity" maxlength="20" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete>
                                        <datalist id="quantity_item_list_add">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Unit Price</label>
                                        <input list="unit_price_item_list_add" class="form-control" type="text" name="unit_price_add" id="unit_price_add" placeholder="Enter Unit Price" maxlength="15" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete>
                                        <datalist id="unit_price_item_list_add">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-top: 27px;">
                                    <input type="button" name="add_item_button" class="btn btn-primary" value="Add Item" id="add_item_button" style="width: 100%" />
                                </div>
                            </div>
                            <div class="row mg-t-7">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <table id="request_item_datatable" class="table table-striped table-bordered" style="background-color: #fff">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="40%">Description</th>
                                                <th width="10%">Quantity</th>
                                                <th width="20%">Unit Price</th>
                                                <th width="20%">Total Price</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align:right">Total:</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Reason and Attachment
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Reason for Investment/Expenditure <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="reason_add" id="reason_add" placeholder="Enter Reason for Investment/Expenditure" maxlength="2000" data-parsley-required required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="pon_request_file" class="control-label">Upload Document Attachment</label>
                                    <div class="form-group" style="display: flex;">
                                        <input type="file" accept=".pdf" id="pon_request_file_add" name="pon_request_file[]" multiple onchange="$(this).updateListAdd()">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="selected_files" class="control-label">Selected File(s)</label>
                                    <div id="selected_files_add">No File Selected</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Submit PON Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update PON Request Modal -->
    <div id="modal_update_pon_request" class="modal fade" data-value=''>
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="icon ion-compose"></i> Update PON Request</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="form_update_pon_request" enctype="multipart/form-data">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Main Details
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20" id="update-pon-request-detail-container">
                            <input class="form-control" type="hidden" name="pon_request_id_update" id="pon_request_id_update" required readonly="readonly">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 cost_centre" id="cost_centre_update" name="cost_centre_update" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 currency" id="currency_update" name="currency_update" style="width: 100%" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Estimated Invoice Date <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="datepicker" id="est_inv_date_update" placeholder="DD/MM/YYYY" autocomplete="off" required>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Supplier <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="supplier_update" id="supplier_update" data-parsley-maxlength="1000" placeholder="Enter Supplier Name" maxlength="50" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Item Details
                    </div>
                    <div class="modal-body pd-t-10 pd-l-20-force pd-b-0">
                        <span>Note: All items below will have a supplier and currency as specified in the main details section.</span>
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20 pd-t-10-force">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Description</label>
                                        </select>
                                        <textarea list="description_item_list_update" class="form-control" type="text" name="description_update" id="description_update" data-parsley-maxlength="3000" placeholder="Enter Description" maxlength="3000"></textarea>
                                        <datalist id="description_item_list_update">
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Qty</label>
                                        <input list="quantity_item_list_update" class="form-control" type="text" name="quantity_update" id="quantity_update" data-parsley-maxlength="5" placeholder="Enter Quantity" maxlength="20" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        <datalist id="quantity_item_list_update">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Unit Price</label>
                                        <input list="unit_price_item_list_update" class="form-control" type="text" name="unit_price_update" id="unit_price_update" data-parsley-maxlength="15" placeholder="Enter Unit Price" maxlength="15" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                        <datalist id="unit_price_item_list_update">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-top: 27px;">
                                    <input type="button" name="add_item_button" class="btn btn-primary" value="Add Item" id="add_item_button_update" style="width: 100%" />
                                </div>
                            </div>
                            <div class="row mg-t-7">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <table id="request_item_datatable_update" class="table table-striped table-bordered" style="background-color: #fff">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="40%">Description</th>
                                                <th width="10%">Quantity</th>
                                                <th width="20%">Unit Price</th>
                                                <th width="20%">Total Price</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4" style="text-align:right">Total:</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Reason and Attachment
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Reason for Investment/Expenditure <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="reason_update" id="reason_update" data-parsley-maxlength="2000" placeholder="Enter Reason for Investment/Expenditure" maxlength="50" data-parsley-required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <label for="pon_request_file" class="control-label">Upload Document Attachment</label>
                                    <div class="form-group" style="display: flex;">
                                        <input type="file" accept=".pdf" id="pon_request_file_update" name="pon_request_file_update[]" multiple onchange="$(this).updateListUpdate()">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <label for="selected_files_update" class="control-label">Selected File(s)</label>
                                    <div id="selected_files_update">No File Selected</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Update New PON Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        // DATATABLE INITIALIZATION
        'use strict';
        var edit_status     = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_EDIT_MKR')] ?>';
        var delete_status   = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_DEL_MKR')] ?>';
        var array_item      = [];
        var array_file      = [];

        var last_sequence;
        var last_sequence_index;

        $(document).ready(function() {
            // SELECT2 DROPDOWN FOR DATATABLES
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $('#data_status').val(0).change();

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                if(message != ""){
                    amaran_error(message);
                }
            };
    
            // DATEPICKER INITIALIZATION
            $('input[name="datepicker"]').datepicker({
                format              : 'dd/mm/yyyy',
                autoclose           : true
            });
            
            $('input[name="datepicker"').val('');
        });



          // ------------------------------------ //
         // PON REQUEST DATATABLE INITIALIZATION //
        // ------------------------------------ //

        // MAIN TABLE INITIALIZATION
        let status_data = 0;
        let action      = true;

        var pon_request_datatable   = $('#pon_request_datatables').DataTable({
            ajax: {
                method  : 'POST',
                url     : "{{ route('pon-request-list-by-status') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data    : {
                    status_data : status_data
                },
                dataSrc : 'pon_request_list'
            },
            aaSorting       : [ [1,'desc'] ],
            processing      : true,
            scrollX         : "100%",
            scrollCollapse  : true,
            deferRender     : true,
            responsive      : true,
            destroy         : true,
            bFilter         : true,
            columns: [{
                data: null
            },
            {
                data    : "sorted_at",
                visible : false
            },
            {
                data: null
            },
            {
                data: "cost_centre"
            },
            {
                data: "supplier"
            },
            {
                data: null
            },
            {
                data: "current_phase"
            },
            {
                data: "pic"
            },
            {
                data: null
            },
            {
                data: null
            },
            {
                data: null,
                visible: action
            }],
            language: {
                searchPlaceholder   : 'Search...',
                sSearch             : '',
                lengthMenu          : '_MENU_ data/page',
            },
            columnDefs: [{
                searchable  : false,
                sortable    : false,
                targets     : 0,
                data        : null,
                render      : function(data, type, full, meta){
                    return meta.row + 1;
                }
            },
            {
                targets     : 2,
                data        : null,
                render      : function(data, type, full){
                    let initial_date = data.created_at; 
                    initial_date = new Date(initial_date);
                    initial_date = dateformat_ddmmyyyy(initial_date, '/');
                   
                    return initial_date;
                }
            },
            {
                targets     : -6,
                data        : null,
                render      : function(data, type, full){
                    var total_price = data.currency+' '+addComasStatic(Math.round((parseFloat(data.total_price) + Number.EPSILON) * 10000) / 10000); 
                   
                    return total_price;
                }
            },
            {
                targets     : -3,
                data        : null,
                className   : "searchable",
                render      : function(data, type, full){
                    var pon_status = '';
                    
                    if (data.status_id == '1'){
                        pon_status = '<span style="color:orange;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    else if (data.status_id == '2'){
                        pon_status = '<span style="color:green;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    else if (data.status_id == '3'){
                        pon_status = '<span style="color:orange;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    else if (data.status_id == '4'){
                        pon_status = '<span style="color:red;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    return pon_status;
                }
            },
            {
                targets     : -2,
                data        : null,
                render      : function(data, type, full){
                    var pon_number = '';
                    
                    if (data.pon_number === '' || data.pon_number === null){
                        pon_number = '-'; 
                    }
                    else {
                        pon_number = data.pon_number; 
                    }

                    return pon_number;
                }
            },
            {
                targets     : -1,
                data        : null,
                sortable    : false,
                searchable  : false,
                render      : function(data, type, full){
                    var edit_status     = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_EDIT_MKR')] ?>';
                    var delete_status   = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_DEL_MKR')] ?>';
                    var checker_status  = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')] ?>';

                    let result          = '';
                    let edit_btn        = '';
                    let delete_btn      = '';
                    let details_btn     = '';

                    if (checker_status) {
                        if (data.status_id == 1) {
                            details_btn = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="PON Request Approval"><span class="fa fa-gavel"></span></button>';
                        }
                        else {
                            details_btn = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="See Details"><span class="icon ion-clipboard"></span></button>';
                        }
                    }
                    else {
                        details_btn     = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="See Details"><span class="icon ion-clipboard"></span></button>';
                    }

                    if (data.status_id == 1) {
                        edit_btn        = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Update PON Request"><span class="icon ion-compose"></span></button>';
                        delete_btn      = '<button style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-pon-request-click-delete" type="button" data-toggle="tooltip" data-placement="top" title="Delete PON Request"><span class="icon ion-trash-a"></span></button>';
                    }

                    result += details_btn;

                    if(edit_status){
                        result += edit_btn;
                    }
                    if(delete_status){
                        result += delete_btn;
                    }

                    return result;
                }
            }],
        }).columns.adjust();

        // STATIC ROW NUMBER
        pon_request_datatable.on( 'order.dt search.dt', function () {
            pon_request_datatable.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
        
        // EXTERNAL SEARCH BOX
        $('#external_datatable_search').keyup(function(){
            pon_request_datatable.search($(this).val()).draw();
        });

        // FILTER BY STATUS
        $("#data_status").change(function(){
            let status_value = $("#data_status").val();

            if (status_value != '0'){
                if (status_value == '1') {
                    status_value = 'Open';
                }
                else if (status_value == '2') {
                    status_value = 'Approved';
                }
                else if (status_value == '3') {
                    status_value = 'Waiting for Approval';
                }
                else if (status_value == '4') {
                    status_value = 'Rejected';
                }

                pon_request_datatable.column(8).search(status_value).draw();
            }
            else {
                pon_request_datatable.column(8).search('').draw();
            }
        });



          // ----------------------------- //
         // ITEM DATATABLE INITIALIZATION //
        // ----------------------------- //

        // ITEM DATATABLE - ADD NEW PON REQUEST
        var item_request_table   = $('#request_item_datatable').DataTable({
            "searching": false,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
 
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                
                // Total over all pages
                let total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 4 ).footer() ).html(
                    // $.fn.dataTable.render.number(',', '.', 4).display(total)
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });

        // ITEM DATATABLE - UPDATE PON REQUEST
        var item_request_table_update = $('#request_item_datatable_update').DataTable({
            "searching": false,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
 
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                
                // Total over all pages
                let total = api
                    .column( 4 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 4 ).footer() ).html(
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });
        
        // ITEM DATATABLE - REQUEST DETAIL
        var item_detail_table = $('#item_detail_datatable').DataTable({
            "searching": false,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
 
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                
                // Total over all pages
                let total = api
                    .column( 3 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                // Update footer
                $( api.column( 3 ).footer() ).html(
                    addComasStatic(Math.round((parseFloat(total) + Number.EPSILON) * 10000) / 10000)
                );
            }
        });



          // ------------------- //
         // ADD NEW PON REQUEST //
        // ------------------- //

        // ADD ITEM REQUEST - ADD NEW PON REQUEST
        $('#add_item_button').click(function(event) {
            event.preventDefault();
            let new_item            = {};
            let each_total          = 0;
            let grand_total         = 0;
            last_sequence           = 0;

            let description_item    = $('#description_add').val();
            let quantity_item       = $('#quantity_add').val();
            let unit_price_item     = $('#unit_price_add').val();

            // AUTOCOMPLETE
            let list_data_description   = '<option value="'+description_item+'"></option>';
            let list_data_quantity      = '<option value="'+quantity_item+'"></option>';
            let list_data_unit_price    = '<option value="'+unit_price_item+'"></option>';
            $('#description_item_list_add').append(list_data_description);
            $('#quantity_item_list_add').append(list_data_quantity);
            $('#unit_price_item_list_add').append(list_data_unit_price);

            if (description_item == '' || quantity_item == '' || unit_price_item == ''){
                amaran_error('Please fill all item fields!');
            }
            else {
                last_sequence           = array_item.length+1;
                last_sequence_index     = array_item.length-1;

                // DATA COLLECTING
                new_item["sequence"]    = last_sequence;
                new_item["description"] = description_item;
                new_item["quantity"]    = quantity_item;
                new_item["unit_price"]  = unit_price_item;
                array_item.push(new_item);

                item_request_table.clear().draw();
                        
                for (var i = 0; i < array_item.length; i++) {
                    let each_total      = array_item[i].quantity*array_item[i].unit_price;
                    let index_number    = i+1;

                    // DATATABLE DATA CONSTRUCTION
                    var main_data = '<td style="width: 5%">'+index_number+'</td>'+
                        '<td style="width: 40%">'+array_item[i].description+'</td>'+
                        '<td style="width: 10%">'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                        '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                        '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                    var menu_bar_header = '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-item-remove" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                    var menu_bar_footer = '</div></div>';
                    var button_menu = '';

                    button_menu = menu_bar_header+menu_bar_footer;

                    last_sequence = i;
                    var jRow = $('<tr>').append(main_data,'<td>'+button_menu+'</td>');
                    item_request_table.row.add(jRow).draw();
                } 

                $('#description_add').val('');
                $('#quantity_add').val('');
                $('#unit_price_add').val('');
            }
        });

        // REMOVE ITEM - ADD NEW PON REQUEST
        $('#request_item_datatable tbody').on('click', '.btn-item-remove', function () {
            let index_number    = item_request_table.row($(this).parents('tr')).index();

            // REMOVE SELECTED INDEX
            array_item.splice(index_number, 1);

            item_request_table.clear().draw();
            
            for (var i = 0; i < array_item.length; i++) {
                let each_total  = array_item[i].quantity*array_item[i].unit_price;
                let index_number = i+1;

                // DATATABLE DATA CONSTRUCTION
                var main_data = '<td style="width: 5%">'+index_number+'</td>'+
                    '<td style="width: 40%">'+array_item[i].description+'</td>'+
                    '<td style="width: 10%">'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                var menu_bar_header = '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-item-remove" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                var menu_bar_footer = '</div></div>';
                var button_menu = '';

                button_menu = menu_bar_header+menu_bar_footer;

                last_sequence = i;
                var jRow = $('<tr>').append(main_data,'<td>'+button_menu+'</td>');
                item_request_table.row.add(jRow).draw();
            }
        });

        // UPDATE SELECTED FILES - ADD PON REQUEST
        $.fn.updateListAdd = function() {
            $('#pon_request_file').empty();
            let input       = document.getElementById('pon_request_file_add');
            let output      = document.getElementById('selected_files_add');
            let children    = '';
            let new_file    = {};
            
            if (input.files.length == 0) {
                output.innerhtml = 'No File Selected';
            }
            else {
                for (let i = 0; i < input.files.length; ++i) {
                    array_file.push(input.files.item(i).name);
                    children += '<li>' + input.files.item(i).name + '</li>';
                }
                output.innerhtml = '<ul>'+children+'</ul>';
            }
            array_file = array_file.map((str) => ({file_name: str}));

            $('#selected_files_add').html(output.innerhtml);
        }

        // ADD PON REQUEST DATA
        $.fn.add_pon_request = function() {
            $.LoadingOverlay("show");
            
            $('#form_add_pon_request')[0].reset();
            $('#selected_files_add').text("No File Selected");
            
            array_item          = [];
            array_file          = [];
            last_sequence       = 0;
            last_sequence_index = 0;

            item_request_table.clear().draw();

            let instance = $('#form_add_pon_request').parsley();
            instance.reset();

            get_cost_centre();
            get_currency();

            $('#modal_add_pon_request').modal("show");
            $.LoadingOverlay('hide');
        }

        // SUBMIT - ADD NEW PON REQUEST
        $('#form_add_pon_request').submit(function(event) {
            event.preventDefault();
            
            let cost_centre                     = $('#cost_centre_add').val();
            let estimated_invoice_date          = $('#est_inv_date_add').val();
            let supplier                        = $('#supplier_add').val();
            let currency                        = $('#currency_add').val();
            let item_list                       = array_item;
            let investment_expenditure_reason   = $('#reason_add').val();
            let file_list                       = array_file;

            let data = {
                cost_centre                     : cost_centre,
                estimated_invoice_date          : estimated_invoice_date,
                supplier                        : supplier,
                currency                        : currency,
                item_list                       : item_list,
                investment_expenditure_reason   : investment_expenditure_reason,
                file_list                       : file_list,
            };

            let instance = $('#form_add_pon_request').parsley();
            if (item_list.length == 0) {                
                amaran_error('Please insert at least 1 item to proceed the request!');
            }
            else {
                if (instance.validate()) {
                    $.ajax({
                        url         : '{{ route("pon-request-add") }}',
                        method      : 'POST',
                        data        : data,
                        datatype    : "json",
                        headers     : {
                           'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success     : function(msg) {
                            $.LoadingOverlay('hide');

                            if (msg['{{ config('constants.result') }}'] == "FAILED") {
                                amaran_error(msg.message);
                            }
                            else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                                // SEND FILE UPLOAD
                                let pon_request_file = $('input[name="pon_request_file[]"]')[0].files;
                                
                                if (pon_request_file != null) {
                                    let file_data = new FormData();

                                    for(var i = 0; i < pon_request_file.length; i++) {
                                        file_data.append('pon_request_file[]', pon_request_file[i]);
                                    }
                                    file_data.append('pon_request_id', msg['pon_request_id']);

                                    $.ajax({
                                        url         : '{{ route("file_upload_post") }}',
                                        method      : 'POST',
                                        data        : file_data,
                                        datatype    : "json",
                                        headers     : {
                                           'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                        },
                                        cache       : false,
                                        processData : false,
                                        contentType : false,
                                        success     : function(msg) {
                                            $.LoadingOverlay('hide');
                                            pon_request_datatable.ajax.reload();
                                        },
                                        error       : function() {
                                            $.LoadingOverlay('hide');
                                            amaran_error('Something went wrong, please contact technical support!');
                                        }
                                    }).done(function() {
                                        $.LoadingOverlay('hide');
                                    });
                                }

                                amaran_success(msg.message);
                                $('#modal_add_pon_request').modal('hide');
                                $('#form_add_pon_request')[0].reset();
                            }
                            else {
                                amaran_error('Oops, Something went wrong!');
                            }
                        },
                        error       : function() {
                            $.LoadingOverlay('hide');
                            amaran_error('Something went wrong, please contact technical support!');
                        }
                    }).done(function() {
                        $.LoadingOverlay('hide');
                    });
                }
                else {
                    amaran_error('Failed, please check your input!');
                }   
            }
        });



          // ---------------------- //
         // UPDATE NEW PON REQUEST //
        // ---------------------- //

        // ADD ITEM REQUEST - UPDATE PON REQUEST
        $('#add_item_button_update').click(function(event) {
            event.preventDefault();
            let new_item        = {};
            let each_total      = 0;
            let grand_total     = 0;

            let description_item    = $('#description_update').val();
            let quantity_item       = $('#quantity_update').val();
            let unit_price_item     = $('#unit_price_update').val();

            // AUTOCOMPLETE
            let list_data_description   = '<option value="'+description_item+'"></option>';
            let list_data_quantity      = '<option value="'+quantity_item+'"></option>';
            let list_data_unit_price    = '<option value="'+unit_price_item+'"></option>';
            $('#description_item_list_update').append(list_data_description);
            $('#quantity_item_list_update').append(list_data_quantity);
            $('#unit_price_item_list_update').append(list_data_unit_price);

            if (description_item == '' || quantity_item == '' || unit_price_item == ''){
                amaran_error('Please fill all item fields!');
            }
            else {
                // DATA COLLECTING
                new_item["description"] = description_item;
                new_item["quantity"]    = quantity_item;
                new_item["unit_price"]  = unit_price_item;
                array_item.push(new_item);

                item_request_table_update.clear().draw();
                        
                for (var i = 0; i < array_item.length; i++) {
                    each_total          = array_item[i].quantity*array_item[i].unit_price;
                    let index_number    = i+1;

                    // DATATABLE DATA CONSTRUCTION
                    var main_data = '<td style="width: 5%">'+index_number+'</td>'+
                        '<td style="width: 40%">'+array_item[i].description+'</td>'+
                        '<td style="width: 10%">'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                        '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                        '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                    var menu_bar_header = '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-item-remove-update" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                    var menu_bar_footer = '</div></div>';
                    var button_menu = '';

                    button_menu = menu_bar_header+menu_bar_footer;

                    last_sequence = i;
                    var jRow = $('<tr>').append(main_data,'<td>'+button_menu+'</td>');
                    item_request_table_update.row.add(jRow).draw();
                }
            }

            $('#description_update').val('');
            $('#quantity_update').val('');
            $('#unit_price_update').val('');
        });
            
        // UPDATE SELECTED FILES - UPDATE PON REQUEST
        $.fn.updateListUpdate = function() {
            $('#pon_request_file_update').empty();
            let input       = document.getElementById('pon_request_file_update');
            let output      = document.getElementById('selected_files_update');
            let children    = '';
            
            if (input.files.length == 0) {
                output.innerhtml = 'No File Selected';
            }
            else {
                for (let i = 0; i < input.files.length; ++i) {
                    children += '<li>' + input.files.item(i).name + '</li>';
                }
                output.innerhtml = '<ul>'+children+'</ul>';
            }

            $('#selected_files_update').html(output.innerhtml);
        }

        // REMOVE ITEM - UPDATE PON REQUEST
        $('#request_item_datatable_update tbody').on('click', '.btn-item-remove-update', function () {
            let index_number    = item_request_table_update.row($(this).parents('tr')).index();

            // REMOVE SELECTED INDEX
            array_item.splice(index_number, 1);

            item_request_table_update.clear().draw();
            
            for (var i = 0; i < array_item.length; i++) {
                let each_total      = array_item[i].quantity*array_item[i].unit_price;
                let index_number    = i+1;

                // DATATABLE DATA CONSTRUCTION
                var main_data = '<td style="width: 5%">'+index_number+'</td>'+
                    '<td style="width: 40%">'+array_item[i].description+'</td>'+
                    '<td style="width: 10%">'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                var menu_bar_header = '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-item-remove-update" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                var menu_bar_footer = '</div></div>';
                var button_menu = '';

                button_menu = menu_bar_header+menu_bar_footer;

                last_sequence = i;
                var jRow = $('<tr>').append(main_data,'<td>'+button_menu+'</td>');
                item_request_table_update.row.add(jRow).draw();
            }
        });

        // UPDATE PON REQUEST
        $('#pon_request_datatables tbody').on('click', '.btn-pon-request-click-update', function () {
            $.LoadingOverlay("show");
            $('#form_update_pon_request')[0].reset();
            $('#selected_files_update').text("No File Selected");
            
            get_cost_centre();
            get_currency();

            let rowdata = pon_request_datatable.row($(this).parents('tr')).data();
            
            let each_total      = 0;
            let grand_total     = 0;
            let pon_request_id  = rowdata.pon_request_id;
            last_sequence       = 0;

            let data = {
                pon_request_id  : pon_request_id
            };
            
            // GET PON REQUEST ITEM DATA
            $.ajax({
                url     : '{{ route("item-list") }}',
                method  : 'POST',
                data    : data,
                datatype: "json",
                headers : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    $.LoadingOverlay('hide');

                    array_item = [];

                    if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                        item_request_table_update.clear().draw();

                        if (msg.item_list.length > 0) {
                            for (var i=0; i<msg.item_list.length; i++) {
                                let new_item            = {};

                                let description_item    = msg.item_list[i].description;
                                let quantity_item       = msg.item_list[i].quantity;
                                let unit_price_item     = msg.item_list[i].unit_price;

                                new_item["description"] = description_item;
                                new_item["quantity"]    = quantity_item;
                                new_item["unit_price"]  = unit_price_item;

                                last_sequence = i;
                                array_item.push(new_item);
                            }

                            for (var i = 0; i < array_item.length; i++) {
                                each_total  = array_item[i].quantity*array_item[i].unit_price;
                                let index_number = i+1;

                                // DATATABLE DATA CONSTRUCTION
                                var main_data = '<td style="width: 5%">'+index_number+'</td>'+
                                    '<td style="width: 40%">'+array_item[i].description+'</td>'+
                                    '<td style="width: 10%">'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                    '<td style="width: 20%">'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                                var menu_bar_header = '<button type="button" style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-item-remove-update" data-toggle="tooltip" data-placement="top" title="Remove Item" data-original-title="Remove Item"><span class="icon ion-trash-a"></span></button>';
                                var menu_bar_footer = '</div></div>';
                                var button_menu = '';

                                button_menu = menu_bar_header+menu_bar_footer;

                                var jRow = $('<tr>').append(main_data,'<td>'+button_menu+'</td>');
                                item_request_table_update.row.add(jRow).draw();
                            }
                        }
                        
                        // GET PON REQUEST ATTACHMENT DATA
                        get_pon_request_file_update(pon_request_id); 
                    }
                    else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                        amaran_error(msg.message);
                    }
                    else{
                        amaran_error('Oops, Get PON Request Item Data Failed!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });

            $('#pon_request_id_update').val(pon_request_id);
            $('#cost_centre_update').val(rowdata.cost_centre_id).change();
            $('#currency_update').val(rowdata.currency_id).change();
            $('#supplier_update').val(rowdata.supplier);
            $('#est_inv_date_update').val(rowdata.estimated_invoice_date);
            $('#reason_update').val(rowdata.reason);

            $('#modal_update_pon_request').modal('show');
            $.LoadingOverlay("hide");
        });
            
        // GET PON REQUEST ATTACHMENT DATA
        function get_pon_request_file_update(pon_request_id){ 
            let data = {
                pon_request_id  : pon_request_id
            };

            $.ajax({
                url     : '{{ route("file_upload_get") }}',
                method  : 'POST',
                data    : data,
                datatype: "json",
                headers : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    $.LoadingOverlay('hide');

                    array_file      = [];
                    let output      = document.getElementById('selected_files_update');
                    let children    = '';
                    let new_file    = {};
                    
                    if (msg.file_list.length == 0) {
                        output.innerhtml = 'No File Selected';
                    }
                    else {
                        for (let i = 0; i < msg.file_list.length; ++i) {
                            array_file.push(msg.file_list[i].file_name);
                            children += '<li>' + msg.file_list[i].file_name + '</li>';
                        }
                        output.innerhtml = '<ul>'+children+'</ul>';
                    }
                    array_file = array_file.map((str) => ({file_name: str}));

                    $('#selected_files_update').html(output.innerhtml);
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });
        }

        // SUBMIT - UPDATE PON REQUEST
        $('#form_update_pon_request').submit(function(event) {
            event.preventDefault();
            
            let pon_request_id                  = $('#pon_request_id_update').val();
            let cost_centre                     = $('#cost_centre_update').val();
            let estimated_invoice_date          = $('#est_inv_date_update').val();
            let supplier                        = $('#supplier_update').val();
            let currency                        = $('#currency_update').val();
            let item_list                       = array_item;
            let investment_expenditure_reason   = $('#reason_update').val();
            let file_list                       = array_file;

            let data = {
                pon_request_id                  : pon_request_id,
                cost_centre                     : cost_centre,
                estimated_invoice_date          : estimated_invoice_date,
                supplier                        : supplier,
                currency                        : currency,
                item_list                       : item_list,
                investment_expenditure_reason   : investment_expenditure_reason,
                file_list                       : file_list,
            };

            let instance = $('#form_update_pon_request').parsley();
            if (instance.validate()) {
                $.ajax({
                    url         : '{{ route("pon-request-update") }}',
                    method      : 'POST',
                    data        : data,
                    datatype    : "json",
                    headers     : {
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success     : function(msg) {
                        $.LoadingOverlay('hide');

                        if (msg['{{ config('constants.result') }}'] == "FAILED") {
                            amaran_error(msg.message);
                        }
                        else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                            // SEND FILE UPLOAD
                            let pon_request_file = $('input[name="pon_request_file_update[]"]')[0].files;
                            
                            if (pon_request_file.length > 0) {
                                let file_data = new FormData();

                                for(var i = 0; i < pon_request_file.length; i++) {
                                    file_data.append('pon_request_file_update[]', pon_request_file[i]);
                                }
                                file_data.append('pon_request_id', pon_request_id);

                                $.ajax({
                                    url         : '{{ route("file_upload_post_update") }}',
                                    method      : 'POST',
                                    data        : file_data,
                                    datatype    : "json",
                                    headers     : {
                                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                    },
                                    cache       : false,
                                    processData : false,
                                    contentType : false,
                                    success     : function(msg) {
                                        $.LoadingOverlay('hide');
                                    },
                                    error       : function() {
                                        $.LoadingOverlay('hide');
                                        amaran_error('Something went wrong uhuy, please contact technical support!');
                                    }
                                }).done(function() {
                                    $.LoadingOverlay('hide');
                                });
                            }

                            $('#modal_update_pon_request').modal('hide');

                            amaran_success(msg.message);
                            $('#form_update_pon_request')[0].reset();
                            pon_request_datatable.ajax.reload();
                        }
                        else {
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error       : function() {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                }).done(function() {
                    $.LoadingOverlay('hide');
                });
            }
            else {
                amaran_error('Failed, please check your input!');
            }
        });



          // ----------------------- //
         // SEE PON REQUEST DETAILS //
        // ----------------------- //

        // REQUEST DETAIL
        $('#pon_request_datatables tbody').on('click', '.btn-pon-request-click-details', function () {
            $.LoadingOverlay("show");

            let rowdata         = pon_request_datatable.row($(this).parents('tr')).data();
            let each_total      = 0;
            let grand_total     = 0;
            let pon_request_id  = rowdata.pon_request_id;
            
            let data = {
                pon_request_id  : pon_request_id
            };
            
            // GET PON REQUEST LIST BY ID
            $.ajax({
                url     : '{{ route("pon-request-list-by-id") }}',
                method  : 'POST',
                data    : data,
                datatype: "json",
                headers : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    $.LoadingOverlay('hide');

                    if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                        if (msg.pon_request_list.length > 0) {
                            let pon_number              = msg.pon_request_list[0].pon_number;
                            let current_phase           = msg.pon_request_list[0].current_phase;
                            let cost_centre             = msg.pon_request_list[0].cost_centre;
                            let supplier                = msg.pon_request_list[0].supplier;
                            let total_price             = addComasStatic(Math.round((parseFloat(msg.pon_request_list[0].total_price) + Number.EPSILON) * 10000) / 10000);
                            let reason                  = msg.pon_request_list[0].reason;
                            let rejection_reason        = msg.pon_request_list[0].rejection_reason;
                            let estimated_invoice_date  = msg.pon_request_list[0].estimated_invoice_date;
                            let created_at              = msg.pon_request_list[0].created_at;
                            let updated_at              = msg.pon_request_list[0].updated_at;
                            let user_firstname          = msg.pon_request_list[0].user_firstname;
                            let user_lastname           = msg.pon_request_list[0].user_lastname;
                            let user_fullname           = user_firstname;
                            let status_id               = msg.pon_request_list[0].status_id;
                            let status                  = msg.pon_request_list[0].status;
                            let user_checker_name       = msg.pon_request_list[0].user_checker_name;
                            let checked_at              = msg.pon_request_list[0].checked_at;
                            let user_approver_name      = msg.pon_request_list[0].user_approver_name;
                            let approved_at             = msg.pon_request_list[0].approved_at;

                            // DATE FORMATTING
                            created_at  = new Date(created_at);
                            created_at  = dateformat_ddmmyyyy(created_at, '/');

                            if (updated_at != null && updated_at != ''){
                                updated_at  = new Date(updated_at);
                                updated_at  = dateformat_ddmmyyyy(updated_at, '/');
                            }

                            if (checked_at === null || checked_at === '') {
                                checked_at = checked_at;
                            }
                            else {
                                checked_at  = new Date(checked_at);
                                checked_at  = dateformat_ddmmyyyy(checked_at, '/');
                            }

                            if (approved_at === null || approved_at === '') {
                                approved_at = '-';
                            }
                            else {
                                approved_at = new Date(approved_at);
                                approved_at = dateformat_ddmmyyyy(approved_at, '/');
                            }
                            
                            // APPROVED
                            if (status_id == 2) {
                                $('.action_status').hide();
                                $('#by_phase_2').text(user_checker_name);
                                $('#updated_2').text(checked_at);
                                $('#detail_step_1').css('color', 'green');
                                $('#detail_step_2').css('color', 'green');
                                $('#detail_step_3').css('color', 'green');

                                if (user_approver_name === null || user_approver_name === ''){
                                    $('#phase_status_2').text(status);
                                    $('#phase_status_3').text('-');
                                    $('#by_phase_3').text('-');
                                    $('#updated_3').text('-');
                                }
                                else {
                                    $('#phase_status_2').text('Completed');
                                    $('#phase_status_3').text(status);
                                    $('#by_phase_3').text(user_approver_name);
                                    $('#updated_3').text(approved_at);
                                }
                            }
                            // REJECTED
                            else if (status_id == 4) {
                                $('.action_status').hide();
                                $('#detail_step_1').css('color', 'red');
                                $('#detail_step_2').css('color', 'red');
                                $('#detail_step_3').css('color', 'red');

                                $('#by_phase_2').text(user_checker_name);
                                $('#updated_2').text(checked_at);

                                if (user_approver_name === null || user_approver_name === ''){
                                    $('#phase_status_2').text(status+' ('+rejection_reason+')');
                                    $('#phase_status_3').text('-');
                                    $('#by_phase_3').text('-');
                                    $('#updated_3').text('-');
                                }
                                else {
                                    $('#phase_status_2').text('Completed');
                                    $('#phase_status_3').text(status+' ('+rejection_reason+')');
                                    $('#by_phase_3').text(user_approver_name);
                                    $('#updated_3').text(approved_at);
                                }
                            }
                            // OPEN
                            else if (status_id == 1) {
                                $('.action_status').show();
                                $('#finance-head').empty();

                                $('#detail_step_1').css('color', 'green');

                                $('#updated_2').text('-');
                                $('#by_phase_2').text('-');
                                $('#phase_status_2').text('Not Completed');
                                $('#detail_step_2').css('color', 'gray');

                                $('#updated_3').text('-');
                                $('#by_phase_3').text('-');
                                $('#phase_status_3').text('Not Completed');
                                $('#detail_step_3').css('color', 'gray');

                                $("#finance-head").append(
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2" style="width: 100%;">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12 mg-y-5" style="float: left; padding: 0.65rem 0.75rem; width: inherit;" data-toggle="tooltip" data-placement="right" title="Approve" onClick="$(this).approve_finance('+pon_request_id+')"><i class="fas fa-check-square"></i> Approve</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12" style="float: left; padding: 0.65rem 0.75rem" data-toggle="tooltip" data-placement="right" title="Reject with Reason" onClick="$(this).reject_finance('+pon_request_id+')"><i class="fas fa-times"></i></button>'+
                                            '<input class="form-control tx-12" type="text" name="reject_reason" id="reject_reason" data-parsley-maxlength="50" placeholder="Enter Reason" maxlength="50" autocomplete="off" style="width: 80%;">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12 mg-y-5" style="float: left; padding: 0.65rem 0.75rem; width: inherit;" data-toggle="tooltip" data-placement="right" title="Request for Top Management Approval" onClick="$(this).forward('+pon_request_id+')"><i class="fas fa-share"></i> Request Top Mgmt Approval</button>'+
                                        '</div>'+
                                    '</div>'
                                );

                                $('#finance-head').show();
                                $('#top-mgmt').hide();
                            }
                            else if (status_id == 3){
                                $('.action_status').show();
                                $('#top-mgmt').empty();

                                $('#detail_step_1').css('color', 'green');
                                $('#detail_step_2').css('color', 'green');
                                $('#detail_step_3').css('color', 'gray');

                                $('#by_phase_2').text(user_checker_name);
                                $('#phase_status_2').text('Completed');
                                $('#updated_2').text(checked_at);
                                
                                $('#by_phase_3').text('-');
                                $('#updated_3').text('-');
                                $('#phase_status_3').text('Not Completed');

                                $("#top-mgmt").append(
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2" style="width: 100%;">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12 mg-y-5" style="float: left; padding: 0.65rem 0.75rem; width: inherit;" data-toggle="tooltip" data-placement="right" title="Approve" onClick="$(this).approve_top()"><i class="fas fa-check-square"></i> Approve</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12" style="float: left; padding: 0.65rem 0.75rem" data-toggle="tooltip" data-placement="right" title="Reject with Reason" onClick="$(this).reject_top()"><i class="fas fa-times"></i></button>'+
                                            '<input class="form-control tx-12" type="text" name="reject_reason_top" id="reject_reason_top" data-parsley-maxlength="50" placeholder="Enter Reason" maxlength="50" autocomplete="off" style="width: 80%;">'+
                                        '</div>'+
                                    '</div>'           
                                );

                                $('#finance-head').hide();
                                $('#top-mgmt').show();
                            }


                            if (user_lastname != null || user_lastname != '') {
                                user_fullname += ' '+user_lastname;
                            }

                            if (pon_number === null || pon_number === '') {
                                $('#pon_view_row').hide();
                                $('#current_phase_row').show();

                                pon_number = '-';
                            }
                            else {
                                $('#pon_view_row').show();
                                $('#current_phase_row').hide();
                            }

                            $('#pon_view').text(pon_number);
                            $('#current_phase').text(current_phase);
                            $('#cost_centre').text(cost_centre);
                            $('#supplier').text(supplier);
                            $('#total_price').text(total_price);
                            $('#request_reason').text(reason);
                            $('#estimated_invoice_date').text(estimated_invoice_date);
                            $('#by_phase_1').text(user_fullname);

                            if (updated_at === null || updated_at === ''){
                                $('#updated_1').text(created_at);
                            }
                            else {
                                $('#updated_1').text(updated_at);
                            }
                            $('#modal_pon_request_detail').modal('show');
                        }
                        
                        // GET PON REQUEST ITEM DATA
                        get_pon_request_item(pon_request_id);

                        // GET PON REQUEST ATTACHMENT DATA
                        get_pon_request_attachment(pon_request_id);
                    }
                    else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                        amaran_error(msg.message);
                    }
                    else{
                        amaran_error('Oops, Get PON Request Data Failed!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });

            $.LoadingOverlay("hide");
        });

        // GET PON REQUEST ITEM DATA
        function get_pon_request_item(pon_request_id){
            let data = {
                pon_request_id  : pon_request_id
            };
            
            $.ajax({
                url     : '{{ route("item-list") }}',
                method  : 'POST',
                data    : data,
                datatype: "json",
                headers : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    $.LoadingOverlay('hide');

                    array_item = [];

                    if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                        item_detail_table.clear().draw();

                        if (msg.item_list.length > 0) {
                            for (var i=0; i<msg.item_list.length; i++) {
                                let new_item            = {};

                                let description_item    = msg.item_list[i].description;
                                let quantity_item       = msg.item_list[i].quantity;
                                let unit_price_item     = msg.item_list[i].unit_price;

                                new_item["description"] = description_item;
                                new_item["quantity"]    = quantity_item;
                                new_item["unit_price"]  = unit_price_item;

                                array_item.push(new_item);
                            }

                            for (var i = 0; i < array_item.length; i++) {
                                let each_total  = array_item[i].quantity*array_item[i].unit_price;
                                let index_number = i+1;

                                // DATATABLE DATA CONSTRUCTION
                                var main_data = '<td>'+index_number+'</td>'+
                                    '<td>'+array_item[i].description+'</td>'+
                                    '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                    '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                    '<td>'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                                var menu_bar_header = '';
                                var menu_bar_footer = '</div></div>';
                                var button_menu = '';

                                button_menu = menu_bar_header+menu_bar_footer;

                                var jRow = $('<tr>').append(main_data);
                                item_detail_table.row.add(jRow).draw();
                            }
                        }
                        
                    }
                    else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                        amaran_error(msg.message);
                    }
                    else{
                        amaran_error('Oops, Get PON Request Item Data Failed!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });
        }

        // GET PON REQUEST ATTACHMENT DATA
        function get_pon_request_attachment(pon_request_id){
            let data = {
                pon_request_id  : pon_request_id
            };

            $.ajax({
                url     : '{{ route("file_upload_get") }}',
                method  : 'POST',
                data    : data,
                datatype: "json",
                headers : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (msg) {
                    $.LoadingOverlay('hide');

                    array_file      = [];

                    let number = 1;
                    $('#document-datatable').empty();

                    if (msg.file_list.length == 0) {
                        $('#document-datatable').append('No Uploaded Document.')
                    }
                    else {
                        $("#document-datatable").append(
                            '<thead>'+
                            '<th style="width: 1%">No.</th>'+
                            '<th>File Name</th>'+
                            '</thead>'+
                            '<tbody id="document-datatable_body">'
                        );
                        for (let i = 0; i < msg.file_list.length; ++i) {
                            $("#document-datatable_body").append(
                                '<tr>'+
                                '<th class="pd-4-force tx-center">'+number+'</th>'+
                                '<th class="pd-4-force"><a href="'+msg.path+msg.file_list[i].file_name+'" target="blank">'+msg.file_list[i].file_name+'</a></th>'+
                                '</tr>'
                            );
                            array_file.push(msg.file_list[i].file_name);
                            number++;
                        }                        
                        $("#document-datatable").append('</tbody>');
                    }
                    array_file = array_file.map((str) => ({file_name: str}));
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });
        }



          // ------------------ //
         // DELETE PON REQUEST //
        // ------------------ //

        // DELETE PON REQUEST DATA
        $('#pon_request_datatables tbody').on('click', '.btn-pon-request-click-delete', function () {
            let rowdata         = pon_request_datatable.row($(this).parents('tr')).data();
            let message         = 'Are you sure you want to delete this PON Request?';
            let user_name       = "{{ Session::get('user_name') }}";
            let pon_request_id  = rowdata.pon_request_id;

            let data = {
                pon_request_id  : pon_request_id,
                user_name       : user_name,
            };

            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("pon-request-delete") }}',
                    method  : 'POST',
                    data    : data,
                    datatype: "json",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (msg) {
                        $.LoadingOverlay('hide');

                        if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            amaran_success(msg.message);
                            pon_request_datatable.ajax.reload();
                        }
                        else{
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, function () {}).set('reverseButtons', true);
        });



          // -------------------------- //
         // PON REQUEST CHECKER ACTION //
        // -------------------------- //

        // APPROVE BY CHECKER (HEAD OF FINANCE)
        $.fn.approve_finance = function(pon_request_id) {
            let message = 'Are you sure you want to approve this PON Request?';
            let data    = {
                pon_request_id  : pon_request_id
            };

            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("approve-by-checker") }}',
                    method  : 'POST',
                    data    : data,
                    datatype: "json",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (msg) {
                        $.LoadingOverlay('hide');

                        if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            amaran_success(msg.message);
                            $('#modal_pon_request_detail').modal('hide');
                            pon_request_datatable.ajax.reload();
                        }
                        else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else{
                            amaran_error('Oops, Approve PON Request Failed!');
                        }
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, function () {}).set('reverseButtons', true);
        }

        // REJECT BY CHECKER (HEAD OF FINANCE)
        $.fn.reject_finance = function(pon_request_id) {
            let message = 'Are you sure you want to reject this PON Request?';
            let rejection_reason  = $('#reject_reason').val();
            let data    = {
                pon_request_id      : pon_request_id,
                rejection_reason    : rejection_reason
            };

            if (rejection_reason === null || rejection_reason === ''){
                amaran_error('Please Fill the Rejection Reason!');
            }
            else {
                alertify.confirm(header_confirm,message, function () {
                    $.ajax({
                        url     : '{{ route("reject-by-checker") }}',
                        method  : 'POST',
                        data    : data,
                        datatype: "json",
                        headers : {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function (msg) {
                            $.LoadingOverlay('hide');

                            if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                amaran_success(msg.message);
                                $('#modal_pon_request_detail').modal('hide');
                                pon_request_datatable.ajax.reload();
                            }
                            else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                amaran_error(msg.message);
                            }
                            else{
                                amaran_error('Oops, Reject PON Request Failed!');
                            }
                        },
                        error: function () {
                            $.LoadingOverlay('hide');
                            amaran_error('Something went wrong, please contact technical support!');
                        }
                    });
                }, function () {}).set('reverseButtons', true);
            }
        }

        // FORWARD TO TOP MANAGEMENT BY CHECKER (HEAD OF FINANCE)
        $.fn.forward = function(pon_request_id) {
            let message = 'Are you sure you want to make request to Top Management approval?';
            let data    = {
                pon_request_id : pon_request_id
            };

            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("forward-by-checker") }}',
                    method  : 'POST',
                    data    : data,
                    datatype: "json",
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function (msg) {
                        $.LoadingOverlay('hide');

                        if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            amaran_success(msg.message);
                            $('#modal_pon_request_detail').modal('hide');
                            pon_request_datatable.ajax.reload();
                        }
                        else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else{
                            amaran_error('Oops, Reject PON Request Failed!');
                        }
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, function () {}).set('reverseButtons', true);
        }



          // --------------- //
         // COMMON FUNCTION //
        // --------------- //

        // FILL COST CENTRE OPTION
        function get_cost_centre(){
            $.ajax({
                url         : '{{ route("cost-centre-list") }}',
                method      : 'GET',
                datatype    : "json",
                async       : false,
                success     : function (data) {
                    $('.cost_centre').html('');
                    $('.cost_centre').append('<option value="" selected disabled>Select Cost Centre</option>');
                    
                    if(data.cost_centre_list.length <= 0){
                        $('.cost_centre').html('');
                        $('.cost_centre').attr('disabled', 'disabled');
                        $('.cost_centre').append('<option value="">No Cost Centre Available</option>');
                    }
                    else{
                        for (var i = 0; i < data.cost_centre_list.length; i++) {
                            $('.cost_centre').append('<option value="'+data.cost_centre_list[i].cost_centre_id+'">'+data.cost_centre_list[i].cost_centre_name+'</option>');
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status==403) {
                        location.reload();
                    }
                }
            });
        }

        // FILL COST CENTRE OPTION
        function get_currency(){
            $.ajax({
                url         : '{{ route("currency-list") }}',
                method      : 'GET',
                datatype    : "json",
                async       : false,
                success     : function (data) {
                    $('.currency').html('');
                    $('.currency').append('<option value="" selected disabled>Select Currency</option>');
                    
                    if(data.currency_list.length <= 0){
                        $('.currency').html('');
                        $('.currency').attr('disabled', 'disabled');
                        $('.currency').append('<option value="">No Currency Available</option>');
                    }
                    else{
                        for (var i = 0; i < data.currency_list.length; i++) {
                            $('.currency').append('<option value="'+data.currency_list[i].currency_id+'">'+data.currency_list[i].name+'</option>');
                        }
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(xhr.status==403) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection