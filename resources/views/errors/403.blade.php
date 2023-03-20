<!DOCTYPE html>
<html lang="en" class="pos-relative">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>403 | Forbidden</title>

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/lib/fontawesome-5.10.1/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/lib/Ionicons/css/ionicons.css') }}">


    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bracket.css') }}">
  </head>

  <body class="pos-relative">

    <div class="ht-100v d-flex align-items-center justify-content-center">
      <div class="wd-lg-70p wd-xl-50p tx-center pd-x-40">
        <h1 class="tx-100 tx-xs-140 tx-normal tx-inverse tx-roboto mg-b-0">403</h1>
        <h5 class="tx-xs-24 tx-normal tx-info mg-b-30 lh-5">{{ $exception->getMessage() }}</h5>
        <p class="tx-16 mg-b-30">We were sorry, You do not have access to the page you requested.<br> Please go back to the Login Page</p>
        <div class="d-flex justify-content-center">
          <div class="input-group " style="width: 106px;">
              <a href="{{ route('logout') }}" class="btn btn-primary">Login Page</a>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/lib/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/bootstrap.js') }}"></script>

  </body>
</html>
