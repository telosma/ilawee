
@extends('layouts.adminMaster')

@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Tên</th>
            <th>Email</th>
            <th>Quyền</th>
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
                        {!! Form::label(
                            'name',
                            'Họ tên',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, [
                                'class' => 'form-control'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'email',
                            'Địa chỉ email',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('email', null, [
                                'class' => 'form-control'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'password',
                            'Mật khẩu',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::password('password', null, [
                                'class' => 'form-control',
                                'id' => 'password'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'password_confirmation',
                            'Xác nhận mật khẩu',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::password('password_confirmation', null, [
                                'class' => 'form-control',
                                'id' => 'password_confirmation'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9"  id="list-role">
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
{!! Html::script('js/adminUser.js') !!}
<script type="text/javascript">
    $(document).ready(function () {

        var user = new Account({
            url: {
                'ajaxList': '{!! route('admin.account.ajax.list') !!}',
                'ajaxCreate': '{!! route('admin.account.ajax.create') !!}',
                'ajaxUpdate': '',
                'ajaxDelete': '{!! route('admin.account.ajax.delete') !!}',
                'ajaxListRole': '{!! route('admin.role.ajax.listOnly') !!}'
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
