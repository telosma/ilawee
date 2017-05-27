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
                                        <h4><strong>{{ $post->title }}</strong></h4>
                                    </div>
                                    <div class="post-content">
                                        {!! $post->content !!}
                                    </div>
                                    <div class="detail-post-info">
                                        <span class="send-date">Gửi bởi</span> {{ $post->user->name }}
                                        <span class="send-date"> {{ $post->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div id="comments" class="post-section">
                                    <h3 class="post-section-title"><strong>Trả lời</strong></h3>
                                    @permission('comment-create')
                                    <div class="comments-form">
                                        <div class="tab-content">
                                            <form id="comments-form" action="{{ route('comment.create') }}" method="post">
                                                <div class="write">
                                                    <div class="comment-area flexbox flex-items-center">
                                                        <div class="avatar is-sm-avatar">
                                                            <img src="{{ Auth::user()->avatar_link }}" alt="{{ Auth::user()->name }}" style="width: 100%; height:100%; ">
                                                        </div>
                                                        <textarea rows="2" name="content" placeholder="Viết bình luận..." class="comment-input" style="overflow: hidden; word-wrap: break-word;"></textarea>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="userId" value="{{ $post->user->id }}">
                                                        <input type="hidden" name="postId" value="{{ $post->id }}">
                                                    </div>
                                                </div>
                                                <div class="comment-actions">
                                                    <button type="button" class="btn btn-sm btn-default" id="btn-cancel-comment">Hủy</button>
                                                    <button type="submit" class="btn btn-sm btn-primary">Trả lời</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    @endpermission
                                    <div id="comment-111" class="comment-origin" style="padding-left:1.5rem;">
                                        <div class="flex-box">
                                            <div class="full-width">
                                                <div class="comment-meta flexbox flex-items-center">
                                                    <div>
                                                        <a href="" target="_blank" class="avatar is-sm-avatar">
                                                            <img src="https://viblo.asia/images/mm.png" alt="avatar">
                                                        </a>
                                                        <span class="comment-author">
                                                            <a href="https://viblo.asia/u/telosma" target="_blank" class="link no-decoration-link">
                                                                <strong>Duy</strong>
                                                            </a>
                                                        </span>
                                                        <span class="hidden-sm-down">
                                                            <span>@CTV</span>
                                                        </span>
                                                    </div>
                                                    <ul class="ml-1 pl-0 flex-no-shrink">
                                                        <li>Friday 25 November 2016</li>
                                                    </ul>
                                                </div>
                                                <div class="comment-body">
                                                    <div class="is-markdown-content">
                                                        <p>Theo quy định tại Điều 143, Điều 144 Luật đất đai, UBND cấp tỉnh căn cứ vào quy hoạch sử dụng đất, quy hoạch xây dựng đô thị, quy hoạch phát triển nông thôn và quỹ đất của địa phương để quy định hạn mức đất ở giao cho mỗi hộ gia đình, cá nhân, quy định diện tích tối thiểu được tách thửa đối với đất ở.
Điều 29 Nghị định số 43/2014/NĐ-CP ngày 15/5/2014 của Chính phủ quy định chi tiết thi hành một số điều của luật đất đai quy định về việc cấp Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất đối với trường hợp thửa đất có diện tích nhỏ hơn diện tích tối thiểu như sau:
- Thửa đất đang sử dụng được hình thành từ trước ngày văn bản quy định của Ủy ban nhân dân cấp tỉnh về diện tích tối thiểu được tách thửa có hiệu lực thi hành mà diện tích thửa đất nhỏ hơn diện tích tối thiểu theo quy định của Ủy ban nhân dân cấp tỉnh nhưng có đủ điều kiện cấp Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất thì người đang sử dụng đất được cấp Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất.
- Không được công chứng, chứng thực, cấp Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất và không được làm thủ tục thực hiện các quyền của người sử dụng đất đối với trường hợp tự chia tách thửa đất đã đăng ký, đã được cấp Giấy chứng nhận thành hai hoặc nhiều thửa đất mà trong đó có ít nhất một thửa đất có diện tích nhỏ hơn diện tích tối thiểu theo quy định của Ủy ban nhân dân cấp tỉnh.
- Trường hợp người sử dụng đất xin tách thửa đất thành thửa đất có diện tích nhỏ hơn diện tích tối thiểu đồng thời với việc xin được hợp thửa đất đó với thửa đất khác liền kề để tạo thành thửa đất mới có diện tích bằng hoặc lớn hơn diện tích tối thiểu được tách thửa thì được phép tách thửa đồng thời với việc hợp thửa và cấp Giấy chứng nhận quyền sử dụng đất, quyền sở hữu nhà ở và tài sản khác gắn liền với đất cho thửa đất mới.
Vậy, bạn cần tìm hiểu quy định cụ thể tại địa phương của bạn về diện tích tối thiểu được tách thửa để xác định xem thửa đất của gia đình mình có đủ điều kiện tách thửa hay không.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach($post->comments as $comment)
                                        <div id="comment-{{ $comment->id }}" class="comment-origin" data-id="{{ $comment->id }}" style="padding-left:1.5rem;">
                                            <div class="flex-box">
                                                <div class="full-width">
                                                    <div class="comment-meta flexbox flex-items-center">
                                                        <div>
                                                            <a href="" target="_blank" class="avatar is-sm-avatar">
                                                                <img src="{{ $comment->user->avatar_link }}" alt="avatar">
                                                            </a>
                                                            <span class="comment-author">
                                                                <a href="" target="_blank" class="link no-decoration-link">
                                                                    <strong>{{ $comment->user->name }}</strong>
                                                                </a>
                                                            </span>
                                                            <span class="hidden-sm-down">
                                                                <span>@CTV</span>
                                                            </span>
                                                        </div>
                                                        <ul class="ml-1 pl-0 flex-no-shrink">
                                                            <li>{{ $comment->created_at }}</li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-trigger="hover" title="" data-original-title="Edit"><i aria-hidden="true" class="fa fa-pencil"></i></a>
                                                            </li>
                                                            <li>
                                                                <a data-toggle="tooltip" data-trigger="hover" title="" data-original-title="Delete" data-action-delete="{{ route('comment.ajax.delete') }}">
                                                                    <i aria-hidden="true" class="fa fa-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="comment-body">
                                                        <div class="is-markdown-content">
                                                            <p>{!! $comment->content !!}</p>
                                                        </div>
                                                    </div>
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
</div>
@endsection()
@push('scripts')
{!! Html::script('js/autosize.js') !!}
{!! Html::script('js/ajaxComment.js') !!}
<script>
    $(function () {
        $('.comment-input').autosize({append:"\n"});
    });
</script>
@endpush
