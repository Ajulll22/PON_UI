
<?php
  // dd(session()->all());
?>
@section('title')
    <title>Prima Vista Solusi | Change Password</title>
@endsection
@section('css')
@endsection

    @extends('change-password-layout')

    @section('body_content')
        <div class="d-flex align-items-center justify-content-center">
            <div class="login-wrapper wd-300 wd-xs-700 pd-30 bg-white rounded shadow-base">
                <div class="pd-x-30 pd-y-20">
                    <div class="tx-center">
                        @if (Session::get('user_first_login') == 1)
                            <h4 class="tx-inverse mg-y-10">Change Password</h4>
                            <h6 class="tx-inverse mg-b-5">You have to change your password first to continue.</h6>
                        @elseif (Session::get('user_first_login') == 0 && Session::get('pw_expiry_tag') == 1)
                            <h4 class="tx-inverse mg-y-10">Password Expired</h4>
                            <h6 class="tx-inverse mg-b-5">You have to set your new password to continue.</h6>
                        @endif
                        <br>
                    </div>

                    <form id="form_change_password">
                        <div class="alert alert-warning" role="alert">
                            <div class="d-flex align-items-center justify-content-start">
                                <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Important!</strong> You will automatically logged out after you change your password.</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="current_password">Current Password <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="password" name="current_password" id="current_password" class="form-control pd-y-12" placeholder="Enter your current password" minlength="8" maxlength="20" autocomplete="off" required>
                                <button class="btn bd bg-white tx-gray-600" type="button" tabindex="-1" onclick="toggleCurrentPassword()">
                                    <i class="fa fa-eye" id="icon-current-password"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="new-password">New Password <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="password" name="new-password" id="new_password" class="form-control pd-y-12" placeholder="Enter your new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required>
                                <button class="btn bd bg-white tx-gray-600" type="button" tabindex="-1" onclick="toggleNewPassword()">
                                    <i class="fa fa-eye" id="icon-new-password"></i>
                                </button>
                            </div>
                            <p class="tx-11 tx-gray">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
                        </div>
                      
                        <div class="form-group mg-b-20">
                            <label for="vn-password">Confirm New Password <span style="color: red">*</span></label>
                            <div class="input-group">
                                <input type="password" name="vn-password" id="vn_password" class="form-control pd-y-12" placeholder="Enter your new password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required>
                                <button class="btn bd bg-white tx-gray-600" type="button" tabindex="-1" onclick="toggleVNPassword()">
                                    <i class="fa fa-eye" id="icon-vn-password"></i>
                                </button>
                            </div>
                            <p class="tx-11 tx-gray">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            let pass_valid = $("#current_password").parsley();

            var frm = $('#form_change_password');
            frm.submit(function (e){
                e.preventDefault();

                var new_pass = $("#new_password").val();
                var old_pass = $("#current_password").val();

                if(pass_valid.isValid()){
                    var data = {
                        user_password       : old_pass,
                        user_password_new   : new_pass
                    };

                    if($('#new_password').val() == $('#vn_password').val()){
                        $.ajax({
                            url         : '{{ route("change-password-process") }}',
                            method      : 'POST',
                            data        : data,
                            headers     : {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                            datatype    : "json",
                            success     : function(msg){
                                // Change Password Success
                                if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                    amaran_success(msg.message);
                                    $("#current_password").prop('style', 'border-color: #23BF08');
                                    $("#new_password").prop('style', 'border-color: #23BF08');
                                    $("#vn_password").prop('style', 'border-color: #23BF08');
                                    setTimeout(function(){                               
                                        window.location = "/logout";
                                    },2000);
                                }

                                // Change Password Failed
                                else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                    amaran_error(msg.message);
                                    if(msg.message == "Incorrect password. Please try again."){
                                        $("#current_password").prop('style', 'border-color: #D61313');
                                    }
                                }
                            }
                        });
                    }
                    else{
                        amaran_error('Your new password didn\'t match. Please check your input and try again.');
                        $("#new_password").prop('style', 'border-color: #D61313');
                        $("#vn_password").prop('style', 'border-color: #D61313');
                    }     
                }
                else{
                    pass_valid.validate();

                    if(!pass_valid.isValid()){
                        pass_valid.validate();
                    }
                }
            });
        });

        // PASSWORD TOGGLE
        function toggleCurrentPassword() {
            var inputPwd = document.getElementById("current_password");
            var iconPwd = document.getElementById("icon-current-password");

            if (inputPwd.type === "password") {
                inputPwd.type = "text";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye-slash"; 
            }
            else{
                inputPwd.type = "password";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye";
            }
        }
        function toggleNewPassword() {
            var inputPwd = document.getElementById("new_password");
            var iconPwd = document.getElementById("icon-new-password");

            if (inputPwd.type === "password") {
                inputPwd.type = "text";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye-slash"; 
            }
            else{
                inputPwd.type = "password";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye";
            }
        }

        // PASSWORD TOGGLE
        function toggleVNPassword() {
            var inputPwd = document.getElementById("vn_password");
            var iconPwd = document.getElementById("icon-vn-password");

            if (inputPwd.type === "password") {
                inputPwd.type = "text";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye-slash"; 
            }
            else{
                inputPwd.type = "password";
                inputPwd.addClass = "tx-15";
                iconPwd.className = "fa fa-eye";
            }
        }
    </script>
@endsection