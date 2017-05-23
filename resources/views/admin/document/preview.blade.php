@extends('layouts.adminMaster')

@section('content')
<ul class="nav nav-tabs">
    <li class="{{ empty($tab) || ($tab == 'itemtoanvan') ? 'active' : ''}}"><a href="#itemtoanvan" data-toggle="tab">Toàn văn</a></li>
    <li class="{{ (isset($tab) && $tab == 'itemthuoctinh') ? 'active' : ''}}"><a href="#itemthuoctinh" data-toggle="tab">Thuộc tính</a></li>
    <li class="{{ (isset($tab) && $tab == 'itemvblienquan') ? 'active' : ''}}""><a href="#itemvblienquan" data-toggle="tab">Văn bản liên quan</a></li>
    <li class="{{ (isset($tab) && $tab == 'itembanpdf') ? 'active' : ''}}""><a href="#itembanpdf" data-toggle="tab">Bản pdf</a></li>
</ul>
<div class="tab-content">
    <div id="itemtoanvan" class="content tab-pane fade in {{ empty($tab) || ($tab == 'itemtoanvan') ? 'active' : ''}}">
        <div class="fulltext">
            <div>
                <div style="display: none;">
                    <textarea id="sourceTA" data-text="{{ $document->content }}">
                    </textarea>
                </div>
                <div id="targetDiv" style="clear:both;"></div>
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
                                        @if ($document->fileStore)
                                        <a href="{{ route('vanban.download', ['key' => $document->fileStore->key, 'id' => $document->fileStore->id]) }}">
                                            {{ basename($document->fileStore->link) }}
                                        </a>
                                        @else
                                        <div class="alert alert-info">
                                            <span>Hiện tại chưa có file đính kèm</span>
                                        </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
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
                    @if ( count($document->guideDocument) || count($document->baseDocument))
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
                                                        <a href="{{ route('admin.document.preview', $baseDoc->id) }}" target="_blank">{!! $baseDoc->docType->name . " " . $baseDoc->notation . ": " .  $baseDoc->description !!}</a>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="itembanpdf" class="content tab-pane fade in {{ (isset($tab) && $tab == 'itembanpdf') ? 'active' : ''}}">
        <div class="fulltext">
            <div class="vbProperties">
                @if ($document->fileStore)
                    <object data="{{ route('vanban.getPdf', ['key' => $document->fileStore->key, 'id' => $document->fileStore->id]) }}" type="application/pdf" height="900" width="760"></object>
                @else
                    <p class="alert alert-info">Bản PDF đang đưọc cập nhật</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('scripts')
    {{ Html::script('js/showdown.min.js') }}
    <script type="text/javascript">
            function run() {
                var text = $('#sourceTA').data('text'),
                    target = document.getElementById('targetDiv'),
                    converter = new showdown.Converter(),
                html = converter.makeHtml(text);

                targetDiv.innerHTML = html;
                var toc = "";
                $('#targetDiv').find('a').each(function() {
                    // console.log($(this).parent().text());
                    toc += "<li class=\"li-toc\"><span><a href=\"#" + $(this).attr('name') + "\">"
                    toc += $(this).parent().text();
                    toc += "</a></span></li>"
                });
                if (toc !== "") { // Van ban co toc
                    $('#menu-toc').prepend(
                        "<div class=\"top\">" +
                            "<div>" +
                                "<a href=\"#\">Mục lục văn bản</a>" +
                            "</div>" +
                        "</div>"
                    );
                    $('#ul-toc').append(toc);
                }
            }
        $(function() {
            var x = new run();
        })
    </script>
@endpush
