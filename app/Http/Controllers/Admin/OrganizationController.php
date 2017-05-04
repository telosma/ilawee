<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Http\Requests\Admin\OrganizationUpdateRequest;

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

    public function ajaxListOnly()
    {
        return Organization::all();
    }

    public function ajaxUpdate(OrganizationUpdateRequest $request)
    {
        $organizationRequest = $request->only(['name', 'parent_id']);

        try {
            $response = Organization::update($organizationRequest, $request->input('id'));

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
}
