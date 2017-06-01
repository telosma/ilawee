@extends('layouts.adminMaster')

@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Tên role</th>
            <th>Tên hiển thị</th>
            <th>Mô tả</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>
<!-- Modal edit/Create-->
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
                <form method="POST" id="form_modal">
                    {{ csrf_field() }}

                    {!! Form::hidden('id', null) !!}

                    <div class="form-group">
                        <label for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Tên...">
                    </div>
                    <div class="form-group">
                        <label for="display_name">Tên hiển thị</label>
                        <input type="text" name="display_name" id="display_name" class="form-control" placeholder="Tên hiển thị...">
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <input type="text" name="description" id="description" class="form-control" placeholder="Mô tả...">
                    </div>
                    <div class="form-group" id="list-permission">
                    </div>
                    <button class="btn btn-primary btn_save" type="submit">Lưu</button>
                </form>
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
{!! Html::script('js/adminRole.js') !!}
<script type="text/javascript">
    $(document).ready(function () {

        var Role = new role({
            url: {
                'ajaxList': '{!! route('admin.role.ajax.list') !!}',
                'ajaxCreate': '{!! route('admin.role.ajax.create') !!}',
                'ajaxUpdate': '{!! route('admin.role.ajax.update') !!}',
                'ajaxDelete': '{!! route('admin.role.ajax.delete') !!}',
                'ajaxListPermisstion': '{!! route('admin.permisstion.ajax.list') !!}',
                'ajaxGetPermissionBaseRole': '{!! route('admin.role.ajax.permisstion.list') !!}'
            },
            lang: {
                'trans': {
                    'title_create': 'Tạo mới Role',
                    'title_update': 'Cập nhật Role',
                },
            }
        });
    });
</script>
@endpush
