<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, DocType, Organization, FileStore};
use Carbon\Carbon;
use DB;
use Exception;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('getLogin', 'postLogin');
    }

    public function index()
    {
        $numDoc = Document::where('confirmed', 1)->count();
        $numConfirming = Document::where('confirmed', 0)->count();

        return view('admin.document.index')->with(['numDoc' => $numDoc, 'numConfirming' => $numConfirming]);
    }

    public function ajaxList()
    {
        return [ 'data' => Document::get(['id', 'notation', 'description']) ];
    }

    public function ajaxShow(Request $request)
    {
        return [ 'data' => Document::where('notation', $request->notation)->first() ];
    }

    public function preview($id, Request $request)
    {
        $numDoc = Document::count();
        $numConfirming = Document::where('confirmed', 0)->count();
        $document = Document::with([
            'fileStore',
            'docType',
            'guideDocument' => function($query) {
                return $query->with('docType');
            },
            'baseDocument' => function($query) {
                return $query->with('docType');
            }
            ])->findOrFail($id);
        $document = Document::find($id);

        $document['publish_day'] = Carbon::parse($document->publish_date)->day;
        $document['publish_month'] = Carbon::parse($document->publish_date)->month;
        $document['publish_year'] = Carbon::parse($document->publish_date)->year;

        return view('admin.document.preview')->with([
            'document' => $document,
            'tab' => $request->tab,
            'numDoc' => $numDoc,
            'numConfirming' => $numConfirming
        ]);
    }

    public function indexConfirming()
    {
        $numDoc = Document::where('confirmed', 1)->count();
        $numConfirming = Document::where('confirmed', 0)->count();

        return view('admin.document.confirming')->with(['numDoc' => $numDoc, 'numConfirming' => $numConfirming]);
    }

    public function ajaxListConfirming()
    {
        return [ 'data' => Document::where('confirmed', 0)->with('upload')->get(['id', 'notation', 'description']) ];
    }

    public function ajaxApprove(Request $request)
    {
        try {
            DB::beginTransaction();
            // foreach ($request->intput('id') as $item_id) {
                $doc = Document::where('id', $request->id)->update(['confirmed' => 1]);
                if ($doc) {
                    return [
                        config('common.flash_message') => 'Văn bản đã đưọc cập nhật vào hệ thống',
                        config('common.flash_level_key') => 'success'
                    ];
                } else {
                    DB::rollback();
                    return [
                        config('common.flash_message') => 'Văn bản không tồn tại',
                        config('common.flash_level_key') => 'error'
                    ];
                }
            // }
            Document::where('id', $request->input('id'))->get()->addToIndex();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            return [
                config('common.flash_message') => $request->id,
                config('common.flash_level_key') => 'error'
            ];
        }
    }
}
