<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="">
  <title>Backend | truthbetkub19</title>
  @yield('meta-tag')
  <link rel="shortcut icon" type="image/png" href="{{ asset('/front-ends-assets/images/logo.svg')}}">
  <meta name="robots" content="index, follow">
  <meta property="og:site_name" content="" />
  <link rel="canonical" href="" />
  {{--  <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">  --}}
  <link rel="stylesheet" href="{{asset('/assets/js/plugins/dropzone/dist/min/dropzone.min.css')}}">
  <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/dashmix.css') }}">
  <link rel="stylesheet" id="css-theme" href="{{ asset('/assets/css/backend-color.css') }}">
  {{--  <link href="{{asset('/assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css" >  --}}
  {{--  <link href="{{asset('/assets/css/fontawesome.min.css')}}" rel="stylesheet" type="text/css" >  --}}
  {{--  <link href="{{asset('/assets/css/backend.css')}}" rel="stylesheet" type="text/css" >  --}}
  <link rel="stylesheet" href="{{asset('/assets/js/plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/js/plugins/simplemde/simplemde.min.css')}}">
  <link rel="stylesheet" href="{{asset('/assets/js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('/assets/backend/js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('/assets/css/bootstrap-colorpicker2.css')}}">
  {{--  <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">  --}}
  
  @yield('style')
</head>

<body>
  <div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark side-o">
    <!-- Sidebar -->
    @include('partials.sidenav')
    <!-- END Sidebar -->

    <!-- Header -->
    @include('partials.topnav')
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
      @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    @include('partials.footer')
    <!-- END Footer -->
  </div>

  <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
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
  <script src="{{ asset('/assets/js/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/simplemde/simplemde.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/dropzone/dropzone.min.js') }}"></script>
  {{-- <script src="{{ asset('/assets/backend/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script> --}}
  <script src="{{ asset('/assets/js/bootstrap-colorpicker2.js') }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <script>
    jQuery(function(){ Dashmix.helpers(['summernote', 'simplemde', 'ckeditor']); });
  </script>
  {{-- <script>
    jQuery(function(){ Dashmix.helpers(['datepicker', 'colorpicker']); });
  </script> --}}
  <script>
  $(document).ready(function () {
    $(".note-btn.btn.btn-light.btn-sm.dropdown-toggle .note-current-fontname").parent().addClass('d-none');
    $('.dropdown-toggle').dropdown()
  });
  </script>
  @yield('js')


</body>

</html>
