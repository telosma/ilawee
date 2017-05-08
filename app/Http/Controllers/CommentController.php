<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\CommentDeleteRequest;
use Auth;

class CommentController extends Controller
{
    public function store(CommentCreateRequest $request)
    {
        try {
            $comment = Comment::create([
                'user_id' => $request->input('userId'),
                'post_id' => $request->input('postId'),
                'content' => $request->input('content')
            ]);

            if (!$comment) {
                return [
                    'status' => false,
                    'message' => 'Không gửi được bình luận',
                ];
            }

            $commentWithUser = Comment::with('user')->find($comment->id);
            return [
                'status' => true,
                'commentRender' => view('includes.partial.itemComment')->with([ 'comment' => $commentWithUser ])->render()
            ];
        } catch (Exception $e) {
            return redirect()->back()->with([
                config('common.flash_message') => 'Đã có lỗi xảy ra',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $result = Comment::where('user_id', Auth::user()->id)->find($request->input('commentId'))->delete();
        if ($result) {
            return [
                'status' => true,
            ];
        }

        return ['status' => false];
    }
}
