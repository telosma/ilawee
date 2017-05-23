<div id="wrapper">
    <div id="header">
        <div>
            <div class="header-top">
                <div class="content-heder-top">
                    <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>Liên hệ</a>
                    {{-- <a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Sơ đồ cổng thông tin</a> --}}
                    {{-- <a href="#"><i class="fa fa-headphones" aria-hidden="true"></i>Hướng dẫn khai thác</a> --}}
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
                                <li>
                                    <a href="{{ route('user.question', ['name' => Auth::user()->name, 'id' => Auth::user()->id ]) }}">Câu hỏi</a>
                                </li>
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
                    <li><a href="{{ route('document.show.advancedSearch') }}"><span>Tìm kiếm</span></a></li>
                    <li><a href="{{ route('advisory') }}"><span>Câu hỏi pháp luật</span></a></li>
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
                                        <td colspan="5">Danh sách các Tỉnh</td>
                                    </tr>
                                    <?php $provChunks = $provinces->chunk(count($provinces) / 4); ?>
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
