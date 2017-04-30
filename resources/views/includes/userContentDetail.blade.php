<div id="content-layouts-wrapper">
    <div id="content-layouts">
        <!-- content -->
        <div id="content">
            <!-- cột trái -->
            @include('includes.menuLeft')
            <!-- cột trái -->
            <!-- cột phải 790 zone1-->
            <div class="right-790">
                <div class="box-container">
                    <div class="box-tab-vb">
                        {{-- Box bread scrum --}}
                        {!! Breadcrumbs::render('vanban.show', $document->id) !!}
                        {{-- end breadscrum --}}
                        <ul class="nav nav-tabs">
                            <li class="{{ empty($tab) || ($tab == 'itemtoanvan') ? 'active' : ''}}"><a href="#itemtoanvan" data-toggle="tab">Toàn văn</a></li>
                            <li class="{{ (isset($tab) && $tab == 'itemthuoctinh') ? 'active' : ''}}"><a href="#itemthuoctinh" data-toggle="tab">Thuộc tính</a></li>
                            <li class="{{ (isset($tab) && $tab == 'itemvblienquan') ? 'active' : ''}}""><a href="#itemvblienquan" data-toggle="tab">Văn bản liên quan</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="itemtoanvan" class="content tab-pane fade in {{ empty($tab) || ($tab == 'itemtoanvan') ? 'active' : ''}}">
                                <div class="fulltext">
                                    <div class="vbInfo">
                                        <ul>
                                            <li class="red">{{ $document->effective ? $document->effective : 'Đang cập nhật' }}</li>
                                            <li class="green">
                                                <span>Ngày có hiệu lực: </span>
                                                {{ $document->start_date }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div>
                                        @if (!(empty($document->content)))
                                            <div class="document-required">
                                                <table width="30%" cellpadding="1" border="0" align="left" style="margin-left: 5px;">
                                                    <tbody>
                                                        <tr>
                                                            <td width="22%" valign="baseline" align="center">
                                                                <div align="center" style="margin-top: 10px;">
                                                                    <b>{{ $document->organizations()->first()->name }}</b>
                                                                </div>
                                                                <div style="border-bottom: 1px solid #000000;width:40px;"></div>
                                                                <div style="padding-top:5px;text-align:center;">
                                                                    Số: {{ $document->notation }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table width="40%" cellpadding="1" border="0" align="right">
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <div style="padding: 5px; text-align: center;">
                                                                    <b>CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></div>
                                                                <div style="padding: 5px; text-align: center;">
                                                                    <b style="border-bottom: 1px solid #000000; margin-left: 10px; padding-bottom: 3px;">
                                                                        Độc lập - Tự do - Hạnh phúc</b></div>
                                                                <div style="padding: 5px; text-align: center;">
                                                                    <i>
                                                                            ngày {{ $document->publish_day }}, tháng {{ $document->publish_month }}, năm {{ $document->publish_year }}
                                                                    </i>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <article style="display: none;">
                                            <textarea id="sourceTA" cols="30" rows="70">
                                                {!! $document->content !!}
                                            </textarea>
                                        </article>
                                        <div id="targetDiv" style="clear:both;"></div>

                                            {{-- <div style="clear:both;"></div> --}}
                                            <div class="toanvancontent" id="toanvancontent">
                                                <div>
                                                    <!-- người ký mới -->
                                                    <style>
                                                        .table_cqbh_cd_nk {margin:20px 0px 50px 0px;}
                                                        .table_cqbh_cd_nk tr {text-align:right;}
                                                        .table_cqbh_cd_nk td {display:block; float:right;text-align:center;padding:2px 0px; max-width:385px;}
                                                        .table_cqbh_cd_nk td p {text-align:center !important; font-weight:bold; padding:0px; font:bold 12px Arial,Helvetica,sans-serif !important;}
                                                        .table_cqbh_cd_nk .upper {text-transform:uppercase;}
                                                    </style>
                                                     {{-- <table style="width:100%;" cellpadding="0px" cellspacing="0px" class="table_cqbh_cd_nk"><tbody><tr><td class="upper" style="width:775px"><p></p></td></tr><tr><td class="upper" style="width:775px"><p>Phó Thủ tướng </p></td></tr><tr><td style="width:775px"><p><i>(Đã ký)</i></p></td></tr><tr><td colspan="4">&nbsp;</td></tr><tr><td style="width:775px"><p>Trịnh Đình Dũng</p></td></tr></tbody></table> --}}
                                                </div>
                                                <!-- file toàn văn -->
                                                <div class="vbFile">
                                                    <div class="header">
                                                        <div>
                                                            Tải file đính kèm</div>
                                                    </div>
                                                    <div class="content">
                                                        <ul>
                                                            <li>
                                                                <span>Bản PDF:</span>
                                                          {{--       <a href="#" download="{{$document->fileStore->link}}">
                                                                    {{ basename($document->fileStore->link) }}
                                                                </a> --}}
                                                            </li>
                                                        <li><span>File đính kèm:</span>
                                                            <ul>
                                                                <li>
                                                                    <a href="#">
                                                                        07-2017-QD-TTg.doc
                                                                    </a>
                                                                    <br>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- file toàn văn -->
                                                <!-- văn bản liên quan -->
                                                <div class="vbLienQuan">
                                                    <div class="content">
                                                        <div id="ctvbthaythe"></div>
                                                        <div id="ctvbdinhchi"></div>
                                                        <div id="ctvbthaythe1phan"></div>
                                                        <div id="ctvbdinhchi1phan"></div>
                                                        <div id="ctvbsuadoi"></div>
                                                        <div id="ctvbhuongdan"></div>
                                                    </div>
                                                </div>
                                                <!-- văn bản liên quan -->
                                                <!-- Thông tin bình luận độc giả -->
                                                <div class="vbLienQuan" style="border: 1px solid #dddddd;">
                                                    <div class="header">
                                                        <div style="float: right;">
                                                            <img src="images/email.gif"><span> <a href="javascript:void(0);" onclick="javascript:execute('form-comment');">Gửi phản hồi </a></span>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="cssComment">
                                                            <div id="form-comment">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Hết thông tin bình luần độc giả-->
                                            </div>
                                        </div>
                                    <div class="bottom">
                                        <div>&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div id="itemthuoctinh" class="content tab-pane fade in {{ (isset($tab) && $tab == 'itemthuoctinh') ? 'active' : ''}}">
                                <div class="fulltext">
                                    <div class="vbInfo">
                                        <ul>
                                            <li class="red">{{ $document->effective ? $document->effective : 'Đang cập nhật' }}</li>
                                            <li class="green">
                                                <span>Ngày có hiệu lực: </span>
                                                {{ $document->start_date }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="vbProperties table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" class="title">
                                                        {{ $document->short_description }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Số ký hiệu</td>
                                                    <td>{{ $document->notation }}</td>
                                                    <td>Ngày ban hành</td>
                                                    <td>{{ $document->publish_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Loại văn bản</td>
                                                    <td>{{ $document->docType->name }}</td>
                                                    <td>Ngày có hiệu lực</td>
                                                    <td>{{ $document->start_date }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Lĩnh vực</td>
                                                    <td>{{ $document->fields }}</td>
                                                </tr>
                                                <tr>
                                                    <?php $signers = $document->signers; $numSign = $document->signers()->count(); ?>
                                                    <td rowspan="{{ $numSign }}">Cơ quan ban hành/ Chức danh / Người ký</td>
                                                        @foreach($signers as $signer)
                                                            <td>{{ $signer->organization->name }}</td>
                                                            <td>{{ $signer->jobTitle }}</td>
                                                            <td>{{ $signer->name }}</td>
                                                        @endforeach
                                                </tr>
                                                <tr>
                                                    <td>Phạm vi</td>
                                                    <td>{{ $document->limit }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="itemvblienquan" class="content tab-pane fade in {{ (isset($tab) && $tab == 'itemvblienquan') ? 'active' : ''}}">
                                <div class="fulltext">
                                    <div class="vbInfo">
                                        <ul>
                                            <li class="red">{{ $document->effective ? $document->effective : 'Đang cập nhật' }}</li>
                                            <li class="green">
                                                <span>Ngày có hiệu lực: </span>
                                                {{ $document->start_date }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="vbLienquan">
                                        <div class="content">
                                            <table cellspacing="5px" border="none">
                                                <tbody>
                                                    <tr>
                                                        <td class="label">Văn bản căn cứ</td>
                                                        <td>
                                                            <ul class="listVB">
                                                                @foreach($document->baseDocument as $baseDoc)
                                                                    <li>
                                                                        <div class="item">
                                                                            <p class="title">
                                                                                <a href="{{ route('vanban.show', $baseDoc->id) }}">{!! $baseDoc->docType->name . " " . $baseDoc->notation . ": " .  $baseDoc->description !!}</a>
                                                                            </p>
                                                                            <ul class="info">
                                                                                <li>
                                                                                    <span>Ngày ban hành</span>
                                                                                    {{ $baseDoc->publish_date }}
                                                                                </li>
                                                                                <li>
                                                                                    <span>Ngày có hiệu lực</span>
                                                                                    {{ $baseDoc->start_date }}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="label">Văn bản được hướng dẫn</td>
                                                        <td>
                                                            <ul class="listVB">
                                                                @forelse($document->guideDocument as $guideDoc)
                                                                    <li>
                                                                        <div class="item">
                                                                            <p class="title">
                                                                                <a href="{{ route('vanban.show', $guideDoc->id) }}">{{ $guideDoc->docType->name . " " . $guideDoc->notation . ": " .$guideDoc->description }}</a>
                                                                            </p>
                                                                            <ul class="info">
                                                                                <li>
                                                                                    <span>Ngày ban hành</span>
                                                                                    {{ $guideDoc->publish_date }}
                                                                                </li>
                                                                                <li>
                                                                                    <span>Ngày có hiệu lực</span>
                                                                                    {{ $guideDoc->start_date }}
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </li>
                                                                @empty
                                                                @endforelse
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- cột phải 790 zone1-->
        </div>
        <!-- content -->
    </div>
</div>

<!-- footer -->
<div id="footer">
    <div>
        <div class="content">
            <div class="ExternalClass68A465453F634381A8A452B550A925CB">
                <p>
                    <strong>CƠ SỞ DỮ LIỆU VĂN BẢN PHÁP LUẬT TRUNG ƯƠNG</strong>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
{{-- <script>
    $(document).ready(function () {

        setTimeout(function () {
            if ($('#toanvancontent').find('table').length) {
                var contentwidth = $('#toanvancontent').width();
                $('#toanvancontent').find('table').each(function (i) {
                    var objtable = contentwidth - $(this).width();
                    if (objtable > 0) {
                        $(this).css("margin-left", objtable/2+"px");
                    }
                    if ($(this).attr('border') == 1) {
                        $(this).find('td').each(function (k) {
                            $(this).css("border", "1px solid");
                        });
                        $(this).find('th').each(function (k) {
                            $(this).css("border", "1px solid");
                        });
                    }


                });
            }
        }, 100);
    });

</script> --}}
@push('scripts')
    {{ Html::script('js/showdown.min.js') }}
    <script type="text/javascript">
            function run() {
                var text = document.getElementById('sourceTA').value,
                    target = document.getElementById('targetDiv'),
                    converter = new showdown.Converter(),
                html = converter.makeHtml(text);

                targetDiv.innerHTML = html;
            }
        $(function() {
            var x = new run();
        })
    </script>
@endpush
