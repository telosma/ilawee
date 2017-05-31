<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('images/default_ava.png') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">QUẢN LÝ</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book"></i> <span>Văn bản</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.organization.index') }}"><i class="fa fa-sitemap"></i> Cơ quan ban hành</a></li>
                    <li><a href="{{ route('admin.signer.index') }}"><i class="fa fa-user"></i> Người ký</a></li>
                    <li>
                        <a href="">
                                <i class="fa fa-files-o"></i>
                            <span>Văn bản chờ phê duyệt</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">4</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.document.index') }}">
                                <i class="fa fa-files-o"></i>
                            <span>Danh sách văn bản</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">{{ $numDoc }}</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-users"></i> <span>Tài khoản</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{ route('admin.role.index') }}">
                                <i class="fa fa-user-circle-o"><span> Quyền</span></i>
                            </a>
                            <a href="{{ route('admin.account.index') }}">
                                <i class="fa fa-user-circle-o"><span> Tài khoản</span></i>
                            </a>
                        </li>
                    </ul>
                </li>
    </section>
    <!-- /.sidebar -->
</aside>
