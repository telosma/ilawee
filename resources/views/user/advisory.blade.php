@extends('layouts.userMaster2')

@section('page_title', 'Cơ sở dữ liệu quốc gia về văn bản pháp luật')
@push('header')
    @include('includes.CkeditorScript')
@endpush
@section('content')
@include('includes.message')
@include('includes.header2')
@include('includes.error')
<div id="content-layouts-wrapper">
    <div id="content-layouts">
        <!-- content -->
        <div id="content">
            <div class="left-200">
                <div class="box-container">
                    <div class="box-content-01">
                        <div class="top">
                            <div>
                                <a href="javascript:;">Lĩnh vực tư vấn</a>
                            </div>
                        </div>
                        <div class="content">
                            <ul class="category" id="capCQ">
                                @for($i = 0; $i < 5; $i++)
                                    <li><span><a href="#">Lĩnh vực </a></span></li>
                                @endfor()
                            </ul>
                        </div>
                        <div class="bottom">
                            <div>&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-780">
                <div class="left-580">
                    <div class="box-container">
                        {{-- Box tim kiem --}}
                        <div class="panel panel-info">
                            <div class="panel-heading" style="background-color: #64B5F6; color: #fff;">
                                <h4>Tìm kiếm tình huống</h4>
                                hoặc

                        <button class="btn btn-success">
                            <a href="#form-submit-question" style="color: #fff; font-size: 1.1em; font-weight: 600;">Đặt câu hỏi</a>
                        </button>
                            </div>
                            <div class="panel-body">
                                <div class="form form-horizontal">
                                    {{ Form::open(['url' => '', 'method' => 'get', 'class' => 'normal-search']) }}
                                        <div class="row mb-20">
                                            <p class="guide-search">Nhập từ khóa tìm kiếm vào cửa sổ tìm kiếm dưới đây</p>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="input-query">
                                                        {{ Form::text('query', old('query'), ['class' => 'form-control']) }}
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button class="btn btn-info">Tìm kiếm</button>
                                                </div>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div class="box-news">
                            <div class="row news-header">
                                <div class="col-sm-10">
                                    <h4>Tình huống</h4>
                                </div>
                             {{--    <div class="col-sm-2">
                                    <h4>Lĩnh vực</h4>
                                </div> --}}
                            </div>
                            <div class="content-news">
                                @for ($i=1; $i<6; $i++)
                                    <div class="row news-item">
                                        <div class="col-sm-11 left">
                                            <p class="title">
                                                <a href="">Điều kiện tách thửa <span class="badge" style="background-color:rgb(0, 150, 240);">5 trả lời</span></a>
                                            </p>
                                            <div class="description">
                                                Hai anh em chúng hiện đang cùng sử dụng chung thửa. Chúng tôi có nhu cầu tách thửa. Diện tích mảnh đất là 7x30m. Vậy có đủ điều kiện tách thửa không?
                                            </div>
                                            <div class="row">
                                                <p class="field">
                                                    <a href=""><span class="badge">Sở hữu trí tuệ</span></a>
                                                </p>
                                            </div>
                                        </div>
                                       {{--  <div class="col-sm-3">
                                            <div class="row">
                                                <p class="field">
                                                    <a href="">Sở hữu trí tuệ</a>
                                                </p>
                                            </div>
                                        </div> --}}
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="question-wrapper panel panel-info">
                            <div class="panel-heading"><h4>Hãy đặt câu hỏi về tình huống phap luật bạn đang thắc mắc</h4></div>
                            <div class="panel-body">
                                {{ Form::open(['route' => 'post.create', 'method' => 'POST', 'id' => 'form-submit-question']) }}
                                    <div class="form-group">
                                        {{ Form::label('field', 'Lựa chọn lĩnh vực') }}
                                        {{ Form::select('field', $fields->toArray() + ['null' => 'Chọn lĩnh vực'], 'null', ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('title', 'Tiêu đề (Khoảng 200 ký tự)') }}
                                        {{ Form::text('title', null, ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('content', 'Nội dung câu hỏi') }}
                                        {{ Form::textarea('content', null, ['id' => 'qcontent', 'rows' => '100', 'cols' => '50']) }}
                                    </div>
                                    @if (Auth::check())
                                        {{ Form::submit('Gửi',['class' => 'btn btn-success']) }}
                                    @else
                                        <p class="info">Đăng nhập để gửi câu hỏi</p>
                                    @endif
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
@push('scripts')
<script>
    CKEDITOR.replace('qcontent');
</script>
@endpush
