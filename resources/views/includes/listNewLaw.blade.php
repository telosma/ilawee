<ul class="listLaw">
    @forelse($documents as $document)
    <li>
        <div class="item">
            <p class="title">
                <a href="#">
                    Quyết định 07/2017/QĐ-TTg
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
                    <label>
                        Ban hành:</label>
                    27/03/2017</p>
                <p class="green">
                    <label>
                        Hiệu lực:</label>
                    15/05/2017</p>

                <p class="red">
                    <label>
                        Trạng thái:</label>
                    Chưa có hiệu lực
                </p>
            </div>
        </div>
    </li>
    @empty
    @endforelse
</ul>
