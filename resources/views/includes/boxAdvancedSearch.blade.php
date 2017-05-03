<div class="panel panel-info">
    <div class="panel-heading" style="background-color: #64B5F6; color: #fff;">
        <h4>Tìm kiếm nâng cao</h4>
    </div>
    <div class="panel-body">
        <div class="form form-horizontal">
            {{ Form::open(['route' => 'document.ajax.search', 'method' => 'get', 'class' => 'advanced-search', 'id' => 'advanced-search-form' ]) }}
                <div class="form-group">
                    <div class="col-sm-3">
                        <label for="query" class="control-label">Từ khóa tìm kiếm</label>
                    </div>
                    <div class="col-sm-9">
                        <div class="input-query">
                            {{ Form::text('query', old('query'), ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-4">
                            <label>
                                {{ Form::radio('match', 'match_phrase', true) }}
                                Chính xác cụm từ trên
                            </label>
                    </div>
                    <div class="col-sm-4">
                            <label>
                                {{ Form::radio('match', 'match_and') }}
                                Có tất cả các từ trên
                            </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Tìm trong</label>
                    </div>
                    <div class="col-sm-3">
                        <label>
                        {{ Form::radio('field', 'all', true) }} Tất cả
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label>
                        {{ Form::radio('field', 'description') }} Trích yếu
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <label>
                        {{ Form::radio('field', 'notation') }} Ký hiệu
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Ngày ban hành</label>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group date" dataprovide="datepicker">
                            {{ Form::label('from', 'Từ', ['class' => 'input-group-addon']) }}
                            {{ Form::text('from', old('from'), ['class' => 'form-control']) }}
                         {{--    <div class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group date" dataprovide="datepicker">
                            {{ Form::label('to', 'Tới', ['class' => 'input-group-addon']) }}
                            {{ Form::text('to', old('to'), ['class' => 'form-control']) }}
                       {{--      <div class="input-group-addon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        {{ Form::submit('Tìm kiếm', ['class' => 'btn btn-default']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
