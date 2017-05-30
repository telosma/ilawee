<div class="panel panel-info">
    <div class="panel-heading" style="background-color: #64B5F6; color: #fff;">
        <h4>Tìm kiếm văn bản</h4>
    </div>
    <div class="panel-body">
        <div class="form form-horizontal">
            {{ Form::open(['route' => 'document.normalSearch', 'method' => 'get', 'class' => 'normal-search', 'id' => 'normal-search-form']) }}
                <div class="row mb-20">
                    <p class="guide-search">Nhập từ khóa tìm kiếm vào cửa sổ tìm kiếm dưới đây</p>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="input-query">
                                {{ Form::text('query', isset($old_query) ? $old_query : old('query'), ['class' => 'form-control']) }}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-info">Tìm kiếm</button>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{ route('document.show.advancedSearch') }}" style="cusor: pointer; color: blue;">Tìm kiếm nâng cao</a>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
