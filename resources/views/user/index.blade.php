@extends('layouts.userMaster2')

@section('page_title', 'Cơ sở dữ liệu quốc gia về văn bản pháp luật')

@section('content')
@include('includes.message')
@include('includes.header2')
@include('includes.error')
@include('includes.userContentIndex2')
@endsection()
@push('scripts')
	{{ Html::script('js/ajaxNormalSearch.js') }}
@endpush
