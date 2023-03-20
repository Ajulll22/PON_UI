<?php  
  $user_id = Session::get('user_id');
  $email = Session::get('email');
  $user_group_id = Session::get('user_group_id');
  $corporate = Session::get('corporate');
  $username = Session::get('username');
  $priv_add_user   = Session::get('priv_add_user');
  $priv_edit_user    = Session::get('priv_edit_user');
  $priv_delete_user  = Session::get('priv_delete_user');
?>

@extends('layout')
@section('title', 'User Setup - Wirecard E-Bidding')
@section('headlink', 'User Setup')
@section('header', 'User Setup')
@section('icon', 'fa fa-users')

@section('addons')
  <div style="float:right">    
  </div>
@endsection
@section('content')

  <style type="text/css">
    .ui-datepicker {
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.15);
        font-family: inherit;
        font-size: inherit;
        padding: 10px;
        margin: 1px 0 0;
        border-radius: 3px;
        display: none;
        width: auto !important;
        z-index: 1051 !important;
    }

    .select2-container--open .select2-dropdown--below {
        z-index: 1051;
    }
  </style>

<div class="card-header bg-white d-flex justify-content-between align-items-center">
  <h6 class="card-title tx-uppercase tx-16 mg-b-0">User List</h6>
  @if($priv_add_user == "OK")
  <button class="btn btn-outline-primary ht-40" data-toggle="modal" data-target="#modalAddUser"><i class="fa fa-plus mg-r-10"></i> Add User</button>
  @endif
</div><!-- card-header -->

<div class="br-section-wrapper">
  <div class="table-wrapper">
      <table id="datatable1" class="table hover table-responsive" style="width: 100%;">
        <thead>
          <tr>
            <th>no</th>
            <th>username</th>
            <th>corporate</th>
            <th>user group</th>
            <th>fullname</th> 
            <th>status</th>            
            <th>address</th>
            <th>email</th>
            <th>auction</th>            
            <th>actions</th>                                                  
          </tr>
        </thead>          
      </table>
  </div>
</div>

<!-- MODAL EDIT USER -->
<div id="modalEditUser" class="modal fade">
<div class="modal-dialog modal-lg wd-55p" role="document" style="max-width: none">
  <div class="modal-content bd-0 tx-14">
    <div class="modal-header pd-y-20 pd-x-25">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Edit User</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form id="form_edit_user">
    <div class="modal-body pd-25">  
      <div class="row">
        <input type="hidden" class="form-control input-lg" id="edit-user-login-id" name="edit-user-login-id" value="">
        <input type="hidden" class="form-control input-lg" id="edit-user-id" name="edit-user-id" value="">
        <input type="hidden" class="form-control input-lg" id="edit-group-id" name="edit-group-id" value="">
        <!-- <input type="hidden" class="form-control input-lg" id="edit-status-id" name="edit-status-id" value=""> -->
      </div>
      <div class="row">
        <div class="col-lg-12">
          <!-- <label class="form-control-label">Auction <span class="tx-danger">*</span></label> -->
          <h5 id="edit-auction" class="pd-b-10" name="edit-username"></h5>
        </div>
      </div>
      <div class="row">        
        <div class="col-lg-12">         
          <label class="ckbox">
            <input type="checkbox" id="checkBoxChangePassword" onclick="changePassword()">
            <span>Change Password</span>
          </label>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <label class="form-control-label">Username <span class="tx-danger">*</span></label>
          <input type="text" class="form-control" id="edit-username" name="edit-username" disabled>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label id="label-edit-password" class="form-control-label" style="display: none;">Password <span class="tx-danger">*</span></label>
            <input type="password" style="display: none;" class="form-control" id="edit-password" name="edit-password" data-parsley-pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$" placeholder="Enter your password" required>
            <p id="label-info-password" style="font-size: 11px; color: gray; display: none;">Use 8 to 20 characters</p>            
          </div><!-- form-group --> 
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label id="label-edit-confirm-password" class="form-control-label" style="display: none;">Confirm Password <span class="tx-danger">*</span></label>
            <input type="password" style="display: none;" class="form-control" id="edit-confirm-password" name="edit-confirm-password" data-parsley-pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$" placeholder="Enter your confirm password" onkeyup="confirmPassword()" required>
            <p id="label_edit_confirm_password" style="font-size: 11px; color: red; display: none;">Confirm password does not match</p>
          </div><!-- form-group --> 
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <label class="form-control-label">User Group <span class="tx-danger">*</span></label>
          <input type="text" class="form-control" id="label-group-option" name="label_group_option" disabled>
        </div>        
        <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                  <select id="edit-status-id" name="edit-status-id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                    <option label="Choose one" disabled></option>                  
                    @foreach($data['status_option'] as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
           <div class="form-group">
            <label class="form-control-label">Fullname <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" id="edit-fullname" name="edit-fullname" maxlength="30" placeholder="Enter your fullname" required>
            <p style="font-size: 11px; color: gray;">Maximum 30 characters</p>
          </div><!-- form-group -->
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Corporate <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" id="edit-corporate" name="edit-corporate" maxlength="30" placeholder="Enter your corporate name" required>
            <p style="font-size: 11px; color: gray;">Maximum 30 characters</p>
          </div><!-- form-group -->
        </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Phone Number <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" id="edit-phone" name="edit-phone" parsley-type="phone" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]{3,18}$" placeholder="Enter your phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="20" required>
            <p style="font-size: 11px; color: gray;">Maximum 20 characters</p>
          </div><!-- form-group -->
        </div>
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Email <span class="tx-danger">*</span></label>
            <input type="email" class="form-control" id="edit-email" name="editemail" maxlength="30" placeholder="Enter your email" maxlength="64" required>
            <p style="font-size: 11px; color: gray;">Maximum 64 characters</p>
          </div><!-- form-group -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label">Address <span class="tx-danger">*</span></label>
            <textarea rows="3" class="form-control" id="edit-address" name="edit-address" maxlength="120" placeholder="Enter your address" required></textarea>
            <p style="font-size: 11px; color: gray;">Maximum 120 characters</p>          
          </div><!-- form-group -->
        </div>
      </div>
    </div>
  </form>
    <div class="modal-footer">
      <button type="button" id="btnEditUser" class="btn btn-primary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" onclick="editUser()">Update</button>
      <button type="button" class="btn btn-outline-secondary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
    </div>
  </div>
</div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL DELETE USER -->
<div id="modalDeleteUser" class="modal fade">
<div class="modal-dialog modal-lg modal-dialog-vertical-center" role="document">
  <div class="modal-content bd-0 tx-14">
    <div class="modal-header pd-y-20 pd-x-25">
      <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Confirmation</h6>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body pd-25">
      <h6 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Are you sure to delete this user?</a></h6>
      <p class="mg-b-5" id="label-username"></p>      
    </div>
    <div class="modal-footer">
      <button type="button" id="btnDeleteUser" class="btn btn-primary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" onclick="deleteUser()">Yes</button>
      <button type="button" class="btn btn-outline-secondary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">No</button>
    </div>
  </div>
</div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MODAL ADD USER -->
<div id="modalAddUser" class="modal fade">
  <div class="modal-dialog modal-lg wd-55p" role="document" style="max-width: none">
    <div class="modal-content bd-0 tx-14">
      <div class="modal-header pd-y-20 pd-x-25">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add User</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form_add_user">
          <div class="modal-body pd-25">
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Username <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" id="add_username" name="add_username" data-parsley-pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$" placeholder="Enter your username" maxlength="20" autocomplete="off" required>
                  <p style="font-size: 11px; color: gray;">Use 8 to 20 characters</p>
                </div><!-- form-group --> 
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Password <span class="tx-danger">*</span></label>
                  <input type="password" class="form-control" id="add_password" name="add_password" data-parsley-pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$" placeholder="Enter your password" maxlength="20" autocomplete="off" required>
                  <p style="font-size: 11px; color: gray;">Use 8 to 20 characters</p>
                </div><!-- form-group -->
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Confirm Password <span class="tx-danger">*</span></label>
                  <input type="password" class="form-control" id="add_confirm_password" name="add_confirm_password" data-parsley-pattern="^[a-zA-Z0-9]([._](?![._])|[a-zA-Z0-9]){6,18}[a-zA-Z0-9]$" placeholder="Enter your confirm password" maxlength="20" onkeyup="confirmPassword()" required>
                  <p id="label_add_confirm_password" style="font-size: 11px; color: red; display: none;">Confirm password does not match</p>
                </div><!-- form-group -->
              </div>
            </div>       
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">User Group <span class="tx-danger">*</span></label>
                  <select id="add_user_group_id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                    <option label="Choose one" disabled></option>                  
                    @foreach($data['group_option'] as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Auction <span class="tx-danger">*</span></label>
                  <select id="add_auction_id" class="form-control select2-show-search" data-placeholder="Choose one (with searchbox)">
                    <option label="Choose one" disabled></option>                  
                    @foreach($data['auction_option'] as $key => $value)
                      <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>            
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Fullname <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" id="add_fullname" name="add_fullname" placeholder="Enter your fullname" maxlength="30" required>
                  <p style="font-size: 11px; color: gray;">Maximum 30 characters</p>
                </div><!-- form-group -->
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Corporate <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" id="add_corporate" name="add_corporate" placeholder="Enter your corporate name" maxlength="30" required>
                  <p style="font-size: 11px; color: gray;">Maximum 30 characters</p>
                </div><!-- form-group -->
              </div>  
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Phone Number <span class="tx-danger">*</span></label>
                  <input type="text" class="form-control" id="add_phone" name="add_phone" parsley-type="phone" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]{3,18}$" maxlength="20" placeholder="Enter your phone number" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="64" required>
                  <p style="font-size: 11px; color: gray;">Maximum 20 characters</p>
                </div><!-- form-group -->
              </div> 
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="form-control-label">Email <span class="tx-danger">*</span></label>
                  <input type="email" class="form-control" id="add_email" name="add_email" maxlength="30" placeholder="Enter your email" maxlength="64" required>
                  <p style="font-size: 11px; color: gray;">Maximum 64 characters</p>
                </div><!-- form-group -->
              </div>                            
            </div>
            <div class="row">              
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-control-label">Address <span class="tx-danger">*</span></label>
                  <textarea rows="3" class="form-control" id="add_address" name="add_address" maxlength="120" placeholder="Enter your address" required></textarea>
                  <p style="font-size: 11px; color: gray;">Maximum 120 characters</p>          
                </div><!-- form-group -->
              </div>
            </div>
        </div>
      </form>      
      <div class="modal-footer">
        <button type="button" id="btnAddUser" class="btn btn-primary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" onclick="addUser()">Add</button>
        <button type="button" class="btn btn-outline-secondary tx-11 pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->
@endsection

@section('javascript')
<script type="text/javascript">

var priv_add_user    = <?php echo json_encode($priv_add_user); ?>;
var priv_edit_user   = <?php echo json_encode($priv_edit_user); ?>;
var priv_delete_user = <?php echo json_encode($priv_delete_user); ?>;

var table = $('#datatable1').DataTable({
  ajax: {
      'url': '/user-list',
      'dataSrc': 'user_list'
  },
  columns: [
      { data: null }, 
      { data: "username" }, 
      { data: "corporate_name" , "visible": false},
      { data: "user_group_id", render: function ( data, type, row ) {
                                  var user_group = '';
                                  if(data == "1") user_group = 'Administrator';
                                  else user_group ='Bidders';
                                    return user_group ;
      }},  
      { data: "full_name", "visible": false}, 
      { data: "status_id", render: function ( data, type, row ) {
                                  var status_id = '';
                                  if(data == "1") status_id = '<div style="color:green;">Active</div>';
                                  else if(data == "2") status_id = '<div style="color:red;">Inactive</div>';
                                  else status_id ='<div style="color:yellow;">Pending</div>';
                                    return status_id ;
      }},
      { data: "address", "visible": false },
      { data: "email" },
      { data: "name", "visible": false },
      { data: null }
  ],
  responsive: true,
  language: {
    searchPlaceholder: 'Search...',
    sSearch: '',
    lengthMenu: '_MENU_ items/page',
  },
  columnDefs: [{
   targets: -1,
   data: null,
   sortable: false,
   render: function (data, type, full) {
      return '<center><button style="text-decoration: none;" class="edit btn btn-sm btn-outline-primary btn-user-click wd-35p" type="button" data-toggle="modal" data-target="#modalEditUser"> <span class="ion-compose tx-14"></span> Edit</button> <button style="text-decoration: none;" class="delete btn btn-sm btn-outline-danger btn-user-click wd-35p" type="button" data-toggle="modal" data-target="#modalDeleteUser"> <span class="ion-trash-a tx-14"></span> Delete</button></center';
   }
}],
  "drawCallback": function( settings ) {

    if(priv_edit_user == "OK"){
      $(".edit").show();
    }else{
      $(".edit").hide();
    }
    
    if(priv_delete_user == "OK"){
      $(".delete").show();
    }else{
      $(".delete").hide();
    }
  },
order: [[ 1, 'asc' ]]           
});

table.on( 'order.dt search.dt', function () {
table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    cell.innerHTML = i+1;
} );
} ).draw();        

//User approval
var user_id = "";
var username = "";
// var user_login_id = "1";
var user_login_id = <?php echo $user_id;?>;  //kahfi 15 aug 2019

$('#datatable1 tbody').on('click', '.btn-user-click', function () {
var data = table.row($(this).parents('tr')).data();

edit_user_id = data.id;
edit_username = data.username;
edit_corporate = data.corporate_name;
edit_phone = data.phone;
edit_email = data.email;
edit_fullname = data.full_name;
edit_address = data.address;
// edit_user_login_id = '1',
edit_user_login_id = <?php echo $user_id; ?>,
edit_auction_name = data.name;
edit_group_id = data.user_group_id;
edit_status_id = data.status_id;
edit_auction = data.name;

if(data.user_group_id == 1){
  label_group_option = "Administrator";
}
else if(data.user_group_id == 2){
  label_group_option = "Bidders"
}

document.getElementById('label-username').innerHTML = data.username;
document.getElementById('edit-username').value = edit_username;
document.getElementById('edit-corporate').value = edit_corporate;
document.getElementById('edit-phone').value = edit_phone;
document.getElementById('edit-email').value = edit_email;
document.getElementById('edit-fullname').value = edit_fullname;
document.getElementById('edit-address').value = edit_address;
document.getElementById('edit-user-login-id').value = edit_user_login_id;
document.getElementById('edit-user-id').value = edit_user_id;
document.getElementById('edit-group-id').value = edit_group_id;
document.getElementById('edit-status-id').value = edit_status_id;
document.getElementById('edit-auction').innerHTML = edit_auction; 
document.getElementById('label-group-option').value = label_group_option;       
});

function editUser(){          
 $('#modalEditUser').modal('hide');

 var changePass = "";

 if(document.getElementById('edit-password').value.length <= 0) {
  changePass = "";
 }
 else {
  changePass = sha256(document.getElementById('edit-username').value + document.getElementById('edit-password').value);  //kahfi 15 aug 2019
 }
 
 var data = {
     user_login_id: document.getElementById('edit-user-login-id').value,
     user_id: document.getElementById('edit-user-id').value,
     // password: document.getElementById('edit-password').value,
     // password: sha256(document.getElementById('edit-username').value + document.getElementById('edit-password').value),  //kahfi 15 aug 2019
     password: changePass,
     corporate: document.getElementById('edit-corporate').value,
     fullname: document.getElementById('edit-fullname').value,
     address: document.getElementById('edit-address').value,
     phone: document.getElementById('edit-phone').value,
     email: document.getElementById('edit-email').value,
     group_id: document.getElementById('edit-group-id').value,
     status_id: document.getElementById('edit-status-id').value
  };

  $.LoadingOverlay("show");

  $.ajax({
     url: '/user-update',
     method: 'POST',
     data: data,
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     datatype: "json",
     success: function (msg) {
        if(msg['{{ config('constants.result') }}'] == "FAILED"){
            alertify.alert(header_failed, 'Failed, Change a few things up and try submitting again!');

          }   
          else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
              alertify.alert(header_success, 'Well done, Your user has been updated!');                      
              table.ajax.reload();        

          }else{
            // alertify.alert(msg['result']);
            alertify.alert(header_failed, 'Oops, Something went wrong!');
          }
          table.ajax.reload();
        },
        error: function(){
          alertify.alert(header_error, 'Something went wrong, please contact technical support!');

          table.ajax.reload();
        }
  });

}

// Select2
$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

function deleteUser(){        
  var data = {
     user_id: edit_user_id,
     user_login_id: user_login_id
 };

 $('#modalDeleteUser').modal('hide');

 $.ajax({
       url: '/user-delete/' + edit_user_id + '/' + user_login_id,
       method: 'GET',
       data: data,
       // headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       datatype: "json",
       success: function (msg) {
        if(msg == "FAILED"){
            alertify.alert(header_failed, 'Failed, Change a few things up and try submitting again!');
            // table.ajax.reload(); 
          }   
          else if(msg == "SUCCESS"){
              alertify.alert(header_success, 'Well done, Your user has been deleted!');                      
              // table.ajax.reload();        

          }else{
            alertify.alert(msg);
            // table.ajax.reload(); 
          }
          table.ajax.reload();
        },
        error: function(){
          alertify.alert(header_error, 'Something went wrong, please contact technical support!');

          table.ajax.reload();
        }
    });
}

function addUser(){
  var auction_id = document.getElementById('add_auction_id').value;
  // var user_login_id = document.getElementById('add_user_login_id').value;          

  var user_login_id = <?php echo $user_group_id ?>;
  // var user_group_id = <?php echo $user_group_id ?>;
  var user_group_id = document.getElementById('add_user_group_id').value;
  // var user_group_id = '2';

  var username = document.getElementById('add_username').value;
  var password = document.getElementById('add_password').value;
  var fullname = document.getElementById('add_fullname').value;
  var corporate = document.getElementById('add_corporate').value;
  var phone = document.getElementById('add_phone').value;
  var email = document.getElementById('add_email').value;
  var address = document.getElementById('add_address').value;

  var data = {
     auction_id: auction_id,
     user_login_id: user_login_id,
     user_group_id:user_group_id,
     username:username,
     // password:password,
     password:sha256(username + password), //kahfi 15 aug 2019
     fullname:fullname,
     corporate:corporate,
     phone:phone,
     email:email,
     address:address
  };

  $.LoadingOverlay("show");

  $.ajax({
     url: '/user-add',
     method: 'POST',
     data: data,
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
     datatype: "json",
     success: function (msg) {
        if(msg['{{ config('constants.result') }}'] == "FAILED"){
            alertify.alert(header_failed, 'Failed, Change a few things up and try submitting again!');

            $('#modalAddUser').modal('hide');
          }   
          else if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
              alertify.alert(header_success, 'Well done, Your user has been added!');                      
              table.ajax.reload();        

              $('#modalAddUser').modal('hide');
          }else{
            alertify.alert(msg['{{ config('constants.result') }}']);

              $('#modalAddUser').modal('hide');
          }
          table.ajax.reload();
        },
        error: function(){
          alertify.alert(header_error, 'Something went wrong, please contact technical support!');

          $('#modalAddUser').modal('hide');
          table.ajax.reload();
        }
  });
  
}

function confirmPassword(){
  var password = document.getElementById('add_password').value;
  var confirmPassword = document.getElementById('add_confirm_password').value;

  if(password != confirmPassword)
    {
      document.getElementById('label_add_confirm_password').style.display = "block";
      document.getElementById('btnAddUser').disabled = true;
    }
  else
    {
      document.getElementById('label_add_confirm_password').style.display = "none";
      document.getElementById('btnAddUser').disabled = false;
    }

  var editPassword = document.getElementById('edit-password').value;
  var confirmEditPassword = document.getElementById('edit-confirm-password').value;
  if(editPassword != confirmEditPassword)
    {
      document.getElementById('label_edit_confirm_password').style.display = "block";
      document.getElementById('btnEditUser').disabled = true;
    }
  else
    {
      document.getElementById('label_edit_confirm_password').style.display = "none";
      document.getElementById('btnEditUser').disabled = false;
    }

}

function changePassword() {
  var checkBox = document.getElementById("checkBoxChangePassword");
  var labelEditPassword = document.getElementById("label-edit-password");
  var labelEditConfirmPassword = document.getElementById("label-edit-confirm-password");  
  var labelInfoPassword = document.getElementById("label-info-password");  
  var inputPassword = document.getElementById("edit-password");
  var inputConfirmPassword = document.getElementById("edit-confirm-password");

  if (checkBox.checked == true){
    labelEditPassword.style.display = "block";
    labelEditConfirmPassword.style.display = "block";
    labelInfoPassword.style.display = "block";
    inputPassword.style.display = "block";
    inputConfirmPassword.style.display = "block";
  } else {
    labelEditPassword.style.display = "none";
    labelEditConfirmPassword.style.display = "none";
    labelInfoPassword.style.display = "none";
    inputPassword.style.display = "none";
    inputConfirmPassword.style.display = "none";  
  }
} 

$("#modalAddUser").on('hide.bs.modal', function () {
  $("#form_add_user")[0].reset();      
  document.getElementById('label_add_confirm_password').style.display = "none";      
});

$("#modalEditUser").on('hide.bs.modal', function () {
  // $("#form_edit_user")[0].reset();        
  document.getElementById('label_edit_confirm_password').style.display = "none";    
});

//Loading Overlay
$(document).ajaxStart(function(){
    $.LoadingOverlay("show");
});
// $(document).ajaxStop(function(){
//     $.LoadingOverlay("hide");
// });
$(document).ajaxComplete(function(event, jqxhr, settings){
        $.LoadingOverlay("hide");
    });
</script>
@endsection