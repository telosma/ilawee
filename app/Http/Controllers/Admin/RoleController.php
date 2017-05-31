<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, Role, Permission};
use App\Http\Requests\Manager\RoleCreateRequest;
use  DB;
use Exeption;
use Validator;

class RoleController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.role.index')->with(['numDoc' => $numDoc]);
    }

    public function ajaxList()
    {
        return [ 'data' => Role::with('perms')->get() ];
    }

    public function ajaxListOnly()
    {
        return [ 'data' => Role::pluck('name', 'id') ];
    }

    public function ajaxListPermission()
    {
        return [ 'data' => Permission::pluck('description', 'id') ];
    }

    public function ajaxCreate(RoleCreateRequest $request)
    {
            // return [
            //     config('common.flash_level_key') => config('admin.noty_status.success'),
            //     config('common.flash_message') => $request->input('description')
            // ];
        try {
            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'description' => $request->input('description')
            ]);

            if ($role) {

            foreach ($request->input('permissions') as  $value) {
                $role->attachPermission($value);
            }

            DB::commit();

            return [
                config('common.flash_level_key') => config('admin.noty_status.success'),
                config('common.flash_message') => 'Role đã đưọc tạo'
            ];
            } else {
                return [
                    config('common.flash_level_key') => config('admin.noty_status.error'),
                    config('common.flash_message') => 'Có lỗi xảy ra, tạo Role thất bại'
                ];
            }
        } catch(Exeption $e) {
            DB::rollback();

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => $e->getMessage()
            ];
        }
    }

    public function ajaxDelete(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:roles,id'
        ]);

        try {
            $response = Role::destroy($request->input('id'));
            if ($response) {
                return [
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Xóa thành công'
                ];
            }

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Xóa thất bại'
            ];
        } catch (Exception $e) {
            logger()->error($e);
            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra'
            ];
        }
    }

    public function ajaxPermissionList(Request $request)
    {
        $role = Role::find($request->id);
        if (! $role )
        {
            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Role không tồn tại'
            ];
        }

        return [
            $role->perms
        ];
    }

}
