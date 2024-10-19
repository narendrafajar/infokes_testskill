<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{__('Page Explorer')}}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('kai/img/kaiadmin/favicon.ico')}}" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts and icons -->
    <script src="{{asset('kai/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: [{{asset('kai/css/fonts.min.css')}}],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('kai/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('kai/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('kai/css/kaiadmin.min.css')}}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{asset('kai/css/demo.css')}}" />
    </head>
    <body>
        <div class="wrapper">
            @include('layouts.navigation')
            <div class="main-panel">
              <div class="container">
                <div class="page-inner">
                    @yield('pageTitle')
                    <div class="row">
                      {{$slot}}
                    </div>
                </div>
              </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{asset('kai/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

    <!-- Chart JS -->
    <script src="{{asset('kai/js/plugin/chart.js/chart.min.js')}}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{asset('kai/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Chart Circle -->
    <script src="{{asset('kai/js/plugin/chart-circle/circles.min.js')}}"></script>

    <!-- Datatables -->
    {{-- <script src="assets/js/plugin/datatables/datatables.min.js"></script> --}}

    <!-- Bootstrap Notify -->
    <script src="{{asset('kai/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

    <!-- jQuery Vector Maps -->
    {{-- <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script> --}}
    {{-- <script src="assets/js/plugin/jsvectormap/world.js"></script> --}}

    <!-- Sweet Alert -->
    <script src="{{'kai/js/plugin/sweetalert/sweetalert.min.js'}}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{asset('kai/js/kaiadmin.min.js')}}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{asset('kai/js/setting-demo.js')}}"></script>
    <script src="{{asset('kai/js/demo.js')}}"></script>
    <script src="{{ asset('js/navigation_page.js') }}"></script>
    {{-- <script src="{{ asset('js/main-folder.js') }}"></script> --}}
    @yield('additional_js')
    </body>
</html>
