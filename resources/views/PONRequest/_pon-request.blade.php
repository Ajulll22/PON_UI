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
<div class="d-flex justify-content-between mg-b-5">
    <div class="d-flex">
        <svg class="my-auto" width="37" height="37" viewBox="0 0 23 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="1" y="1" width="15" height="17" rx="2" stroke="#757575" stroke-width="2"/>
            <path d="M12.7394 15.9686L13.6138 13.7219L14.8946 14.8879L12.7394 15.9686Z" fill="#51CBFF"/>
            <rect x="14.9883" y="14.6125" width="1.5" height="10.5684" transform="rotate(-137.684 14.9883 14.6125)" fill="#757575" stroke="#757575" stroke-width="0.3"/>
            <path d="M6.392 8.968C6.59467 8.968 6.77067 8.94267 6.92 8.892C7.072 8.84133 7.196 8.772 7.292 8.684C7.39067 8.59333 7.464 8.48667 7.512 8.364C7.56 8.24133 7.584 8.10667 7.584 7.96C7.584 7.66667 7.48667 7.44133 7.292 7.284C7.1 7.12667 6.80533 7.048 6.408 7.048H5.72V8.968H6.392ZM9.16 12H8.188C8.004 12 7.87067 11.928 7.788 11.784L6.572 9.932C6.52667 9.86267 6.476 9.81333 6.42 9.784C6.36667 9.75467 6.28667 9.74 6.18 9.74H5.72V12H4.644V6.216H6.408C6.8 6.216 7.136 6.25733 7.416 6.34C7.69867 6.42 7.92933 6.53333 8.108 6.68C8.28933 6.82667 8.42267 7.00267 8.508 7.208C8.59333 7.41067 8.636 7.63467 8.636 7.88C8.636 8.07467 8.60667 8.25867 8.548 8.432C8.492 8.60533 8.40933 8.76267 8.3 8.904C8.19333 9.04533 8.06 9.16933 7.9 9.276C7.74267 9.38267 7.56267 9.46667 7.36 9.528C7.42933 9.568 7.49333 9.616 7.552 9.672C7.61067 9.72533 7.664 9.78933 7.712 9.864L9.16 12ZM10.5619 10.936C10.6739 11.072 10.7953 11.168 10.9259 11.224C11.0593 11.28 11.2033 11.308 11.3579 11.308C11.5073 11.308 11.6419 11.28 11.7619 11.224C11.8819 11.168 11.9833 11.0827 12.0659 10.968C12.1513 10.8533 12.2166 10.7093 12.2619 10.536C12.3073 10.36 12.3299 10.1533 12.3299 9.916C12.3299 9.676 12.3099 9.47333 12.2699 9.308C12.2326 9.14 12.1779 9.004 12.1059 8.9C12.0339 8.796 11.9459 8.72 11.8419 8.672C11.7406 8.624 11.6246 8.6 11.4939 8.6C11.2886 8.6 11.1139 8.644 10.9699 8.732C10.8259 8.81733 10.6899 8.93867 10.5619 9.096V10.936ZM10.5099 8.456C10.6779 8.26667 10.8686 8.11333 11.0819 7.996C11.2953 7.87867 11.5459 7.82 11.8339 7.82C12.0579 7.82 12.2619 7.86667 12.4459 7.96C12.6326 8.05333 12.7926 8.18933 12.9259 8.368C13.0619 8.544 13.1659 8.76267 13.2379 9.024C13.3126 9.28267 13.3499 9.58 13.3499 9.916C13.3499 10.2227 13.3086 10.5067 13.2259 10.768C13.1433 11.0293 13.0246 11.256 12.8699 11.448C12.7179 11.64 12.5326 11.7907 12.3139 11.9C12.0979 12.0067 11.8553 12.06 11.5859 12.06C11.3566 12.06 11.1606 12.0253 10.9979 11.956C10.8353 11.884 10.6899 11.7853 10.5619 11.66V13.34H9.57394V7.896H10.1779C10.3059 7.896 10.3899 7.956 10.4299 8.076L10.5099 8.456Z" fill="#51CBFF"/>
        </svg>            
        <div class="ml-3">
            <h4 class="tx-gray-800">PON Request</h4>
            <h6 class="ml-2">List PON Request</h6>
        </div>
    </div>
    @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_MKR')])
        <div class="d-flex justify-content-end">
            <button id="add_modal_show" class='btn-scale my-auto rounded-xl btn btn-primary modal-add mx-1'><i class="fas fa-plus"></i> Initiate Request
            </button>
        </div>
    @endif
</div>
@endsection

@section('body_content')
<div class="card-border p-4">
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
                            <div class="row mg-t-7">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label class="form-control-label">Item Details</label>
                                    <table id="item_detail_datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr id="head-item_detail_datatable" >
                                                <th width="5%">No</th>
                                                <th width="35%">Description</th>
                                                <th width="15%">Quantity</th>
                                                <th width="20%">Unit Price</th>
                                                <th width="5%">Action</th>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 cost_centre" id="cost_centre_add" name="cost_centre_add" style="width: 100%" required>
                                            <option value="">Select Cost Centre</option>
                                            @foreach ($data["cost_centre_list"] as $costCentre)
                                                <option value="{{$costCentre["cost_centre_id"]}}">{{$costCentre["cost_centre_name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 currency" id="currency_add" name="currency_add" style="width: 100%" required>
                                            <option value="">Select Curency</option>
                                            @foreach ($data["currency_list"] as $costCentre)
                                                <option value="{{$costCentre["currency_id"]}}">{{$costCentre["name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Estimated Invoice Date <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="datepicker" id="est_inv_date_add" placeholder="DD/MM/YYYY" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Supplier <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 supplier" id="supplier_add" name="supplier_add" style="width: 100%" required>
                                            <option value="">Select Supllier</option>
                                            @foreach ($data["supplier_list"] as $costCentre)
                                                <option value="{{$costCentre["supplier_id"]}}" {{$costCentre["supplier_id"] == 1 ? "disabled" : ""}} >{{$costCentre["name"]}}</option>
                                            @endforeach
                                        </select>                                    
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
                                        <input list="quantity_item_list_add" class="form-control" type="text" name="quantity_add" id="quantity_add" placeholder="Enter Quantity" maxlength="4" oninput="this.value = forceNumber(this.value)" autocomplete>
                                        <datalist id="quantity_item_list_add">
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label">Unit Price</label>
                                        <input list="unit_price_item_list_add" 
                                            oninput="this.value = formatRupiah(this.value)"
                                            class="form-control" type="text" name="unit_price_add" id="unit_price_add" placeholder="Enter Unit Price" maxlength="15" autocomplete>
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
                    <input type="text" id="pon_request_id_update" hidden>
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Main Details
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20" id="pon-request-detail-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 cost_centre" id="cost_centre_update" name="cost_centre_update" style="width: 100%" required>
                                            <option value="">Select Cost Centre</option>
                                            @foreach ($data["cost_centre_list"] as $costCentre)
                                                <option value="{{$costCentre["cost_centre_id"]}}">{{$costCentre["cost_centre_name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 currency" id="currency_update" name="currency_update" style="width: 100%" required>
                                            @foreach ($data["currency_list"] as $costCentre)
                                                <option value="{{$costCentre["currency_id"]}}">{{$costCentre["name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-control-label">Estimated Invoice Date <span class="tx-danger">*</span></label>
                                    <input type="text" class="form-control fc-datepicker" name="datepicker" id="est_inv_date_update" placeholder="DD/MM/YYYY" autocomplete="off" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Supplier <span class="tx-danger">*</span></label>
                                        <select class="form-control select2 supplier" id="supplier_update" name="supplier_update" style="width: 100%" required>
                                            @foreach ($data["supplier_list"] as $costCentre)
                                                <option value="{{$costCentre["supplier_id"]}}">{{$costCentre["name"]}}</option>
                                            @endforeach
                                        </select>                                    
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
                            <div id="update-pon_form_add">
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
                                            <input list="quantity_item_list_update" class="form-control" type="text" name="quantity_update" id="quantity_update" data-parsley-maxlength="5" placeholder="Enter Quantity" maxlength="4" autocomplete="off" oninput="this.value = forceNumber(this.value)">
                                            <datalist id="quantity_item_list_update">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-control-label">Unit Price</label>
                                            <input list="unit_price_item_list_update" class="form-control" type="text" name="unit_price_update" id="unit_price_update" data-parsley-maxlength="15" placeholder="Enter Unit Price" maxlength="15" oninput="this.value = formatRupiah(this.value)">
                                            <datalist id="unit_price_item_list_update">
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-md-2" style="padding-top: 27px;">
                                        <input type="button" name="add_item_button" class="btn btn-primary" value="Add Item" id="add_item_button_update" style="width: 100%" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mg-t-7" id="update-pon_table">
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

                            <div class="row mg-t-7" id="update-claim_table">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <table id="request_item_claim_datatable_update" class="table table-striped table-bordered" style="background-color: #fff">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center">Description</th>
                                                <th class="text-center">Amount</th>
                                                <th class="text-center">Note</th>
                                            </tr>
                                        </thead>
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
                                        <input class="form-control" type="text" name="reason_update" id="reason_update" data-parsley-maxlength="2000" placeholder="Enter Reason for Investment/Expenditure" maxlength="2000" data-parsley-required>
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

        var change_item = [];

        var last_sequence;
        var last_sequence_index;

        
        $(document).ready(function() {
            // SELECT2 DROPDOWN FOR DATATABLES
            $(".select2").select2({
                matcher: matchCustom
            })
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
                method  : 'GET',
                url     : "{{ route('pon-request-list') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
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
                data    : "pon_request_id",
                visible : false
            },
            {
                data: null
            },
            {
                data: "cost_centre"
            },
            {
                data: "supplier_name"
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


                    details_btn     = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="See Details"><span class="icon ion-clipboard"></span></button>';
                    edit_btn        = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Update PON Request"><span class="icon ion-compose"></span></button>';
                    delete_btn      = '<button style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-pon-request-click-delete" type="button" data-toggle="tooltip" data-placement="top" title="Delete PON Request"><span class="icon ion-trash-a"></span></button>';


                    result += details_btn;

                    if(edit_status){
                        if (data.supplier != 1 && data.status_id == 1) {
                            result += edit_btn;
                        } else if (data.supplier == 1 && data.status_id == 4) {
                            result += edit_btn;
                        }
                    }
                    if(delete_status){
                        if (data.supplier != 1 && data.status_id == 1) {
                            result += delete_btn;
                        }
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

        var item_claim_table_update = $('#request_item_claim_datatable_update').DataTable({
            "searching": false,
        })

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
            unit_price_item = parseInt(unit_price_item.replaceAll(".", ""));

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
        $("#add_modal_show").click( function() {
            $.LoadingOverlay("show");
            
            $('#form_add_pon_request')[0].reset();
            $('#cost_centre_add').val("").change();
            $('#supplier_add').val("").change();
            $('#currency_add').val("").change();
            $('#selected_files_add').text("No File Selected");
            
            array_item          = [];
            array_file          = [];
            last_sequence       = 0;
            last_sequence_index = 0;

            item_request_table.clear().draw();

            let instance = $('#form_add_pon_request').parsley();
            instance.reset();

            // get_cost_centre();
            // get_currency();

            $('#modal_add_pon_request').modal("show");
            $.LoadingOverlay('hide');
        } )

        // SUBMIT - ADD NEW PON REQUEST
        $('#form_add_pon_request').submit(function(event) {
            event.preventDefault();
            let filePost = []
            let pon_request_file = $('input[name="pon_request_file[]"]')[0].files;
            for(var i = 0; i < pon_request_file.length; i++) {
                if (pon_request_file[i].size > 5242880) {
                    amaran_error("Upload Document File Too Big")
                    return
                }
                filePost.push({ file_name: pon_request_file[i].name});
            }
            
            let cost_centre                     = $('#cost_centre_add').val();
            let estimated_invoice_date          = $('#est_inv_date_add').val();
            let supplier                        = $('#supplier_add').val();
            let currency                        = $('#currency_add').val();
            let item_list                       = array_item;
            let investment_expenditure_reason   = $('#reason_add').val();
            let file_list                       = filePost;

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
            unit_price_item = parseInt(unit_price_item.replaceAll(".", ""));

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
            
            let rowdata = pon_request_datatable.row($(this).parents('tr')).data();
            
            let each_total      = 0;
            let grand_total     = 0;
            let pon_request_id  = rowdata.pon_request_id;
            last_sequence       = 0;

            let data = {
                pon_request_id  : pon_request_id
            };

            if (rowdata.supplier == 1) {
                $("#update-pon_form_add").hide();
                $("#reason_update").prop("disabled", true);
            } else {
                $("#update-pon_form_add").show();
                $("#reason_update").prop("disabled", false);
            }
            
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
                        item_claim_table_update.clear().draw();

                        if (msg.item_list.length > 0) {
                            for (var i=0; i<msg.item_list.length; i++) {
                                let new_item            = {};

                                let description_item    = msg.item_list[i].description;
                                let quantity_item       = msg.item_list[i].quantity;
                                let unit_price_item     = msg.item_list[i].unit_price;

                                new_item["description"] = description_item;
                                new_item["quantity"]    = quantity_item;
                                new_item["unit_price"]  = unit_price_item;
                                new_item["item_detail"]  = msg.item_list[i].item_detail;
                                new_item["claim_request_id"]  = msg.item_list[i].claim_request_id;

                                last_sequence = i;
                                array_item.push(new_item);
                            }
                            if (rowdata.supplier == 1) {
                                $("#update-pon_table").hide();
                                $("#update-claim_table").show();
                                // sekarang
                                let nomor = 1;
                                change_item = JSON.parse(JSON.stringify(array_item))
                                change_item.forEach((valData, indexData) => {
                                    valData.item_detail.forEach((valItem, indexItem) => {
                                        let listHtml = `
                                            <td>${nomor++}</td>
                                            <td>${valData.description}</td>
                                            <td>${valItem.claim_category_name}</td>
                                            <td>${valItem.claim_date}</td>
                                            <td>${valItem.claim_desc}</td>
                                            <td style="width: 15%"><input oninput="this.value = formatRupiah(this.value);onInputAmount(event);" value="${formatRupiah(valItem.claim_amount) ?? ""}" data-index_data="${indexData}" data-index_item="${indexItem}" class="form-control" style="font-size: 11px;padding: 4px;" placeholder="Claim Amount" type="text"></td>
                                            <td style="width: 15%">${valItem.note ?? ""}</td>
                                        `
                                        var jRow = $('<tr>').append(listHtml);
                                        item_claim_table_update.row.add(jRow).draw();
                                    });
                                });

                            } else {
                                $("#update-pon_table").show();
                                $("#update-claim_table").hide();
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
            $('#supplier_update').val(rowdata.supplier).change();
            if (rowdata.supplier == 1) {
                $('#supplier_update').prop('disabled', true);
            }else {
                $('#supplier_update').prop('disabled', false);
            }
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

            let pon_request_file = $('input[name="pon_request_file_update[]"]')[0].files;
            if (pon_request_file.length > 0) {
                for(var i = 0; i < pon_request_file.length; i++) {
                    if (pon_request_file[i].size > 5242880) {
                        amaran_error("Upload Document File Too Big")
                        return
                    }
                }
            }
            
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
                file_list                       : JSON.stringify(file_list),
            };

            if (supplier == 1) {
                const update_item_list = [];
                change_item.forEach((valData, indexData) => {
                    valData.item_detail.forEach((valItem, indexItem) => {
                        if (valItem.claim_amount != array_item[indexData].item_detail[indexItem].claim_amount) {
                            let indexChange = update_item_list.findIndex( el => el.claim_request_id == valData.claim_request_id);
                            if (indexChange == -1) {
                                update_item_list.push({
                                    claim_request_id: valData.claim_request_id,
                                    item_detail: [
                                        {
                                            claim_item_id: valItem.claim_item_id,
                                            amount: valItem.claim_amount
                                        }
                                    ]
                                })
                            } else {
                                update_item_list[indexChange].item_detail.push({
                                    claim_item_id: valItem.claim_item_id,
                                    amount: valItem.claim_amount
                                })
                            }
                        }
                    })
                });

                data.item_list = JSON.stringify(update_item_list)
            }

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

            console.log(rowdata);

            
            let pon_number              = rowdata.pon_number;
            let current_phase           = rowdata.current_phase;
            let cost_centre             = rowdata.cost_centre;
            let supplier                = rowdata.supplier_name;
            let total_price             = addComasStatic(Math.round((parseFloat(rowdata.total_price) + Number.EPSILON) * 10000) / 10000);
            let reason                  = rowdata.reason;
            let rejection_reason        = rowdata.rejection_reason;
            let estimated_invoice_date  = rowdata.estimated_invoice_date;
            let created_at              = rowdata.created_at;
            let updated_at              = rowdata.updated_at;
            let user_firstname          = rowdata.user_firstname;
            let user_lastname           = rowdata.user_lastname;
            let user_fullname           = user_firstname;
            let status_id               = rowdata.status_id;
            let status                  = rowdata.status;
            let user_checker_name       = rowdata.user_checker_name;
            let checked_at              = rowdata.checked_at;
            let user_approver_name      = rowdata.user_approver_name;
            let approved_at             = rowdata.approved_at;

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

            if (rowdata.supplier == "1") {
                $("#head-item_detail_datatable").html(`
                    <th width="5%">No</th>
                    <th width="35%">Name</th>
                    <th width="15%">Quantity</th>
                    <th width="20%">Total Price</th>
                    <th width="5%">Action</th>
                `)
            } else {
                $("#head-item_detail_datatable").html(`
                    <th width="5%">No</th>
                    <th width="35%">Description</th>
                    <th width="15%">Quantity</th>
                    <th width="20%">Unit Price</th>
                    <th width="20%">Total Price</th>
                `)
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
            // GET PON REQUEST ITEM DATA
            get_pon_request_item(pon_request_id, rowdata.supplier);

            // GET PON REQUEST ATTACHMENT DATA
            get_pon_request_attachment(pon_request_id);

            $.LoadingOverlay("hide");
        });

        // GET PON REQUEST ITEM DATA
        async function get_pon_request_item(pon_request_id, supplier){
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
                    console.log(msg);

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
                                new_item["item_detail"]  = msg.item_list[i].item_detail;

                                array_item.push(new_item);
                            }

                            for (var i = 0; i < array_item.length; i++) {
                                let each_total  = array_item[i].quantity*array_item[i].unit_price;
                                let index_number = i+1;

                                // DATATABLE DATA CONSTRUCTION
                                let main_data = "";
                                if (supplier == 1) {           
                                    main_data = '<td>'+index_number+'</td>'+
                                        '<td>'+array_item[i].description+'</td>'+
                                        '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                        '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                        '<td>'+'<button onclick="getRowChild(event)" style="text-decoration: none;" class="btn btn-outline-primary" type="button" title="Claim Detail"><span class="my-auto icon ion-eye"></span></button>'+'</td>';
                                } else {
                                    main_data = '<td>'+index_number+'</td>'+
                                        '<td>'+array_item[i].description+'</td>'+
                                        '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].quantity) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                        '<td>'+addComasStatic(Math.round((parseFloat(array_item[i].unit_price) + Number.EPSILON) * 10000) / 10000)+'</td>'+
                                        '<td>'+addComasStatic(Math.round((parseFloat(each_total) + Number.EPSILON) * 10000) / 10000)+'</td>';

                                }

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

        function getRowChild(e) {  
            let tr = e.target.closest('tr');
            let row = item_detail_table.row(tr);
            const indexData = parseInt(row.data()[0])-1
            const dataItem = array_item[indexData];
            if (row.child.isShown()) {
                row.child.hide();
            } else {
                if (dataItem.item_detail.length) {
                    let childHtml = ``;
                    dataItem.item_detail.forEach((val, indexItem) => {
                        childHtml += `<tr>
                            <td>${val.claim_category_name}</td>
                            <td>${val.claim_date}</td>
                            <td>${val.claim_amount}</td>
                            <td>${val.claim_desc}</td>
                            <td>${val.note ?? ""}</td>
                        </tr>`
                    });
                    row.child(`
                        <table class='border'>
                            <tbody>
                                <tr>
                                    <th>Claim Category</th>
                                    <th>Claim Date</th>
                                    <th>Claim Amount</th>
                                    <th>Claim Description</th>
                                    <th>Note</th>
                                </tr>
                                ${childHtml}
                            </tbody>
                        </table>
                    `).show();
                } else {
                    row.child("<div class='text-center'>No Item Detail Found</div>").show();
                }
            }
        }

        // GET PON REQUEST ATTACHMENT DATA
        async function get_pon_request_attachment(pon_request_id){
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

        function forceNumber(angka) {
            angka = angka.replaceAll(",", "");
            angka = angka.replace(/[^,\d]/g, '').toString();

            return angka;
        }

        function formatRupiah(angka)
        {
            angka = angka.replaceAll(",", "");
            angka = angka.replace(/^0+/, '');
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split    = number_string.split(','),
                sisa     = split[0].length % 3,
                rupiah     = split[0].substr(0, sisa),
                ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
                
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah ? rupiah : 0;

        }

        function onInputAmount(e) {  
            const indexData = parseInt($(e.target).data("index_data"));
            const indexItem = parseInt($(e.target).data("index_item"));
            change_item[indexData].item_detail[indexItem].claim_amount = forceNumber(e.target.value);
        }

        

        function matchCustom(params, data) {
            // If there are no search terms, return all of the data
            if ($.trim(params.term) === '') {
                return data;
            }

            // Do not display the item if there is no 'text' property
            if (typeof data.text === 'undefined') {
                return null;
            }

            // `params.term` should be the term that is used for searching
            // `data.text` is the text that is displayed for the data object
            if (data.text.toLowerCase().indexOf(params.term.toLowerCase()) > -1) {
                var modifiedData = $.extend({}, data, true);

                // You can return modified objects from here
                // This includes matching the `children` how you want in nested data sets
                return modifiedData;
            }

            // Return `null` if the term should not be displayed
            return null;
        }
    </script>
@endsection