<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Customer Portal">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{Config::get("customer_portal.company_name")}}</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/js/vendor/sweetalert/dist/sweetalert.css">
    <link rel="stylesheet" href="/assets/css/global.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="/messages.js" type="text/javascript"></script>
    @yield('additionalCSS')
</head>