<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Prima Vista Solusi {{ config('constants.app_name') }} | Password Recovery</title>

        <!-- Image -->
        <link rel="icon" type="image/ico" href="{{ asset('assets/img/pvs-icon.png') }}">

        <!-- Vendor css -->
        <link rel="stylesheet" href="{{ asset('assets/lib/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/SpinKit/spinkit.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/AmaranJS/dist/css/amaran.min.css') }}">

        <!-- Bracket CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bracket.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bracket.min.css') }}">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/custom-general.css') }}">

        <style type="text/css">
            /* AMARAN */
            .amaran {
                max-width: 500px !important;
                width: auto !important;
                padding: 0 !important;
            }

            .amaran.default .default-message span {
                line-height: 20px !important;
                padding-top: 50px !important;
                vertical-align: middle !important;
            }
        </style>
    </head>

    <body class="login bg-br-primary" style="background-image: url('/assets/img/loginbg.jpg'); background-size: auto;">
        <div class="d-flex align-items-center justify-content-center ht-100v">
            <form id="forgot-password-form" autocomplete="off">
                <div class="login-wrapper wd-500 wd-xs-500 pd-25 pd-xs-40 bg-white rounded shadow-base">
                    <div class="tx-center tx-inverse">
                        <div class="mg-b-0">
                            <img width="50%" height="50%" src="http://localhost:8500/assets/img/pvs-lg.png" alt="Primavista Logo" class="shell_logo">
                        </div>
                        <div class="mg-b-20">
                            <div class="tx-16">Finance PON Registration</div>
                            <div class="tx-16 tx-bold">Password Recovery</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="form-group">
                        <div id="success-alert" class="alert alert-success tx-center" role="alert" style="">
                            <div>Your new password has been generated.</div>
                            <div>Please check your email to get your new password.</div>
                        </div>
                    </div>

                    <div id="email-input" class="form-group" style="display: none;">
                        <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Registered Email</label>
                        <input type="email" class="form-control" id="user_email" placeholder="Enter your registered email" value="" required="">
                    </div>
            
                    <div class="login-button-div">
                        <button id="change-password-btn" type="submit" class="btn btn-info btn-block login-btn" style="display: none;" disabled="">
                            <div class="login-btn-text" style="display: block;">Find Account</div>
                            <div class="login-btn-spinner" style="display: none;">
                                <div class="sk-wave">
                                    <div class="sk-rect sk-rect1"></div>
                                    <div class="sk-rect sk-rect2"></div>
                                    <div class="sk-rect sk-rect3"></div>
                                    <div class="sk-rect sk-rect4"></div>
                                    <div class="sk-rect sk-rect5"></div>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="form-group tx-12 tx-center login-footer">
                        Copyright © 2021 | PT Prima Vista Solusi.<br>
                        All rights reserved.
                    </div>
                    <div class="tx-12 tx-center">version 1.0.0</div>
                </div>
            </form>
        </div>

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            let current_url = window.location.href;
            let params      = (new URL(current_url)).searchParams;
            let user_name   = params.get('un');
            let user_email  = params.get('em');
            console.log(current_url);
            console.log(user_name);
            console.log(user_email);

            let frm = $('#form_change_password');
            frm.submit(function (e){
                e.preventDefault();

                let new_pass = $("#new_password").val();

                let data = {
                    user_name           : user_name,
                    user_email          : user_email,
                    user_password_new   : new_pass
                };

                if($('#new_password').val() == $('#vn_password').val()){
                    $.ajax({
                        url         : '{{ route("recover-password-process") }}',
                        method      : 'POST',
                        data        : data,
                        headers     : {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        datatype    : "json",
                        success     : function(msg){
                            console.log(msg);
                            // Change Password Success
                            if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                                amaran_success(msg.message);
                                $("#new_password").prop('style', 'border-color: #23BF08');
                                $("#vn_password").prop('style', 'border-color: #23BF08');
                                // setTimeout(function(){                               
                                //     window.location = "/logout";
                                // },2000);
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
        function toggleCurrentPassword() {
            let inputPwd = document.getElementById("current_password");
            let iconPwd = document.getElementById("icon-current-password");

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
            let inputPwd = document.getElementById("new_password");
            let iconPwd = document.getElementById("icon-new-password");

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
            let inputPwd = document.getElementById("vn_password");
            let iconPwd = document.getElementById("icon-vn-password");

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
    </body>
</html>