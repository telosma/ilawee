<div id="content-layouts-wrapper">
    <div id="content-layouts">
        <!-- content -->
        <div id="content">
            @include('includes.menuLeft')
            <!-- cột phải 790 zone1-->
            <div class="right-790">
                <!-- Cột giữa -->
                <div class="left-580">
                    <div class="ms-webpart-zone ms-fullWidth">
                        <!-- ô tìm kiếm -->
                        @include('includes.boxSearch')
                        <!-- ô tìm kiếm -->
                        <div class="s4-wpcell-plain ms-webpartzone-cell ms-webpart-cell-vertical ms-fullWidth ">
                            <div class="ms-webpart-chrome ms-webpart-chrome-vertical ms-webpart-chrome-fullWidth">
                                <div width="100%" class="ms-WPBody">
                                    <div id="grid_vanban">
                                        <div class="box-container">
                                            <div class="box-tab" id="tabVB_lv1">
                                                <div class="header">
                                                    <ul class="nav nav-tabs">
                                                        <li class="tabVB_lv1_01 {{ empty($tab) || ($tab == 'tabVB_lv1_01') ? 'active' : ''}}"><a href="{{ route('home') . "/?tab=tabVB_lv1_01" }}"><span>Văn bản mới</span></a></li>
                                                        <li class="tabVB_lv1_02 {{ ($tab == 'tabVB_lv1_02') ? 'active' : ''}}"><a href="{{ route('home') . "/?tab=tabVB_lv1_02" }}"><span>Văn bản có hiệu lực trong tháng</span></a></li>
                                                        <li class="tabVB_lv1_03 {{ ($tab == 'tabVB_lv1_03') ? 'active' : ''}}"><a href="{{ route('home') . "/?tab=tabVB_lv1_03" }}"><span>Văn bản hết hiệu lực trong tháng</span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="content tab-pane fade in {{ empty($tab) || ($tab == 'tabVB_lv1_01') ? 'active' : ''}} id="tabVB_lv1_01">
                                                        <!-- danh sách văn bản -->
                                                        <ul class="listLaw">
                                                            @forelse($newLaws as $document)
                                                                @include('includes.listLaw')
                                                            @empty
                                                            @endforelse
                                                        </ul>
                                                        <div>
                                                            {{ $newLaws->links() }}
                                                        </div>
                                                        <!-- danh sách văn bản -->
                                                    </div>
                                                    <div class="content tab-pane fade in {{ ($tab == 'tabVB_lv1_02') ? 'active' : ''}}" id="tabVB_lv1_02">
                                                        <ul class="listLaw">
                                                            @forelse($lawStartInMonths as $document)
                                                                @include('includes.listLaw')
                                                            @empty
                                                            @endforelse
                                                        </ul>
                                                        <div>
                                                            {{ $lawStartInMonths->links() }}
                                                        </div>
                                                    </div>
                                                    <div class="content tab-pane fade {{ ($tab == 'tabVB_lv1_03') ? 'active' : ''}}" id="tabVB_lv1_03">
                                                        <span>hello</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- cột phải -->
                @include('includes.menuRight')
                <!-- cột phải -->
            </div>
            <!-- cột phải 790 zone1-->
        </div>
        <!-- content -->
    </div>
</div>
