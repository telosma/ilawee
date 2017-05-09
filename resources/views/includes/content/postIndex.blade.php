<div class="box-news">
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
                        <a href="{{ route('post.show', $post->id) }}">
                            {{ $post->title }}
                            <span class="badge" style="background-color:rgb(0, 150, 240);">{{ Lang::choice('post.num_comment', $post->comments_count, ['num' => $post->comments_count]) }}</span></a>
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
</div>
