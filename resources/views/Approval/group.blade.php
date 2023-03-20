@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Group Approval</title>
@endsection

@section('css')
@endsection
@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-check-square"></i>  Group Approval</h4>
@endsection
@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Group Approval</h3>
            </div>
            <div class="col-md-6">
            </div>
        </div>
        <div class="br-section-wrapper pd-b-50-force">
            <div class="table-wrapper">
                <table id="group_datatables" class="table display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="wd-5p-force">No</th>
                            <th>Group name</th>
                            <th>Group Description</th>
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

    <div id="modal_approval_group" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
        <div class="modal-dialog modal-md" role="document" >
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i> Approval Group</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Group Detail
                </div>
                <form id="form_approval_group" autocomplete="off">
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Group name</th>
                                                <td style="padding: 0.5rem !important" id="group_name"></td>
                                                <input class="form-control" type="hidden" name="field_group_name" id="field_group_name" value="" autocomplete="off">
                                            </tr>
                                            <tr>
                                                <th>Group Description</th>
                                                <td style="padding: 0.5rem !important" id="group_description"></td>
                                                <input class="form-control" type="hidden" name="field_group_description" id="field_group_description" value="" autocomplete="off">
                                            </tr>
                                            <tr>
                                                <th>Group Status</th>
                                                <td style="padding: 0.5rem !important" id="group_active"></td>
                                                <input class="form-control" type="hidden" name="field_group_active" id="field_group_active" value="" autocomplete="off">
                                            </tr>
                                            <tr>
                                                <th>Group Package</th>
                                                <td style="padding: 0.5rem !important" id="group_package"></td>
                                                <input class="form-control" type="hidden" name="field_group_package" id="field_group_package" value="" autocomplete="off">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Group Data Filter(s)
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
                                                <td class="pd-4-force" id="request_group_by"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Request Time </th>
                                                <td class="pd-4-force" id="request_group_date"></td>
                                            </tr>
                                            <tr id="container_verified_by" style="display: none;">
                                                <th class="pd-4-force">Verified by</th>
                                                <td class="pd-4-force" id="verified_group_by"></td>
                                            </tr>
                                            <tr id="container_verified_time" style="display: none;">
                                                <th class="pd-4-force">Verified Time </th>
                                                <td class="pd-4-force" id="verified_group_date"></td>
                                            </tr>
                                            <tr>
                                                <th class="pd-4-force">Request Reason </th>
                                                <td class="pd-4-force" id="request_reason"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Approval/Decline Reason
                    </div>
                    <div class="modal-body pd-20" id="reason-container">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
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
                                        <textarea class="form-control" placeholder="Why this group should be approved/declined?" id="field_other_reason"></textarea>
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
    <script>
        let package_list = JSON.parse('<?php echo json_encode($data['package_list']) ?>');

        $(document).ready(function() {
            // Select2 Initialization
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                if(message!=""){
                    amaran_error();
                }
            };
            
            $('#select-reason').select2({
                placeholder: "Please select a reason",
                width: '100%',
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

    // Datatable Initialization
    'use strict';
    var approve = "<?php echo $data['privilege_menu'][config('constants.GROUP_APR_VIEW')] ?>";
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
        var approve_add     = "<?php echo $data['privilege_menu'][config('constants.GROUP_ADD_APR')] ?>";
        var approve_edit    = "<?php echo $data['privilege_menu'][config('constants.GROUP_EDIT_APR')] ?>";
        var approve_delete  = "<?php echo $data['privilege_menu'][config('constants.GROUP_DEL_APR')] ?>";

        var checker_add     = "<?php echo $data['privilege_menu'][config('constants.GROUP_ADD_CKR')] ?>";
        var checker_edit    = "<?php echo $data['privilege_menu'][config('constants.GROUP_EDIT_CKR')] ?>";
        var checker_delete  = "<?php echo $data['privilege_menu'][config('constants.GROUP_DEL_CKR')] ?>";

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
                    result['btn_text']='Approve';
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
                    result['btn_text']='Approve';
                    result['icon']='fas fa-check-square';
                }
            }
        }
        return result;
    }

        var table = $('#group_datatables').DataTable({
            processing: true,
            deferRender: true,
            ajax: {
                url         : "{{ route('group-request-list') }}",
                dataSrc     : "group_request_list"
            },
            columns: [{
                data: null
            },
            {
                data: "group_name"
            },
            {
                data: "group_description"
            },
            {
                data: null
            },
            {
                data: null
            },
            {
                data: "request_group_date"
            },
            {
                data: null,
                visible: action
            }],
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ data/page',
            },
            columnDefs: [{
                searchable: false,
                sortable: true,
                targets: 0,
                data:null,
                render: function(data, type, full,meta){
                  return meta.row + 1;
                }
            },
            {
                targets: -4,
                sortable: true,
                data: null,
                render: function(data, type, full){
                    var type_name = data.request_type_name;
                    var status = "";

                    if(type_name == "ADD"){
                        status = '<span class="tx-success" style="font-weight: bold;">'+type_name+'</span>'; 
                    }
                    else if(type_name == "UPDATE"){
                        status = '<span class="tx-warning" style="font-weight: bold;">'+type_name+'</span>'; 
                    }
                    else if(type_name == "DELETE"){
                        status = '<span class="tx-danger" style="font-weight: bold;">'+type_name+'</span>'; 
                    }

                    return status;
                }
            },
            {
                targets: -3,
                data: null,
                render: function(data, type, full){
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
                sortable: false,
                render: function(data, type, full){
                    var status_name     = data.request_status_name;
                    var type_name       = data.request_type_name;
                    var temp  = check_privilege(data.feature_level,status_name,type_name); 
                    var result='';
                    if (temp['status']==true) {
                        result = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-approve" type="button" data-status="'+temp['data_status']+'"><span class="'+temp['icon']+'"></span> '+temp['btn_text']+'</button>';
                    }

                    return result;
                }
            }],
            "order": [[ 0, 'asc' ]]
        });

        // Row number
        // table.on('order.dt search.dt', function (){
        //     table.column(0, {
        //     search: 'applied',
        //     order: 'applied'
        //     }).nodes().each(function (cell, i){
        //         cell.innerHTML = i + 1;
        //     });
        // }).draw();
    
        // APPROVE GROUP
        $('#group_datatables tbody').on('click', '.btn-user-click-approve', function () {
            $.LoadingOverlay("show");

            $('#modal_approval_group').modal("show");

            // Reset Form
            $('#form_approval_group')[0].reset();

            // Get Data from Current Selection
            var data = table.row($(this).parents('tr')).data();

            $('#select-reason').val('').trigger('change');

            // Group Name
            $('#group_name').text(data.group_name);
            $('#field_group_name').val(data.group_name);

            // Group Description
            $('#group_description').text(data.group_description);
            $('#field_group_description').val(data.group_description);

            // Group Active
            var status = "";

            if(data.group_active == '1'){
                status ='<span style="color:green;font-weight: bold;">Active</span>'; 
            }
            else{
                status ='<span style="color:red;font-weight: bold;">Non Active</span>'; 
            }

            $('#group_active').html(status);
            $('#field_group_active').val(data.group_active);

            // Group Package
            var package_name = '';
            $.each(package_list, function(index,value){
                if(package_list[index].package_id == data.package_id){
                    package_name = package_list[index].package_name;
                }
            });

            $('#group_package').text(package_name);
            $('#field_group_package').val(package_name);

            // Request By
            $('#request_group_by').text(data.request_group_by);
            $('#request_group_date').text(data.request_group_date);

            // Request Type
            $('#field_request_type_name').val(data.request_type_name);
            if(data.request_type_name == 'ADD'){
                $('#request_type').html('<span class="tx-success" style="font-weight: bold;">ADD</span>');
            }
            else if(data.request_type_name == 'UPDATE'){
                $('#request_type').html('<span class="tx-warning" style="font-weight: bold;">UPDATE</span>');
            }
            else if(data.request_type_name == 'DELETE'){
                $('#request_type').html('<span class="tx-danger" style="font-weight: bold;">DELETE</span>');
            }

            // Request Status
            if(data.request_status_name=='PENDING'){
                $('#request_status').html('<span class="label label-warning">PENDING</span>'); 
            }else if(data.request_status_name=='APPROVED')
            {
                $('#request_status').html('<span class="label label-success">APPROVED</span>'); 
            }else if(data.request_status_name=='VERIFIED')
            {
                $('#request_status').html('<span class="label label-info">VERIFIED</span>');
                $('#verified_group_by').text(data.verify_group_by);
                $('#verified_group_date').text(data.verify_group_date);
                $('#container_verified_by').show();
                $('#container_verified_time').show(); 
            }
            else if(data.request_status_name=='DECLINED')
            {
                $('#request_status').html('<span class="label label-danger">DECLINED</span>'); 
            }

            // Request Reason
            $('#request_reason').text(data.reason);

            $('#table_data_filter').find("tr:gt(0)").remove();
            $.ajax({
                url         : '{{ route("approval-group-data-filter") }}',
                method      : 'POST',
                datatype    : "json",
                headers     : {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data        : {
                    group_name: data.group_name
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
                    $.LoadingOverlay('hide');
                    // amaran_error();
                }
            });

            // Show Modal
            $('#btn_approve').html('<i class="fa fa-check"></i> ' + $(this).text().toUpperCase());
            $('#btn_approve').attr('data-status', $(this).data('status'));
            $('#modal_approval_group').modal('show'); 

            $.LoadingOverlay("hide");
        });
        
        // Function Approval Group
        var frm = $('#form_approval_group');
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

            var instance        = $('#form_approval_group').parsley();
            var group_name_conf = $('#group_name').text();

            // Confirmation Message
            var confirm_message = 'Are you sure want to <strong style="color: '+color+'">'+action_name+'</strong> group <strong>'+group_name_conf+'</strong> ?';

            // Form Submit Action
            if(instance.validate()){
                alertify.confirm(header_confirm, confirm_message,
                    function(){
                        var reason="";
                        if($('#select-reason').val() == 'other'){
                            reason = $('#field_other_reason').val();
                        }
                        else{
                            reason = $('#select-reason').val();
                        }

                        var data = {
                            package_id          : $('#field_group_package').val(),
                            group_name          : $('#field_group_name').val(),
                            group_description   : $('#field_group_description').val(),
                            group_active        : $('#field_group_active').val(),
                            request_type_name   : $('#field_request_type_name').val(),
                            request_status_name : status_name,
                            reason              : reason,
                        }

                        $.ajax({
                            url: '{{ route("group-request-approval") }}',
                            method: 'POST',
                            data: data,
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            datatype: "json",
                            success: function(msg) {
                                $.LoadingOverlay('hide');

                                if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                    amaran_error(msg.message);
                                }
                                else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                    $('#modal_approval_package').modal('hide');
                                    amaran_success(msg.message);
                                    $('#form_approval_group')[0].reset();
                                }
                                else{
                                    amaran_error('Oops, Something went wrong!');
                                }

                                table.ajax.reload();

                                $('#modal_approval_group').modal("hide");
                            },
                            error: function () {
                                $.LoadingOverlay('hide');
                                // amaran_error('Something went wrong, please contact technical support!');

                                table.ajax.reload();
                            }
                        });
                }, function () {}).set('reverseButtons', true);
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });

        $('#btn_approve').mouseenter(function(){
            $('#select-reason').prop('required',false);
        });

        $('#btn_decline').mouseenter(function(){
            $('#select-reason').prop('required',true);
        });
    </script>
@endsection