<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<!-- Fonts -->
<link rel="dns-prefetch" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/fonts/themify/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/fonts/elegant-font/html-css/style.css') }}">

<!-- Custom Styles -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/animate/animate.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/css-hamburgers/hamburgers.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/animsition/css/animsition.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/vendor/noui/nouislider.min.css') }}">

<!-- Custom Styles For This Template-->
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/css/util.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/fashe-colorlib/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@yield('links')