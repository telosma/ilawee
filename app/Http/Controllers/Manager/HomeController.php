<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, DocType, Upload};
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager');
    }

    public function index()
    {
        return view('manager.index');
    }

    public function ajaxListDoc()
    {
        $doc_ids = Upload::where('user_id', Auth::user()->id)->pluck('document_id');
        if (count($doc_ids)) {
            return [ 'data' => Document::whereIn('id', $doc_ids)->get(['id', 'notation', 'description', 'confirmed']) ];
        } else {
            return [ 'data' => []];
        }

    }

    public function ajaxListType()
    {
        return [ 'data' => DocType::all() ];
    }
}
