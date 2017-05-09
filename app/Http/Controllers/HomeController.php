<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{DocType, Organization, Document, Field, Post};
use App\Http\Controllers\DocumentController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;
use App\Traits\Common;
use DB;

class HomeController extends Controller
{
    use DocumentMethod;
    use Common;

    public function home(Request $request)
    {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        $perPage = 10;
        $rangeDay = 60;
        $lawStartInMonths = $this->getLawStartInMonth(Carbon::now()->month, 2016, $perPage);
        $newLaws = $this->getNewLawByPublish( Carbon::createFromFormat('Y-m-d', '2016-12-10')->subDays($rangeDay), $perPage );
        $topDocuments = Document::orderBy('view_count', 'desc')->take(10)->with('docType')->get();
        return view('user.index')->with([
            'doctypes' => $doctypes,
            'lawStartInMonths' => $lawStartInMonths->appends(Input::except('page')),
            'newLaws' => $newLaws->appends(Input::except('page')),
            'tab' => $request->tab,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces,
            'topDocuments' => $topDocuments
        ]);
    }

    public function advisory()
    {
        $data = $this->getDataMenu();
        $fields = Field::pluck('name', 'id');
        $posts = Post::with('field')->withCount('comments')->paginate(10);
        return view('user.advisory')->with([
            'doctypes' => $data['doctypes'],
            'governments' => $data['governments'],
            'ministries' => $data['ministries'],
            'provinces' => $data['provinces'],
            'posts' => $posts,
            'fields' => $fields
        ]);
    }

    public function getPostByUser($name, $id)
    {
        $Post = new Post();
        $posts = $Post->getByUser($id);
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        if ($posts) {
            return view('user.post')->with([
                'doctypes' => $doctypes,
                'governments' => $governments,
                'ministries' => $ministries,
                'provinces' => $provinces,
                'posts' => $posts
            ]);
        } else {
            return redirect()->back()->with([
                config('common.flash_message') => 'Đã có lỗi xảy ra',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }

    public function getPostByField($name, Request $request)
    {
        try {
            $field = Field::where('name', $name)->first();
            if ($field)
            {
                $posts = $field->posts()->with('field')->withCount('comments')->get();
            }
            $doctypes = DocType::all();
            $governments = Organization::where('type', config('common.type.trunguong'))->get();
            $ministries = Organization::where('type', config('common.type.bonganh'))->get();
            $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
            $fields = Field::pluck('name', 'id');

            return view('user.advisory')->with([
                'doctypes' => $doctypes,
                'governments' => $governments,
                'ministries' => $ministries,
                'provinces' => $provinces,
                'fields' => $fields,
                'posts' => $posts,
                'linhvuc' => $name
            ]);
        } catch(Exception $e) {
            return redirect()->back()->with([
                config('common.flash_message') => 'Đã có lỗi xảy ra',
                config('common.flash_level_key') => config('common.flash_level.error')
            ]);
        }
    }
}
