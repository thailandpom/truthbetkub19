<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="">
  <title>Backend - truthbetkub19</title>
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="index, follow">
  <meta property="og:site_name" content="" />
  <link rel="canonical" href="" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/dashmix.css') }}">  
  <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/backend-color.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="https://use.typekit.net/obm6pja.css">
  <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">
</head>
<body>
    <div id="app"></div>
    

       
            @yield('content')
      
    </div>
{{-- <script src="{{ asset('/assets/js/dashmix.app.js') }}"></script> --}}
   
  <script src="{{ asset('/assets/js/dashmix.core.min.js') }}"></script>
  <script src="{{ asset('/assets/js/dashmix.app.min.js') }}"></script>
  <script src="{{ asset('/assets/js/laravel.app.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script>
  <script src="{{ asset('/assets/js/pages/be_tables_datatables.min.js') }}"></script>

  <script src="{{ asset('/assets/tinymce/tinymce.min.js') }}"></script>
</body>
</html>
