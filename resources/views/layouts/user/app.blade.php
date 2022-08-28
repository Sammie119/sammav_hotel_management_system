<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('public/assets/images/smmie_logo.ico') }}" type="image/x-icon">
    
    <title>@yield('title')</title>
  
  <!-- Font Awesome Icons -->  
  <script src="{{ asset('public/assets/js/awesome-fonts.5.15.3.js') }}" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap-5.2.0-dist/css/bootstrap.min.css') }}">

<!-- Theme style -->
  <link href="{{ asset('public/assets/css/styles.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('public/assets/css/custom-styles.css') }}">

  {{-- Alert css --}}
  <link rel="stylesheet" href="{{ asset('public/assets/js/alert/toastr_alert.css') }}">
  
</head>

<body class="sb-nav-fixed">
    {{-- Nav Bar --}}
    @include('layouts.user.nav-bar')

    <div id="layoutSidenav" style="margin-top: -60px;">

        <div id="layoutSidenav_content">

            <main> 
                @yield('content')
            </main>

            <footer class="py-4 bg-light mt-auto">
                @include('layouts.user.footer')
            </footer>

        </div>

    </div>

</div>

    <!-- REQUIRED SCRIPTS -->

    <script src="{{ asset('public/assets/css/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>

    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>

    <!-- jQuery -->
    {{-- <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script> --}}

    <script src="{{ asset('public/assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/alert/toastr_alert.js') }}"></script>

    @stack('scripts')

    @if(Session::has('success'))
        <script>
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.success("{!! Session::get('success') !!}");
        </script>
    @endif

    @if(Session::has('error'))
        <script>
            toastr.options =
            {
            "closeButton" : true,
            "progressBar" : true
            }
            toastr.error("{!! Session::get('success') !!}");
        </script>
    @endif

    {{-- <script>
        $(".alert").fadeTo(2000, 500).slideUp(1000, function(){
            $(".alert").slideUp(1000);
        });
    </script> --}}

    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = true;
            if (sidebarToggle) {           
                event.preventDefault();
                document.body.classList.toggle('sb-sidenav-toggled');
                localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));   
            }
        });
    </script>

</body>
</html>