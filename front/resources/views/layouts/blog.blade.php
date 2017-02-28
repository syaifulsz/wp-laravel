<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle or 'Index' }}</title>
    <link href="{{ \ViewHelper::asset_versioning('/themes/ragnarokx/dist/stylesheets/global.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]><script src="{{ \ViewHelper::asset_versioning('dist/scripts/ie-libs.min.js') }}"></script><![endif]-->
    @stack('styles')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
</head>
<body>
    @include('partials.header')
    @yield('content')
    <script src="{{ \ViewHelper::asset_versioning('themes/ragnarokx/dist/scripts/global.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
