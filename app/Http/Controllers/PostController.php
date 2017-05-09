<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\{DocType, Organization, Document, Field, Post};
use Exception;
use Auth;
use App\Traits\Common;

class PostController extends Controller
{
    use Common;

    protected $userId;
    public function __construct()
    {
        if (Auth::check()) {
            $this->userId = Auth::user()->id;
        }
    }
    public function create(CreatePostRequest $request)
    {
        try {
            $post = Post::create([
                'user_id' => Auth::user()->id,
                'field_id' => $request->input('field'),
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);

            if ($post) {
                // Post::with('field')->find($post->id)->addToIndex();
                return redirect()->back()->with([
                    config('common.flash_message') => 'Gửi câu hỏi thành công',
                    config('common.flash_level_key') => 'success'
                ]);
            } else {
                return redirect()->back()->with([
                    config('common.flash_message') => 'Đã có lỗi xảy ra',
                    config('common.flash_level_key') => 'error'
                ]);
            }
        } catch(Exception $e)
        {
            return redirect()->back()->with([
                config('common.flash_message') => 'Hệ thống đang xảy ra lỗi xin vui lòng thử lại sau',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }

    public function show($id)
    {
        try {
            $data = $this->getDataMenu();
            $fields = Field::pluck('name', 'id');
            $post = Post::with(['comments' => function ($query) {
                return $query->with('user');
            }, 'user'])->find($id);
            if ($post) {
                return view('post.show')->with([
                    'doctypes' => $data['doctypes'],
                    'governments' => $data['governments'],
                    'ministries' => $data['ministries'],
                    'provinces' => $data['provinces'],
                    'post' => $post,
                    'fields' => $fields
                ]);
            } else {
                return redirect()->back()->with([
                    config('common.flash_message') => 'Không tìm thấy câu hỏi',
                    config('common.flash_level_key') => 'error',
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                config('common.flash_message') => 'Hệ thống đang xảy ra lỗi xin vui lòng thử lại sau',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }

    public function search(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $query = $request->input('query');
        $posts = Post::with('field')->withCount('comments')->where('content', 'LIKE', "%{$query}%")->paginate(2);

        if ($posts) {
            $fields = Field::pluck('name', 'id');

                if ($request->ajax()) {
                    return [
                        'postIndexRender' => view('includes.content.postIndex')->with([
                            'posts' => $posts->appends($request->input())
                        ])->render(),
                        'query' => $query,
                        'page' => $page
                    ];
                } else {
                    $data = $this->getDataMenu();
                    $fields = Field::pluck('name', 'id');

                    return view('user.advisory')->with([
                        'doctypes' => $data['doctypes'],
                        'governments' => $data['governments'],
                        'ministries' => $data['ministries'],
                        'provinces' => $data['provinces'],
                        'posts' => $posts->appends($request->input()),
                        'fields' => $fields
                    ]);
                }
        }
    }
}
