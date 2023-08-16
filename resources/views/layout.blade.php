<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('title')

    <link rel="icon" type="image/ico" href="{{ asset('assets/img/pvs-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/jquery-switchbutton/jquery.switchButton.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/fontawesome-5.10.1/css/all.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/lib/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/datatables/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/lou-multi-select/css/multi-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/AmaranJS/dist/css/amaran.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/alertify.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/semantic.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/AlertifyJS-master/build/css/themes/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap-3.4.1-dist/css/label.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/lib/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.css') }}">
    
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style/main.css') }}">

    @yield('css')

    <link rel="stylesheet" href="{{ asset('assets/css/bracket.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/letter-avatar.css') }}" />
</head>

<body class="">
    <div class="br-logo admin-logo">
        <a class="wd-logo-topbar card-img-bottom img-fluid" style="text-align: center;" href="/">
            <img style="width: inherit;" src="{{ asset('assets/img/pvs-lg.png') }}" alt="Image">
        </a>
    </div>

    <!-- SIDEBAR MENU -->
    <div class="br-sideleft overflow-y-auto">
        <div class="br-sideleft-menu">
            <div class="sidebar-label pd-x-10 mg-t-20" style="opacity: 1">Navigation</div>
            <a href="{{ route('dashboard') }}" class="br-menu-link {{ $data['menu'] == 'dashboard' ? 'active' : '' }}">
                <div class="br-menu-item">
                    <img width="22" height="22" src="{{ asset('assets/img/icon-new/Dashboard.svg') }}" alt="">

                    <span class="menu-item-label">Dashboard</span>
                </div>
            </a>

            <!-- APPROVAL / REQUEST LIST -->
            @if (
                $data['privilege_menu'][config('constants.USER_APR_VIEW')] ||
                    $data['privilege_menu'][config('constants.GROUP_APR_VIEW')] ||
                    $data['privilege_menu'][config('constants.SUBGROUP_APR_VIEW')] ||
                    $data['privilege_menu'][config('constants.PACKAGE_APR_VIEW')]
            )
                <a href="#" class="br-menu-link {{ $data['menu'] == 'approval' ? 'active show-sub' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/Approval.svg') }}" alt="">
                            
                        <span class="menu-item-label">User Request</span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a>

                <ul class="br-menu-sub nav flex-column">
                    @if ($data['privilege_menu'][config('constants.USER_APR_VIEW')])
                        <li class="nav-item"><a href="{{ route('user-approval') }}"
                                class="nav-link {{ $data['sub_menu'] == 'user-approval' ? 'active' : '' }}">User</a></li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.SUBGROUP_APR_VIEW')])
                        <li class="nav-item"><a href="{{ route('subgroup-approval') }}"
                                class="nav-link {{ $data['sub_menu'] == 'subgroup-approval' ? 'active' : '' }}">Sub
                                Group</a></li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.GROUP_APR_VIEW')])
                        <li class="nav-item"><a href="{{ route('group-approval') }}"
                                class="nav-link {{ $data['sub_menu'] == 'group-approval' ? 'active' : '' }}">Group</a></li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.PACKAGE_APR_VIEW')])
                        <li class="nav-item"><a href="{{ route('package-approval') }}"
                                class="nav-link {{ $data['sub_menu'] == 'package-approval' ? 'active' : '' }}">Package</a>
                        </li>
                    @endif
                </ul>
            @endif

            <!-- MAIN FEATURE -->
            @if (
                $data['privilege_menu'][config('constants.PON_REQUEST_VIEW')] ||
                    $data['privilege_menu'][config('constants.PON_REQUEST_APR_VIEW')]
            )
                <div class="sidebar-label pd-x-10 mg-t-20" style="opacity: 1">Main Feature</div>
            @endif

            <!-- Update -->
            @if ( $data['privilege_menu']["CLAIM_REQUEST_PUSAT_VIEW"] || $data['privilege_menu']["CLAIM_APPROVAL_PUSAT_VIEW"] || $data['privilege_menu']["CLAIM_PROCESSING_VIEW"] ) 
                <a href="#" class="br-menu-link {{ $data['menu'] == 'claim' ? 'active show-sub' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/Claim.svg') }}" alt="">
                        <span class="menu-item-label">Claim</span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a>
                <ul class="br-menu-sub nav flex-column">
                    @if ( $data['privilege_menu']["CLAIM_REQUEST_PUSAT_VIEW"] ) 
                        <li class="nav-item"><a href="{{ route('claim_request') }}"
                            class="nav-link {{ $data['sub_menu'] == 'claim-request' ? 'active' : '' }}">Claim Request</a>
                        </li>
                    @endif
                    @if ( $data['privilege_menu']["CLAIM_APPROVAL_PUSAT_VIEW"] ) 
                        <li class="nav-item"><a href="{{ route('claim_approval') }}"
                            class="nav-link {{ $data['sub_menu'] == 'claim-approval' ? 'active' : '' }}">Claim Approval</a>
                        </li>
                    @endif
                    @if ( $data['privilege_menu']["CLAIM_PROCESSING_VIEW"] )                   
                        <li class="nav-item"><a href="{{ route('claim_processing') }}"
                            class="nav-link {{ $data['sub_menu'] == 'claim-processing' ? 'active' : '' }}">Claim Processing</a>
                        </li>
                    @endif
                </ul>
            @endif

            <!-- PON REQUEST -->
            @if (
                $data['privilege_menu'][config('constants.PON_REQUEST_VIEW')]
            )
                <a href="{{ route('pon-request-view') }}"
                    class="br-menu-link {{ $data['menu'] == 'pon-request' ? 'active' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/PON.svg') }}" alt="">
                        <span class="menu-item-label">PON Request</span>
                    </div>
                </a>
            @endif

            <!-- PON REQUEST APPROVAL -->
            @if ($data['privilege_menu'][config('constants.PON_REQUEST_APR_VIEW')])
                <a href="{{ route('pon-request-approval') }}"
                    class="br-menu-link {{ $data['menu'] == 'pon-request-approval' ? 'active' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/PON.svg') }}" alt="">
                        <span class="menu-item-label">PON Request Approval</span>
                    </div>
                </a>
            @endif

            <!-- SETTINGS -->
            @if (
                $data['privilege_menu'][config('constants.AUDIT_VIEW')] ||
                    $data['privilege_menu'][config('constants.FEATURE_VIEW')]
            )
                <div class="sidebar-label pd-x-10 mg-t-20" style="opacity: 1">Web Configuration</div>
                <a href="#" class="br-menu-link {{ $data['menu'] == 'settings' ? 'active show-sub' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/Setting.svg') }}" alt="">
                        <span class="menu-item-label">Settings</span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a>

                <ul class="br-menu-sub nav flex-column">
                    @if ($data['privilege_menu'][config('constants.AUDIT_VIEW')])
                        <li class="nav-item"><a href="{{ route('audit-trail') }}"
                                class="nav-link {{ $data['sub_menu'] == 'audit-trail' ? 'active' : '' }}">Audit Trail</a>
                        </li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.FEATURE_VIEW')])
                        <li class="nav-item"><a href="{{ route('feature') }}"
                                class="nav-link {{ $data['sub_menu'] == 'feature' ? 'active' : '' }}">Feature</a>
                        </li>
                    @endif
                    <li class="nav-item"><a href="{{ route('claim_category') }}"
                        class="nav-link {{ $data['sub_menu'] == 'claim-category' ? 'active' : '' }}">Claim Category</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('currency') }}"
                        class="nav-link {{ $data['sub_menu'] == 'currency' ? 'active' : '' }}">Currency</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('cost_centre') }}"
                        class="nav-link {{ $data['sub_menu'] == 'cost-centre' ? 'active' : '' }}">Cost Centre</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('rf_period') }}"
                        class="nav-link {{ $data['sub_menu'] == 'rf-period' ? 'active' : '' }}">RF Period</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('supplier') }}"
                        class="nav-link {{ $data['sub_menu'] == 'supplier' ? 'active' : '' }}">Supplier</a>
                    </li>
                </ul>
            @endif

            <!-- USER MANAGEMENT -->
            @if (
                $data['privilege_menu'][config('constants.USER_VIEW')] ||
                    $data['privilege_menu'][config('constants.SUBGROUP_VIEW')] ||
                    $data['privilege_menu'][config('constants.GROUP_VIEW')] ||
                    $data['privilege_menu'][config('constants.PACKAGE_VIEW')]
            )
                <a href="#" class="br-menu-link {{ $data['menu'] == 'user-management' ? 'active show-sub' : '' }}">
                    <div class="br-menu-item">
                        <img width="22" height="22" src="{{ asset('assets/img/icon-new/User.png') }}" alt="">
                        <span class="menu-item-label">User Management</span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a>

                <ul class="br-menu-sub nav flex-column">
                    @if ($data['privilege_menu'][config('constants.USER_VIEW')])
                        <li class="nav-item"><a href="{{ route('user-setup') }}"
                                class="nav-link {{ $data['sub_menu'] == 'user-setup' ? 'active' : '' }}">User Setup</a></li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.SUBGROUP_VIEW')])
                        <li class="nav-item"><a href="{{ route('subgroup-setup') }}"
                                class="nav-link {{ $data['sub_menu'] == 'subgroup-setup' ? 'active' : '' }}">Subroup
                                Setup</a></li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.GROUP_VIEW')])
                        <li class="nav-item"><a href="{{ route('group-setup') }}"
                                class="nav-link {{ $data['sub_menu'] == 'group-setup' ? 'active' : '' }}">Group Setup</a>
                        </li>
                    @endif
                    @if ($data['privilege_menu'][config('constants.PACKAGE_VIEW')])
                        <li class="nav-item"><a href="{{ route('package-setup') }}"
                                class="nav-link {{ $data['sub_menu'] == 'package-setup' ? 'active' : '' }}">Package
                                Setup</a></li>
                    @endif
                </ul>
            @endif
        </div>
        <br>
    </div>

    <!-- HEADER -->
    <div class="br-header">
        <div class="br-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i
                        class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i
                        class="icon ion-navicon-round"></i></a></div>
        </div>

        <div class="br-header-right">
            

            <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down"></span>
                    <img class="round" width="30" height="30"
                        avatar="{{ Session::get('user_name') }}">
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-300">
                    <ul class="list-unstyled user-profile-nav pd-t-15 tx-center">
                        <li class="profile-card"><img class="round" width="60" height="60"
                                avatar="{{ Session::get('user_name') }}">
                        </li>
                        <li class="profile-card">
                            <p class="tx-bold mg-b-5">{{ Session::get('user_firstname') }}
                                {{ Session::get('user_lastname') }}</p>
                            <p class="tx-gray-500 mg-b-5">{{ Session::get('user_name') }}</p>
                        </li>
                    </ul>
                    <ul class="list-unstyled user-profile-nav">
                        <hr>
                        <li>
                            <a href="{{ route('profile-view') }}"><i class="fas fa-user"
                                    style="padding-right:10px;"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('set-password') }}"><i class="fas fa-key"
                                    style="padding-right:10px;"></i> Change Password</a>
                        </li>
                        <hr>
                        <li>
                            <a href="{{ route('logout') }}"><i class="fas fa-power-off"
                                    style="padding-right:10px;"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- MAIN PANEL -->
<div class="br-mainpanel">
    <div class=" pd-b-10 pd-t-30 pd-l-30 pd-r-30">
        @yield('header_content')
    </div>

    <div class="br-pagebody mg-t-5 pd-x-30">
        @if ($errors->any())
            <span>{!! $errors->first() !!}</span>
        @endif
        @yield('body_content')
    </div>
    <footer class="br-footer">
        <div class="footer-left">
            <div class="mg-b-2">Prima Vista Solusi - {{ config('constants.app_name') }}.
                {{ config('constants.version_app') }}. Copyright &copy; 2021. PT Prima Vista Solusi. All Rights
                Reserved.</div>
        </div>
    </footer>
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
<script src="{{ asset('assets/lib/AlertifyJS-master/build/alertify.js') }}"></script>
<script src="{{ asset('assets/lib/jquery-loading-overlay-master/loadingoverlay.js') }}"></script>
<script src="{{ asset('assets/lib/parsleyjs/parsley.js') }}"></script>
<script src="{{ asset('assets/js/letter-avatar.js') }}"></script>
<script src="{{ asset('assets/lib/lou-multi-select/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/lib/AmaranJS/dist/js/jquery.amaran.js') }}"></script>
<script src="{{ asset('assets/js/jquery.quicksearch.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/lib/DateJS/build/date.js') }}"></script>

<script src="{{ asset('js/date-fixed.js') }}"></script>
<script src="{{ asset('js/ajaxtable.js') }}"></script>

<script type="text/javascript">
    var header_confirm =
        '<div class="row pd-l-15" style="color: #3593D2"><div class="ion-help-circled tx-24"></div> <div style="padding: 7px">Confirmation</div></div>';
    var header_delete =
        '<div class="row pd-l-15" style="color: #D61A1A"><div class="ion-alert-circled tx-24"></div><div style="padding: 7px">Warning: You will delete the data!</div></div>';
    var header_success =
        '<div class="row pd-l-15" style="color: #47B625"><div class="ion-checkmark-circled tx-24"></div> <div style="padding: 7px">Success</div></div>';
    var header_failed =
        '<div class="row pd-l-15" style="color: #D61A1A"><div class="ion-close-circled tx-24"></div> <div style="padding: 7px">Failed</div></div>';
    var header_qr =
        '<div class="row pd-l-15" style="color: #3593D2"><div class="ion-qr-scanner tx-24"></div> <div style="padding: 7px">Generated QR</div></div>';
    var header_error =
        '<div class="row pd-l-15" style="color: #D61A1A"><div class="ion-close-circled tx-24"></div> <div style="padding: 7px">Error</div></div>';
    var header_info =
        '<div class="row pd-l-15" style="color: #3593D2"><div class="ion-help-circled tx-24"></div> <div style="padding: 7px">Information</div></div>';

    $(document).ready(function() {
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });

    //Loading Overlay
    $(document).ajaxSend(function(event, jqxhr, settings) {
        $.LoadingOverlay("show");
    });

    $(window).ajaxComplete(function(e, xhr, settings) {
        $.LoadingOverlay("hide");
        if (xhr.status == 500) {
            amaran_error(xhr.statusText);
        } else if (xhr.status == 401) {
            setTimeout(function() {
                window.location.href = '{{ route('logout') }}';
            }, 3000);
            amaran_error('Your session has been expired!');
        } else if (xhr.status != 200) {
            amaran_error('Ajax Technical Issue. Please contact technical support!');
        } else if (xhr.status == 200) {} else {
            amaran_error('Something went wrong, please contact technical support!');
        }
    });

    $('ul.dropdown-menu').on('click', function(event) {
        event.stopPropagation();
    });

    // AMARAN
    // Error Alert
    function amaran_error(msg = "") {
        var message = "";
        if (msg == "") {
            message = 'Something went wrong, please contact technical support!';
        } else {
            message =
                '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-ios-close alert-icon tx-24"></i><span><strong>' +
                msg + '</strong></span></div>';
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

        $(".amaran.colorful").css("border", "1px solid #DC3545");
    }

    // Warning Alert
    function amaran_warning(msg = "") {
        var message = "";
        if (msg == "") {
            message = 'Something went wrong, please contact technical support!';
        } else {
            message =
                '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-alert-circled alert-icon tx-24"></i><span><strong>' +
                msg + '</strong></span></div>';
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

        $(".amaran.colorful").css("border", "1px solid #f49917");
    }

    // Success Alert
    function amaran_success(msg = "") {
        var message = "";
        if (msg == "") {
            message = 'success';
        } else {
            message =
                '<div class="d-flex align-items-center justify-content-start"><i class="icon ion-checkmark-circled alert-icon tx-24"></i><span><strong>' +
                msg + '</strong></span></div>';
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

        $(".amaran.colorful").css("border", "1px solid #23bf08");
    }
</script>
@yield('javascript')

</body>

</html>
