@extends('layouts.userMaster')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <div class="nav-left">
                        <ul>
                            <li class="group-menu">
                                <div class="menu-head">
                                    <span>Co quan ban hanh</span>
                                </div>
                                <ul class="menu">
                                    <li><a>Thu tuong</a></li>
                                    <li><a>Quoc hoi</a></li>
                                    <li><a>Chu tich nuoc</a></li>
                                </ul>
                            </li>
                            <li class="group-menu">
                                <div class="menu-head">
                                    <span>Loai van ban</span>
                                </div>
                                <ul class="menu">
                                    <li class="active"><a>Hien phao</a></li>
                                    <li><a>Bo luat</a></li>
                                    <li><a>Phap lenh</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="body-content">

                    </div>
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="nav-right"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
