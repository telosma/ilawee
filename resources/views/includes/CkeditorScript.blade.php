@push('header')
{{-- {!! Html::script('library/ckeditor-dev/ckeditor.js') !!} --}}
<script src="{{ asset('library/ckeditor-dev/ckeditor.js') }}" charset="utf-8"></script>
@endpush

@push('scripts')
<script>
	CKEDITOR.config.filebrowserImageUploadUrl = '{!! route('upload.image.CKEditor') . '?_token=' . csrf_token() !!}';
    CKEDITOR.config.customConfig = '{!! asset('js/ckeditor-config.js') !!}';
</script>
@endpush
