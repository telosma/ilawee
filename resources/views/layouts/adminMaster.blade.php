<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title')</title>
        @include('includes.adminStyle')
        @yield('style')
    </head>
    <body class="skin-blue sidebar-mini" style="height: auto;">
        @include('includes.adminMenu')
        @include('includes.admin.sidebar');
        <div class="content-wrapper">
            <section class="content-header">
                <h1>Admin</h1>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @include('includes.error')
                                @include('includes.message')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
        @include('includes.adminScript')
        @yield('script')
        @stack('scripts')
    </body>
</html>
