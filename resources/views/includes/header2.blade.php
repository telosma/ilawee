<div id="wrapper">
    <div id="header">
        <div>
            <div class="header-top">
                <div class="content-heder-top">
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Liên hệ</a>
                    <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Sơ đồ cổng thông tin</a>
                    <a href="#"><i class="fa fa-headphones" aria-hidden="true"></i>Hướng dẫn khai thác</a>
                    @if (Auth::check())
                        <div class="account dropdown">
                            <div data-toggle="dropdown" style="display: inline-flex;">
                                <span class="icon round-image">
                                    <img src="{{ Auth::user()->avatar_link }}">
                                </span>
                                <span class="name">
                                    {{ Auth::user()->name }}
                                    <span class="caret"></span>
                                </span>
                            </div>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}">Đăng xuất</a>
                                </li>
                                <li class="divider"></li>
                                <li>Tùy chỉnh</li>
                            </ul>
                        </div>
                    @else
                        <a href="#" data-toggle="modal" data-target="#auth-modal">Đăng nhập/Đăng ký</a>
                    @endif
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
                    <li><a href="{{ route('home') }}"><span>CSDL Quốc Gia</span></a></li>

                    <li><a href="#"><span>Trang chủ</span></a></li>
                    <li><a href="#"><span>Tìm kiếm</span></a></li>

                    <li><a href="#"><span>English</span></a></li>
                </ul>
                <div class="right" id="HovershowListDonVi">
                </div>
                <div class="right" id="HovershowListBo">
                </div>
                <div class="right dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Trung Ương <b class="caret"></b></a>
                    <div class="dropdown-menu list-bo" style="left: 0;">
                        <div class="container">
                            <table width="100%" cellspacing="1" cellpadding="5">
                                <tbody>
                                    <tr class="header">
                                        <td colspan="3">Danh sách các cơ quan Trung Ương</td>
                                    </tr>
                                    <?php $govChunks = $governments->chunk(count($governments) / 2); ?>
                                    <tr>
                                        @foreach( $govChunks as $govChunk )
                                            <td>
                                                <ul>
                                                    @foreach ( $govChunk as $government )
                                                    <li><a href="{{ route('listLawByOrganization', $government->id) }}">{{ $government->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="right dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Bộ, Ngành <b class="caret"></b></a>
                    <div class="dropdown-menu list-bo" style="left: 0;">
                        <div class="container">
                            <table width="100%" cellspacing="1" cellpadding="5">
                                <tbody>
                                    <tr class="header">
                                        <td colspan="3">Danh sách các Bộ, Ngành</td>
                                    </tr>
                                    <?php $minisChunks = $ministries->chunk(count($ministries) / 2); ?>
                                    <tr>
                                        @foreach( $minisChunks as $minisChunk )
                                            <td>
                                                <ul>
                                                    @foreach ( $minisChunk as $ministry )
                                                    <li><a href="{{ route('listLawByOrganization', $ministry->id) }}">{{ $ministry->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        @endforeach
                                      {{--   <td>
                                            <ul>
                                                <li><a href="/bocongan">Bộ Công an</a></li>
                                                <li><a href="/bocongthuong">Bộ Công thương</a></li>
                                                <li><a href="/bogiaoducdaotao">Bộ Giáo dục và Đào tạo</a></li>
                                                <li><a href="/bogiaothong">Bộ Giao thông vận tải</a></li>
                                                <li><a href="/bokehoachvadautu">Bộ Kế hoạch và Đầu tư</a></li>
                                                <li><a href="/bokhoahoccongnghe">Bộ Khoa học và Công nghệ</a></li>
                                                <li><a href="/bolaodong">Bộ Lao động - Thương Binh và Xã hội</a></li>
                                                <li><a href="/bonongnghiep">Bộ Nông nghiệp và Phát triển nông thôn</a></li>
                                                <li><a href="/bonoivu">Bộ Nội vụ</a></li>
                                                <li><a href="/bongoaigiao">Bộ Ngoại giao</a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li><a href="/boquocphong">Bộ Quốc phòng</a></li>
                                                <li><a href="/botaichinh">Bộ Tài chính</a></li>
                                                <li><a href="/botainguyen">Bộ Tài nguyên và Môi trường</a></li>
                                                <li><a href="/botuphap">Bộ Tư pháp</a></li>
                                                <li><a href="/bothongtin">Bộ Thông tin và Truyền thông</a></li>
                                                <li><a href="/bovanhoathethao">Bộ Văn hóa - Thể thao và Du lịch</a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li><a href="/kiemtoannhanuoc">Kiểm toán Nhà nước</a></li>
                                                <li><a href="/toaannhandantoicao">Tòa án nhân dân tối cao</a></li>
                                                <li><a href="/vienkiemsatnhandantoicao">Viện kiểm sát nhân dân tối cao</a></li>
                                            </ul>
                                        </td> --}}
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="right dropdown">
                    <a href="{{ route('home') }}" class="dropdown-toggle" data-toggle="dropdown">Địa Phưong <b class="caret"></b></a>
                    <div class="dropdown-menu list-bo" style="left: 0;">
                        <div class="container">
                            <table width="100%" cellspacing="1" cellpadding="5">
                                <tbody>
                                    <tr class="header">
                                        <td colspan="3">Danh sách các Tỉnh</td>
                                    </tr>
                                    <?php $provChunks = $provinces->chunk(count($provinces) / 3); ?>
                                    <tr>
                                        @foreach( $provChunks as $provChunk )
                                            <td>
                                                <ul>
                                                    @foreach ( $provChunk as $province )
                                                    <li><a href="{{ route('listLawByOrganization', $province->id) }}">{{ $province->name }}</a></li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id='bttop'>Lên đầu trang</div>
            </div>
        </div>
    </div>
</div>
@if(!Auth::check())
    @include('includes.authModal')
@endif()
@push('scripts')
    <script>
        $(function(){
        $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop( true, true ).fadeIn("fast");
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop( true, true ).fadeOut("fast");
                    $(this).toggleClass('open');
                });
        });
    </script>
@endpush
