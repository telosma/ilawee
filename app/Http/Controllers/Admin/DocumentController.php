<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, DocType, Organization, FileStore};
use Carbon\Carbon;

class DocumentController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.document.index')->with(['numDoc' => $numDoc]);
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
        ]);
    }
}
