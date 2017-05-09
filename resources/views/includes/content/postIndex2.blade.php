{{-- <div class="box-news">
    <div class="row news-header">
        <div class="col-sm-10">
            <h4>Tình huống</h4>
        </div>
    </div>
    <div class="content-news">
        @forelse ($posts as $post)
            <div class="row news-item">
                <div class="col-sm-11 left">
                    <p class="title">
                        <a href="{{ route('post.show', $post->id) }}">{{ $post->title }} <span class="badge" style="background-color:rgb(0, 150, 240);">{{ Lang::choice('post.num_comment', $post->comments_count, ['num' => $post->comments_count]) }}</span></a>
                    </p>
                    <div class="description">
                        {!! $post->short_desc !!}
                    </div>
                    <div class="row">
                        <div class="col-sm-11 left">
                            <p class="field">
                                <a href=""><span class="badge">{{ $post->field->name }}</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert-no-posts">
                <p class="alert alert-info">Chưa có câu hỏi nào</p>
            </div>
        @endforelse
        <div class="row">
            <div class="col-sm-11">
            @if(count($posts))
                {{ $posts->links() }}
            @endif
            </div>
        </div>
    </div>
</div> --}}

<div class="box-container">
    <div class="box-news">
    @forelse($posts as $post)
        <div class="row" style="  margin: 0 0 20px 0;  border-bottom: 1px solid #e2e2e2; background-color: #fff;
    border-top: 1px solid #e2e2e2;">
            <div class="event-header" style="color: #999; font-size: 13px; margin-bottom: 4px; margin-top: 5px;">
                <span>Lĩnh vực: {{ $post->field->name }}</span>
                <span class="topic" style="color: #999; font-size: 13px;">
                    <span class="bullet">.</span>
                </span>
                <span class="badge" style="background-color:rgb(0, 150, 240);">{{ Lang::choice('post.num_comment', $post->comments_count, ['num' => $post->comments_count]) }}</span></a>
            </div>
            <div class="item-post-header" style="font-family: Georgia,Times,Times New Roman,serif;">
                <a href="" style="font-family: Georgia,Times,Times New Roman,serif; font-size: 17px; line-height: 1.4; color: #333; word-wrap: break-word; tab-size: 2em; font-weight: bold;">
                    <span hover="text-decoration: underline">
                        {{ $post->title }}
                    </span>
                </a>
            </div>
            <div class="anser">
                <div class="anwser-user anwser-user-inline">
                    <div class="anwser-header" style="margin-top: 10px; position: relative;margin-bottom: 5px;font-size: 16px; line-height: 1.4;font-family: Helvetica,Arial,sans-serif;">
                        <div class="photo-text-layout sm-ava">
                            <!-- -->
                            <div class="row">
                                {{-- <div class="col-md-3 col-sm-3"> --}}
                                    <div class="layout-photo-wrapper" style="position: absolute; top: 0; left:0;">
                                        <div class="layout-photo" style="position: relative; width: 40px; height: 40px;">
                                            <a href="">
                                                <img style="width: 40px; height:40px; border-radius: 50%;" class="profile_photo_img" src="{{ $post->user->avatar_link }}" height="50" alt="Peter Szinek" width="50">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="layout-text-wrapper" style="padding-left: 63px;">
                                        <div class="layout-text" style="display: table-cell; vertical-align: middle; height: 40px; font-family: 'q_serif',Georgia,Times,"Times New Roman",serif;">
                                            <a href="" class="user" style="color: #333; text-decoration: none;">{{ $post->user->name }}</a>
                                        </div>
                                    </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <div class="anser-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div>
                                    <span style="tab-size: 2em; font-family: Georgia,Times, sans-serif;">
                                        <article style="display: inline; margin: 0; padding: 0; font-size: 15px; line-height: 1.4;">
                                            {!! $post->content !!}
                                        </article>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert-no-posts">
            <p class="alert alert-info">Chưa có câu hỏi nào</p>
        </div>
    @endforelse
        <div class="row">
            <div class="col-sm-11">
            @if(count($posts))
                {{ $posts->links() }}
            @endif
            </div>
        </div>
    </div>
</div>
