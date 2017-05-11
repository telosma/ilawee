<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Http\Requests\Admin\{OrganizationUpdateRequest, OrganizationCreateRequest};
use Validator;

class OrganizationController extends Controller
{
    public function index()
    {
        return view('admin.organization.list');
    }

    public function ajaxList()
    {
        return [ 'data' => Organization::withCount('documents')->get() ];
    }

    public function ajaxCreate(OrganizationCreateRequest $request)
    {
        $organizationRequest = $request->only(['name', 'type', 'parent_id']);
        $response = Organization::create($organizationRequest);

        if ($response) {
            return [
                config('common.flash_level_key') => config('admin.noty_status.success'),
                config('common.flash_message') => 'Tạo mới tổ chức thành công'
            ];
        }

        return [
            config('common.flash_level_key') => config('admin.noty_status.error'),
            config('common.flash_message') => 'Tạo mới tổ chức thất bại'
        ];
    }

    public function ajaxListOnly()
    {
        return ['data' => Organization::all()];
    }

    public function ajaxUpdate(OrganizationUpdateRequest $request)
    {
        $organizationRequest = $request->only(['name', 'parent_id']);

        try {
            $response = Organization::where('id', $request->input('id'))->update($organizationRequest);

            if ($response) {
                return [
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Cập nhật thành công',
                ];
            }

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra',
            ];
        } catch (Exception $e) {
            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra',
            ];
        }
    }

    public function ajaxDelete(Request $request)
    {
        Validator::make($request->all(), [
            'id' => 'required|exists:organizations,id'
        ]);

        try {
            $response = Organization::destroy($request->input('id'));
            if ($response) {
                return [
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Xóa thành công'
                ];
            }

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Xóa tổ chức thất bại'
            ];
        } catch (Exception $e) {
            logger()->error($e);
            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra'
            ];
        }
    }

}
