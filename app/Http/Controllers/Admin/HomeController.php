<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Http\Requests\Admin\LoginRequest;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')->except('getLogin', 'postLogin');
    }

    public function index()
    {
        $numDoc = Document::count();

        return view('admin.home')->with(['numDoc' => $numDoc]);
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->back()->with([
                config('common.flash_message') => 'Đăng nhập thất bại',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();

        return redirect()->route('admin.getLogin');
    }
}
