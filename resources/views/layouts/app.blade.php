<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="RAJ_SHAH">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Catch The Flag') }}</title>

    <link rel="shortcut icon" href="{{ url('/img/icon.png') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Pace -->
    <link rel="stylesheet" type="text/css" href="{{ url('/adminlte/plugins/pace/pace.min.css') }}">
    <script src="{{ url('/adminlte/plugins/pace/pace.min.js') }}"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @section('header-scripts')

    @show

    @section('stylesheets')
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <!--link rel="stylesheet" type="text/css" href="{{ elixir('css/app.css') }}"-->

      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ url('adminlte/dist/css/AdminLTE.min.css') }}">
      <!-- AdminLTE Skins-->
      <link rel="stylesheet" href="{{ url('adminlte/dist/css/skins/skin-blue.min.css') }}">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

      <!-- Non-compiled css -->
      <!--link rel="stylesheet" type="text/css" href="{{ url('css/style.css') }}"-->
          
    @show

</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div id="app" class="wrapper">
        @section('header')
            @include('layouts.header')
        @show
        
        @section('sidebar')
            @include('layouts.sidebar')
        @show

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            @section('flashMessages')
                @include('layouts.flashMessages')
            @show
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <h1>
                @yield('content-header')  
              </h1>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Page Content Here -->
              @yield('content')

            </section>
            <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->
        
        @section('footer')
            @include('layouts.footer')
        @show

    </div>
    
    @section('scripts')
      <!-- jQuery library -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <!-- Bootstrap JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- AdminLTE JS -->
      <script src="{{ url('adminlte/dist/js/app.min.js') }}"></script>      
    @show

</body>
</html>
