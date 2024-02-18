<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from crm-admin-dashboard-template.multipurposethemes.com/hospital/vertical/main/auth_login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 03 Oct 2023 09:41:09 GMT -->
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('nowa/images/favicon.ico')}}">

    <title>@yield('titulo') - Iniciar sessão</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('src/css/vendors_css.css')}}">

    {{-- <link rel="stylesheet" href="{{ asset('nowa/assets/icons/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/Ionicons/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/linea-icons/linea.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/glyphicons/glyphicon.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/flag-icon-css/css/flag-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/material-design-iconic-font/css/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/cryptocoins-master/cryptocoins.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/iconsmind/style.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/icons/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('nowa/assets/vendor_components/animate/animate.css') }}"> --}}

	<!-- Style-->
	<link rel="stylesheet" href="{{ asset('nowa/src/css/styler.css')}}">
	<link rel="stylesheet" href="{{ asset('nowa/src/css/skin_color.css')}}">
</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url('{{ asset('nowa/images/auth-bg/bg-1.jpg')}}')">

    <div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
            @yield('conteudo')
        </div>
    </div>

    <!-- Vendor JS -->
    <script src="{{ asset('nowa/src/js/vendors.min.js')}}"></script>
    <script src="{{ asset('nowa/src/js/pages/chat-popup.js')}}"></script>
    <script src="{{ asset('nowa/assets/icons/feather-icons/feather.min.js')}}"></script>
</body>
</html>
