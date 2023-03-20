<?php
  $priv_approve_user  = Session::get('priv_approve_user');
  $priv_decline_user  = Session::get('priv_decline_user');
?>
@extends('layout')

@section('title', 'User Approval - Wirecard E-Bidding')
@section('headlink', 'User Approval')
@section('header', 'User Approval')
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
  <h6 class="card-title tx-uppercase tx-16 mg-b-0">User Approval List</h6>
</div><!-- card-header -->

<div class="br-section-wrapper">
  <div class="table-wrapper">
      <table id="datatable1" class="table table-responsive" style="width: 100%;">
        <thead>
          <tr>
            <th class="wd-10p">Username</th>
            <th class="wd-10p">Auction</th>
            <th class="wd-10p">Corporate</th>
            <th class="wd-10p">Fullname</th>           
            <th class="wd-15p">Email</th>
            <th class="wd-15p"></th>                                                  
          </tr>
        </thead>          
      </table>
  </div>
</div>

<!-- USER APPROVAL MODAL -->
<div id="modalUserApproval" class="modal fade">
   <div class="modal-dialog modal-dialog-vertical-center" role="document">
      <div class="modal-content bd-0 tx-14">
         <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">User Approval</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-25">
            <h6 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Do you want to approve this user?</a></h6>
            <p class="mg-b-5" id="label-username"></p>
         </div>
         <div class="modal-footer">
            <button type="button" id="btnApprovalUser" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="approveUser()">Approve</button>
            <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->

<!-- USER DECLINE MODAL -->
<div id="modalUserDecline" class="modal fade">
   <div class="modal-dialog modal-lg modal-dialog-vertical-center" role="document">
      <div class="modal-content bd-0 tx-14">
         <div class="modal-header pd-y-20 pd-x-25">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">User Decline</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pd-25">
            <h6 class="lh-3 mg-b-20"><a href="" class="tx-inverse hover-primary">Do you want to decline this user?</a></h6>
            <p class="mg-b-5" id="label-username"></p>
            <label class="form-control-label">Please give the reasons or notes to inform the user</label>
            <textarea rows="3" class="form-control wd-400" id="notes-decline" name="address" maxlength="120" placeholder="Enter your reasons or notes" required></textarea>
            <p style="font-size: 11px; color: gray;">Maximum 120 characters</p>
         </div>
         <div class="modal-footer">
            <button type="button" id="btnDeclineUser" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="declineUser()">Decline</button>
            <button type="button" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Cancel</button>
         </div>
      </div>
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->

<!-- SUCCESS MODAL -->
<div id="modalSuccess" class="modal fade">
   <div class="modal-dialog" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success tx-semibold mg-b-20">Approve Successful!</h4>
            <p class="mg-b-20 mg-x-20">Please click Close</p>
            <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
            Close</button>
         </div>
         <!-- modal-body -->
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->

<!-- FAILED MODAL -->
<div id="modalFailed" class="modal fade">
   <div class="modal-dialog" role="document">
      <div class="modal-content tx-size-sm">
         <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-danger  tx-semibold mg-b-20">Approve Failed!</h4>
            <p class="mg-b-20 mg-x-20">Username is already exist. Please try another one.</p>
            <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
            Close</button>
         </div>
         <!-- modal-body -->
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->
@endsection

@section('javascript')
<script type="text/javascript">
var priv_approve_user = <?php echo json_encode($priv_approve_user); ?>;
var priv_decline_user = <?php echo json_encode($priv_decline_user); ?>;

var table = $('#datatable1').DataTable({
  ajax: {
    'url': '/user-list-temp',
    'dataSrc': 'user_list_temp'
  },
  columns: [
    {
      data: "username"
    },
    {
      data: "name"
    },
    {
      data: "corporate_name"
    },
    {
      data: "full_name"
    },    
    {
      data: "email"
    },
    {
      data: "status_id"
    }
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
      return '<center><button style="text-decoration: none;" class="approve btn btn-sm btn-outline-primary btn-user-click" type="button" onclick="approveUser()"> <span class="ion-checkmark tx-14"></span> Approve</button> <button style="text-decoration: none;" class="decline btn btn-sm btn-outline-danger btn-user-click" type="button" data-toggle="modal" data-target="#modalUserDecline"> <span class="ion-close tx-14"></span> Decline</button></center';
    }
  }],
  "drawCallback": function( settings ) {

    if(priv_approve_user == "OK"){
      $(".approve").show();
    }else{
      $(".approve").hide();
    }
    
    if(priv_decline_user == "OK"){
      $(".decline").show();
    }else{
      $(".decline").hide();
    }
  }
});

// Select2
// $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

//USER APPROVAL
var user_id = "";
var username = "";
var user_login_id = "1";

$('#datatable1 tbody').on('click', '.btn-user-click', function () {
  var data = table.row($(this).parents('tr')).data();

  user_id = data.id;
  username = data.username;

  document.getElementById('label-username').innerHTML = username;
});

function approveUser(){
  var data = {
    user_id: user_id,
    user_login_id: user_login_id
  };

  var message = 'Are you sure you want to approve this user?';

          alertify.confirm(header_confirm, message, function(){ 
              $.ajax({
                url: '/user-approve/' + user_id + '/' + user_login_id,
                method: 'GET',
                data: data,
                datatype: "json",
                success: function(msg){
                  if(msg == "FAILED"){
                    alertify.alert(header_failed, 'Failed, Change a few things up and try submitting again!');
                  }   
                  else if(msg == "SUCCESS"){
                    alertify.alert(header_success, 'Well done, Your user has been approved!');                                            
                  }else{
                    alertify.alert(msg);
                  }
                  table.ajax.reload();
                },
                error: function(){
                  alertify.alert(header_error, 'Something went wrong, please contact technical support!');
                  table.ajax.reload();
                }
              });
          }, function(){});
}

function declineUser(){
  var notes = document.getElementById('notes-decline').value;

  var data = {
    user_id: user_id,
    user_login_id: user_login_id,
    notes: notes
  };  

  var message = 'Are you sure you want to decline this user?';

          alertify.confirm(header_delete, message, function(){ 
              $.ajax({
                url: '/user-decline',
                method: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                datatype: "json",
                success: function(msg){
                  if(msg == "FAILED"){
                    alertify.alert(header_failed, 'Failed, Change a few things up and try submitting again!');

                    $('#modalUserDecline').modal('hide');
                    document.getElementById('notes-decline').value = "";
                  }   
                  else if(msg == "SUCCESS"){
                      alertify.alert(header_success, 'Well done, Your user has been delete!');                      
                      table.ajax.reload();        

                      $('#modalUserDecline').modal('hide');
                      document.getElementById('notes-decline').value = "";              
                  }else{
                    alertify.alert(msg);

                      $('#modalUserDecline').modal('hide');
                      document.getElementById('notes-decline').value = "";
                  }
                  table.ajax.reload();
                },
                error: function(){
                  alertify.alert(header_error, 'Something went wrong, please contact technical support!');

                  $('#modalUserDecline').modal('hide');
                  document.getElementById('notes-decline').value = "";
                  table.ajax.reload();
                }
              });
          }, function(){});          
}

// Select2
$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

//Loading Overlay
$(document).ajaxStart(function(){
    $.LoadingOverlay("show");
});

  // Hide Loading Animation when Ajax Completed
  $(document).ajaxComplete(function(event, jqxhr, settings){
      $.LoadingOverlay("hide");
  });
</script>
@endsection