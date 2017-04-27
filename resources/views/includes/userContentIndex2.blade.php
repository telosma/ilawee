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
                </div>
                <!-- cột phải -->
                <div class="right-200">
                    <!-- văn bản được quan tâm -->
                    <div class="ms-webpart-zone ms-fullWidth">
                        <div class="s4-wpcell-plain ms-webpartzone-cell ms-webpart-cell-vertical ms-fullWidth ">
                            <div class="ms-webpart-chrome ms-webpart-chrome-vertical ms-webpart-chrome-fullWidth ">
                                <div width="100%" class="ms-WPBody">
                                    <div class="box-container">

                                        <div class="box-content-01">
                                            <div class="top">
                                                <div>
                                                    <a href="#">Văn bản được xem nhiều</a></div>
                                            </div>
                                            <div class="content">
                                                <ul class="list">

                                                    <li class="">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=30615&dvid=13" title="Luật 32/2013/QH13" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=30615">Luật 32/2013/QH13</a>
                                                    </li>

                                                    <li class="odd">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=18128&dvid=13" title="Bộ luật 33/2005/QH11" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=18128">Bộ luật 33/2005/QH11</a>
                                                    </li>

                                                    <li class="">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=16267&dvid=13" title="Quyết định 19/2006/QĐ-BTC" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=16267">Quyết định 19/2006/QĐ-BTC</a>
                                                    </li>

                                                    <li class="odd">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=27615&dvid=13" title="Bộ luật 10/2012/QH13" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=27615">Bộ luật 10/2012/QH13</a>
                                                    </li>

                                                    <li class="">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=16726&dvid=13" title="Luật 60/2005/QH11" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=16726">Luật 60/2005/QH11</a>
                                                    </li>

                                                    <li class="odd">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=16858&dvid=13" title="Nghị định 158/2005/NĐ-CP" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=16858">Nghị định 158/2005/NĐ-CP</a>
                                                    </li>

                                                    <li class="">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=19419&dvid=13" title="Luật 13/2003/QH11" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=19419">Luật 13/2003/QH11</a>
                                                    </li>

                                                    <li class="odd">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=6157&dvid=13" title="Bộ luật 15/1999/QH10" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=6157">Bộ luật 15/1999/QH10</a>
                                                    </li>

                                                    <li class="">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=6117&dvid=13" title="Luật 22/2000/QH10" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=6117">Luật 22/2000/QH10</a>
                                                    </li>

                                                    <li class="odd">
                                                        <a href="/TW/Pages/vbpq-toanvan.aspx?ItemID=18542&dvid=13" title="Nghị định 181/2004/NĐ-CP" class="jt" rel="/VBQPPL_UserControls/Publishing_22/pLoadAjaxVN.aspx?IsVietNamese=true&ItemID=18542">Nghị định 181/2004/NĐ-CP</a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="bottom">
                                                <div>
                                                    &nbsp;</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ms-clear"></div>
                            </div>

                        </div>
                        <div class="ms-clear"></div>
                    </div>
                </div>
                <!-- cột phải -->
            </div>
            <!-- cột phải 790 zone1-->
        </div>
        <!-- content -->
    </div>
</div>
