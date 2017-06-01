@extends('layouts.managerMaster')
@section('content-header', 'Cộng tác viên - Quản lý người ký')
@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Tên</th>
            <th>Chức vụ</th>
            <th>Cơ quan/Tổ chức</th>
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
                {!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'id' => 'form_modal']) !!}
                    {!! Form::hidden('id', null) !!}
                    <div class="form-group">
                        {!! Form::label('organization_id', 'Cơ quan/Tổ chức', [
                            'class' => 'col-md-3 control-label'
                        ]) !!}
                        <div class="col-md-8">
                            {!! Form::select('organization_id', [], null, [
                                'class' => 'form-control',
                                'placeholder' => 'Chọn cơ quan công tác'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'name',
                            'Họ tên người ký',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Họ tên'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'jobTitle',
                            'Chức vụ',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('jobTitle', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Tên chức vụ'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-9">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary btn_save']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
    </div>
</div>
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('scripts')
{!! Html::script('js/adminSigner.js') !!}
<script type="text/javascript">
    $(document).ready(function () {

        var signer = new Signer({
            url: {
                'ajaxList': '{!! route('manager.signer.ajax.list') !!}',
                'ajaxCreate': '{!! route('manager.signer.ajax.create') !!}',
                'ajaxUpdate': '{!! route('manager.signer.ajax.update') !!}',
                'ajaxDelete': '{!! route('manager.signer.ajax.delete') !!}',
                'ajaxOrganizationListOnly': '{!! route('manager.organization.ajax.listOnly') !!}',
            },
            lang: {
                'trans': {
                    'title_create': 'Tạo mới',
                    'title_update': 'Cập nhật',
                },
            }
        });
    });
</script>
@endpush
