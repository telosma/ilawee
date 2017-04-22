<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title')</title>
        {{-- <link rel="stylesheet" href=".{{ elixir('css/app.css') }}"> --}}
        {!! Html::style('css/style.css') !!}
        {!! Html::style('css/reset.css') !!}
        @yield('style')
        @stack('header')
    </head>
    <body>
        {{-- @include('includes.header2') --}}
        <div class="container-fluid page-body">
            @yield('content')
        </div>
        <div class="container-fluid">
        </div>
        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/metisMenu.min.js') !!}
        {!! Html::script('js/materialize.min.js') !!}
        @yield('script')
        @stack('scripts')
        <script type="text/javascript">
            $("#menu").metisMenu();
            $('#tabVB_lv1').tabs();
        </script>
    </body>
</html>