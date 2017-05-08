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
