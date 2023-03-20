<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @yield('title')
        
        <link rel="icon" type="image/ico" href="{{ asset('assets/img/new_wirecard.png') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/jquery-switchbutton/jquery.switchButton.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/fontawesome-5.10.1/css/all.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/lib/datatables/jquery.dataTables.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/datatables/dataTables.bootstrap4.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/lib/select2/css/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/lou-multi-select/css/multi-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/AmaranJS/dist/css/amaran.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/alertify.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/default.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/semantic.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/bootstrap.min.css')}}"/>
        <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap-3.4.1-dist/css/label.css')}}"/>

        <style type="text/css">
            /* CUSTOMIZED CSS */
            /* Space between title and content */
            .br-pagebody {
                margin-top: 15px;
                margin-bottom: 30px;
            }
            
            .admin-logo {
                box-shadow: 0 1px 4px 0px rgba(0, 0, 0, 0.16);
            }

            a {
                transition: all 0.2s ease-in-out;
            }

            /* Profile Card */
            .profile-card {
                font-size: 15px; 
                padding: 5px;
            }

            .dropdown-profile-card{
                border-top: 0;
                margin-top: 1px;
                box-shadow: 0 1px 4px 0px rgba(0, 0, 0, 0.16);
                border-top-left-radius: 0;
                border-top-right-radius: 0;
                left: auto !important;
                right: -1px !important;
                top: 44px !important;
                transform: none !important;
                will-change: unset !important;
            }

            /* ALERTIFY */
            .alertify .ajs-header {
                padding: 6px 24px;
            }

            .alertify .ajs-footer {
                padding: 0px;
            }

            .alertify .ajs-body .ajs-content {
                padding: 24px;
            }

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
        @yield('css')

        <link rel="stylesheet" href="{{ asset('assets/css/bracket.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom-admin.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/custom-general.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/letter-avatar.css')}}"/>
    </head>

    <body class="bg-br-primary">
        <!-- MAIN PANEL -->
        <div class="br-mainpanel mg-l-0">
            <div class=" pd-y-0 pd-l-30 pd-r-30">
                @yield('header_content')
            </div>

            <div class="br-pagebody pd-t-0 pd-x-30">
                @if($errors->any())
                    <span>{!! $errors->first() !!}</span>
                @endif

                <div class="d-flex align-items-center justify-content-center">
                    <div class="login-wrapper wd-300 wd-xs-500 pd-25 pd-xs-40 bg-white rounded shadow-base">
                        @yield('body_content')

                        <div class="form-group tx-12 tx-center login-footer">
                          Copyright © 2021 PT Prima Vista Solusi.<br>
                          All rights reserved. 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery-ui/jquery-ui.js') }}"></script>
        <script src="{{ asset('assets/lib/popper/popper.js') }}"></script>
        <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
        <script src="{{ asset('assets/lib/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/lib/jquery-switchbutton/jquery.switchButton.js') }}"></script>
        <script src="{{ asset('assets/lib/peity/jquery.peity.js') }}"></script>
        <script src="{{ asset('assets/lib/highlightjs/highlight.pack.js') }}"></script>
        <script src="{{ asset('assets/js/bracket.js') }}"></script>

        <script src="{{ asset('assets/lib/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/lib/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('assets/lib/AlertifyJS-master/build/alertify.js')}}"></script>
        <script src="{{ asset('assets/lib/jquery-loading-overlay-master/loadingoverlay.js')}}"></script>
        <script src="{{ asset('assets/lib/parsleyjs/parsley.js') }}"></script>
        <script src="{{ asset('assets/js/letter-avatar.js') }}"></script>
        <script src="{{ asset('assets/lib/lou-multi-select/js/jquery.multi-select.js') }}"></script>
        <script src="{{ asset('assets/lib/AmaranJS/dist/js/jquery.amaran.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.quicksearch.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            });

            //Loading Overlay
            $(document).ajaxSend(function(event, jqxhr, settings) {
                $.LoadingOverlay("show");
            });
            
            $(window).ajaxComplete(function(e, xhr, settings) {
                $.LoadingOverlay("hide");
                if (xhr.status == 500) {
                    amaran_error(xhr.statusText);
                }
                else if (xhr.status==401) {
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
        </script>
        @yield('javascript')

    </body>
</html>
