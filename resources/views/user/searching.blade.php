@extends('layouts.userMaster2')

@section('page_title', 'Cơ sở dữ liệu quốc gia về văn bản pháp luật')

@section('content')
@include('includes.message')
@include('includes.header2')
@include('includes.error')
@include('includes.content.searching')
@endsection()
@push('header')
    {{ Html::style('css/bootstrap-datepicker3.min.css') }}
@endpush
@push('scripts')
    {{ Html::script('js/bootstrap-datepicker.min.js') }}
    {{ Html::script('js/bootstrap-datepicker.vi.min.js') }}
    {{-- {{ Html::script('js/jquery.validate.min.js') }} --}}
    {{ Html::script('js/additional-methods.min.js') }}
    {{ Html::script('js/ajaxAdvancedSearch.js') }}
    <script>
        $(document).ready(function() {
            $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true,
                language: 'vi'
            });
        });
    </script>
@endpush
