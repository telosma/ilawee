<li>
    <div class="item">
        <p class="title">
            <a href="{!! route('vanban.show', $document['_source']['id']) !!}">
                {{ $document['_source']['doc_type']['name'] . " " . $document['_source']['notation']}}
            </a>
        </p>
        <div class="left">
            <div class="des">
                @if (isset($document['highlight']))
                    {!! $document['highlight']['description'][0] !!}
                @else
                    {!! $document['_source']['description'] !!}
                @endif
            </div>
            <div class="link">
                <ul>
                    <li class="ref"><a href="#">
                        VB liên quan</a></li>
                    <li class="thuoctinh"><a href="#">
                        Thuộc tính</a></li>
                    <li class="map"><a href="#">
                        Lược đồ</a></li>
                </ul>
            </div>
        </div>
        <div class="right">
            <p class="green">
                <label>Ban hành:</label>
                {{ $document['_source']['publish_date'] }}
            </p>
            <p class="green">
                <label>Hiệu lực:</label>
                {{ $document['_source']['start_date'] }}
            </p>

            <p class="red">
                {{-- <label>Trạng thái:</label> --}}
                {{ $document['_source']['effective'] }}
            </p>
        </div>
    </div>
</li>
