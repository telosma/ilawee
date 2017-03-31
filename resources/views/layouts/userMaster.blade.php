<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title')</title>
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/metisMenu.min.css') !!}
        {!! Html::style('css/mystyle.css') !!}
        @yield('style')
        @stack('header')
    </head>
    <body>
        @include('includes.header')
        <div class="container-fluid page-body">
            @yield('content')
        </div>
        <div class="container-fluid">
            {{-- @include('includes.userFooter') --}}
        </div>
        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/userScript.js') !!}
        {!! Html::script('js/metisMenu.min.js') !!}
        @yield('script')
        @stack('scripts')
        <script type="text/javascript">
        $("#menu").metisMenu();
        </script>
    </body>
</html>
