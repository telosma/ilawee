<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('manager.login');
    }

    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only(['email', 'password']))) {
            return redirect()->route('manager.index');
        } else {
            return redirect()->back()->with([
                config('common.flash_message') => 'Đăng nhập thất bại',
                config('common.flash_level_key') => 'error'
            ]);
        }
    }
}
