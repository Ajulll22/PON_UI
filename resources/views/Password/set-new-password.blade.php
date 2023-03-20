
<?php
  // dd(session()->all());
?>
@section('title')
    <title>Prima Vista Solusi | Set New Password</title>
@endsection
@section('css')
@endsection

@extends('layout')

    @section('body_content')
        <div class="d-flex align-items-center justify-content-center">
            <div class="login-wrapper wd-300 wd-xs-700 pd-30 bg-white rounded shadow-base">
                <div class="pd-x-30 pd-y-20">
                    <div class="tx-center">
                        <h3 class="tx-inverse mg-y-10">Set New Password</h3>
                    </div>

                    <form id="form_set_password">
                        <div class="alert alert-warning" role="alert">
                            <div class="d-flex align-items-center justify-content-start">
                                <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Important!</strong> You will automatically redirected to login page after you change your password.</span>
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
                                <button class="btn bd bg-white tx-gray-600" type="button" tabindex="-1" onclick="toggleVnPassword()">
                                    <i class="fa fa-eye" id="icon-vn-password"></i>
                                </button>
                            </div>
                            <p class="tx-11 tx-gray">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters</p>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block tx-size-xs pd-t-7-force pd-b-7-force">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            var frm = $('#form_set_password');
            frm.submit(function (e){
                e.preventDefault();

                var user_password = $("#new_password").val();

                if($('#new_password').val() == $('#vn_password').val()){
                    $.ajax({
                        url         : '{{ route("set-new-password-process") }}',
                        method      : 'POST',
                        data        : {
                            user_password   : user_password
                        },
                        headers     : {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        datatype    : "json",
                        success     : function(msg){
                            // Change Password Success
                            if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                amaran_success(msg.message);
                                $("#new_password").prop('style', 'border-color: #23BF08');
                                $("#vn_password").prop('style', 'border-color: #23BF08');
                                setTimeout(function(){                               
                                    window.location = "/logout";
                                },2000);
                            }

                            // Change Password Failed
                            else if(msg['{{ config('constants.result') }}'] == "FAILED"){
                                amaran_error(msg.message);
                            }
                        }
                    });
                }
                else{
                    amaran_error('Your new password didn\'t match. Please check your input and try again.');
                    $("#new_password").prop('style', 'border-color: #D61313');
                    $("#vn_password").prop('style', 'border-color: #D61313');
                }
            });
        });

        // PASSWORD TOGGLE
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
        function toggleVnPassword() {
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