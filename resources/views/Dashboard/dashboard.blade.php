@extends('layout')
@section('title')
<title>PT Prima Vista Solusi | Dashboard</title>
@endsection
@section('css')

@endsection

@section('header_content')
@endsection

@section('body_content')
    <div class="br-pagebody mg-t-0 mg-b-100 pd-x-15">
        <div class="row row-sm mg-b-15">
          	<div class="col-sm-12 col-xl-12">
		  		<h4 class="tx-gray-800 mg-b-15"><i class="fa fa-home"></i> Prima Vista Solusi - {{ config('constants.app_name') }}</h4>
		  	</div>
        </div>

        <div class="row row-sm mg-b-50">
          	<div class="col-sm-12 col-xl-12">
	          	<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">PON Request Summary</h6>
                <!-- FINANCE STAFF AND ADMINISTRATOR -->
                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_MKR')])
                    <p class="mg-b-15 mg-lg-b-20">Number of all PON Request, on Head of Finance Approval phase, and on Top Management Approval phase.</p>
                @endif
                <!-- HEAD OF FINANCE -->
                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                    <p class="mg-b-15 mg-lg-b-20">Number of all PON Request and PON Request need to respond to.</p>
                @endif
                <!-- TOP MANAGEMENT -->
                @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                    <p class="mg-b-15 mg-lg-b-20">Number of PON Request need to respond to.</p>
                @endif
		  	</div>

            <!-- ADMINISTRATOR, FINANCE STAFF AND HEAD OF FINANCE -->
            @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_MKR')] || $data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')])
                <div class="col-sm-6 col-xl-6 mg-t-20 mg-xl-t-10">
                    <div class="bg-br-primary rounded-xl overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="fa fa-paste tx-30 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">All PON Request</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="pon_request_all">0</p>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="col-sm-6 col-xl-6 mg-t-20 mg-xl-t-10">
                    <div class="bg-br-primary rounded-xl overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="fa fa-tasks tx-30 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">On Approval Phase</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="pon_request_on_progress">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6 col-xl-6 mg-t-20 mg-xl-t-10">
                    <div class="bg-br-primary rounded-xl overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="fa fa-envelope-open tx-30 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Head of Finance Approval</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="pon_request_open">0</p>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="col-sm-6 col-xl-6 mg-t-20 mg-xl-t-10">
                    <div class="bg-br-primary rounded-xl overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="fa fa-clock tx-30 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Top Management Approval</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="pon_request_waiting">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- TOP MANAGEMENT -->
            @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                <div class="col-sm-12 col-xl-12 mg-t-5 mg-xl-t-5">
                    <div class="bg-br-primary rounded overflow-hidden">
                        <div class="pd-25 d-flex align-items-center">
                            <i class="fa fa-envelope-open tx-30 lh-0 tx-white op-7"></i>
                            <div class="mg-l-20">
                                <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">PON Request need to be approved</p>
                                <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="pon_request_waiting">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- QUICK GUIDELINE -->
        <div class="row row-sm">
          	<div class="col-sm-12 col-xl-12">
		      	<h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Quick Guideline</h6>
                <p>Short tutorial of how to use Prima Vista Solusi - {{ config('constants.app_name') }}. Some features may not available due to user privilege restriction.</p>
		  	</div>
		</div>

        <div class="br-section-wrapper rounded-xl">
          	<div id="guideline_accordion" class="accordion" role="tablist" aria-multiselectable="true">
          		<!-- PON REQUEST -->
	            <div class="card rounded-top-xl">
	              	<div class="card-header" role="tab" id="heading_one">
	                	<h6 class="mg-b-0">
	                  		<a class="tx-gray-800 transition" data-toggle="collapse" data-parent="#guideline_accordion" href="#collapse_one" aria-expanded="false" aria-controls="collapse_one"><i class="fa fa-paste"></i> PON Request</a>
	                	</h6>
	              	</div>
                    <!-- FINANCE STAFF -->
                    @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_MKR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                        <div id="collapse_one" class="" role="tabpanel" aria-labelledby="heading_one">
                            <div class="card-block pd-10">
                                <!-- ADD NEW PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Add New PON Request</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Initiate New PON Request" button on the top right corner.</li>
                                    <li>Fill the necessary PON Request data, then click "Submit PON Request" button on the bottom right corner.</li>
                                    <li>New PON request will be made and ready to be approved later by Head of Finance or Top Management.</li>
                                </ul>
                                <hr>

                                <!-- DETAILS PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">See PON Request Details</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "See Details" button on the PON Request you want to see its details.</li>
                                </ul>
                                <hr>

                                <!-- UPDATE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update Existing PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be updated.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Update PON Request" button on the PON Request you want to update.</li>
                                    <li>Fill the necessary PON Request data, then click "Update PON Request" button on the bottom right corner.</li>
                                    <li>Updated PON request is ready to be approved later by Head of Finance or Top Management.</li>
                                </ul>
                                <hr>

                                <!-- DELETE TID -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete Existing PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be deleted.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Delete PON Request" button on the PON Request you want to delete.</li>
                                    <li>Click "Ok" on confirmation pop-up.</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- HEAD OF FINANCE -->
                    @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_CKR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                        <div id="collapse_one" class="" role="tabpanel" aria-labelledby="heading_one">
                            <div class="card-block pd-10">
                                <!-- APPROVE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Approve PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be approved.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Approve" button on the Progress section.</li>
                                </ul>
                                <hr>

                                <!-- REJECT PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Reject PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be rejected.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Fill the rejection reason beside "Reject" button on the Progress section.</li>
                                    <li>Click "Reject" button.</li>
                                </ul>
                                <hr>

                                <!-- FORWARD PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Request for Top Management Approval</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be forwarded to Top Management.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Request Top Mgmt Approval" button on the Progress section.</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- TOP MANAGEMENT -->
                    @if ($data['privilege_menu'][config('constants.PON_REQUEST_ADD_APR')] == true && $data['privilege_menu'][config('constants.AUDIT_VIEW')] == false)
                        <div id="collapse_one" class="" role="tabpanel" aria-labelledby="heading_one">
                            <div class="card-block pd-10">
                                <!-- APPROVE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Approve PON Request</h6>
                                <ul>
                                    <li>Choose PON Request Approval menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Approve" button on the Progress section.</li>
                                </ul>
                                <hr>

                                <!-- REJECT PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Reject PON Request</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Fill the rejection reason beside "Reject" button on the Progress section.</li>
                                    <li>Click "Reject" button.</li>
                                </ul>
                                <hr>
                            </div>
                        </div>
                    @endif
                    <!-- ADMINISTRATOR -->
                    @if ($data['privilege_menu'][config('constants.AUDIT_VIEW')])
                        <div id="collapse_one" class="collapse" role="tabpanel" aria-labelledby="heading_one">
                            <div class="card-block pd-10">
                                <!-- ADD NEW PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Add New PON Request</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Initiate New PON Request" button on the top right corner.</li>
                                    <li>Fill the necessary PON Request data, then click "Submit PON Request" button on the bottom right corner.</li>
                                    <li>New PON request will be made and ready to be approved later by Head of Finance or Top Management.</li>
                                </ul>
                                <hr>

                                <!-- DETAILS PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">See PON Request Details</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "See Details" button on the PON Request you want to see its details.</li>
                                </ul>
                                <hr>

                                <!-- UPDATE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update Existing PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be updated.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Update PON Request" button on the PON Request you want to update.</li>
                                    <li>Fill the necessary PON Request data, then click "Update PON Request" button on the bottom right corner.</li>
                                    <li>Updated PON request is ready to be approved later by Head of Finance or Top Management.</li>
                                </ul>
                                <hr>

                                <!-- DELETE TID -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete Existing PON Request</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be deleted.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "Delete PON Request" button on the PON Request you want to delete.</li>
                                    <li>Click "Ok" on confirmation pop-up.</li>
                                </ul>
                                <hr>

                                <!-- APPROVE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Approve PON Request as Head of Finance</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be approved.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Approve" button on the Progress section.</li>
                                </ul>
                                <hr>

                                <!-- REJECT PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Reject PON Request as Head of Finance</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be rejected.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Fill the rejection reason beside "Reject" button on the Progress section.</li>
                                    <li>Click "Reject" button.</li>
                                </ul>
                                <hr>

                                <!-- FORWARD PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Request for Top Management Approval</h6>
                                <strong class="d-block d-sm-inline-block-force">
                                    <p class="mg-x-10">Please note that only requests that are "Open" can be forwarded to Top Management.</p>
                                </strong>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Request Top Mgmt Approval" button on the Progress section.</li>
                                </ul>
                                <hr>

                                <!-- APPROVE PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Approve PON Request as Top Management</h6>
                                <ul>
                                    <li>Choose PON Request Approval menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Click "Approve" button on the Progress section.</li>
                                </ul>
                                <hr>

                                <!-- REJECT PON REQUEST -->
                                <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Reject PON Request as Top Management</h6>
                                <ul>
                                    <li>Choose PON Request menu.</li>
                                    <li>Click "PON Request Approval" button on the PON Request you want to approve.</li>
                                    <li>Fill the rejection reason beside "Reject" button on the Progress section.</li>
                                    <li>Click "Reject" button.</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- ADMINISTRATOR -->
                @if ($data['privilege_menu'][config('constants.AUDIT_VIEW')])
                <!-- ACCESS MANAGEMENT -->
                <div class="card">
                    <div class="card-header" role="tab" id="heading_two">
                        <h6 class="mg-b-0">
                            <a data-toggle="collapse" data-parent="#guideline_accordion" href="#collapse_two" aria-expanded="true" aria-controls="collapse_two" class="tx-gray-800 transition"><i class="fa fa-user"></i> Access Management</a>
                        </h6>
                    </div>

                    <div id="collapse_two" class="collapse" role="tabpanel" aria-labelledby="heading_two">
                        <div class="card-block pd-10">
                            <!-- ADD USER -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Create New User</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-info-circle"></i> To create new user, please make sure that at least one of each subgroup, group, and package are already available.</strong></p>
                            <ul>
                                <li>Choose "User Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Add User" button on the top right corner.</li>
                                <li>Fill the necessary user data, then click "Add User" button on the bottom right corner.</li>
                                <li>If user creation has 2 or 3 levels of authorization, new user request will be made and added to Approval page to be approved later by privileged user. Otherwise, if user creation only has 1 level authorization, new user will immediately added and appear in the user list table.</li>
                            </ul>
                            <hr>

                            <!-- UPDATE USER -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update User Data</h6>
                            <ul>
                                <li>Choose "User Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Edit User" button on the right side of your selected user.</li>
                                <li>Update the user data, then click "Update User" button on the bottom right corner.</li>
                                <li>If user data changes has 2 or 3 levels of authorization, new user update request will be made and added to Approval page to be approved later by privileged user. Otherwise, if user data changes only has 1 level authorization, user data will immediately updated and can be accessed in the user list table.</li>
                            </ul>
                            <hr>

                            <!-- DELETE USER -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete User</h6>
                            <p class="tx-danger tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-exclamation-triangle"></i> Please note that once you delete a user, you can't undo the process.</strong></p>
                            <ul>
                                <li>Choose "User Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Delete User" button on the right side of your selected user and confirmation message will show up.</li>
                                <li>Click "Yes" if you want to proceed the user deletion or "Cancel" to cancel the user deletion.</li>
                            </ul>
                            <hr>

                            <!-- RESET PASSWORD USER -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Reset Password User</h6>
                            <ul>
                                <li>Choose "User Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Reset Password" button on the right side of your selected user and confirmation message will show up.</li>
                                <li>Click "Yes" if you want to proceed the user reset password process or "Cancel" to cancel the user deletion.</li>
                            </ul>
                            <hr>
                        </div>
                        <div class="card-block pd-10">
                            <!-- ADD SUBGROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Create New Subgroup</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-info-circle"></i> To create new subgroup, please make sure that at least one of each group and package are already available.</strong></p>
                            <ul>
                                <li>Choose "Subgroup Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Add Subgroup" button on the top right corner.</li>
                                <li>Fill the necessary subgroup data, then click "Add Subgroup" button on the bottom right corner.</li>
                                <li>If subgroup creation has 2 or 3 levels of authorization, new subgroup request will be made and added to Approval page to be approved later by privileged user. Otherwise, if subgroup creation only has 1 level authorization, new subgroup will immediately added and appear in the subgroup list table.</li>
                            </ul>
                            <hr>

                            <!-- UPDATE SUBGROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update Subgroup Data</h6>
                            <ul>
                                <li>Choose "Subgroup Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Edit Subgroup" button on the right side of your selected subgroup.</li>
                                <li>Update the subgroup data, then click "Update Subgroup" button on the bottom right corner.</li>
                                <li>If subgroup data changes has 2 or 3 levels of authorization, new subgroup update request will be made and added to Approval page to be approved later by privileged user. Otherwise, if subgroup data changes only has 1 level authorization, subgroup data will immediately updated and can be accessed in the subgroup list table.</li>
                            </ul>
                            <hr>

                            <!-- DELETE SUBGROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete Subgroup</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10 mg-b-5"><strong><i class="fas fa-info-circle"></i> You can only delete subgroup which does not contain any user.</strong></p>
                            <p class="tx-danger tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-exclamation-triangle"></i> Please note that once you delete a subgroup, you can't undo the process.</strong></p>
                            <ul>
                                <li>Choose "Subgroup Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Delete Subgroup" button on the right side of your selected subgroup and confirmation message will show up.</li>
                                <li>Click "Yes" if you want to proceed the subgroup deletion or "Cancel" to cancel the subgroup deletion.</li>
                            </ul>
                            <hr>
                        </div>
                        <div class="card-block pd-10">
                            <!-- ADD GROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Create New Group</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-info-circle"></i> To create new group, please make sure that at least one package is already available.</strong></p>
                            <ul>
                                <li>Choose "Group Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Add Group" button on the top right corner.</li>
                                <li>Fill the necessary group data, then click "Add Group" button on the bottom right corner.</li>
                                <li>If group creation has 2 or 3 levels of authorization, new group request will be made and added to Approval page to be approved later by privileged user. Otherwise, if group creation only has 1 level authorization, new group will immediately added and appear in the group list table.</li>
                            </ul>
                            <hr>

                            <!-- UPDATE GROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update Group Data</h6>
                            <ul>
                                <li>Choose "Group Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Edit Group" button on the right side of your selected group.</li>
                                <li>Update the group data, then click "Update Group" button on the bottom right corner.</li>
                                <li>If group data changes has 2 or 3 levels of authorization, new group update request will be made and added to Approval page to be approved later by privileged user. Otherwise, if group data changes only has 1 level authorization, group data will immediately updated and can be accessed in the group list table.</li>
                            </ul>
                            <hr>

                            <!-- DELETE GROUP -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete Group</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10 mg-b-5"><strong><i class="fas fa-info-circle"></i> You can only delete group which does not contain any subgroup.</strong></p>
                            <p class="tx-danger tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-exclamation-triangle"></i> Please note that once you delete a group, you can't undo the process.</strong></p>
                            <ul>
                                <li>Choose "Group Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Delete Group" button on the right side of your selected group and confirmation message will show up.</li>
                                <li>Click "Yes" if you want to proceed the group deletion or "Cancel" to cancel the group deletion.</li>
                            </ul>
                            <hr>
                        </div>
                        <div class="card-block pd-10">
                            <!-- ADD PACKAGE -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Create New Package</h6>
                            <ul>
                                <li>Choose "Package Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Add Package" button on the top right corner.</li>
                                <li>Fill the necessary package data, then click "Add Package" button on the bottom right corner.</li>
                                <li>If package creation has 2 or 3 levels of authorization, new package request will be made and added to Approval page to be approved later by privileged user. Otherwise, if package creation only has 1 level authorization, new package will immediately added and appear in the package list table.</li>
                            </ul>
                            <hr>

                            <!-- UPDATE PACKAGE -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Update Package Data</h6>
                            <ul>
                                <li>Choose "Package Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Edit Package" button on the right side of your selected package.</li>
                                <li>Update the package data, then click "Update Package" button on the bottom right corner.</li>
                                <li>If package data changes has 2 or 3 levels of authorization, new package update request will be made and added to Approval page to be approved later by privileged user. Otherwise, if package data changes only has 1 level authorization, package data will immediately updated and can be accessed in the package list table.</li>
                            </ul>
                            <hr>

                            <!-- DELETE PACKAGE -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Delete Package</h6>
                            <p class="tx-info tx-uppercase tx-bold tx-12 mg-x-10 mg-b-5"><strong><i class="fas fa-info-circle"></i> You can only delete package which does not contain any group.</strong></p>
                            <p class="tx-danger tx-uppercase tx-bold tx-12 mg-x-10"><strong><i class="fas fa-exclamation-triangle"></i> Please note that once you delete a package, you can't undo the process.</strong></p>
                            <ul>
                                <li>Choose "Package Setup" feature inside Access Management menu on Web Configuration section.</li>
                                <li>Click "Delete Package" button on the right side of your selected package and confirmation message will show up.</li>
                                <li>Click "Yes" if you want to proceed the package deletion or "Cancel" to cancel the package deletion.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FEATURE MANAGEMENT -->
                <div class="card">
                    <div class="card-header" role="tab" id="heading_four">
                        <h6 class="mg-b-0">
                            <a data-toggle="collapse" data-parent="#guideline_accordion" href="#collapse_four" aria-expanded="true" aria-controls="collapse_four" class="tx-gray-800 transition"><i class="fas fa-clipboard-list"></i> Feature Management</a>
                        </h6>
                    </div>

                    <div id="collapse_four" class="collapse" role="tabpanel" aria-labelledby="heading_four">
                        <div class="card-block pd-10">
                            <!-- CHANGE FEATURE LEVEL -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Change Feature Level</h6>
                            <ul>
                                <li>Choose "Feature" inside Settings Menu on Web Configuration section.</li>
                                <li>Click "Edit Feature Level" button on the right side of your selected feature.</li>
                                <li>Change feature level, then click "Update Feature" button on the bottom right corner.</li>
                                <li>Feature level will be updated immediately.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- AUDIT TRAIL -->
                <div class="card rounded-bot-xl">
                    <div class="card-header" role="tab" id="heading_three">
                        <h6 class="mg-b-0">
                            <a data-toggle="collapse" data-parent="#guideline_accordion" href="#collapse_three" aria-expanded="true" aria-controls="collapse_three" class="tx-gray-800 transition"><i class="fa fa-desktop"></i> Audit Trail</a>
                        </h6>
                    </div>

                    <div id="collapse_three" class="collapse" role="tabpanel" aria-labelledby="heading_three">
                        <div class="card-block pd-10">
                            <!-- ACCESS AUDIT TRAIL -->
                            <h6 class="tx-gray-700 tx-uppercase tx-bold tx-14 mg-x-10">Accessing Audit Trail</h6>
                            <ul>
                                <li>Choose "Audit Trail" feature inside Settings Menu on Web Configuration section.</li>
                                <li>Select the date you want to see the audit data. You can select username/email and description as well for more specific result.</li>
                                <li>Click "Search" button on the top right corner.</li>
                                <li>Audit Trail Data will be visible to you based on date, username/email, and description you set before.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
          	</div>
        </div>
    </div>
@endsection

@section('javascript')
	<script type="text/javascript">	
	    $(document).ready(function() {
	        $.ajax({
	            url 	: '{{ route("dashboard-data") }}',
	            method 	: 'GET',
	            headers : {
	                'X-CSRF-TOKEN': "{{ csrf_token() }}"
	            },
	            datatype: "json",
	            success: function (msg) {
	                $.LoadingOverlay('hide');
	                $('#pon_request_all').text(msg.dashboard_data[0].total_pon_request);
	                $('#pon_request_open').text(msg.dashboard_data[0].pon_request_open);
                    $('#pon_request_waiting').text(msg.dashboard_data[0].pon_request_waiting);
                    $('#pon_request_on_progress').text(msg.dashboard_data[0].pon_request_on_progress);
	            },
	            error: function () {
	                $.LoadingOverlay('hide');
	            }
	        });
	    });
	</script>
@endsection