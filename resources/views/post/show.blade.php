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
                                @foreach($fields as $key => $field)
                                    <li><span><a href="{{ route('field.post.list', $field) }}">{{ $field }} </a></span></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bottom">
                            <div>&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-780">
                <div class="left-650">
                    <div class="box-container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="post-content-wrapper">
                                    <div class="post-title">
                                        <h4><strong>Điều kiện tách thửa</strong></h4>
                                    </div>
                                    <div class="post-content">
                                        <p>Hai anh em chúng hiện đang cùng sử dụng chung thửa. Chúng tôi có nhu cầu tách thửa. Diện tích mảnh đất là 7x30m. Vậy có đủ điều kiện tách thửa không?</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div id="comments" class="post-section">
                                    <h3 class="post-section-title"><strong>Trả lời</strong></h3>
                                    <div id="comments-form">
                                        <div class="tab-content">
                                            <form>
                                                <div class="write">
                                                    <div class="comment-area flexbox flex-items-center">
                                                        <div class="avatar is-sm-avatar">
                                                            <img src="https://viblo.asia/uploads/avatar/2fa8889d-d001-47be-a46f-a10979023109.jpg" alt="Le Xuan Duy" style="width: 100%; height:100%; ">
                                                        </div>
                                                        <textarea rows="2" name="comment_contents" placeholder="Viết bình luận..." class="comment-input" style="overflow: hidden; word-wrap: break-word;"></textarea>
                                                    </div>
                                                </div>
                                                <div class="comment-actions">
                                                    <button type="button" class="btn btn-sm btn-default">Hủy</button>
                                                    <button type="submit" class="btn btn-sm btn-primary">Trả lời</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
{!! Html::script('js/autosize.js') !!}
<script>
    $(function () {
        $('.comment-input').autosize({append:"\n"});
    });
</script>
@endpush
