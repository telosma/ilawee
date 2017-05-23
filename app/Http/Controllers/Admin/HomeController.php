<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;

class HomeController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.home')->with(['numDoc' => $numDoc]);
    }
}
