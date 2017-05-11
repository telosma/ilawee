<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.role.list');
    }

    public function ajaxList()
    {
        return [ 'data' => Role::all() ];
    }
}
