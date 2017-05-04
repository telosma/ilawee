@push('scripts')
{!! Html::script('js/datatableBase.js') !!}
<script>
    console.log('dttt');
    var DatatableBase = new datatableBase({
        lang: {
            'trans': {
                'unknown_error': '{!! trans('dataTable.unknown_error') !!}',
                'confirm_select_all': '{!! trans('dataTable.confirm_select_all') !!}',
                'confirm_delete': '{!! trans('dataTable.confirm_delete') !!}',
            },
            'button_text': {
                'select_page': 'Select',
                'select_all': 'Select all',
                'unselect': 'Un select',
                'delete_select': 'delete select',
                'create': 'create',
            },
            'response': {
                'key_name': 'flash_level_key',
                'message_name': 'flash_message',
            },
        }
    });
</script>
@endpush
