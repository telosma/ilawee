@push('scripts')
    @if ((Session::has(config('common.flash_message'))) && (Session::has(config('common.flash_level_key'))))
        <script>
            message('{!! Session::get(config('common.flash_message')) !!}', '{!! Session::get(config('common.flash_level_key')) !!}', 3000);
        </script>
    @endif
@endpush
