@extends('layouts.adminMaster')

@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>name</th>
            <th>document count</th>
            <th>type</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
</table>
<!-- Modal edit-->
{{-- <div class="modal fade" id="myModal" role="dialog">
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
                        {!! Form::label('parent_id', 'Trực thuộc', [
                            'class' => 'col-md-3 control-label'
                        ]) !!}
                        <div class="col-md-8">
                            {!! Form::select('parent_id', [], null, [
                                'class' => 'form-control',
                                'placeholder' => 'Chọn cơ quan trực thuộc'
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'name',
                            'Tên cơ quan ban hành',
                            ['class' => 'col-md-3 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Điền tên cơ quan'
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
</div> --}}
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('scripts')
{!! Html::script('js/adminOrganization.js') !!}
<script type="text/javascript">
    $(document).ready(function () {

        var Organization = new organization({
            url: {
                'ajaxList': '{!! route('admin.role.ajax.list') !!}',
                'ajaxCreate': '',
                'ajaxUpdate': '',
                'ajaxDelete': '',
                'ajaxListOnly': '',
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
