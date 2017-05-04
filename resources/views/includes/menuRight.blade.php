<div class="right-200">
    <!-- văn bản được quan tâm -->
    <div class="ms-webpart-zone ms-fullWidth">
        <div width="100%" class="ms-WPBody">
            <div class="box-container">

                <div class="box-content-01">
                    <div class="top">
                        <div>
                            <a href="#">Văn bản được xem nhiều</a></div>
                    </div>
                    <div class="content">
                        <ul class="list">
                            @foreach($topDocuments as $key => $topDoc)
                                <li class={{ $key % 2 == 0 ? "odd" : '' }}>
                                    <a href="{{ route('vanban.show', $topDoc->id) }}">{{ $topDoc->docType->name . " " . $topDoc->notation }}</a>
                                </li>
                            @endforeach
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
