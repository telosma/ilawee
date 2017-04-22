<div id="wrapper">
    <div id="header">
        <div>
            <div class="header-top">
                <div class="content-heder-top">
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Liên hệ</a>
                    <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Sơ đồ cổng thông tin</a>
                    <a href="#"><i class="fa fa-headphones" aria-hidden="true"></i>Hướng dẫn khai thác</a>
                    <a href="#" data-toggle="modal" data-target="#auth-modal">Đăng nhập/Đăng ký</a>
                </div>
            </div>
        </div>

        <div id="content-banner">
            <div class="banner">
                <div style="padding-top: 55px; padding-left: 90px;">
                </div>
            </div>
        </div>
    </div>
    <div id="content-menu-top">
        <div id="menu">
            <div class="menu-container">
                <ul class="topMenu">
                    <li><a href="#"><span>CSDL Quốc Gia</span></a></li>

                    <li><a href="#"><span>Trang chủ</span></a></li>
                    <li><a href="#"><span>Tìm kiếm</span></a></li>

                    <li><a href="#"><span>English</span></a></li>
                </ul>
                <div class="right" id="HovershowListDonVi">
                </div>
                <div class="right" id="HovershowListBo">
                </div>
                <div class="right" id="HovershowListBo2">
                    <a href="#" id="showListBo">Trung ương</a>
                </div>
                <div class="right" id="HovershowListBo2">
                    <a href="#" id="showListBo">Bo, Nganh</a>
                </div>
                <div class="right" id="HovershowListBo2">
                    <a href="#" id="showListBo">Dia phuong</a>
                </div>
                <div id='bttop'>Lên đầu trang</div>
            </div>
        </div>
    </div>
</div>
@if(!Auth::check())
    @include('includes.authModal');
@endif()
