{{-- <ul class="listLaw">
    @forelse($lawStartInMonths as $document) --}}
    <li>
        <div class="item">
            <p class="title">
                <a href="{!! route('document.show', $document->id) !!}">
                    {{ $document->docType->name . " " . $document->notation}}
                </a>
            </p>
            <div class="left">
                <div class="des">
                        {{-- {!! $document['highlight']['description'][0] !!} --}}
                        {{ $document->short_description }}
                </div>
                <div class="link">
                    <ul>
                        <li class="ref"><a href="#">
                            VB liên quan</a></li>
                        <li class="thuoctinh"><a href="#">
                            Thuộc tính</a></li>
                        <li class="map"><a href="#">
                            Lược đồ</a></li>

                        <li class="download"><a href="javascript:downloadfile('07-2017-QD-TTg.doc','/TW/Lists/vbpq/Attachments/120226/07-2017-QD-TTg.doc');">Tải về</a></li>


                        <div id="divShowDialogDownload_120226" title="Danh sách văn bản tải về"
                            style="display: none">
                            <ul class="fileAttack">

                            </ul>
                        </div>
                        <script type="text/javascript">
                            function ShowDialogDownload(id) {
                                $('#divShowDialogDownload_' + id + '').dialog();
                            }
                        </script>
                    </ul>
                </div>
            </div>
            <div class="right">
                <p class="green">
                    <label>Ban hành:</label>
                    {{ $document->publish_date }}
                </p>
                <p class="green">
                    <label>Hiệu lực:</label>
                    {{ $document->start_date }}
                </p>

                <p class="red">
                    {{-- <label>Trạng thái:</label> --}}
                    {{ $document->effective }}
                </p>
            </div>
        </div>
    </li>
{{--     @empty
    @endforelse
</ul>
<div>
    {{ $lawStartInMonths->links() }}
</div>
 --}}
