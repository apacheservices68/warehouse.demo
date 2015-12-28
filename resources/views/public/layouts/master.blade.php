<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>
      body {
      min-height: 2000px;
      padding-top: 70px;
    }
    .text-red{color:red;}
    .row{text-align:center; }
    .style-margin{margin: 5px 0px;}
    .group-error{border:1px solid red;}
    .font-10{font-size:10px;text-align:left;}
    .no-display{display:none;}
    </style>
    <title>@yield('title')</title>
    <!-- Bootstrap core CSS -->

    {{-- <link href="asset('bower_components/bootstrap/dist/css/bootstrap.min.css')" rel="stylesheet">         --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/flatly/bootstrap.min.css" rel="stylesheet" >
    
    <link href="{{ asset('/assets/datatables/css/demo.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/datatables/css/datatables.bootstrap.css') }}" rel="stylesheet">
  </head>
  <body>
     @yield('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>    
    <script src="{{ asset('assets/custom.js') }}"></script>

    @stack('scripts')
  </body>
</html>
