@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | User Approval</title>
@endsection

@section('css')
@endsection
@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-check-square"></i>  User Approval</h4>
@endsection
@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> User List</h3>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="br-section-wrapper pd-b-50-force">
            <div class="table-wrapper">
                <table id="user_datatables" class="table display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="wd-5p-force">No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Request Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- APPROVAL MODAL -->
    <div id="modal_approval_user" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Approval User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_approval_user" autocomplete="off">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        User Detail
                    </div>
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th >User name</th>
                                                <td style="padding: 0.5rem !important" id="user_name"></td>
                                                <input type="hidden" name="user_name" id="field_user_name">
                                            </tr>
                                            <tr>
                                                <th >User status</th>
                                                <td style="padding: 0.5rem !important" id="user_active"></td>
                                                <input type="hidden" name="user_active" id="field_user_active">
                                            </tr>
                                            <tr>
                                                <th >Group </th>
                                                <td style="padding: 0.5rem !important" id="group_name"></td>
                                                <input type="hidden" name="group_name" id="field_group_name">
                                            </tr>
                                            <tr>
                                                <th >Subgroup </th>
                                                <td style="padding: 0.5rem !important" id="subgroup_name"></td>
                                                <input type="hidden" name="subgroup_name" id="field_subgroup_name">
                                            </tr>
                                            <tr>
                                                <th >First Name </th>
                                                <td style="padding: 0.5rem !important" id="user_firstname"></td>
                                                <input type="hidden" name="user_firstname" id="field_user_firstname">
                                            </tr>
                                            <tr>
                                                <th >Last Name </th>
                                                <td style="padding: 0.5rem !important" id="user_lastname"></td>
                                                <input type="hidden" name="user_lastname" id="field_user_lastname">
                                            </tr>
                                            <tr>
                                                <th >Email </th>
                                                <td style="padding: 0.5rem !important" id="user_email"></td>
                                                <input type="hidden" name="user_email" id="field_user_email">
                                            </tr>
                                            <tr>
                                                <th >Phone </th>
                                                <td style="padding: 0.5rem !important" id="user_phone"></td>
                                                <input type="hidden" name="user_phone" id="field_user_phone">
                                            </tr>
                                            <tr>
                                                <th >Address </th>
                                                <td style="padding: 0.5rem !important" id="user_address"></td>
                                                <input type="hidden" name="user_address" id="field_user_address">
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td style="padding: 0.5rem !important" id="user_description"></td>
                                                <input type="hidden" name="user_description" id="field_user_description">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        User Data Filter(s)
                    </div>
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12" id="wrapper_table_modal">
                                    <table class="table table-striped table-hover" id="table_data_filter">
                                        <thead>
                                            <th class="wd-5p">#</th>
                                            <th>Data Filter Type</th>
                                            <th>Data Filter Name</th>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Request Detail
                    </div>
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th class="pd-4-force">Request Status </th>
                                                <td class="pd-4-force" id="request_status"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Request Type </th>
                                                <td class="pd-4-force" id="request_type"></td>
                                                <input type="hidden" name="request_type_name" id="field_request_type_name">
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Request by</th>
                                                <td class="pd-4-force" id="request_user_by"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Request Time </th>
                                                <td class="pd-4-force" id="request_user_date"></td>
                                            </tr>
                                            <tr id="container_verified_by" style="display: none;">
                                                <th class="pd-4-force">Verified by</th>
                                                <td class="pd-4-force" id="verified_user_by"></td>
                                            </tr>
                                            <tr id="container_verified_time" style="display: none;">
                                                <th class="pd-4-force">Verified Time </th>
                                                <td class="pd-4-force" id="verified_user_date"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Reason </th>
                                                <td class="pd-4-force" id="request_reason"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Reason
                    </div>
                    <div class="modal-body pd-20" id="reason-container">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <select class="form-control select2" id="select-reason">
                                            <option value=""></option>
                                            @foreach ($data['reason_list'] as $value)
                                                <option value="{{ $value['request_reason_name'] }}">{{ $value['request_reason_name'] }}</option>
                                            @endforeach
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="other-reason" style="display: none;">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Reason" id="field_other_reason" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pd-8-force">
                        <button type="submit" class="btn btn-danger tx-size-xs pd-t-7-force pd-b-7-force" data-status="DECLINED" id="btn_decline">
                            <i class="fa fa-times" ></i> DECLINE
                        </button>
                        <button type="submit" class="btn btn-success tx-size-xs pd-t-7-force pd-b-7-force" id="btn_approve">
                            <i class="fa fa-check"></i>   
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $.fn.dataTable.ext.errMode = function(settings, helpPage, message) {
                if (message != "") {
                    amaran_error();
                }
            };

            $('#select-reason').select2({
                placeholder: "select reason",
                width: '100%',
                allowClear: true,
                dropdownParent: $('#reason-container')
            }).on('change', function(event){
                var selected = this.value;
                if (selected=="other") {
                    $('#other-reason').show();
                    $('#field_other_reason').prop('required',true);
                }else{
                    $('#other-reason').hide();
                    $('#field_other_reason').prop('required',false);
                }
            });
        });

        var approve = "<?php echo $data['privilege_menu'][config('constants.USER_APR_VIEW')] ?>";
        let action = false;
        if (approve) {
            action = true;
        }
        
        var table_df = $('#table_data_filter').DataTable({
            fixedHeader: true,
            scrollY: "200px",
            scrollCollapse: true,
            bSort: false,
            paging: false,
            autoWidth: false,
            bFilter: false,
            bInfo: false,
            responsive: true
        });
        table_df.columns.adjust().draw();

        function check_privilege(feature_level, status_name, type_name) {
            var result ={
                status : false,
                data_status : '',
                btn_text : ''
            };
            var approve_add     = "<?php echo $data['privilege_menu'][config('constants.USER_ADD_APR')] ?>";
            var approve_edit    = "<?php echo $data['privilege_menu'][config('constants.USER_EDIT_APR')] ?>";
            var approve_delete  = "<?php echo $data['privilege_menu'][config('constants.USER_DEL_APR')] ?>";

            var checker_add     = "<?php echo $data['privilege_menu'][config('constants.USER_ADD_CKR')] ?>";
            var checker_edit    = "<?php echo $data['privilege_menu'][config('constants.USER_EDIT_CKR')] ?>";
            var checker_delete  = "<?php echo $data['privilege_menu'][config('constants.USER_DEL_CKR')] ?>";

            if (feature_level==2) {
                if (status_name=='PENDING') {
                    if (
                        (approve_add && type_name=='ADD') ||
                        (approve_edit && type_name=='UPDATE')||
                        (approve_delete && type_name=='DELETE')
                        ) {
                        // var result = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-approve" type="button" data-status="APPROVED"><span class="fa fa-gavel"></span> Approval</button>';
                        result['status']=true;
                        result['data_status']='APPROVED';
                        result['btn_text']='Approval';
                        result['icon']='fas fa-check-square';
                    }
                }

            }else if (feature_level==3) {
                if (status_name=='PENDING') {
                    if (
                        (checker_add && type_name=='ADD') ||
                        (checker_edit && type_name=='UPDATE') ||
                        (checker_delete && type_name=='DELETE')
                        ) {
                            // var result = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-approve" type="button" data-status="VERIFIED"><span class="fa fa-gavel"></span> Checker</button>';
                            result['status']=true;
                            result['data_status']='VERIFIED';
                            result['btn_text']='Verify';
                            result['icon']='fa fa-gavel';
                    }
                }else if (status_name=='VERIFIED') {
                    if (
                        (approve_add && type_name=='ADD') ||
                        (approve_edit && type_name=='UPDATE')||
                        (approve_delete && type_name=='DELETE')
                        ) {
                        // var result = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-approve" type="button" data-status="APPROVED"><span class="fa fa-gavel"></span> Approval</button>';
                        result['status']=true;
                        result['data_status']='APPROVED';
                        result['btn_text']='Approval';
                        result['icon']='fas fa-check-square';
                    }
                }
            }
            return result;
        }

        'use strict';

        var table = $('#user_datatables').DataTable({
            ajax: {
                'url': "{{ route('user-request-list') }}",
                'dataSrc': 'user_list'
            },
            scrollX: true,
            scrollCollapse: true,
            deferRender: true,
            processing: true,
            columns: [{
                    data: null
                },
                {
                    data: "user_name"
                },
                {
                    data: "user_email"
                },
                {
                    data: null
                },
                {
                    data: null
                },
                {
                    data: "request_user_date"
                },
                {
                    data: null,
                    visible: action
                }
            ],
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            },
            columnDefs: [{
                    searchable: false,
                    sortable: true,
                    targets: 0,
                    data: null,
                    render: function(data, type, full, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    targets: -4,
                    sortable: true,
                    data: null,
                    render: function(data, type, full) {
                        var type_name = data.request_type_name;
                        var status = "";
                        if (type_name == 'ADD') {
                            status = '<span class="tx-success" style="font-weight: bold;">' + type_name + '</span>';
                        } else if (type_name == 'UPDATE') {
                            status = '<span class="tx-warning" style="font-weight: bold;">' + type_name + '</span>';
                        } else if (type_name == 'DELETE') {
                            status = '<span class="tx-danger" style="font-weight: bold;">' + type_name + '</span>';
                        }
                        return status;
                    }
                },
                {
                    targets: -3,
                    sortable: true,
                    data: null,
                    render: function(data, type, full) {
                        var status_name=data.request_status_name;
                        var status="";
                        if(status_name=='PENDING'){
                            status ='<span class="label label-warning">'+status_name+'</span>'; 
                        }else if(status_name=='APPROVED'){
                            status ='<span class="label label-success">'+status_name+'</span>'; 
                        }else if(status_name=='VERIFIED'){
                            status ='<span class="label label-info">'+status_name+'</span>'; 
                        }
                        else if(status_name=='DECLINED'){
                            status ='<span class="label label-danger">'+status_name+'</span>'; 
                        }
                
                        return status;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    sortable: true,
                    render: function(data, type, full) {
                        var status_name     = data.request_status_name;
                        var type_name       = data.request_type_name;
                        var temp  = check_privilege(data.feature_level,status_name,type_name); 
                        var result='';
                        if (temp['status']==true) {
                            result= '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-approve" type="button" data-status="'+temp['data_status']+'"><span class="'+temp['icon']+'"></span> '+temp['btn_text']+'</button>';
                        }

                        return result;
                    }
                }
            ],
            "order": [
                [0, 'asc']
            ]
        });


        // APPROVE USER
        $('#user_datatables tbody').on('click', '.btn-user-click-approve', function () {
            $.LoadingOverlay("show");
            var data = table.row($(this).parents('tr')).data();

            $('#select-reason').val('').trigger('change');
            $('#form_approval_user')[0].reset();
            // $('#table_privilege').find("tr:gt(0)").remove();
            $('#user_name').text(data.user_name);
            $('#field_user_name').val(data.user_name);
            
            if (data.user_active == 0 ) {
                $('#user_active').html('<span class="tx-danger" style="font-weight: bold;">Non Active</span>');
            }else{
                $('#user_active').html('<span class="tx-success" style="font-weight: bold;">ADD</span>');
            }
            $('#field_user_active').val(data.user_active);

            $('#group_name').text(data.group_name);
            $('#field_group_name').val(data.group_name);

            $('#subgroup_name').text(data.subgroup_name);
            $('#field_subgroup_name').val(data.subgroup_name);

            $('#user_firstname').text(data.user_firstname);
            $('#field_user_firstname').val(data.user_firstname);

            $('#user_lastname').text(data.user_lastname);
            $('#field_user_lastname').val(data.user_lastname);

            $('#user_email').text(data.user_email);
            $('#field_user_email').val(data.user_email);

            $('#user_phone').text(data.user_phone);
            $('#field_user_phone').val(data.user_phone);

            $('#user_address').text(data.user_address);
            $('#field_user_address').val(data.user_address);

            $('#user_description').text(data.user_description);
            $('#field_user_description').val(data.user_description);

            $('#request_user_by').text(data.request_user_by);
            $('#request_user_date').text(data.request_user_date);

            $('#field_request_type_name').val(data.request_type_name);
            if (data.request_type_name=='ADD') {
                $('#request_type').html('<span class="tx-success" style="font-weight: bold;">ADD</span>');
            }else if(data.request_type_name=='UPDATE'){
                $('#request_type').html('<span class="tx-warning" style="font-weight: bold;">UPDATE</span>');
            }else if (data.request_type_name=='DELETE') {
                $('#request_type').html('<span class="tx-danger" style="font-weight: bold;">DELETE</span>');
            }

            if(data.request_status_name=='PENDING'){
                $('#request_status').html('<span class="label label-warning">PENDING</span>'); 
            }else if(data.request_status_name=='APPROVED')
            {
                $('#request_status').html('<span class="label label-success">APPROVED</span>'); 
            }else if(data.request_status_name=='VERIFIED')
            {
                $('#request_status').html('<span class="label label-info">VERIFIED</span>'); 
                $('#verified_user_by').text(data.verify_user_by);
                $('#verified_user_date').text(data.verify_user_date);
                $('#container_verified_by').show();
                $('#container_verified_time').show();
            }
            else if(data.request_status_name=='DECLINED')
            {
                $('#request_status').html('<span class="label label-danger">DECLINED</span>'); 
            }
            $('#request_reason').text(data.reason);

            // Data Filter
            $('#table_data_filter').find("tr:gt(0)").remove();
                $.ajax({
                    url         : '{{ route("approval-user-data-filter") }}',
                    method      : 'POST',
                    datatype    : "json",
                    headers     : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data        : {
                        user_name: data.user_name
                    },
                    success: function(msg){
                        if (msg['{{ config('constants.result') }}']=="SUCCESS") {
                            var selected_data_filter = msg['data_filter'];

                            var number = 1;
                            for(var key in selected_data_filter){
                                for(var i=0; i<selected_data_filter[key].length; i++) {
                                    $('#table_data_filter').append('<tr>'+
                                        '<td class="pd-4-force text-center">'+number+'</td>'+
                                        '<td class="pd-4-force">'+selected_data_filter[key][i]['type']+'</td>'+
                                        '<td class="pd-4-force">'+selected_data_filter[key][i]['label']+'</td>'+
                                    '</tr>');
                                    number++;
                                }
                                var empty_data_filter = $('#table_data_filter tbody tr').children().length;
                            }
                            if(empty_data_filter == 0){
                                $('#table_data_filter').append('<tr>'+
                                    '<td class="pd-4-force text-center" colspan=3>No Data Filter Selected</td>'+
                                '</tr>');
                            }
                        }else{
                            $.LoadingOverlay('hide');
                            amaran_error(msg.message);
                        }
                    },
                    error: function(msg){
                        // amaran_error();
                    }
                });

            $('#btn_approve').html('<i class="fa fa-check"></i> ' + $(this).text().toUpperCase());
            $('#btn_approve').attr('data-status', $(this).data('status'));
            $('#modal_approval_user').modal('show'); 
            $.LoadingOverlay("hide");
        });
        
        var frm = $('#form_approval_user');
        frm.submit(function (e) {
            e.preventDefault();
            var status_name = $(this).find("button[type=submit]:focus").attr('data-status');
            var action_name = "";
            var color       = "";
            
            if (status_name == "DECLINED") {
                action_name = "DECLINE";
                color       = "red";
            }
            else if (status_name == "VERIFIED") {
                action_name = "VERIFY";
                color       = "blue";
            }
            else {
                action_name = "APPROVE";
                color       = "green";
            }

            var instance        = $('#form_approval_user').parsley();
            var user_name_conf  = $('#user_name').text();

            // Confirmation Message
            var confirm_message = 'Are you sure want to <strong style="color: '+color+'">'+action_name+'</strong> user <strong>'+user_name_conf+'</strong> ?';

            if (instance.validate()) {
                alertify.confirm(header_confirm, confirm_message,
                    function () {
                        var reason="";
                        if ($('#select-reason').val()=='other') {
                            reason = $('#field_other_reason').val();
                        }else{
                            reason = $('#select-reason').val();
                        }

                        var data ={
                            user_name           : $('#field_user_name').val(),
                            user_firstname      : $('#field_user_firstname').val(),
                            user_lastname       : $('#field_user_lastname').val(),
                            user_email          : $('#field_user_email').val(),
                            user_description    : $('#field_user_description').val(),
                            request_type_name   : $('#field_request_type_name').val(),
                            request_status_name : status_name,
                            reason              : reason,
                        }

                        $.ajax({
                            url: '{{ route("user-request-approval") }}',
                            method: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            datatype: "json",
                            success: function (msg) {
                                $.LoadingOverlay('hide');
                                if (msg['{{ config('constants.result') }}'] == "FAILED") {
                                    amaran_error(msg.message);
                                } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                                    $('#modal_approval_user').modal('hide');
                                    amaran_success(msg.message);
                                    $('#form_approval_user')[0].reset();
                                    table.ajax.reload();
                                } else {
                                    amaran_error('Oops, Something went wrong!');
                                }
                            },
                            error: function () {
                                $.LoadingOverlay('hide');
                            }
                        });
                }, function () {}).set('reverseButtons', true);
            }else{
                amaran_error('Failed, please check your input!');
            }
        });
        
        $('#btn_approve').mouseenter(function(){
            $('#select-reason').prop('required',false);
        });
        
        $('#btn_decline').mouseenter(function(){
            $('#select-reason').prop('required',true);
        });
        // END APPROVE USER
    </script>
@endsection