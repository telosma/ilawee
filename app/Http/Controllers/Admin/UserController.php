<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, User, Role};
use App\Http\Requests\Admin\AccountCreateRequest;
use DB;
use Exception;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.user.index', compact('numDoc'));
    }

    public function ajaxList()
    {
        return ['data' => User::with('roles')->where('confirmed', '1')->get()];
    }

    public function ajaxCreate(AccountCreateRequest $request)
    {
        $params = $request->only('name', 'email', 'password');
        $default = config('default.avatar');
        $size = 40;
        $params['avatar_link'] = "https://www.gravatar.com/avatar/" . md5($request->input('email')) . "?d=" . urlencode( $default ) . "&s=" . $size;
        $params['confirmed'] = true;

        try {
            DB::beginTransaction();

            $user = User::create($params);
            if ($user) {
                foreach ($request->input('roles') as $role) {
                    $user->attachRole($role);
                }

                DB::commit();

                return [
                    config('common.flash_message') => "Tài khoản đã đưọc tạo",
                    config('common.flash_level_key') => "success"
                ];
            }
        } catch (Exception $e) {
            DB::rollback();

            return [
                config('common.flash_message') => "Hệ thống gặp lỗi, vui lòng thử lại sau",
                config('common.flash_level_key') => "error"
            ];
        }
    }

    public function ajaxDelete(Request $request)
    {
        if (!in_array(Auth::user()->id, $request->id)) {
            $response = User::destroy($request->id);

            if ($response) {
                return [
                    config('common.flash_level_key') => 'success',
                    config('common.flash_message') => 'Đã xóa tài khoản'
                ];
            }
        }

        return [
            config('common.flash_level_key') => 'error',
            config('common.flash_message') => 'Xóa thất bại'
        ];
    }
}
