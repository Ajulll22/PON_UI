@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Group Setup</title>
@endsection

@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-users"></i> Group Setup</h4>
@endsection
@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Group List</h3>
            </div>
            @if ($data['privilege_menu'][config('constants.GROUP_ADD_MKR')])
                <div class="col-md-6">
                    <button class='btn btn-primary add-btn' onclick="add_group()"><i class="fas fa-plus"></i> Add Group</button>
                </div>
            @endif
        </div>

        <div class="br-section-wrapper pd-b-50-force">
            <div class="table-wrapper">
                <table id="group_datatables" class="table display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="wd-5p-force">No</th>
                            <th>Group name</th>
                            <th>Group Description</th>
                            <th>Group Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Group Modal -->
    <div id="modal_add_group" class="modal fade" data-value=''>
        <div class="modal-dialog modal-md" style="width: 800px;" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Add Group</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form id="form_add_group" autocomplete="off" novalidate>
                    <!-- Group Details -->
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Group Detail
                    </div> 
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Package : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectPackage" style="width: 100%" name="package_id" id="package_id" data-search="true" data-parsley-errors-container=".error-message-package-name" required>
                                            <option selected="select" disabled></option>
                                            @foreach($data['package_list'] as $key => $value)
                                                <option value="{{ $value['package_id'] }}">{{ $value['package_name'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="tx-danger error-message-package-name"></div>
                                    </div>
                                </div>   
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Group Name : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="group_name" id="group_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" data-parsley-errors-container=".error-message" required>
                                        <p class="hint-message">Maximum 30 characters</p>
                                        <div class="tx-danger error-message"></div>
                                    </div>
                                </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label">Group Description : </label>
                                        <textarea class="form-control" id="group_description" name="group_description" maxlength="100" placeholder="Enter description" rows="2"></textarea>
                                        <p class="hint-message">Maximum 100 characters</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Filter Details -->
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Data Filter(s)
                    </div>
                    <div class="modal-body pd-20" id="add_data_filter_type_container">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-control-label">Data Filter Type:</label>
                                </div>
                                <div class="wd-45p pd-l-15" style="min-height: 1px; position: relative;">
                                    <div class="form-group">
                                        <select class="form-control select_data_filter_type_add" style="width: 100%" name="data_filter_type_add" id="data_filter_type_add">
                                        @foreach($data['data_filter_type'] as $key => $value)
                                            <option value="{{ strtolower($value['data_filter_type_name']) }}">{{ $value['data_filter_type_name'] }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="wd-10p" style="min-height: 1px; position: relative;"></div>
                                <div class="wd-45p pd-r-15" id="hint-message-wrapper" style="display: none; min-height: 1px; position: relative;">
                                    <div class="form-group">
                                        <div class="d-block d-sm-inline-block-force">
                                            <div class="alert alert-bordered alert-warning pd-y-7-force" role="alert">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                    <span class="hint-message tx-12" id="message_data_filter"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @foreach($data['data_filter_type'] as $key => $value)
                                            <div class="wrapper_data_filter" id="data_filter_{{ strtolower($value['data_filter_type_name']) }}_wrapper" style="display: none;">
                                                <label class="form-control-label">{{ $value['data_filter_type_name'] }} Data Filter</label>
                                                <select multiple="multiple" id="data_filter_{{ strtolower($value['data_filter_type_name']) }}_selected" data-type="{{ strtolower($value['data_filter_type_name']) }}" name="data_filter_{{ strtolower($value['data_filter_type_name']) }}_selected[]"></select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reason -->
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Reason
                    </div>
                    <div class="modal-body pd-20" id="reason-container-add">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <select class="form-control select2" id="select-reason-add" required>
                                            @foreach ($data['reason_list'] as $value)
                                                <option value="{{ $value['request_reason_name'] }}">{{ $value['request_reason_name'] }}</option>
                                            @endforeach
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="other-reason-add" style="display: none;">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Reason" id="field_other_reason_add" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Add Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Group Modal -->
    <div id="modal_update_group" class="modal fade" data-value=''>
        <div class="modal-dialog modal-md" style="width: 800px;" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Update Group</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form id="form_update_group" autocomplete="off">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Group Detail
                    </div> 
                    <div class="modal-body pd-20">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Group Name: <span class="tx-danger">*</span></label>
                                        <div class="tx-danger error-message"></div>
                                        <input class="form-control" type="text" name="update_group_name" id="update_group_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" readonly="readonly" required data-parsley-errors-container=".error-message">
                                        <p class="hint-message">Maximum 30 characters</p>
                                    </div>
                                </div> 

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Package Name: <span class="tx-danger">*</span></label>
                                        <select class="form-control selectPackage" style="width: 100%" name="update_package_id" id="update_package_id" data-search="true" required>
                                            <option selected="select" disabled></option>
                                            @foreach($data['package_list'] as $key => $value)
                                                <option value="{{ $value['package_id'] }}">{{ $value['package_name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>   
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Group Description: </label>
                                        <textarea class="form-control" id="update_group_description" name="update_group_description" maxlength="100" placeholder="Enter description" rows="2"></textarea>
                                        <p class="hint-message">Maximum 100 characters</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Data Filter(s)
                    </div>
                    <div class="modal-body pd-20" id="edit_data_filter_type_container">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-control-label">Data Filter Type:</label>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select_data_filter_type_edit" style="width: 100%" name="edit_data_filter_type" id="edit_data_filter_type">
                                        @foreach($data['data_filter_type'] as $key => $value)
                                            <option value="{{ strtolower($value['data_filter_type_name']) }}">{{ $value['data_filter_type_name'] }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="edit_hint-message-wrapper" style="display: none;">
                                    <div class="form-group">
                                        <div class="d-block d-sm-inline-block-force">
                                            <div class="alert alert-bordered alert-warning pd-y-7-force" role="alert">
                                                <div class="d-flex align-items-center justify-content-start">
                                                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                    <span class="hint-message tx-12" id="edit_message_data_filter"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        @foreach($data['data_filter_type'] as $key => $value)
                                            <div class="wrapper_data_filter_edit" id="edit_data_filter_{{ strtolower($value['data_filter_type_name']) }}_wrapper" style="display: none;">
                                                <label class="form-control-label">{{ $value['data_filter_type_name'] }} Data Filter</label>
                                                <select multiple="multiple" id="edit_data_filter_{{ strtolower($value['data_filter_type_name']) }}_selected" data-type="{{ strtolower($value['data_filter_type_name']) }}" name="edit_data_filter_{{ strtolower($value['data_filter_type_name']) }}_selected[]"></select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reason -->
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        Reason
                    </div>
                    <div class="modal-body pd-20" id="reason-container-edit">
                        <div class="form-layout">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <select class="form-control select2" id="select-reason-edit" required>
                                            @foreach ($data['reason_list'] as $value)
                                                <option value="{{ $value['request_reason_name'] }}">{{ $value['request_reason_name'] }}</option>
                                            @endforeach
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="other-reason-edit" style="display: none;">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Reason" id="field_other_reason_edit" maxlength="100"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Update Group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Request Group Modal -->
    <div id="modal_delete_group" class="modal fade" data-value=''>
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Delete Group</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_delete_group" autocomplete="off">
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Reason
                </div>
                <div class="modal-body pd-20" id="reason-container-delete">
                    <input type="hidden" id="field_delete_group_name">
                    <input type="hidden" id="field_delete_group_description">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <select class="form-control select2" id="select-reason-delete" required>
                                        @foreach ($data['reason_list'] as $value)
                                            <option value="{{ $value['request_reason_name'] }}">{{ $value['request_reason_name'] }}</option>
                                        @endforeach
                                        <option value="other">other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="other-reason-delete" style="display: none;">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Reason" id="field_other_reason_delete" maxlength="100"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-8-force">
                    <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger tx-size-xs pd-t-7-force pd-b-7-force">Delete Group</button>
                </div>
                    <!-- modal-footer -->
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>

@endsection
@section('javascript')
    <script>
        // Start Global Variables
        let group_data_filter   = {};        
        let init_data_filter    = JSON.parse('<?php echo json_encode($data['data_filter']) ?>');        
        let data_filter_type    = JSON.parse('<?php echo json_encode($data['data_filter_type']) ?>');
        let hierarchy           = {};
        let temp_delete_group   = {};

        function set_hierarchy(group_data_filter) {
             // DEFINING DATA FILTER HIERARCHY
            for(var data_filter_key in group_data_filter){
                hierarchy[data_filter_key] = new Array();
                if (group_data_filter[data_filter_key].length>0) {
                    if(group_data_filter[data_filter_key][0]['parent'] != null && group_data_filter[data_filter_key][0]['parent'] != "null"){
                        var parent_type = group_data_filter[data_filter_key][0]['parent_type'].toLowerCase();
                        hierarchy[parent_type].push(data_filter_key);     
                    }
                }
            }
        }
        set_hierarchy(init_data_filter);

        $(document).ready(function(){
            // Select2 Initialization
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                if(message!=""){
                    amaran_error();
                }
            };

            // SHOW ADD GROUP FILTER WRAPPER
            $.each(group_data_filter,function(value,index){
                for(var i=0; i<group_data_filter[value].length; i++){
                    if(group_data_filter[value][i].parent == null || group_data_filter[value][i].parent == 'null'){
                        $('#data_filter_'+group_data_filter[value][i].type.toLowerCase()+'_wrapper').show();
                        break;
                    }
                }
            });

            // SHOW EDIT USER DATA FILTER WRAPPER
            $.each(group_data_filter,function(value,index){
                for(var i=0; i<group_data_filter[value].length; i++){
                    if (group_data_filter[value][i].parent==null || group_data_filter[value][i].parent=='null') {
                        $('#edit_data_filter_'+group_data_filter[value][i].type.toLowerCase()+'_wrapper').show();
                        break;
                    }
                }
            });

            // Package Selection Handle
            $(".selectPackage").select2({
                placeholder: "Select Package"
            }).on('change', function(event){
            });

            // Reason Selection Handle
            $('#select-reason-add').select2({
                placeholder: "Select Addition Reason",
                width: '100%',
                allowClear: true,
                dropdownParent: $('#reason-container-add')
            }).on('change', function(event){
                var selected = this.value;
                if(selected == "other"){
                    $('#other-reason-add').show();
                    $('#field_other_reason_add').prop('required',true);
                }
                else{
                    $('#other-reason-add').hide();
                    $('#field_other_reason_add').prop('required',false);
                }
            });

            $('#select-reason-edit').select2({
                placeholder: "Select Update Reason",
                width: '100%',
                allowClear: true,
                dropdownParent: $('#reason-container-edit')
            }).on('change', function(event){
                var selected = this.value;
                if(selected == "other"){
                    $('#other-reason-edit').show();
                    $('#field_other_reason_edit').prop('required',true);
                }
                else{
                    $('#other-reason-edit').hide();
                    $('#field_other_reason_edit').prop('required',false);
                }
            });

            $('#select-reason-delete').select2({
                placeholder: "Select Deletion Reason",
                width: '100%',
                allowClear: true,
                dropdownParent: $('#reason-container-delete')
            }).on('change', function(event){
                var selected = this.value;
                if (selected=="other") {
                    $('#other-reason-delete').show();
                    $('#field_other_reason_delete').prop('required',true);
                }else{
                    $('#other-reason-delete').hide();
                    $('#field_other_reason_delete').prop('required',false);
                }
            });

            $(".select_data_filter_type_add").select2({
                placeholder: "Select Data Filter Type",
                width: '100%',
                dropdownParent: $('#add_data_filter_type_container')
            }).on('change', function(event){
                var selected = this.value;

                if(selected != ''){
                    // $('#data_filter_'+selected+'_selected option').remove();
                    // $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                    $('.wrapper_data_filter').hide();
                    $('#data_filter_'+selected+'_wrapper').show();

                    if(group_data_filter[selected].length > 0 && 
                        (group_data_filter[selected][0].parent_type != null && group_data_filter[selected][0].parent_type !='null'))
                    {
                        if ($('#data_filter_'+group_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val()==null) {
                            $('#message_data_filter').html('Please select <strong>'+group_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#hint-message-wrapper').show();
                            $('#data_filter_'+selected+'_selected').multiSelect('deselect_all');
                            $('#data_filter_'+selected+'_selected option').remove();
                            $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                        }else{
                            $('#message_data_filter').html('').hide();
                            $('#hint-message-wrapper').hide();
                            var parent_id = $('#data_filter_'+group_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val();
                            var parent_type=group_data_filter[selected][0].parent_type.toLowerCase();
                            
                            $.each(group_data_filter,function(value,index){
                                if(selected==value){
                                    $('#data_filter_'+selected+'_selected option').remove();
                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                    for (var j = 0; j < group_data_filter[selected].length; j++) {
                                        if(parent_id.includes(group_data_filter[selected][j].parent)){
                                  
                                            if (parent_type==group_data_filter[selected][j].parent_type.toLowerCase()) {
                                                if (group_data_filter[selected][j].show=="1") {
                                                    $('#data_filter_'+selected+'_selected').multiSelect('addOption', { value: group_data_filter[selected][j].value, text: group_data_filter[selected][j].label});
                                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }

                                                if(group_data_filter[selected][j].selected=="1"){
                                                    $('#data_filter_'+selected+'_selected').multiSelect('select', group_data_filter[selected][j].value);
                                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }
                    else if(group_data_filter[selected].length > 0){
                        if (group_data_filter[selected][0].parent_type == null || group_data_filter[selected][0].parent_type == 'null') {
                            $('#message_data_filter').html('').hide();
                            $('#hint-message-wrapper').hide();

                            $.each(group_data_filter,function(value,index){
                                if(selected == value){
                                    for(var i=0; i<group_data_filter[selected].length; i++){
                                        if (group_data_filter[selected][i].show=="1") {
                                            $('#data_filter_'+selected+'_selected').multiSelect('addOption', { value: group_data_filter[selected][i].value, text: group_data_filter[selected][i].label});
                                            $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                        }
                                
                                        if(group_data_filter[selected][i].selected=="1"){
                                            $('#data_filter_'+selected+'_selected').multiSelect('select', group_data_filter[selected][i].value);
                                        }
                                        $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                    }
                                }
                            });
                        }else{
                            $('#message_data_filter').html('Please select <strong>'+group_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#hint-message-wrapper').show();
                            $('#data_filter_'+selected+'_wrapper').hide();
                        }
                    }else{
                        $('#message_data_filter').html('<strong>'+selected.toLowerCase()+'</strong> doesn\'t have data filter').show();
                        $('#hint-message-wrapper').show();
                        $('#data_filter_'+selected+'_wrapper').hide();
                    }
                }
                else{
                    $('.wrapper_data_filter').hide();
                }
            });

        
            $(".select_data_filter_type_edit").select2({
                placeholder: "Select Data Filter Type",
                width: '100%',
                dropdownParent: $('#edit_data_filter_type_container')
            }).on('change', function(event){
                var selected = this.value;

                if(selected != ''){
                    // $('#data_filter_'+selected+'_selected option').remove();
                    // $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                    $('.wrapper_data_filter_edit').hide();
                    $('#edit_data_filter_'+selected+'_wrapper').show();

                    if(group_data_filter[selected].length > 0 && 
                        (group_data_filter[selected][0].parent_type != null && group_data_filter[selected][0].parent_type != 'null' ))
                    {
                        if ($('#edit_data_filter_'+group_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val()==null){
                            
                            $('#edit_message_data_filter').html('Please select <strong>'+group_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#edit_hint-message-wrapper').show();
                            $('#edit_data_filter_'+selected+'_selected').multiSelect('deselect_all');
                            $('#edit_data_filter_'+selected+'_selected option').remove();
                            $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                        }else{
                            $('#edit_message_data_filter').html('').hide();
                            $('#edit_hint-message-wrapper').hide();
                            var parent_id = $('#edit_data_filter_'+group_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val();
                            var parent_type=group_data_filter[selected][0].parent_type.toLowerCase();
                            
                            $.each(group_data_filter,function(value,index){
                                if(selected==value){
                                    $('#edit_data_filter_'+selected+'_selected option').remove();
                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');

                                    for (var j = 0; j < group_data_filter[selected].length; j++) {
                                        if(parent_id.includes(group_data_filter[selected][j].parent)){
                                  
                                            if (parent_type==group_data_filter[selected][j].parent_type.toLowerCase()) {
                                                if (group_data_filter[selected][j].show=="1") {
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('addOption', { value: group_data_filter[selected][j].value, text: group_data_filter[selected][j].label});
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }

                                                if(group_data_filter[selected][j].selected=="1"){
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('select', group_data_filter[selected][j].value);
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }
                    else if(group_data_filter[selected].length > 0){
                        if (group_data_filter[selected][0].parent_type == null || group_data_filter[selected][0].parent_type == 'null') {
                            $('#edit_message_data_filter').html('').hide();
                            $('#edit_hint-message-wrapper').hide();

                            $.each(group_data_filter,function(value,index){
                                if(selected == value){
                                    for(var i=0; i<group_data_filter[selected].length; i++){
                                        if (group_data_filter[selected][i].show=="1") {
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('addOption', { value: group_data_filter[selected][i].value, text: group_data_filter[selected][i].label});
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                        }
                                
                                        if(group_data_filter[selected][i].selected=="1"){
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('select', group_data_filter[selected][i].value);
                                        }
                                        $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                    }
                                }
                            });
                        }else{
                            $('#edit_message_data_filter').html('Please select <strong>'+group_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#edit_hint-message-wrapper').show();
                            $('#edit_data_filter_'+selected+'_wrapper').hide();
                        }
                    }else{
                        $('#edit_message_data_filter').html('<strong>'+selected.toLowerCase()+'</strong> doesn\'t have data filter').show();
                        $('#edit_hint-message-wrapper').show();
                        $('#edit_data_filter_'+selected+'_wrapper').hide();
                    }
                }
                else{
                    $('.wrapper_data_filter_edit').hide();
                }
            });
        });

        for(var i=0; i<data_filter_type.length; i++){
            $('#data_filter_'+data_filter_type[i].data_filter_type_name.toLowerCase()+'_selected').multiSelect({
                selectableHeader: "<input type='text' class='form-control search-input mg-b-10' autocomplete='off' placeholder='search..'>",
                selectionHeader: "<input type='text' class='form-control search-input mg-b-10' autocomplete='off' placeholder='search..'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
            
                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if(e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });
            
                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if(e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
                },
                afterSelect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type = $(".select_data_filter_type_add").val();
                    for(var data_filter_key in group_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<group_data_filter[hierarchy[type][i]].length; j++){
                                    group_data_filter[hierarchy[type][i]][j].show = "1";
                                }
                            }
                        }
                    }
                    for(var i=0; i<group_data_filter[type].length; i++){
                        if(group_data_filter[type][i].value == values){
                            group_data_filter[type][i].selected = "1";
                        }
                    }
                },
                afterDeselect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type = $(".select_data_filter_type_add").val();
                    for(var data_filter_key in group_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<group_data_filter[hierarchy[type][i]].length; j++){
                                    if (group_data_filter[hierarchy[type][i]][j].parent   == values) {
                                        group_data_filter[hierarchy[type][i]][j].selected = "0";
                                        group_data_filter[hierarchy[type][i]][j].show     = "0";
                                    }
                                }
                            }
                        }
                    }
                    for(var i=0; i<group_data_filter[type].length; i++){
                        if(group_data_filter[type][i].value   == values){
                            group_data_filter[type][i].selected = "0";
                        }
                    }
                }
            });
        }

        for(var i=0; i<data_filter_type.length; i++){
            $('#edit_data_filter_'+data_filter_type[i].data_filter_type_name.toLowerCase()+'_selected').multiSelect({
                selectableHeader: "<input type='text' class='form-control search-input mg-b-10' autocomplete='off' placeholder='search..'>",
                selectionHeader: "<input type='text' class='form-control search-input mg-b-10' autocomplete='off' placeholder='search..'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch       = that.$selectableUl.prev(),
                        $selectionSearch        = that.$selectionUl.prev(),
                        selectableSearchString  = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString   = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
            
                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                        if(e.which === 40){
                            that.$selectableUl.focus();
                            return false;
                        }
                    });
            
                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                        if(e.which == 40){
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
                },
                afterSelect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type = $(".select_data_filter_type_edit").val();
                    for( var data_filter_key in group_data_filter ) {
                        if(data_filter_key == type) {
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<group_data_filter[hierarchy[type][i]].length; j++){
                                    group_data_filter[hierarchy[type][i]][j].show = "1";
                                }
                            }
                        }
                    }
                    for(var i=0; i<group_data_filter[type].length; i++){
                        if(group_data_filter[type][i].value       == values){
                            group_data_filter[type][i].selected   = "1";
                        }
                    }
                },
                afterDeselect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type=$(".select_data_filter_type_edit").val();
                    for(var data_filter_key in group_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<group_data_filter[hierarchy[type][i]].length; j++){
                                    if (group_data_filter[hierarchy[type][i]][j].parent   == values){
                                        group_data_filter[hierarchy[type][i]][j].selected ="0";
                                        group_data_filter[hierarchy[type][i]][j].show     ="0";
                                    }
                                }
                            }
                        }
                    }
                    for(var i=0; i<group_data_filter[type].length; i++){
                        if(group_data_filter[type][i].value       ==values){
                            group_data_filter[type][i].selected   ="0"; 
                        }
                    }
                }
            });
        }

        // Datatable Initialization
        'use strict';
        let action          = false;
        var edit_status     = '<?php echo $data['privilege_menu'][config('constants.GROUP_EDIT_MKR')] ?>';
        var delete_status   = '<?php echo $data['privilege_menu'][config('constants.GROUP_DEL_MKR')] ?>';
        
        if(edit_status || delete_status){
            action = true;
        }
        var table = $('#group_datatables').DataTable({
            ajax: {
                'url': "{{ route('group-setup-list') }}",
                'dataSrc': 'group_list'
            },
            processing      : true,
            scrollX         : true,
            scrollCollapse  : true,
            deferRender     : true,
            responsive      : true,
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
                data: null,
                visible: action
            }],
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
                targets: -2,
                data: null,
                render: function(data, type, full){
                    var status = '';
                    
                    if(data.group_active=='1'){
                        status ='<span style="color:green;font-weight: bold;">Active</span>'; 
                    }else{
                        status ='<span style="color:red;font-weight: bold;">Non Active</span>'; 
                    }
                    return status;
                }
            },
            {
                targets: -1,
                data: null,
                sortable: true,
                render: function (data){

                    var result = "";
                    var edit_status     = '<?php echo $data['privilege_menu'][config('constants.GROUP_EDIT_MKR')] ?>';
                    var delete_status   = '<?php echo $data['privilege_menu'][config('constants.GROUP_DEL_MKR')] ?>';

                    var edit_btn   = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Edit Group"><span class="icon ion-compose"></span></button>';
                    var delete_btn = '<button style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-user-click-delete" type="button" data-toggle="tooltip" data-placement="top" title="Delete Group"><span class="icon ion-trash-a"></span></button>';

                    if(edit_status){
                        result += edit_btn;
                    }
                    if(delete_status){
                        if (data.allowed_delete != 0) {
                            result += delete_btn;
                        }
                    }

                    return result;
                }
            }],
            "order": [[ 0, 'asc' ]]
        });

        // Group Name Parsley Validation
        let package_id_valid = $("#package_id").parsley();
        let group_name_valid = $("#group_name").parsley();
        $("#group_name").focus(function(){
            $("#group_name").css('border-color', 'rgba(0, 0, 0, 0.15)');
        });

        // ADD GROUP MODAL
        function add_group(){
            $.LoadingOverlay("show");
            $('#form_add_group')[0].reset();
            var instance = $('#form_add_group').parsley();
            instance.reset();
            group_data_filter = {};

            set_hierarchy(init_data_filter);
            group_data_filter = init_data_filter;

            $('#package_id').val('').trigger('change');
            $('#data_filter_type_add').val('').trigger('change');
            $('#select-reason-add').val('').trigger('change');

            $('#modal_add_group').modal("show");
            $.LoadingOverlay('hide');
        }

        var frm = $('#form_add_group');
        frm.submit(function(e){
            e.preventDefault();
            package_id_valid.validate();
            group_name_valid.validate();

            var package_id          = $('#package_id').val();     
            var group_name          = $('#group_name').val();     
            var group_description   = $('#group_description').val();  
            var reason              = "";

            if($('#select-reason-add').val() == 'other'){
                reason = $('#field_other_reason_add').val();
            }
            else{
                reason = $('#select-reason-add').val();
            }

            var data = {
                package_id          : package_id,
                group_name          : group_name,
                group_description   : group_description,
                data_filter         : group_data_filter,
                reason              : reason
            };

            // Ajax Post
            var instance = $('#form_add_group').parsley();
            if(instance.validate()){
                $.ajax({
                    url     : '{{ route("group-setup-add") }}',
                    method  : 'POST',
                    data    : data,
                    headers : {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success : function(msg){
                        $.LoadingOverlay('hide');
                        
                        if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                            $("#group_name").css('border-color', 'rgba(0, 0, 0, 0.15)');
                        }
                        else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            $('#modal_add_group').modal("hide");
                            amaran_success(msg.message);
                            $("#group_name").css('border-color', 'rgba(39, 191, 9, 1)');
                            $('#form_add_group')[0].reset();
                            table.ajax.reload();
                        }
                        else{
                            $("#group_name").css('border-color', 'rgba(0, 0, 0, 0.15)');
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error: function(){
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });

        // Update Group
        $('#group_datatables tbody').on('click', '.btn-user-click-update', function () {
            $.LoadingOverlay("show");

            var instance = $('#form_update_group').parsley();
            instance.reset();
            group_data_filter ={};
            var data = table.row($(this).parents('tr')).data();

            $('#update_package_id').val(data.package_id).change();
            $('#update_group_name').val(data.group_name);
            $('#update_group_description').val(data.group_description);
            $('#edit_data_filter_type').val('').trigger('change');
            $('#select-reason-edit').val('').trigger('change');

            $.ajax({
                url: '{{ route("group-data-filter") }}',
                method: 'POST',
                data: {
                    group_name: data.group_name
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                datatype: "json",
                success: function(msg){
                    $.LoadingOverlay('hide');

                    if(msg['{{ config('constants.result') }}'] == "FAILED"){
                        amaran_error(msg.message);
                    }
                    else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                        set_hierarchy(msg['data_filter']);
                        group_data_filter = msg['data_filter'];
                    }
                    else{
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                }
            });

            $('#modal_update_group').modal("show");
            $.LoadingOverlay("hide");
        });
        
        // Form Update Group
        var frm = $('#form_update_group');
        frm.submit(function (e) {
            e.preventDefault();

            var package_id              = $('#update_package_id').val();     
            var group_name              = $('#update_group_name').val();     
            var group_description       = $('#update_group_description').val();

            var reason = "";
            if($('#select-reason-edit').val() == 'other'){
                reason = $('#field_other_reason_edit').val();
            }
            else{
                reason = $('#select-reason-edit').val();
            }

            var data = {
                package_id          : package_id,
                group_name          : group_name,
                group_description   : group_description,
                data_filter         : group_data_filter,
                reason              : reason
            };

            var instance = $('#form_update_group').parsley();
            if(instance.validate()){

                $.ajax({
                    url: '{{ route("group-setup-update") }}',
                    method: 'POST',
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success: function(msg){
                        $.LoadingOverlay('hide');

                        if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            amaran_success(msg.message);
                            $('#modal_update_group').modal('hide');
                            table.ajax.reload();
                        }
                        else{
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        // amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });
            
        $('#update_group_name').click(function(){
            amaran_warning('Group name can\'t be edit!');
        });

        // Delete Group
        $('#group_datatables tbody').on('click', '.btn-user-click-delete', function(){
            temp_delete_group = {};
            var data = table.row($(this).parents('tr')).data();
            var instance = $('#form_delete_group').parsley();
            instance.reset();
            temp_delete_group={
                group_name        : data.group_name,
                package_id        : data.package_id,
                group_description : data.group_description
            };

            $.ajax({
                url: '{{ route("group-data-filter") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    group_name: data.group_name
                },
                datatype: "JSON",
                success: function(msg) {
                    $.LoadingOverlay('hide');
                    if (msg['{{ config('constants.result') }}'] == "FAILED") {
                        amaran_error(msg.message);
                        $('#modal_delete_package').modal('hide');
                    } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                        temp_delete_group['data_filter'] = msg['data_filter'];
                    } else {
                        $('#modal_delete_group').modal('hide');
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function(msg) {
                    $.LoadingOverlay('hide');
                    // amaran_error();
                }
            });

            $('#select-reason-delete').val('').trigger('change');
            $('#field_delete_group_name').val(data.group_name);
            $('#field_delete_group_description').val(data.group_description);
            $('#modal_delete_group').modal('show');
        });

        // Form Delete Group
        var frm = $('#form_delete_group');
        frm.submit(function(e){
            e.preventDefault();

            var reason = "";
            if($('#select-reason-delete').val() == 'other'){
                reason = $('#field_other_reason_delete').val();
            }
            else{
                reason = $('#select-reason-delete').val();
            }

            temp_delete_group['reason'] = reason;
            var data = temp_delete_group;
            var instance = frm.parsley();
            if(instance.validate()){
                var message = 'Are you sure you want to <strong style="color:red">DELETE</strong> <strong>'+data.group_name+'</strong> group?';
                alertify.confirm(header_confirm,message, function(){
                    $.ajax({
                        url     : '{{ route("group-setup-delete") }}',
                        method  : 'POST',
                        data    : data,
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        datatype: "json",
                        success: function(msg){
                            $.LoadingOverlay('hide');
                            if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                amaran_error(msg.message);
                            }
                            else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                amaran_success(msg.message);
                                table.ajax.reload();
                            }
                            else{
                                amaran_error('Oops, Something went wrong!');
                            }
                            $('#modal_delete_group').modal('hide');
                        },
                        error: function(){
                            $.LoadingOverlay('hide');
                            // amaran_error('Something went wrong, please contact technical support!');
                        }
                    });
                }, function(){}).set('reverseButtons', true);
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });
    
  </script>
@endsection