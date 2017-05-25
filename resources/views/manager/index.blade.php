@extends('layouts.managerMaster')

@section('content')
{{-- @include('includes.message') --}}
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Ký hiệu</th>
            <th>Trích dẫn</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>
<!-- Modal edit-->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog" style="width: 70%;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title"></h4>
                <!--end modal-header-->
            </div>
            <div class="modal-body">
                {{ Form::open(['route' => 'manager.document.ajax.create', 'method' => 'post', 'id' => 'form_modal_create_doc', 'enctype' => 'multipart/form-data']) }}
                    <div class="form-group">
                        <label for="vb-notation">Ký hiệu (Văn bản số)</label>
                        <input type="text" name="notation" class="form-control" id="vb-notation">
                    </div>
                    <div class="form-group">
                        <label for="vb-type">Loại văn bản</label>
                        {!! Form::select('type', [], null, [
                            'class' => 'form-control',
                            'placeholder' => 'Chọn loại văn bản',
                            'id' => 'vb-type'
                        ]) !!}
                    </div>
                    <div class="form-group">
                        <label for="vb-limit">Giới hạn</label>
                        <input type="text" name="limit" id="vb-limit" class="form-control" placeholder="vd: Hiệu lực toàn quốc,..">
                    </div>
                    <div class="form-group">
                        <label for="vb-field">Lĩnh vực</label>
                        <input type="text" name="field" id="vb-field" class="form-control" placeholder="vd: Hành chính,..">
                    </div>
                    <div class="form-group">
                        <label for="vb-publish-date">Ngày ban hành</label>
                        <input type="text" name="publishDate" id="vb-publish-date" class="form-control" placeholder="YYYY-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="vb-start-date">Ngày có hiệu lực</label>
                        <input type="text" name="startDate" id="vb-start-date" class="form-control" placeholder="YYYY-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="vb-end-date">Ngày hết hiệu lực</label>
                        <input type="text" name="endDate" id="vb-end-date" class="form-control" placeholder="YYYY-mm-dd">
                    </div>
                    <div class="form-group">
                        <label for="vb-effective">Tình trang hiệu lực</label>
                        <select name="effective" id="vb-effective" class="form-control">
                            <option value="">Chọn tình trạng hiệu lực</option>
                            <option value="Còn hiệu lực">Còn hiệu lực</option>
                            <option value="Chưa có hiệu lực">Chưa có hiệu lực</option>
                            <option value="Hết hiệu lực">Hết hiệu lực</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vb-description">Trích dẫn</label>
                        <input type="text" name="description" id="vb-description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vb-source">Nguồn thu thập</label>
                        <input type="text" name="source" id="vb-source" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="vb-signer">Người ký (Theo thứ tự bắt đầu từ trái)</label>
                        <input type="text" name="signer" id="vb-signer" data-role="tagsinput">
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung văn bản</label>
                        {{ Form::textarea('content', old('content'), ['id' => 'vbcontent', 'class' => 'form-control']) }}
                    </div>
                    <script>
                        CKEDITOR.replace('content');
                    </script>
                    <div class="form-group">
                        <label for="vb-file">Bản PDF văn bản</label>
                        {{-- accept="application/pdf" --}}
                        {{ Form::file('docFile', ['id' => 'vb-file', 'class' => 'form-control', 'accept' => 'application/pdf']) }}
                    </div>
                    {{ Form::submit('Thêm văn bản', ['id' => 'btn-vb-submit-form']) }}
                {{ Form::close() }}
                {{-- </form> --}}
            </div>
            <!--end modal-content-->
        </div>
    </div>
</div>
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('header')
    @include('includes.CkeditorScript')
    {{ Html::style('css/bootstrap-datepicker3.min.css') }}
    {{ Html::style('css/bootstrap-tagsinput.css') }}
    {{ Html::style('css/bootstrap-tagsinput-typeahead.css') }}
@endpush

@push('scripts')
{!! Html::script('js/bootstrap.min.js') !!}
{{ Html::script('js/bootstrap-datepicker.min.js') }}
{{ Html::script('js/bootstrap-datepicker.vi.min.js') }}
{{ Html::script('js/typeahead.bundle.min.js') }}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script> --}}
{{ Html::script('js/bootstrap-tagsinput.min.js') }}
{!! Html::script('js/managerDocument.js') !!}

<script type="text/javascript">

    $(document).ready(function () {

        var Doc = new doc({
            url: {
                'ajaxList': '{!! route('manager.document.ajax.list') !!}',
                'ajaxCreate': '{!! route('manager.document.ajax.create') !!}',
                'ajaxUpdate': '',
                'ajaxListSigner': '',
                'ajaxListDocType': '{!! route('manager.docType.ajax.list') !!}'
            },
            lang: {
                'trans': {
                    'title_create': 'Tạo mới',
                    'title_update': 'Xem/Sửa',
                },
            }
        });
    $('.dt-buttons').on('click', '#btn-vb-open-form',function() {
        $('#form_modal_create_doc')[0].reset();
        $('.form-group').removeClass('has-error');
        $('#myModal').modal("show");
        SendRequest.send('{!! route('manager.docType.ajax.list') !!}', null, 'get', function (response) {
            if (response.status === 200) {
                $('#vb-type').children(':nth-child(n+2)').remove();
                $('#vb-type').append(drawDocTypeList(response.responseJSON.data));
            } else {
                alert('Load dữ liệu lỗi ' + response.status);
            }
        });
        CKEDITOR.instances.vbcontent.setData('{!! old('content') !!}');
    });
        $('#vb-start-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            language: 'vi'
        });
        $('#vb-publish-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            language: 'vi'
        });
        $('#vb-end-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            language: 'vi'
        });


    });
        // Tagsinput
        var signers = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('info'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '{!! route('manager.signer.ajax.listFullInfo') !!}'
            }
        });

        signers.initialize();

        var elt = $('#vb-signer');
        elt.tagsinput({
            itemValue: 'id',
            itemText: 'info',
            typeaheadjs: {
                name: 'signers',
                displayKey: 'info',
                source: signers.ttAdapter()
            }
        });
</script>
@endpush
