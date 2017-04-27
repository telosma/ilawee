@extends('layouts.userMaster2')

@section('page_title', 'Cơ sở dữ liệu quốc gia về văn bản pháp luật')

@section('content')
@include('includes.message')
@include('includes.header2')
@include('includes.error')
<div id="content-layouts-wrapper">
    <div id="content-layouts">
        <!-- content -->
        <div id="content">
            @include('includes.menuLeft')
            <!-- cột phải 790 zone1-->

            <div class="right-790">
                <div class="row">
                    <div  id="myDiagramDiv" style="border: 1px solid black; width: 760px; min-height: 700px; height: auto; background-color: #DAE4E4;">
                        {{-- data-node-data={{ $organizations }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('scripts')
    {{ Html::script('js/go-debug.js') }}
    {{ Html::script('js/tree.js') }}
    {{-- var dataNode = {{ $organizations }}; --}}
{{--     <script>
        var tree = new tree();
        var nodeDataArray = $('#myDiagramDiv').data('nodeData');
        tree.init(nodeDataArray);
    </script> --}}
@endpush
