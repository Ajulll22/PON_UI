@extends('layout')

@section('title')
    <title>PT Prima Vista Solusi | User Setup</title>
@endsection

@section('css')
<style>
    strong li{
        font-weight: 400 !important;
    }
</style>
@endsection
@section('header_content')
    <h4 class="tx-gray-800 mg-b-5"><i class="fas fa-users"></i>  User Setup</h4>
@endsection
@section('body_content')
    <div class="card mg-b-80">
        <div class="card-header bg-transparent pd-l-20-force pd-t-10-force pd-b-10-force row">
            <div class="col-md-6">
                <h3 class="card-title tx-uppercase tx-14 mg-t-7 mg-b-0-force"><i class="fas fa-list"></i> User List</h3>
            </div>
            @if ($data['privilege_menu'][config('constants.USER_ADD_MKR')])
                <div class="col-md-6">
                    <button class='btn btn-primary add-btn' onclick="add_user()"><i class="fas fa-plus"></i> Add User</button>
                </div>
            @endif
        </div>
        <div class="br-section-wrapper pd-b-50-force">
            <div class="table-wrapper">
                <table id="user_datatables" class="table display responsive nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="wd-5p-force">No</th>
                            <th>User name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- table-wrapper -->
        </div>
        <!-- br-section-wrapper -->
    </div>

    <!-- Add User Modal -->
    <div id="modal_add_user" class="modal fade" data-value=''>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Add User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_add_user" autocomplete="off">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        User Detail
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20" id="user-detail-container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">User Name : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="user_name" id="user_name" data-parsley-pattern="^[a-zA-Z0-9]([@_](?![@_])|[a-zA-Z0-9]){6,20}[a-zA-Z0-9]$" maxlength="20" placeholder="Enter user name" autocomplete="off" required value="">
                                        <p class="hint-message">Use 8 to 20 characters</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Subgroup : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectSubgroup" style="width: 100%" name="subgroup_id" id="subgroup_id" data-search="true" required>
                                            @foreach ($data['group_list'] as $group)
                                                <optgroup id="{{ $group['group_name'] }}" label="{{ $group['group_name'] }}">
                                                    @foreach ($data['subgroup_list'] as $subgroup)
                                                        @if ($subgroup['group_name'] == $group['group_name']){
                                                            <option value="{{ $subgroup['subgroup_id'] }}">{{ $subgroup['subgroup_name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="user_firstname" id="user_firstname" maxlength="30" placeholder="Enter first name" required value="">
                                        <p class="hint-message">Maximum 30 characters</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name :</label>
                                        <input class="form-control" type="text" name="user_lastname" id="user_lastname" maxlength="30" placeholder="Enter last name" value="">
                                        <p class="hint-message">Maximum 30 characters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="email" name="user_email" id="user_email" maxlength="50" placeholder="Enter email" autocomplete="off" required value="">
                                        <p class="hint-message">Maximum 50 characters</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Phone : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="user_phone" id="user_phone" maxlength="20" placeholder="Enter phone number" autocomplete="off" required value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStyle" style="width: 100%" name="select_user_status" id="select_user_status" required>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStyle" style="width: 100%" name="cost_centre_id" id="cost_centre_id" required>
                                            <option value=""></option>
                                            @foreach ($data["cost_centre_list"] as $main_div)
                                                <option value="{{$main_div["cost_centre_id"]}}">{{$main_div["cost_centre_name"]}}</option>
                                                @if (array_key_exists("division", $main_div))
                                                    @foreach ($main_div["division"] as $div_1)
                                                        <option value="{{$div_1["cost_centre_id"]}}">&ensp;{{$div_1["cost_centre_name"]}}</option>
                                                        @if (array_key_exists("division", $div_1))
                                                            @foreach ($div_1["division"] as $div_2)
                                                                <option value="{{$div_2["cost_centre_id"]}}">&ensp;{{$div_2["cost_centre_name"]}}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Role : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStyle" style="width: 100%" name="role_id" id="role_id" required>
                                            <option value=""></option>
                                            @foreach ($data["role_list"] as $role)
                                                <option value="{{$role["role_id"]}}">{{$role["name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Team Leader :</label>
                                        <select class="form-control selectStyle" style="width: 100%" name="leader_user_id" id="leader_user_id" >
                                            <option value="">-</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label">Address : </label>
                                        <textarea class="form-control" id="user_address" name="user_address" maxlength="100" placeholder="Enter address" required></textarea>
                                        <p class="hint-message">Maximum 100 characters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label">User Description : </label>
                                        <textarea class="form-control" id="user_description" name="user_description" maxlength="100" placeholder="Enter description"></textarea>
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

                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Add User</button>
                    </div>
                    <!-- modal-footer -->
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>

    <!-- Delete User Modal -->
    <div id="modal_delete_user" class="modal fade" data-value=''>
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Delete User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_delete_user" autocomplete="off">
                    <div class="modal-body pd-20" id="reason-container-delete">
                        <div class="form-layout">
                            <div class="row">
                                <div class="show-delete col-md-6">
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
                                <div class="col-md-12 hide-delete">
                                    <div id="delete-reason" class="alert alert-danger mb-0">
                                        test
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
                        <button type="submit" class="show-delete btn btn-danger tx-size-xs pd-t-7-force pd-b-7-force">Delete User</button>
                    </div>
                    <!-- modal-footer -->
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>

    <!-- Edit User Modal -->
    <div id="modal_edit_user" class="modal fade" data-value=''>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"> <i class="fa fa-plus mg-r-10"></i>  Edit User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_user" autocomplete="off">
                    <div class="modal-body pd-5-force pd-l-20-force bg-gray-400 ">
                        User Detail
                    </div>
                    <div class="form-layout">
                        <div class="modal-body pd-20" id="user-detail-container-edit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">User Name : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="edit_user_name" id="edit_user_name" maxlength="30" placeholder="Enter user name" autocomplete="off" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Subgroup : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectSubgroupEdit" style="width: 100%" name="edit_subgroup_id" id="edit_subgroup_id" data-search="true" required>
                                            @foreach ($data['group_list'] as $group)
                                                <optgroup id="{{ $group['group_name'] }}" label="{{ $group['group_name'] }}">
                                                    @foreach ($data['subgroup_list'] as $subgroup)
                                                        @if ($subgroup['group_name'] == $group['group_name']){
                                                            <option value="{{ $subgroup['subgroup_id'] }}">{{ $subgroup['subgroup_name'] }}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">First Name : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="edit_user_firstname" id="edit_user_firstname" maxlength="30" placeholder="Enter first name" required>
                                        <p class="hint-message">Maximum 30 characters</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Last Name :</label>
                                        <input class="form-control" type="text" name="edit_user_lastname" id="edit_user_lastname" maxlength="30" placeholder="Enter last name">
                                        <p class="hint-message">Maximum 30 characters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Email : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="email" name="edit_user_email" id="edit_user_email" maxlength="50" placeholder="Enter email" autocomplete="off" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Phone : <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="edit_user_phone" id="edit_user_phone" maxlength="20" placeholder="Enter phone number" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Status : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStatusEdit" style="width: 100%" name="select_user_status_edit" id="select_user_status_edit" required>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Cost Centre : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStyle" style="width: 100%" name="cost_centre_id_edit" id="cost_centre_id_edit" required>
                                            <option value=""></option>
                                            @foreach ($data["cost_centre_list"] as $main_div)
                                                <option value="{{$main_div["cost_centre_id"]}}">{{$main_div["cost_centre_name"]}}</option>
                                                @if (array_key_exists("division", $main_div))
                                                    @foreach ($main_div["division"] as $div_1)
                                                        <option value="{{$div_1["cost_centre_id"]}}">&ensp;{{$div_1["cost_centre_name"]}}</option>
                                                        @if (array_key_exists("division", $div_1))
                                                            @foreach ($div_1["division"] as $div_2)
                                                                <option value="{{$div_2["cost_centre_id"]}}">&ensp;{{$div_2["cost_centre_name"]}}</option>
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Role : <span class="tx-danger">*</span></label>
                                        <select class="form-control selectStyle" style="width: 100%" name="role_id_edit" id="role_id_edit" required>
                                            <option value=""></option>
                                            @foreach ($data["role_list"] as $role)
                                                <option value="{{$role["role_id"]}}">{{$role["name"]}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Team Leader :</label>
                                        <select class="form-control selectStyle" style="width: 100%" name="leader_user_id_edit" id="leader_user_id_edit">
                                            <option value="">-</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label">Address : </label>
                                        <textarea class="form-control" id="edit_user_address" name="edit_user_address" maxlength="100" placeholder="Enter address" required>Jakarta selatan</textarea>
                                        <p class="hint-message">Maximum 100 characters</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label class="form-control-label">User Description : </label>
                                        <textarea class="form-control" id="edit_user_description" name="edit_user_description" maxlength="100" placeholder="Enter description">User Testing</textarea>
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

                    <div class="modal-footer pd-8-force">
                        <button type="button" class="btn btn-dark tx-size-xs pd-t-7-force pd-b-7-force" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary tx-size-xs pd-t-7-force pd-b-7-force">Update User</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal-dialog -->
    </div>

@endsection
@section('javascript')
    <script src="{{ asset('assets/lib/js-sha256/src/sha256.js') }}"></script>
    <script>
        // GLOBAL VARIABLE
        let user_data_filter    = {};
        let data_filter_type    = JSON.parse('<?php echo json_encode($data['data_filter_type']) ?>');
        let hierarchy           = {};
        let temp_delete_user    = {};
        let leader_list         = @json($data['leader_list']);

        function set_hierarchy(user_data_filter) {
             // DEFINING DATA FILTER HIERARCHY
            for(var data_filter_key in user_data_filter){
                hierarchy[data_filter_key] = new Array();
                if (user_data_filter[data_filter_key].length>0) {
                    if(user_data_filter[data_filter_key][0]['parent'] != null && user_data_filter[data_filter_key][0]['parent'] != "null"){
                        var parent_type = user_data_filter[data_filter_key][0]['parent_type'].toLowerCase();
                        hierarchy[parent_type].push(data_filter_key);     
                    }
                }
            }
        }
        
        $(document).ready(function() {
            // DELETE GROUP LABEL WITH NO SUBGROUP INSIDE
            $('optgroup').each(function(index,value){
                if(this.children.length == 0){
                    this.remove();
                }
            });

            // SELECT2 DROPDOWN FOR DATATABLES
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

            $.fn.dataTable.ext.errMode = function ( settings, helpPage, message ) { 
                if(message != ""){
                    amaran_error();
                }
            };
        
            // SHOW ADD USER DATA FILTER WRAPPER
            $.each(user_data_filter,function(value,index){
                for(var i=0; i<user_data_filter[value].length; i++){
                    if(user_data_filter[value][i].parent == null || user_data_filter[value][i].parent == 'null'){
                        $('#data_filter_'+user_data_filter[value][i].type.toLowerCase()+'_wrapper').show();
                        break;
                    }
                }
            });

            // SHOW EDIT USER DATA FILTER WRAPPER
            $.each(user_data_filter,function(value,index){
                for(var i=0; i<user_data_filter[value].length; i++){
                    if (user_data_filter[value][i].parent==null || user_data_filter[value][i].parent=='null') {
                        $('#edit_data_filter_'+user_data_filter[value][i].type.toLowerCase()+'_wrapper').show();
                        break;
                    }
                }
            });
        
            // DROPDOWN SUBGROUP - ADD USER MODAL
            $(".selectSubgroup").select2({
                placeholder     : "Select a Subgroup"
            }).on('change', function(event){
                var group_name = $(this).find('option:selected').parent().attr('id');
                $(".select_data_filter_type_add").val('').trigger('change');
                // $('#data_filter_type_add').removeAttr('disabled');
                $('#message_data_filter').html('').hide();
                $('#hint-message-wrapper').hide();
                var data = {
                    group_name : group_name
                }
                $.ajax({
                    url         : '{{ route("group-data-filter-option") }}',
                    method      : 'POST',
                    data        : data,
                    datatype    : "json",
                    headers     : {
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success     : function(msg){
                        if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            user_data_filter = msg['data_filter'];
                            if (user_data_filter.hasOwnProperty('group')) {
                                set_hierarchy(user_data_filter);
                                if (user_data_filter.group.length==0) {
                                    var subgroup_name_selected = $('.selectSubgroup').find('option:selected').text();
                                    amaran_error('<strong>'+subgroup_name_selected+'</strong> and its group doesn\'t have any data filter. Please select another subgroup!');
                                    $('#subgroup_id').focus().select2('open');
                                    $('#data_filter_type_add').attr('disabled', 'disabled');
                                }else{
                                    if ($('.selectSubgroup').val()!=null) {
                                        $('#data_filter_type_add').removeAttr('disabled');
                                    }
                                }
                            }
                        }
                        else{
                            amaran_error(msg.message);
                        }
                    },
                    error       : function(){
                        $.LoadingOverlay('hide');
                    }
                })
            });

            // DROPDOWN SUBGROUP - EDIT USER MODAL
            $(".selectSubgroupEdit").select2({
                placeholder     : "Select a Subgroup"
            }).on('change', function(event){
                var group_name = $(this).find('option:selected').parent().attr('id');
                $('#edit_data_filter_type').removeAttr('disabled');
                $('#message_data_filter').html('').hide();
                $('#hint-message-wrapper').hide();
                var data = {
                    group_name : group_name
                }

                $.ajax({
                    url         : '{{ route("group-data-filter") }}',
                    method      : 'POST',
                    data        : data,
                    datatype    : "json",
                    headers     : {
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success     : function(msg){
                        console.log(1);
                        if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            
                            user_data_filter = msg['data_filter'];
                            set_hierarchy(user_data_filter);

                            if (user_data_filter.group.length==0) {
                                var subgroup_name_selected = $('.selectSubgroupEdit').find('option:selected').text();
                                amaran_error('<strong>'+subgroup_name_selected+'</strong> and its group doesn\'t have any data filter. Please select another subgroup!');
                                $('#edit_subgroup_id').focus().select2('open');
                                $('#edit_data_filter_type').attr('disabled', true);
                            }else{
                                $('#edit_data_filter_type').removeAttr('disabled');
                            }
                        }
                        else{
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error       : function(){
                        $.LoadingOverlay('hide');
                    }
                })
            });

            function buildListLeader(data, action) {
                let optionHtml = `<option value="">-</option>`
                data.forEach(element => {
                    optionHtml += `<option value="${element.leader_user_id}" >${element.leader_fullname}</option>`
                });
                if (action == "add") { 
                    $("#leader_user_id").html(optionHtml);
                } else {
                    $("#leader_user_id_edit").html(optionHtml);
                }
            }

            // role change
            $("#role_id").change( function () { 

                const leader = leader_list[this.value] || []
                buildListLeader(leader, "add");
                $("#leader_user_id").val("").change();
            } )
            $("#role_id_edit").change( function () { 

                const leader = leader_list[this.value] || []
                buildListLeader(leader, "edit");
            } )

            // User Status Dropdown Handle
            $('#cost_centre_id').select2({
                placeholder: "Select Cost Centre",
                width: '100%',
                dropdownParent: $('#user-detail-container')
            });
            $('#cost_centre_id_edit').select2({
                placeholder: "Select Cost Centre",
                width: '100%',
                dropdownParent: $('#user-detail-container-edit')
            });

            $('#role_id').select2({
                placeholder: "Select Cost Centre",
                width: '100%',
                dropdownParent: $('#user-detail-container')
            });
            $('#role_id_edit').select2({
                placeholder: "Select Cost Centre",
                width: '100%',
                dropdownParent: $('#user-detail-container-edit')
            });

            $('#select_user_status').select2({
                placeholder: "Select User Status",
                width: '100%',
                minimumResultsForSearch: Infinity,
                dropdownParent: $('#user-detail-container')
            });

            $('#select_user_status_edit').select2({
                placeholder: "Select User Status",
                width: '100%',
                minimumResultsForSearch: Infinity,
                dropdownParent: $('#user-detail-container-edit')
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

                    if(user_data_filter[selected].length > 0 && 
                        (user_data_filter[selected][0].parent_type != null && user_data_filter[selected][0].parent_type !='null'))
                    {
                        if ($('#data_filter_'+user_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val()==null) {
                            $('#message_data_filter').html('Please select <strong>'+user_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#hint-message-wrapper').show();
                            $('#data_filter_'+selected+'_selected').multiSelect('deselect_all');
                            $('#data_filter_'+selected+'_selected option').remove();
                            $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                        }else{
                            $('#message_data_filter').html('').hide();
                            $('#hint-message-wrapper').hide();
                            var parent_id = $('#data_filter_'+user_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val();
                            var parent_type=user_data_filter[selected][0].parent_type.toLowerCase();
                            
                            $.each(user_data_filter,function(value,index){
                                if(selected==value){
                                    $('#data_filter_'+selected+'_selected option').remove();
                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                    for (var j = 0; j < user_data_filter[selected].length; j++) {
                                        if(parent_id.includes(user_data_filter[selected][j].parent)){
                                  
                                            if (parent_type==user_data_filter[selected][j].parent_type.toLowerCase()) {
                                                if (user_data_filter[selected][j].show=="1") {
                                                    $('#data_filter_'+selected+'_selected').multiSelect('addOption', { value: user_data_filter[selected][j].value, text: user_data_filter[selected][j].label});
                                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }

                                                if(user_data_filter[selected][j].selected=="1"){
                                                    $('#data_filter_'+selected+'_selected').multiSelect('select', user_data_filter[selected][j].value);
                                                    $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }
                    else if(user_data_filter[selected].length > 0){
                        if (user_data_filter[selected][0].parent_type == null || user_data_filter[selected][0].parent_type == 'null') {
                            $('#message_data_filter').html('').hide();
                            $('#hint-message-wrapper').hide();

                            $.each(user_data_filter,function(value,index){
                                if(selected == value){
                                    for(var i=0; i<user_data_filter[selected].length; i++){
                                        if (user_data_filter[selected][i].show=="1") {
                                            $('#data_filter_'+selected+'_selected').multiSelect('addOption', { value: user_data_filter[selected][i].value, text: user_data_filter[selected][i].label});
                                            $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                        }
                                
                                        if(user_data_filter[selected][i].selected=="1"){
                                            $('#data_filter_'+selected+'_selected').multiSelect('select', user_data_filter[selected][i].value);
                                        }
                                        $('#data_filter_'+selected+'_selected').multiSelect('refresh');
                                    }
                                }
                            });
                        }else{
                            $('#message_data_filter').html('Please select <strong>'+user_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
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

                    if(user_data_filter[selected].length > 0 && 
                        (user_data_filter[selected][0].parent_type != null && user_data_filter[selected][0].parent_type != 'null' ))
                    {
                        if ($('#edit_data_filter_'+user_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val()==null){
                            
                            $('#edit_message_data_filter').html('Please select <strong>'+user_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
                            $('#edit_hint-message-wrapper').show();
                            $('#edit_data_filter_'+selected+'_selected').multiSelect('deselect_all');
                            $('#edit_data_filter_'+selected+'_selected option').remove();
                            $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                        }else{
                            $('#edit_message_data_filter').html('').hide();
                            $('#edit_hint-message-wrapper').hide();
                            var parent_id = $('#edit_data_filter_'+user_data_filter[selected][0].parent_type.toLowerCase()+'_selected').val();
                            var parent_type=user_data_filter[selected][0].parent_type.toLowerCase();
                            
                            $.each(user_data_filter,function(value,index){
                                if(selected==value){
                                    $('#edit_data_filter_'+selected+'_selected option').remove();
                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');

                                    for (var j = 0; j < user_data_filter[selected].length; j++) {
                                        if(parent_id.includes(user_data_filter[selected][j].parent)){
                                  
                                            if (parent_type==user_data_filter[selected][j].parent_type.toLowerCase()) {
                                                if (user_data_filter[selected][j].show=="1") {
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('addOption', { value: user_data_filter[selected][j].value, text: user_data_filter[selected][j].label});
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }

                                                if(user_data_filter[selected][j].selected=="1"){
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('select', user_data_filter[selected][j].value);
                                                    $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                        }
                    }
                    else if(user_data_filter[selected].length > 0){
                        if (user_data_filter[selected][0].parent_type == null || user_data_filter[selected][0].parent_type == 'null') {
                            $('#edit_message_data_filter').html('').hide();
                            $('#edit_hint-message-wrapper').hide();

                            $.each(user_data_filter,function(value,index){
                                if(selected == value){
                                    for(var i=0; i<user_data_filter[selected].length; i++){
                                        if (user_data_filter[selected][i].show=="1") {
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('addOption', { value: user_data_filter[selected][i].value, text: user_data_filter[selected][i].label});
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                        }
                                
                                        if(user_data_filter[selected][i].selected=="1"){
                                            $('#edit_data_filter_'+selected+'_selected').multiSelect('select', user_data_filter[selected][i].value);
                                        }
                                        $('#edit_data_filter_'+selected+'_selected').multiSelect('refresh');
                                    }
                                }
                            });
                        }else{
                            $('#edit_message_data_filter').html('Please select <strong>'+user_data_filter[selected][0].parent_type.toLowerCase()+'</strong> data filter to configure <strong>'+selected+'</strong> data filter').show();
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
                    for(var data_filter_key in user_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<user_data_filter[hierarchy[type][i]].length; j++){
                                    user_data_filter[hierarchy[type][i]][j].show = "1";
                                }
                            }
                        }
                    }
                    for(var i=0; i<user_data_filter[type].length; i++){
                        if(user_data_filter[type][i].value == values){
                            user_data_filter[type][i].selected = "1";
                        }
                    }
                },
                afterDeselect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type = $(".select_data_filter_type_add").val();
                    for(var data_filter_key in user_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<user_data_filter[hierarchy[type][i]].length; j++){
                                    if (user_data_filter[hierarchy[type][i]][j].parent   == values) {
                                        user_data_filter[hierarchy[type][i]][j].selected = "0";
                                        user_data_filter[hierarchy[type][i]][j].show     = "0";
                                    }
                                }
                            }
                        }
                    }
                    for(var i=0; i<user_data_filter[type].length; i++){
                        if(user_data_filter[type][i].value   == values){
                            user_data_filter[type][i].selected = "0";
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
                    for( var data_filter_key in user_data_filter ) {
                        if(data_filter_key == type) {
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<user_data_filter[hierarchy[type][i]].length; j++){
                                    user_data_filter[hierarchy[type][i]][j].show = "1";
                                }
                            }
                        }
                    }
                    for(var i=0; i<user_data_filter[type].length; i++){
                        if(user_data_filter[type][i].value       == values){
                            user_data_filter[type][i].selected   = "1";
                        }
                    }
                },
                afterDeselect: function(values){
                    this.qs1.cache();
                    this.qs2.cache();
                    var type=$(".select_data_filter_type_edit").val();
                    for(var data_filter_key in user_data_filter){
                        if(data_filter_key == type){
                            for(var i=0; i<hierarchy[type].length; i++){
                                for(var j=0; j<user_data_filter[hierarchy[type][i]].length; j++){
                                    if (user_data_filter[hierarchy[type][i]][j].parent   == values){
                                        user_data_filter[hierarchy[type][i]][j].selected ="0";
                                        user_data_filter[hierarchy[type][i]][j].show     ="0";
                                    }
                                }
                            }
                        }
                    }
                    for(var i=0; i<user_data_filter[type].length; i++){
                        if(user_data_filter[type][i].value       ==values){
                            user_data_filter[type][i].selected   ="0"; 
                        }
                    }
                }
            });
        }
        
        'use strict';
        var edit_status     = '<?php echo $data['privilege_menu'][config('constants.USER_EDIT_MKR')] ?>';
        var delete_status   = '<?php echo $data['privilege_menu'][config('constants.USER_DEL_MKR')] ?>';
        var reset_status    = '<?php echo $data['privilege_menu'][config('constants.USER_RSTPASS_MKR')] ?>';

        let action          = false;
        if(edit_status || delete_status || reset_status){
            action = true;
        }
        var table = $('#user_datatables').DataTable({
            ajax: {
                'url'       : "{{ route('user-list') }}",
                'dataSrc'   : 'user_list'
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
                data: "user_name"
            },
            {
                data: "user_email"
            },
            {
                data: "user_phone"
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
                sortable    : true,
                targets     : 0,
                data        : null,
                render      : function(data, type, full, meta){
                    return meta.row + 1;
                }
            },
            {
                targets     : -2,
                data        : null,
                render      : function(data, type, full){
                    var status = '';
                    
                    if(data.user_active == '1'){
                        status = '<span style="color:green;font-weight: bold;">Active</span>'; 
                    }
                    else{
                        status = '<span style="color:red;font-weight: bold;">Non Active</span>'; 
                    }
                    return status;
                }
            },
            {
                targets     : -1,
                data        : null,
                sortable    : false,
                render      : function(data, type, full){
                    var result          = "";
                    var edit_status     = '<?php echo $data['privilege_menu'][config('constants.USER_EDIT_MKR')] ?>';
                    var delete_status   = '<?php echo $data['privilege_menu'][config('constants.USER_DEL_MKR')] ?>';
                    var reset_status    = '<?php echo $data['privilege_menu'][config('constants.USER_RSTPASS_MKR')] ?>';

                    var edit_btn        = '<button style="text-decoration: none;" class="btn btn-outline-primary mg-r-5 btn-user-click-update" type="button" data-toggle="tooltip" data-placement="top" title="Edit User"><span class="icon ion-compose"></span></button>';
                    var delete_btn      = '<button style="text-decoration: none;" class="btn btn-outline-danger mg-r-5 btn-user-click-delete" type="button" data-toggle="tooltip" data-placement="top" title="Delete User"><span class="icon ion-trash-a"></span></button>';
                    var reset_btn       = '<button class="btn btn-outline-danger mg-r-5 btn-user-click-reset" type="button" data-toggle="tooltip" data-placement="top" title="Reset Password"><span class="icon ion-unlocked"></span></button>';

                    if(edit_status){
                        result += edit_btn;
                    }
                    if(reset_status){
                        result += reset_btn;
                    }
                    if(delete_status){
                        result += delete_btn;
                    }

                    return result;
                }
            }],
            "order": [[0, 'asc']]
        });
        
        // ADD USER
        function add_user(){
            $.LoadingOverlay("show");
            $('#form_add_user')[0].reset();
            var instance = $('#form_add_user').parsley();
            instance.reset();

            user_data_filter= {};
            // Event Change select2
            $('#subgroup_id').val('').trigger('change');
            $('#select_user_status').val('1').trigger('change');
            $('#data_filter_type_add').val('').trigger('change');
            $('#select-reason-add').val('').trigger('change');
            $('#cost_centre_id').val('').trigger('change');
            $("#role_id").val("").change();
            $('#data_filter_type_add').attr('disabled', 'disabled');
            $('#modal_add_user').modal("show");
            
            $.LoadingOverlay('hide');
        }

        var frm = $('#form_add_user');
        frm.submit(function (e) {
            e.preventDefault();
            
            var user_name 		    = $('#user_name').val();     
            var user_firstname 	    = $('#user_firstname').val();     
            var user_lastname       = $('#user_lastname').val();     
            var user_description 	= $('#user_description').val();
            var user_email          = $('#user_email').val();
            var user_phone          = $('#user_phone').val();     
            var user_active         = $('#select_user_status').val();
            var user_address 		= $('#user_address').val();
            var subgroup_id 		= $('#subgroup_id').val();     
            var cost_centre_id 		= $('#cost_centre_id').val();     
            var role_id 		    = $('#role_id').val();     
            var leader_user_id 		= $('#leader_user_id').val();     

            var reason = "";
            if($('#select-reason-add').val() == 'other'){
                reason = $('#field_other_reason_add').val();
            }
            else{
                reason = $('#select-reason-add').val();
            }

            var data = {
                user_name           : user_name,
                user_firstname      : user_firstname,
                user_lastname       : user_lastname,
                user_description    : user_description,
                user_email          : user_email,
                user_phone          : user_phone,
                user_active         : user_active,
                user_address        : user_address,
                subgroup_id         : subgroup_id,
                data_filter         : user_data_filter,
                reason              : reason,
                cost_centre_id,
                role_id, leader_user_id
            };

            var instance = $('#form_add_user').parsley();
            if(instance.validate()){
                $.ajax({
                    url         : '{{ route("user-setup-add") }}',
                    method      : 'POST',
                    data        : data,
                    datatype    : "json",
                    headers     : {
                       'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success     : function(msg){
                        $.LoadingOverlay('hide');
                        if(msg['{{ config('constants.result') }}'] == "FAILED"){
                            amaran_error(msg.message);
                        }
                        else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            $('#modal_add_user').modal('hide');
                            amaran_success(msg.message);
                            $('#form_add_user')[0].reset();
                            table.ajax.reload();
                        }
                        else{
                            amaran_error('Oops, Something went wrong!');
                        }
                    },
                    error       : function(){
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                }).done(function(){
                    $.LoadingOverlay('hide');
                });
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });
        // END ADD USER
        
        // EDIT USER
        $('#user_datatables tbody').on('click', '.btn-user-click-update', function () {
            $.LoadingOverlay("show");

            var instance = $('#form_edit_user').parsley();
            instance.reset();
            user_data_filter ={};
            var data = table.row($(this).parents('tr')).data();
            console.log(data);
            $('#edit_subgroup_id').val(data.subgroup_id).change();
            
            $('#edit_user_name').val(data.user_name);
            $('#select-reason-edit').val('').trigger('change');
            $('#edit_subgroup_name').val(data.subgroup_name);
            $('#edit_user_firstname').val(data.user_firstname);
            $('#edit_user_lastname').val(data.user_lastname);
            $('#edit_user_email').val(data.user_email);
            $('#edit_user_phone').val(data.user_phone);
            $('#select_user_status_edit').val(data.user_active).trigger('change');
            $('#edit_user_address').val(data.user_address);
            $('#edit_user_description').val(data.user_description);
            $('#role_id_edit').val(data.role_id).change();
            $('#cost_centre_id_edit').val(data.cost_centre_id).change();


            $('#edit_data_filter_type').val('').trigger('change');
            $("#leader_user_id_edit").val(data.team_leader_user_id).change();
            setTimeout(() => {
                $.ajax({
                    url    : '{{ route("user-data-filter") }}',
                    method : 'POST',
                    data: {
                        user_name   : data.user_name,
                        group_name  : data.group_name
                    },
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success: function (msg) {
                        console.log(2);
                        if (msg['{{ config('constants.result') }}'] == "FAILED") {
                            amaran_error(msg.message);
                        } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                            user_data_filter = msg['data_filter'];
                        } else {
                            amaran_error('Oops, Something went wrong!');
                        }
                        $('#modal_edit_user').modal('show');
                        $.LoadingOverlay('hide');
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        // amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, 2000);
        });

        var frm = $('#form_edit_user');
        frm.submit(function (e) {
            e.preventDefault();

            var edit_user_name           = $('#edit_user_name').val();     
            var edit_user_firstname      = $('#edit_user_firstname').val();     
            var edit_user_lastname       = $('#edit_user_lastname').val();     
            var edit_user_description    = $('#edit_user_description').val();
            var edit_user_email          = $('#edit_user_email').val();
            var edit_user_phone          = $('#edit_user_phone').val();     
            var edit_user_active         = $('#select_user_status_edit').val();
            var edit_user_address        = $('#edit_user_address').val();
            var edit_subgroup_id         = $('#edit_subgroup_id').val();
            var cost_centre_id 		     = $('#cost_centre_id_edit').val();     
            var role_id 		         = $('#role_id_edit').val();   
            var leader_user_id 		     = $('#leader_user_id_edit').val();   

            var reason = "";
            if($('#select-reason-edit').val() == 'other'){
                reason = $('#field_other_reason_edit').val();
            }
            else{
                reason = $('#select-reason-edit').val();
            }

            var data = {
                user_name           : edit_user_name,
                user_firstname      : edit_user_firstname,
                user_lastname       : edit_user_lastname,
                user_description    : edit_user_description,
                user_email          : edit_user_email,
                user_phone          : edit_user_phone,
                user_address        : edit_user_address,
                user_active         : edit_user_active,
                subgroup_id         : edit_subgroup_id,
                data_filter         : user_data_filter,
                reason              : reason,
                cost_centre_id, role_id, leader_user_id
            };

            var instance = $('#form_edit_user').parsley();
            if(instance.validate()){
                $.ajax({
                    url     : '{{ route("user-setup-update") }}',
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
                            $('#modal_edit_user').modal('hide');
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
            }
            else{
                amaran_error('Failed, please check your input!');
            }
        });
        // END EDIT USER

        // RESET USER
        $('#user_datatables tbody').on('click', '.btn-user-click-reset', function () {
            var data = table.row($(this).parents('tr')).data();
            var message = 'Are you sure you want to reset <strong>'+data.user_name+'</strong> user password?';

            alertify.confirm(header_confirm,message, function () {
                $.ajax({
                    url     : '{{ route("reset-password") }}',
                    method  : 'POST',
                    data    : {
                        user_reset          : data.user_name,
                        user_email_reset    : data.user_email
                    },
                    headers : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    datatype: "json",
                    success: function (msg) {
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
                    },
                    error: function () {
                        $.LoadingOverlay('hide');
                        amaran_error('Something went wrong, please contact technical support!');
                    }
                });
            }, function () {}).set('reverseButtons', true);
        });    

        // DELETE USER
        $('#user_datatables tbody').on('click', '.btn-user-click-delete', function () {
            temp_delete_user = {};
            var data = table.row($(this).parents('tr')).data();
            console.log(data);
            temp_delete_user = {
                user_name           : data.user_name,
                user_firstname      : data.user_firstname,
                user_lastname       : data.user_lastname,
                user_description    : data.user_description,
                user_email          : data.user_email,
                user_phone          : data.user_phone,
                user_address        : data.user_address,
                user_active         : data.user_active,
                subgroup_id         : data.subgroup_id
            };

            $.ajax({
                url    : '{{ route("user-data-filter") }}',
                method : 'POST',
                data: {
                    user_name   : data.user_name,
                    group_name  : data.group_name
                },
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                datatype: "json",
                success: function (msg) {
                    console.log(msg);
                    if (msg['{{ config('constants.result') }}'] == "FAILED") {
                        amaran_error(msg.message);
                        return;
                    } else if (msg['{{ config('constants.result') }}'] == "SUCCESS") {
                        temp_delete_user['data_filter'] = msg['data_filter'];
                        $.ajax({
                            url    : '{{ route("user-setup-check") }}',
                            method : 'POST',
                            data: {
                                user_name   : data.user_name
                            },
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            datatype: "json",
                            success: function (res) {
                                console.log(res);
                                if (res.data.allowed_delete == 0) {
                                    $(".show-delete").hide()                                   
                                    $(".hide-delete").show()
                                    $("#delete-reason").html( `<strong>${res.data.reason}</strong>` )                                   
                                } else {
                                    $(".show-delete").show()  
                                    $(".hide-delete").hide()  
                                }
                                $('#select-reason-delete').val('').trigger('change');
                                $('#modal_delete_user').modal('show');
                            }
                        })
                    } else {
                        amaran_error('Oops, Something went wrong!');
                    }
                },
                error: function () {
                    $.LoadingOverlay('hide');
                    // amaran_error('Something went wrong, please contact technical support!');
                }
            });
        });

        var frm = $('#form_delete_user');
        frm.submit(function (e) {
            e.preventDefault();

            var reason="";
            if ($('#select-reason-delete').val()=='other') {
                reason = $('#field_other_reason_delete').val();
            }else{
                reason = $('#select-reason-delete').val();
            }

            temp_delete_user['reason'] = reason;
            
            var data = temp_delete_user;
            var instance = frm.parsley();
            if (instance.validate()) {
                var message = 'Are you sure you want to request <strong style="color:red">DELETE</strong> user <strong>'+data.user_name+'</strong>?';
                alertify.confirm(header_confirm,message, function () {
                    $.ajax({
                        url     : '{{ route("user-setup-delete") }}',
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
                                $('#modal_delete_user').modal('hide');
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
            }else {
                amaran_error('Failed, please check your input!');
            }
        });
        // END DELETE USER

        $('#edit_user_email').click(function(){
            amaran_warning('Email can\'t be edited!');
        });

        $('#edit_user_name').click(function(){
            amaran_warning('User name can\'t be edited!');
        });

        $('#edit_subgroup_name').click(function(){
            amaran_warning('Subgroup name can\'t be edited!');
        });
    </script>
@endsection