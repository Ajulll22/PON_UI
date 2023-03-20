@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | PON Request Approval</title>
@endsection

@section('css')
    <style type="text/css">
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
    </style>
@endsection

@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-paste"></i> PON Request Approval</h4>
@endsection

@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> PON Request Approval List</h3>
            </div>
        </div>

        <div class="br-section-wrapper pd-b-50-force">
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

                <form id="form_pon_request_detail" autocomplete="off">
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
                                                        <div id="top-mgmt">
                                                        </div>
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

@endsection
@section('javascript')
    <script src="{{ asset('assets/lib/js-sha256/src/sha256.js') }}"></script>
    <script>
        // DATATABLE INITIALIZATION
        'use strict';
        var array_item      = [];
        var array_file      = [];
        
        // GLOBAL VARIABLE
        $(document).ready(function() {
            // SELECT2 DROPDOWN FOR DATATABLES
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            var request_form_table   = $('#request_form_datatable').DataTable({
                "searching": false
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) {
                if(message != ""){
                    amaran_error(message);
                }
            };
        });



          // --------------------------------------------- //
         // PON REQUEST APPROVAL DATATABLE INITIALIZATION //
        // --------------------------------------------- //
        let action      = true;

        var pon_request_datatable   = $('#pon_request_datatables').DataTable({
            ajax: {
                'url'       : "{{ route('pon-request-approval-list') }}",
                'dataSrc'   : 'pon_request_list'
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
                targets     : -5,
                data        : null,
                render      : function(data, type, full){
                    var total_price = data.currency+' '+addComasStatic(Math.round((parseFloat(data.total_price) + Number.EPSILON) * 10000) / 10000); 
                   
                    return total_price;
                }
            },
            {
                targets     : -2,
                data        : null,
                className   : "tx-center",
                render      : function(data, type, full){
                    var pon_status = '';
                    
                    if (data.status_id == '1'){
                        pon_status = '<span style="color:orange;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    else if (data.status_id == '2'){
                        pon_status = '<span style="color:green;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    else if (data.status_id == '3'){
                        pon_status = '<span style="color:orange;font-weight: bold;">Waiting for Approval</span>'; 
                    }
                    else if (data.status_id == '4'){
                        pon_status = '<span style="color:red;font-weight: bold;">'+data.status+'</span>'; 
                    }
                    return pon_status;
                }
            },
            {
                targets     : -1,
                data        : null,
                sortable    : false,
                render      : function(data, type, full){
                    var edit_status     = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_EDIT_MKR')] ?>';
                    var delete_status   = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_DEL_MKR')] ?>';
                    var approver_status = '<?php echo $data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')] ?>';

                    let result          = '';
                    let details_btn     = '';

                    if (approver_status) {
                        if (data.status_id == 3) {
                            details_btn = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="PON Request Approval"><span class="fa fa-gavel"></span></button>';
                        }
                        else {
                            details_btn = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="See Details"><span class="icon ion-clipboard"></span></button>';
                        }
                    }
                    else {
                        details_btn     = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-pon-request-click-details" type="button" data-toggle="tooltip" data-placement="top" title="See Details"><span class="icon ion-clipboard"></span></button>';
                    }

                    result += details_btn;

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



          // ----------------------------- //
         // ITEM DATATABLE INITIALIZATION //
        // ----------------------------- //

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
                url     : '{{ route("pon-request-list-by-id-approval") }}',
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
                                $('#phase_status_2').text(status);
                                $('#updated_2').text(checked_at);
                                $('#detail_step_1').css('color', 'green');
                                $('#detail_step_2').css('color', 'green');
                                $('#detail_step_3').css('color', 'green');

                                if (user_approver_name === null || user_approver_name === ''){
                                    $('#phase_status_3').text('-');
                                    $('#by_phase_3').text('-');
                                    $('#updated_3').text('-');
                                }
                                else {
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
                                $('#phase_status_2').text(status+' ('+rejection_reason+')');
                                $('#updated_2').text(checked_at);

                                if (user_approver_name === null || user_approver_name === ''){
                                    $('#phase_status_3').text('-');
                                    $('#by_phase_3').text('-');
                                    $('#updated_3').text('-');
                                }
                                else {
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

                                $("#top-mgmt").append(
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2" style="width: 100%;">'+
                                            '<button type="button" class="btn btn-outline-primary tx-12 mg-y-5" style="float: left; padding: 0.65rem 0.75rem; width: inherit;" data-toggle="tooltip" data-placement="right" title="Approve" onClick="$(this).approve_top('+pon_request_id+')"><i class="fas fa-check-square"></i> Approve</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="row mg-x-0">'+
                                        '<div class="col-xs-2" style="width:100%">'+
                                            '<button type="button" class="btn btn-outline-primary mg-r-5 tx-12" style="float: left; padding: 0.65rem 0.75rem" data-toggle="tooltip" data-placement="right" title="Reject with Reason" onClick="$(this).reject_top('+pon_request_id+')"><i class="fas fa-times"></i></button>'+
                                            '<input class="form-control tx-12" type="text" name="reject_reason_top" id="reject_reason_top" data-parsley-maxlength="50" placeholder="Enter Reason" maxlength="50" autocomplete="off" style="width: 82%;">'+
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



          // --------------------------- //
         // PON REQUEST APPROVER ACTION //
        // --------------------------- //

        // APPROVE BY APPROVER (MD)
        $.fn.approve_top = function(pon_request_id) {
            let message = 'Are you sure you want to approve this PON Request?';
            let data    = {
                pon_request_id  : pon_request_id
            };

            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("approve-by-top-management") }}',
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
                        }
                        else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else{
                            amaran_error('Oops, Approve PON Request Failed!');
                        }

                        pon_request_datatable.ajax.reload();
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');

                        pon_request_datatable.ajax.reload();
                    }
                });
            }, function () {}).set('reverseButtons', true);
        }

        // REJECT BY APPROVER (MD)
        $.fn.reject_top = function(pon_request_id) {
            let message             = 'Are you sure you want to reject this PON Request?';
            let rejection_reason    = $('#reject_reason_top').val();
            let data = {
                pon_request_id      : pon_request_id,
                rejection_reason    : rejection_reason
            };

            if (rejection_reason === null || rejection_reason === ''){
                amaran_error('Please Fill the Rejection Reason!');
            }
            else {
                alertify.confirm(header_confirm,message, function () {
                    $.ajax({
                        url     : '{{ route("reject-by-top-management") }}',
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
                            }
                            else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                amaran_error(msg.message);
                            }
                            else{
                                amaran_error('Oops, Reject PON Request Failed!');
                            }

                            pon_request_datatable.ajax.reload();
                        },
                        error: function () {
                            $.LoadingOverlay('hide');
                            amaran_error('Something went wrong, please contact technical support!');

                            pon_request_datatable.ajax.reload();
                        }
                    });
                }, function () {}).set('reverseButtons', true);
            }
        }
    </script>
@endsection