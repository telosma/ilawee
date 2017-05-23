<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, Role};

class RoleController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.role.list')->with(['numDoc' => $numDoc]);
    }

    public function ajaxList()
    {
        return [ 'data' => Role::all() ];
    }
}
