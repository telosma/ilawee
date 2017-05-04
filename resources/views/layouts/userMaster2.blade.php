<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title')</title>
        {{-- {!! Html::style('css/materialize.min.css') !!} --}}
        {!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/font-awesome.min.css') !!}
        {!! Html::style('css/style.css') !!}
        {!! Html::style('css/reset.css') !!}
        @yield('style')
        @stack('header')
    </head>
    <body>
        <div id="flash-overlay" class="flash-overlay">
            <div class="loading">
                <i class="fa fa-spinner fa-pulse fa-4x fa-fw" style="color: green;"></i>
            </div>
        </div>
        <div class="container-fluid page-body">
            @yield('content')
        </div>
        <div class="container-fluid">
            @include('includes.footer')
        </div>
        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/materialize.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
        {!! Html::script('js/metisMenu.min.js') !!}
        {!! Html::script('js/materialize.min.js') !!}
        {!! Html::script('js/user.js') !!}
        @yield('script')
        @stack('scripts')
    </body>
</html>
