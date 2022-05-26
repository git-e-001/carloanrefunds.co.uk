<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8"/><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title', 'Payday Loan Claim Specialists - Redbridge Finance')</title>

    <meta name="description" content="@yield('page_description', '')">
    <meta name="keywords" content="@yield('page_keywords', '')">
    <meta property="og:title" content="@yield('page_og_title', '')">
    <meta property="og:type" content="@yield('page_og_type', '')">
    <meta property="og:url" content="@yield('page_og_url', '')">
    <meta property="og:description" content="@yield('page_og_description', '')">
    <meta property="og:image" content="@yield('page_og_image', '')">
    <meta name="twitter:title" content="@yield('page_twitter_title', '')">
    <meta name="twitter:site" content="@yield('page_twitter_site', '')">
    <meta name="twitter:card" content="@yield('page_twitter_card', '')">
    <meta name="twitter:description" content="@yield('page_twitter_description', '')">
    <meta name="twitter:image" content="@yield('page_twitter_image', '')">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-v4.6.0-min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,600">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
{{--    <script async src='{{ asset('frontend/assets/js/api.js') }}'></script>--}}

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- Leave those next 4 lines if you care about users using IE8 -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        img {
            max-width: 100%;
            width: auto 9;
            height: auto;
            vertical-align: middle;
            border: 0;
            -ms-interpolation-mode: bicubic;
        }
    </style>
@stack('style')
@include('snippets/google-tag-manager-head')
@include('snippets/pca')

<!--page-script-->
    @yield('page_scripts')

</head>
<body>
@include('snippets/google-tag-manager-body')
@include('snippets/tracking')


<div id="app">
    @include('includes.header')

    @include('cookieConsent::index')

    @yield('content')

    @include('includes.footer')
</div>


<script data-cfasync='false' src="{{ asset('js/app.js') }}"></script>
<script>
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>

<script src="{{ asset('frontend/assets/plugins/toastr/toastr.min.js') }}"></script>

<script data-cfasync="false" src="{{ asset('frontend/assets/js/email-decode.min.js') }}"></script>

<script data-cfasync='false' src="{{ asset('js/legacy.js') }}"></script>

<script>
    if (laravelCookieConsent) {
        $("#cookieConsentMOdal").modal('show')
    }
</script>

@stack('script')

@include('snippets/google-analytics')
</body>
</html>
