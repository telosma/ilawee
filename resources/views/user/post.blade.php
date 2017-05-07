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
            <div class="right-780" style="display: flex;">
                <div class="left-580" style="margin: auto;">
                    <div class="box-container">
                        <div class="box-news">
                            <div class="content-news">
                                @foreach ($posts as $post)
                                    <div class="row news-item">
                                        <div class="col-sm-11 left">
                                            <p class="title">
                                                <a href="">{{ $post->title }} <span class="badge" style="background-color:rgb(0, 150, 240);">{{ Lang::choice('post.num_comment', $post->comments_count, ['num' => $post->comments_count]) }}</span></a>
                                            </p>
                                            <div class="description">
                                                {!! $post->short_desc !!}
                                            </div>
                                            <div class="row">
                                                <p class="field">
                                                    <a href=""><span class="badge">{{ $post->field->name }}</span></a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
