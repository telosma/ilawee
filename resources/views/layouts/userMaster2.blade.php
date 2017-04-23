<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title')</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/style.css') !!}
        {!! Html::style('css/reset.css') !!}
        @yield('style')
        @stack('header')
    </head>
    <body>
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
    </body>
</html>
