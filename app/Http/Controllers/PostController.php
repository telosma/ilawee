<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\{Post, User};
use Exception;
use Auth;

class PostController extends Controller
{
    protected $userId;
    public function _construct()
    {
        if (Auth::check()) {
            $this->userId = Auth::user()->id;
        }
    }
    public function create(CreatePostRequest $request)
    {
        // dd($request);
        try {
            $post = Post::create([
                'user_id' => Auth::user()->id,
                'field_id' => $request->input('field'),
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            if ($post) {
                return redirect()->back()->with([
                    config('common.flash_message') => 'Gửi câu hỏi thành công',
                    config('common.flash_level_key') => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    config('common.flash_message') => 'Đã có lỗi xảy ra',
                    config('common.flash_level_key') => 'danger'
                ]);
            }
        } catch(Exception $e)
        {
            return redirect()->back()->with([
                config('common.flash_message') => 'Hệ thống đang xảy ra lỗi xin vui lòng thử lại sau',
                config('common.flash_level_key') => 'danger'
            ]);
        }
    }
}
