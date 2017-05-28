<div class="alert alert-info">{{ $total ? $total : 0}} kết quả</div>

<ul class="listLaw">
@forelse ($documents as $document)
    @include('includes.elasticListLaw')
@empty
	@push('scripts')
		<script>
			$(function () {
				message('Không tìm thấy văn bản phù hợp', 'warning', 2000);
			});
		</script>
	@endpush
@endforelse
</ul>
<div>
    {{ $links ? $links : ''}}
</div>
