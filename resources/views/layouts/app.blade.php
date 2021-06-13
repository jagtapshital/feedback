<!DOCTYPE html>
<!--
* @version Cv3.0.0-alpha.1
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    @yield('head_meta')
    <title>Feedback - @yield('title','The App for Feedback')</title>
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/flag.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pace.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css?242342343') }}" rel="stylesheet">
    <script src="/js/jquery.min.js?{{ env('JS_VERSION',rand(10,100)) }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    
    @yield('css')


  </head>
  <body class="c-app flex-row" style="padding-top:10px !important">

    @yield('content') 

    <script src="{{ asset('js/pace.min.js') }}"></script> 
    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>    
    @yield('javascript')

  </body>
</html>
