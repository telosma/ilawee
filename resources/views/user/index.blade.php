@extends('layouts.userMaster2')

@section('page_title', 'Index')

@section('content')
@include('includes.header2')
@include('includes.userContentIndex2')
@endsection()

@push('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endpush()
