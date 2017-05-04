@push('scripts')
{!! Html::script('js/sendRequest.js') !!}
<script>
    var SendRequest = new sendRequest({
        'lang': {
            'unknown_error': 'Error',
            'comfirm_login': 'Bạn phải đăng nhập',
        },
        'url': {
            'login': '',
        }
    });
</script>
@endpush
