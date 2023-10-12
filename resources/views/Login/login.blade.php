<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Prima Vista Solusi {{ config('constants.app_name') }} | Login</title>

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
            <form id="loginForm" autocomplete="off" name="login-form" >
                <!-- Login Modal -->
                <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">
                    <div class="tx-center tx-inverse">
                        <div>
                            <img width="50%" height="50%" src="{{ asset('assets/img/pvs-lg-blue.png') }}" alt="Primavista Logo" class="shell_logo">
                        </div>
                        <div class="mg-b-20">
                            <div class="tx-16">{{ config('constants.app_name') }}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="form-group">
                        <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1" style="color: #000; font-weight: bold;">Email</label>
                        <input type="email" class="form-control" id="user_email" placeholder="Enter your email address" required>
                    </div>

                    <div class="form-group mg-b-30">
                        <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1" style="color: #000; font-weight: bold;">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password"  placeholder="Password" required>
                            <span class="input-group-btn">
                                <button class="btn bd bg-white tx-gray-600" type="button" name="plain-password" tabindex="-1" onclick="togglePassword()" style="background-color: #fff!important; color: #000;">
                                    <i class="fa fa-eye" id="icon-password"></i>
                                </button>
                            </span>
                        </div>
                    </div>
            
                    <div class="login-button-div">
                        <button type="submit" name="submit-login" class="btn btn-shadow btn-block mg-b-20 login-btn submit custom-button">
                            <div class="login-btn-text">Login</div>
                            <div class="login-btn-spinner">
                                <div class="sk-wave">
                                    <div class="sk-rect sk-rect1"></div>
                                    <div class="sk-rect sk-rect2"></div>
                                    <div class="sk-rect sk-rect3"></div>
                                    <div class="sk-rect sk-rect4"></div>
                                    <div class="sk-rect sk-rect5"></div>
                                </div>
                            </div>
                        </button>

                        <div class="mg-y-20 tx-center">
                            <a href="{{ route('forgot-password') }}" class="tx-info">Forgot your password?</a>
                        </div>
                    </div>

                    <div class="form-group tx-12 tx-center login-footer">
                        Copyright © 2021 | PT Prima Vista Solusi.<br>
                        All rights reserved.
                    </div>
                    <div class="tx-12 tx-center">{{ config('constants.version_app') }}</div>
                </div>
            </form>
        </div>

        <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/lib/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/lib/js-sha256/src/sha256.js') }}"></script>
        <script src="{{ asset('assets/lib/AmaranJS/dist/js/jquery.amaran.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            });

            //Loading Overlay
            $(document).ajaxSend(function(event, jqxhr, settings) {
                // $.LoadingOverlay("show");
            });
            
            $(window).ajaxComplete(function(e, xhr, settings) {
                // $.LoadingOverlay("hide");
                if (xhr.status == 500) {
                    amaran_error(xhr.statusText);
                }
                else if (xhr.status == 401) {
                    setTimeout(function(){ 
                        window.location.href = '{{ route('logout') }}';
                    }, 3000);
                    amaran_error('Your session has been expired!');
                }
                else if(xhr.status != 200) {
                    amaran_error('Something went wrong, please contact technical support!');
                }
                else if(xhr.status == 200) {
                }
                else{
                    amaran_error('Something went wrong, please contact technical support!');
                }
            });
            
            // AMARAN
            // Error Alert
            function amaran_error(msg = "") {
                var message = "";
                if(msg == "") {
                    message = 'Something went wrong, please contact technical support!';
                }
                else {
                    message = '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-ios-close alert-icon tx-24"></i><span><strong>'+msg+'</strong></span></div>';
                }
               
                $.amaran({
                    content: {
                        bgcolor: '#fceced',
                        color: '#b51f2e',
                        message: message,
                    },
                    delay: 5000,
                    theme: 'colorful',
                    inEffect: 'slideTop',
                    'clearAll': true,
                    'position': 'top right'
                });
            
                $(".amaran.colorful").css("border","1px solid #DC3545");
            }
            
            // Warning Alert
            function amaran_warning(msg = "") {
                var message = "";
                if(msg == "") {
                    message = 'Something went wrong, please contact technical support!';
                }
                else {
                    message = '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-alert-circled alert-icon tx-24"></i><span><strong>'+msg+'</strong></span></div>';
                }
               
                $.amaran({
                    content: {
                        bgcolor: '#fef7ed',
                        color: '#c47709',
                        message: message,
                    },
                    delay: 5000,
                    theme: 'colorful',
                    inEffect: 'slideTop',
                    'clearAll': true,
                    'position': 'top right'
                });
            
                $(".amaran.colorful").css("border","1px solid #f49917");
            }
            
            // Success Alert
            function amaran_success(msg = "") {
                var message = "";
                if(msg==""){
                    message = 'success';
                }
                else {
                    message = '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-checkmark-circled alert-icon tx-24"></i><span><strong>'+msg+'</strong></span></div>';
                }
               
                $.amaran({
                    content: {
                        bgcolor: '#f2fef0',
                        color: '#1c9806',
                        message: message,
                    },
                    delay: 5000,
                    theme: 'colorful',
                    inEffect: 'slideTop',
                    'clearAll': true,
                    'position': 'top right'
                });
            
                $(".amaran.colorful").css("border","1px solid #23bf08");
            }

            // LOGIN PROCESS
            $("#loginForm").submit(function(e){
                e.preventDefault();

                $('.login-btn-text').css('display', 'none');
                $('.login-btn').prop('disabled', true);
                $('.login-btn-spinner').css('display', 'block');

                let data = {
                    user_email  : $('#user_email').val().toLowerCase(),
                    password    : $('#password').val()
                };

                $.ajax({
                    url         : '{{ route('login-process') }}',
                    method      : 'POST',
                    data        : data,
                    dataType    : 'json',
                    cache       : false,
                    headers     : {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(msg){
                        if(msg['{{ config('constants.result') }}'] == "SUCCESS"){
                            $('.login-btn-text').css('display', 'block');
                            $('.login-btn-spinner').css('display', 'none');
                            amaran_success(msg.message);

                            if(msg.user_data.user_force_change_password == 1 || msg.user_data.is_expired == 1){
                                window.location = '{{ route('change-password') }}';
                            }
                            else {
                                setTimeout(function(){
                                    window.location = '{{ route('dashboard') }}'
                                },1000);
                            }

                        }
                        else{
                            $('.login-btn-text').css('display', 'block');
                            $('.login-btn').prop('disabled', false);
                            $('.login-btn-spinner').css('display', 'none');
                            amaran_error(msg.message);
                        }
                    },
                    error: function(msg){
                        $('.login-btn-text').css('display', 'block');
                        $('.login-btn').prop('disabled', false);
                        $('.login-btn-spinner').css('display', 'none');
                    }
                });
                
                $('.login-btn-text').css('display', 'none');
                $('.login-btn').prop('disabled', true);
                $('.login-btn-spinner').css('display', 'block');
            });

            // PASSWORD TOGGLE
            function togglePassword() {
                var inputPwd = document.getElementById("password");
                var iconPwd = document.getElementById("icon-password");

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
    </body>
</html>
