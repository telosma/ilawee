<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, DocType};

class HomeController extends Controller
{
    public function index()
    {
        return view('manager.index');
    }

    public function ajaxListDoc()
    {
        return [ 'data' => Document::get(['id', 'notation', 'description']) ];
    }

    public function ajaxListType()
    {
        return [ 'data' => DocType::all() ];
    }
}
