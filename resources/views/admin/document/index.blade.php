@extends('layouts.adminMaster')

@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Ký hiệu</th>
            <th>Trích dẫn</th>
{{--             <th>document count</th>
            <th>type</th> --}}
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>
<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title"></h4>
                <!--end modal-header-->
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#toanvan">Toàn văn</a></li>
                    <li><a href="#thuoctinh">Thuộc tính</a></li>
                    <li><a href="#coquan">Cơ quan ban hành</a></li>
                    <li><a href="#banpdf"></a></li>
                </ul>
                <div class="tab-content">
                    <div id="toanvan" class="content tab-pane fade in active"></div>
                    <div id="thuoctinh"></div>
                    <div id="coquan"></div>
                    <div id="banpdf"></div>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>
</div>
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('scripts')
{!! Html::script('js/adminDocument.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
<script type="text/javascript">
    $(document).ready(function () {

        var Doc = new doc({
            url: {
                'ajaxList': '{!! route('admin.document.ajax.list') !!}',
                'ajaxCreate': '',
                'ajaxUpdate': '',
                'ajaxDelete': '',
                'ajaxListOnly': '{!! route('admin.document.ajax.show') !!}'
            },
            lang: {
                'trans': {
                    'title_create': 'Tạo mới',
                    'title_update': 'Xem/Sửa',
                },
            }
        });
    });
</script>
@endpush
