<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{asset('assets/images/kabupaten-bandung-logo.png')}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Dispora">
        <meta name="keywords" content="Dispora">
        <meta name="author" content="LEFT4CODE">
        <title>Sidora V2 - Dispora Kabupuaten Bandung</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="https://sidora.bandungkab.go.id/assets/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        @yield('content')
        <!-- BEGIN: JS Assets-->
        <script src="https://sidora.bandungkab.go.id/assets/js/app.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
</html>
