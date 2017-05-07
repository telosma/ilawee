<!-- cột trái -->
<div class="left-200">
    <div class="ms-webpart-zone ms-fullWidth">
        <div class="s4-wpcell-plain ms-webpartzone-cell ms-webpart-cell-vertical ms-fullWidth ">
            <div class="ms-webpart-chrome ms-webpart-chrome-vertical ms-webpart-chrome-fullWidth ">
                <div width="100%" class="ms-WPBody " allowDelete="false" allowExport="false" style="" >
                    <div class="box-container">
                        <div class="left-menu">
                            <div class="bottom">
                                <div class="left-menu-c">
                                    <div class="content">
                                        <ul>
                                            @for($i = 0; $i < 3; $i++)
                                                <li><span><a href="/tw/Pages/home.aspx?dvid=13">Văn bản quy phạm pháp luật</a></span></li>
                                            @endfor()
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-clear"></div>
                </div>
            </div>
            <div class="ms-PartSpacingVertical"></div>
        </div>
        <div class="box-container">
            <div class="box-content-01" id="menu-toc">
                <div class="content">
                    <ul id="ul-toc" class="category"></ul>

                </div>
            </div>
        </div>
        <div class="s4-wpcell-plain ms-webpartzone-cell ms-webpart-cell-vertical ms-fullWidth">
            <div class="ms-webpart-chrome ms-webpart-chrome-vertical ms-webpart-chrome-fullWidth ">
                <div width="100%" class="ms-WPBody " allowDelete="false" allowExport="false" style="" >
                    <div>
                        <div class="box-container">
                            <div class="box-content-01">
                                <div class="top">
                                    <div>
                                        <a href="javascript:;">Cơ quan ban hành</a></div>
                                </div>
                                <div class="content">
                                    <ul class="category" id="capCQ">
                                        @for($i = 0; $i < 5; $i++)
                                        <li><span><a href="#">Thủ tướng </a></span></li>
                                        @endfor()
                                    </ul>
                                </div>
                                <div class="bottom">
                                    <div>&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        <div class="box-container">
                            <div class="box-content-01">
                                <div class="top">
                                    <div>
                                        <a href="">Loại văn bản</a>
                                    </div>
                                </div>
                                <div class="content">
                                    <ul class="category" id="loaiVB">
                                        @foreach($doctypes as $doctype)
                                            <li>
                                                <span>
                                                    <a href="{{ route('document.filter.type', $doctype->id) }}" class="item-doctype" data-type-id="{{ $doctype->id }}">
                                                       {{ $doctype->name }}
                                                    </a>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-clear"></div>
                </div>
            </div>
            <div class="ms-PartSpacingVertical"></div>
        </div>
    </div>
</div>
<!-- cột trái -->
