<ul class="listLaw">
@forelse ($documents as $document)
    @include('includes.elasticListLaw')
@empty

@endforelse
</ul>
<div>
    {{ $links }}
</div>
