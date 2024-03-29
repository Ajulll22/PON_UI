@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | Sub Group Setup</title>
@endsection

@section('css')
@endsection
@section('header_content')
<h4 class="tx-gray-800 mg-b-5"><i class="fas fa-users"></i>  Subgroup Setup</h4>
@endsection
@section('body_content')
<div class="card mg-b-80">
    <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
        <div class="col-md-6">
            <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> Subgroup List</h3>
        </div>
        @if ($data['privilege_menu'][config('constants.SUBGROUP_ADD_MKR')])
          <div class="col-md-6">
              <button class='btn btn-primary add-btn' onclick="add_subgroup()"><i class="fas fa-plus"></i> Add Subgroup</button>
          </div>
        @endif
    </div>
    <div class="br-section-wrapper pd-b-50-force">
        <div class="table-wrapper">
            <table id="subgroup_datatables" class="table display responsive nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="wd-5p-force">No</th>
                        <th>Subgroup name</th>
                        <th>Subgroup Description</th>
                        <th>Group Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- table-wrapper -->
    </div>
    <!-- br-section-wrapper -->
</div>
<!-- ADD MODAL -->
<div id="modal_add_subgroup" class="modal fade" data-value=''>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Add Subgroup</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                Subgroup Detail
            </div>
            <form id="form_add_subgroup" autocomplete="off">
                <div class="modal-body pd-20">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Group Name : <span class="tx-danger">*</span></label>
                                    <select class="form-control selectGroup" style="width: 100%" name="group_id" id="group_id" data-search="true" required>
                                        @foreach ($data['group_list'] as $group)
                                        <option value="{{ $group['group_id'] }}" package_name="{{ $group['package_name'] }}">{{ $group['group_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Subgroup Name : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="subgroup_name" id="subgroup_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" data-parsley-pattern="^[a-zA-Z0-9]([@_](?![@_])|[a-zA-Z0-9\s]){6,30}[a-zA-Z0-9]$" required>
                                    <p class="hint-message">Use 6 to 30 characters</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label">Subgroup Description : </label>
                                    <textarea class="form-control" id="subgroup_description" name="subgroup_description" maxlength="100" placeholder="Enter description"></textarea>
                                    <p class="hint-message">Maximum 100 characters</p>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- form-layout -->
                </div>
                <!-- modal-body -->
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Subgroup Privilege(s)
                </div>
                <div class="modal-body pd-20">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group coba-apus">
                                    <select multiple="multiple" class="priv_select" id="priv_selected" name="priv_selected[]" required>
                                        <option value=""></option>
                                    </select>
                                </div>
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
                                    <select class="form-control select2" id="select-reason" required>
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
                    <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Add Subgroup</button>
                </div>
                <!-- modal-footer -->
            </form>
        </div>
    </div>
    <!-- modal-dialog -->
</div>
<!--END ADD MODAL -->

<!-- EDIT MODAL -->
<div id="modal_edit_subgroup" class="modal fade" data-value=''>
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Edit Subgroup</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                Subgroup Detail
            </div>
            <form id="form_edit_subgroup" autocomplete="off">
                <div class="modal-body pd-20">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Group Name : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="hidden" name="edit_group_id" id="edit_group_id" value="" maxlength="30" placeholder="Enter name" autocomplete="off" required readonly="readonly">
                                    <input class="form-control" type="text" name="edit_group_name" id="edit_group_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" required readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Subgroup Name : <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="edit_subgroup_name" id="edit_subgroup_name" value="" maxlength="30" placeholder="Enter name" autocomplete="off" required readonly="readonly">
                                    <p class="hint-message">Maximum 30 characters</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label">Subgroup Description : </label>
                                    <textarea class="form-control" id="edit_subgroup_description" name="edit_subgroup_description" maxlength="100" placeholder="Enter description"></textarea>
                                    <p class="hint-message">Maximum 100 characters</p>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- form-layout -->
                </div>
                <!-- modal-body -->
                <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                    Subgroup Privilege(s)
                </div>
                <div class="modal-body pd-20">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select multiple="multiple" id="edit_priv_selected" name="edit_priv_selected[]" required>
                                        {{-- @foreach ($data['privilege_list'] as $priv)
                                        <option value="{{ $priv['privilege_id'] }}">{{ $priv['privilege_name'] }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <div class="col-md-12" id="other-reason-edit" style="display: none;">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Reason" id="field_other_reason_edit" maxlength="100"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-8-force">
                    <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Update Subgroup</button>
                </div>
                <!-- modal-footer -->
            </form>
        </div>
    </div>
    <!-- modal-dialog -->
</div>
<!--END EDIT MODAL -->

<!-- REQUEST DELETE MODAL -->
<div id="modal_delete_subgroup" class="modal fade" data-value=''>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Delete Subgroup</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_delete_subgroup" autocomplete="off">
            <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                Reason
            </div>
            <div class="modal-body pd-20" id="reason-container-delete">
                <div class="form-layout">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Reason</label>
                                <select class="form-control select2" id="select-reason-delete" required>
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
                <button type="submit" class="btn btn-danger tx-size-xs pd-t-7-force pd-b-7-force">Delete Subgroup</button>
            </div>
                <!-- modal-footer -->
            </form>
        </div>
    </div>
    <!-- modal-dialog -->
</div>
<!--REQUEST DELETE MODAL -->
@endsection
@section('javascript')
<script>
    {{-- Global Variable --}}
    let data_privilege = JSON.parse('<?php echo json_encode($data['privilege_list']) ?>');
    let data_group = JSON.parse('<?php echo json_encode($data['group_list']) ?>');
    let temp_delete_subgroup ={};
    {{-- END Global Variable --}}

    $('.selectGroup').on('change', function() {
        var groupPrivPack = $(this).find('option:selected').attr("package_name")
        if(groupPrivPack !== undefined){
            getPackagePrivilage(groupPrivPack);
        }
    });

    function getPackagePrivilage(package_name){
        var data = {package_name}

        $.ajax({
            url         : '{{ route("subgroup.privilage_list") }}',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            datatype: "json",
            success     : function (data) {
                $('#priv_selected').empty();
                for (var i = 0; i < data.length; i++) {
                    $('#priv_selected').append('<option value="'+data[i].privilege_id+'">'+data[i].privilege_name+'</option>');
                }
                $('#priv_selected').multiSelect('refresh'); 
            }
        });
    }

    function getPackagePrivilageEdit(package_name, selected){
        var data = {package_name}

        $.ajax({
            url         : '{{ route("subgroup.privilage_list") }}',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            datatype: "json",
            success     : function (data) {
                $('#edit_priv_selected').empty();
                for (var i = 0; i < data.length; i++) {
                    $('#edit_priv_selected').append('<option value="'+data[i].privilege_id+'">'+data[i].privilege_name+'</option>');
                }
                $("#edit_priv_selected").multiSelect('refresh');
                $.each(selected, function(index, value){
                    if(value.privilege_selected=='1'){
                        $('#edit_priv_selected').multiSelect('select', value.privilege_id);
                    }
                });
                $("#edit_priv_selected").multiSelect('refresh');
            }
        });
    }
    
    $(document).ready(function() {
      $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
      });
      
      $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
        if(message!=""){
          amaran_error();
        }
      };
    
      $(".selectGroup").select2({
          placeholder: "select group"
      }).on('change', function(event){
      });

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

      $('#select-reason-delete').select2({
            placeholder: "select reason",
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

        $('#select-reason-edit').select2({
            placeholder: "select reason",
            width: '100%',
            allowClear: true,
            dropdownParent: $('#reason-container-edit')
        }).on('change', function(event){
            var selected = this.value;
            if (selected=="other") {
                $('#other-reason-edit').show();
                $('#field_other_reason_edit').prop('required',true);
            }else{
                $('#other-reason-edit').hide();
                $('#field_other_reason_edit').prop('required',false);
            }
        });
    });

    $('#priv_selected').multiSelect({
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
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });
    
        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });  
    
    
    $('#edit_priv_selected').multiSelect({
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
          if (e.which === 40){
            that.$selectableUl.focus();
            return false;
          }
        });
    
        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
        .on('keydown', function(e){
          if (e.which == 40){
            that.$selectionUl.focus();
            return false;
          }
        });
      },
      afterSelect: function(){
        this.qs1.cache();
        this.qs2.cache();
      },
      afterDeselect: function(){
        this.qs1.cache();
        this.qs2.cache();
      }
    });
    
    'use strict';
    var edit_status = '<?php echo $data['privilege_menu'][config('constants.SUBGROUP_EDIT_MKR')] ?>';
    var delete_status = '<?php echo $data['privilege_menu'][config('constants.SUBGROUP_DEL_MKR')] ?>';
    let action=false;
    if (edit_status || delete_status) {
        action= true;
    }
    var table = $('#subgroup_datatables').DataTable({
      ajax: {
        'url': "{{ route('subgroup-setup-list') }}",
        'dataSrc': 'subgroup_list'
      },
      scrollX:true,
      scrollCollapse : true,
      deferRender: true,
      processing:true,
      columns: [{
          data: null
        },
        {
          data: "subgroup_name"
        },
        {
          data: "subgroup_description"
        },
        {
          data: "group_name"
        },
        {
          data: null,
          visible: action
        }
      ],
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      },
      columnDefs: [
      {
        searchable: false,
        sortable: true,
        targets: 0,
        data:null,
        render: function (data, type, full,meta) {
          return meta.row+1;
        }
      },
      {
        targets: -1,
        data: null,
        sortable: false,
        render: function (data) {
            var result = "";
            var edit_status = '<?php echo $data['privilege_menu'][config('constants.SUBGROUP_EDIT_MKR')] ?>';
            var delete_status = '<?php echo $data['privilege_menu'][config('constants.SUBGROUP_DEL_MKR')] ?>';
            
            var edit_btn        = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Edit Subgroup"><span class="icon ion-compose"></span></button>';
            var delete_btn      = '<button style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-user-click-delete" type="button" data-toggle="tooltip" data-placement="top" title="Delete Subgroup"><span class="icon ion-trash-a"></span></button>';

            if (edit_status) {
              result += edit_btn;
            }
            if (delete_status) {
                if (data.allowed_delete != 0) {
                    result += delete_btn;
                }
            }
            return result;
        }
      }],
      "order": [[ 0, 'asc' ]]
    });
    
    // ADD SUBGROUP
    
    function add_subgroup() {
        $.LoadingOverlay("show");

        $('#priv_selected').empty();
        $('#priv_selected').multiSelect('refresh');

        var instance = $('#form_add_subgroup').parsley();
        instance.reset();
      // Event Change select2
        $('#group_id').val('').trigger('change');
        $('#select-reason').val('').trigger('change');

        // Fill Value
        $('#subgroup_name').val('');
        $('#subgroup_description').val('');

        $('#modal_add_subgroup').modal("show");
        $.LoadingOverlay('hide');
    }
    
    var frm = $('#form_add_subgroup');
    frm.submit(function (e) {
        e.preventDefault();
        var priv_selected = [];
        var group_id='';
        var subgroup_name = '';
        var subgroup_description = '';
        var privilege_list = [];
    
        group_id              = $('#group_id').val();
        subgroup_name         = $('#subgroup_name').val();
        subgroup_description  = $('#subgroup_description').val();
        priv_selected         = $('#priv_selected').val();
        
        var instance          = $('#form_add_subgroup').parsley();
        instance.reset();

        if (instance.validate()) {
            $.each(data_privilege, function(index, value){
                if(priv_selected.includes(value.privilege_id)){
                  privilege_list.push({
                    privilege_id: value.privilege_id,
                    privilege_name: value.privilege_name,
                    privilege_selected: '1'
                  });
                }else{
                  privilege_list.push({
                    privilege_id: value.privilege_id,
                    privilege_name: value.privilege_name,
                    privilege_selected: '0'
                  });
                }
            });


            var reason="";
            if ($('#select-reason').val()=='other') {
                reason = $('#field_other_reason').val();
            }else{
                reason = $('#select-reason').val();
            }

            var data = {
                group_id            : group_id,
                subgroup_name       : subgroup_name,
                subgroup_description: subgroup_description,
                privilege_list      : privilege_list,
                reason              : reason
            };

            $.ajax({
                url: '{{ route("subgroup-setup-add") }}',
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
                        amaran_success(msg.message);
                        $('#form_add_subgroup')[0].reset();
                        $('#priv_selected').multiSelect('deselect_all');
                        $("#priv_selected").multiSelect('refresh');
                        table.ajax.reload();
                        $('#modal_add_subgroup').modal('hide');
                    } else {
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    // amaran_error('Something went wrong, please contact technical support!');
                }
            });
        }else{
            amaran_error('Failed, please check your input!');
        }
    });
    // END ADD SUBGROUP
    
    // EDIT SUBGROUP
    $('#subgroup_datatables tbody').on('click', '.btn-user-click-update', function () {
        $.LoadingOverlay("show");
        $('#form_edit_subgroup')[0].reset();
        
        var instance = $('#form_edit_subgroup').parsley();
        instance.reset();

        $('#select-reason-edit').val('').trigger('change');
        $("#edit_priv_selected").multiSelect('deselect_all');
        $("#edit_priv_selected").multiSelect('refresh');

        var data = table.row($(this).parents('tr')).data();
        $('#edit_group_id').val(data.group_id);
        $('#edit_group_name').val(data.group_name);
        $('#edit_subgroup_name').val(data.subgroup_name);
        $('#edit_subgroup_description').val(data.subgroup_description);

        getPackagePrivilageEdit(data.package_name, data.privilege_list);

        // $.each(data.privilege_list, function(index, value){
        //     if(value.privilege_selected=='1'){
        //         $('#edit_priv_selected').multiSelect('select', value.privilege_id);
        //     }
        // });
        // $("#edit_priv_selected").multiSelect('refresh');
        $('#modal_edit_subgroup').modal('show'); 
    
        // $.ajax({
        //     url    : '{{ route("list-subgroup-privilege") }}',
        //     method : 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //     },
        //     data   :{
        //         subgroup_name:data.subgroup_name
        //     },
        //     datatype: "JSON",
        //     success: function(msg){
        //         var selected_privilege = msg.privilege_list;
        //         $.each(selected_privilege, function(index, value){
        //             if(value.privilege_selected=='1'){
        //                 $('#edit_priv_selected').multiSelect('select', value.privilege_id);
        //             }
        //         });
        //         $("#edit_priv_selected").multiSelect('refresh');
        //         $('#modal_edit_subgroup').modal('show'); 
        //     },
        //     error: function(msg){
        //         $.LoadingOverlay('hide');
        //         // amaran_error();
        //     }
        // });
        $.LoadingOverlay("hide");
    });
    
    var frm = $('#form_edit_subgroup');
    frm.submit(function (e) {
        e.preventDefault();
        var priv_selected = [];
        var subgroup_name = '';
        var subgroup_description = '';
        var privilege_list = [];
        var group_id ='';
    
        group_id              = $('#edit_group_id').val();
        subgroup_name         = $('#edit_subgroup_name').val();
        subgroup_description  = $('#edit_subgroup_description').val();
        priv_selected         = $('#edit_priv_selected').val();
    
        var instance = $('#form_edit_subgroup').parsley();
        if (instance.validate()) {
            $.each(data_privilege, function(index, value){
                if(priv_selected.includes(value.privilege_id)){
                    privilege_list.push({
                        privilege_id: value.privilege_id,
                        privilege_name: value.privilege_name,
                        privilege_selected: '1'
                    });
                }else{
                    privilege_list.push({
                        privilege_id: value.privilege_id,
                        privilege_name: value.privilege_name,
                        privilege_selected: '0'
                    });
                }
            });

            var reason="";
            if ($('#select-reason-edit').val()=='other') {
                reason = $('#field_other_reason_edit').val();
            }else{
                reason = $('#select-reason-edit').val();
            }

            var data = {
                group_id            : group_id,
                subgroup_name       : subgroup_name,
                subgroup_description: subgroup_description,
                privilege_list      : privilege_list,
                reason              : reason
            };   

            $.ajax({
                url: '{{ route("subgroup-setup-update") }}',
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
                        amaran_success(msg.message);
                        $('#modal_edit_subgroup').modal('hide');
                        $('#form_edit_subgroup')[0].reset();
                        $('#edit_priv_selected').multiSelect('deselect_all');
                        table.ajax.reload();
                        $('#modal_edit_subgroup').modal('hide');
                    } else {
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    // amaran_error('Something went wrong, please contact technical support!');
                }
            });
        }else{
            amaran_error('Failed, please check your input!');
        }
    });
    // END EDIT SUBGROUP
    
    // DELETE SUBGROUP
    $('#subgroup_datatables tbody').on('click', '.btn-user-click-delete', function () {
        temp_delete_subgroup = {};
        var data = table.row($(this).parents('tr')).data();
        var instance = $('#form_delete_subgroup').parsley();
        instance.reset();

        temp_delete_subgroup ={
            group_id                : data.group_id,
            subgroup_name           : data.subgroup_name,
            subgroup_description    : data.subgroup_description
        };
        
        $.ajax({
            url    : '{{ route("list-subgroup-privilege") }}',
            method : 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            data   :{
                subgroup_name:data.subgroup_name
            },
            datatype: "JSON",
            success: function(msg){
                $.LoadingOverlay('hide');
                if (msg['{{ config('constants.result') }}'] == "FAILED") {
                    amaran_error(msg.message);
                } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                    temp_delete_subgroup['privilege_list'] = msg['privilege_list'];
                } else {
                    amaran_error('Oops, Something went wrong!');
                }
            },
            error: function(msg){
                $.LoadingOverlay('hide');
                // amaran_error();
            }
        });
        $('#select-reason-delete').val('').trigger('change');
        $('#modal_delete_subgroup').modal('show');
    });

    var frm = $('#form_delete_subgroup');
    frm.submit(function (e) {
        e.preventDefault();
        var reason="";
        if ($('#select-reason-delete').val()=='other') {
            reason = $('#field_other_reason_delete').val();
        }else{
            reason = $('#select-reason-delete').val();
        }
        temp_delete_subgroup['reason'] = reason;

        var data = temp_delete_subgroup;
        var instance = $('#form_delete_subgroup').parsley();
        if(instance.validate()){
            var message = 'Are you sure you want to <strong style="color:red">DELETE</strong> subgroup <strong>'+temp_delete_subgroup.subgroup_name+'</strong>?';
            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("subgroup-setup-delete") }}',
                    method  : 'POST',
                    data    : data,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                datatype: "json",
                success: function (msg) {
                    $.LoadingOverlay('hide');
                    if (msg['{{ config('constants.result') }}'] == "FAILED") {
                        amaran_error(msg.message);
                    } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                        amaran_success(msg.message);
                        $('#modal_delete_subgroup').modal('hide');
                        table.ajax.reload();
                    } else {
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    // amaran_error('Something went wrong, please contact technical support!');
                }
                });
            }, function () {}).set('reverseButtons', true);
        }else{
            amaran_error('Failed, please check your input!');
        }
    });
    // END DELETE SUBGROUP
    
    $('#edit_group_name').click(function(){
    amaran_warning('Group name can\'t be edit!');
    });
    
    $('#edit_subgroup_name').click(function(){
    amaran_warning('Subgroup name can\'t be edit!');
    });

    $('#priv_selected option').remove();
</script>
@endsection