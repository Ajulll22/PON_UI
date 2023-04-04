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
            <button class='btn-scale my-auto rounded-xl btn btn-primary modal-add mx-1'><i class="fas fa-plus"></i> Initiate Request
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
@endsection
@section('javascript')
    <script>
        var pon_request_list = @json($data["pon_request_list"]);
        
        let status_data = 0;
        let action      = true;
        var pon_request_datatable   = $('#pon_request_datatables').DataTable({
            data            : pon_request_list,
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
                data    : "approval_id",
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
    </script>
@endsection