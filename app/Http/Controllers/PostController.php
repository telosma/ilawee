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
                Post::with('field')->find($post->id)->addToIndex();
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

    public function show($id)
    {
        try {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
            // $this->getDataMenu();
            $fields = Field::pluck('name', 'id');
            // $post = Post::find($id);
            // if ($post) {
                return view('post.show')->with([
                    'doctypes' => $doctypes,
                    'governments' => $governments,
                    'ministries' => $ministries,
                    'provinces' => $provinces,
                    // 'post' => $post,
                    'fields' => $fields
                ]);
            // }
        } catch (\Exception $e) {
            return redirect()->back()->with([
                config('common.flash_message') => 'Hệ thống đang xảy ra lỗi xin vui lòng thử lại sau',
                config('common.flash_level_key') => 'danger'
            ]);
        }
    }
}
