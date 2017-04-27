<ul class="listLaw">
@forelse ($documents as $document)
	@include('includes.listLaw')
@empty

@endforelse
</ul>
<div>
	{{ $documents->links() }}
</div>
