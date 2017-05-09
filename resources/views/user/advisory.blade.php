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
                <div width="100%" class="ms-WPBody " allowdelete="false" allowexport="false">
                    <div class="box-container">
                        <div class="box-content-01" style="min-width: 190px;">
                            <div class="top">
                                <div>
                                    <a href="javascript:;">Lĩnh vực tư vấn</a>
                                </div>
                            </div>
                            <div class="content">
                                <ul class="category" id="capCQ">
                                    @foreach($fields as $key => $field)
                                        <li class='{{ (isset($linhvuc) && $linhvuc == $field) ? 'active' : ''}}'>
                                            <span><a href="{{ route('field.post.list', $field) }}">{!! $field !!} </a></span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="bottom">
                                <div>&nbsp;</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-780" style="display: flex;">
                <div class="left-650" style="margin: auto;">
                    <div class="box-container">
                        {{-- Box tim kiem --}}
                        <div class="panel panel-info">
                            <div class="panel-heading" style="background-color: #64B5F6; color: #fff;">
                                <h4>Tìm kiếm tình huống</h4>
                                hoặc
                                <a class="btn btn-success" id="btn-question" href="#form-submit-question" style="color: #fff; font-size: 1.1em; font-weight: 600;">Đặt câu hỏi</a>
                            </div>
                            <div class="panel-body">
                                <div class="form form-horizontal">
                                    {{ Form::open(['route' => 'post.search', 'method' => 'get', 'class' => 'normal-search', 'id' => 'form-posts-search']) }}
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
                        {{-- List cau hoi --}}
                        <div class="box-posts">
                            @include('includes.content.postIndex2')
                        </div>
                        {{-- End list cau hoi --}}
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
                                        {{ Form::label('title', 'Tiêu đề (Tối đa 100 ký tự)') }}
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
{!! Html::script('js/ajaxSearchPost.js') !!}
<script>
    CKEDITOR.replace('qcontent');
    $(document).ready(function() {
        $('#btn-question').on('click', function() {
            $('.question-wrapper').show()
        });
    });
</script>
@endpush
