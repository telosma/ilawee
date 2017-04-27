<div class="box-map">
    @if ($breadcrumbs)
        <ul>
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$breadcrumb->last)
                    <li><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a><span> » </span></li>
                @else
                    <li>
                        <a href="">{{ $breadcrumb->title }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</div>
