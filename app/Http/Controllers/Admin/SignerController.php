<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Organization, Signer, Document};
use App\Http\Requests\Admin\SignerCreateRequest;
use Validator;
use DB;

class SignerController extends Controller
{
    public function index()
    {
        $numDoc = Document::count();

        return view('admin.signer.index')->with(['numDoc' => $numDoc]);
    }

    public function ajaxList()
    {
        return [ 'data' => Signer::with('organization')->get() ];
    }

    public function ajaxCreate(SignerCreateRequest $request)
    {
        $organizationRequest = $request->only(['name', 'jobTitle', 'organization_id']);
        $response = Signer::create($organizationRequest);

        if ($response) {
            return [
                config('common.flash_level_key') => config('admin.noty_status.success'),
                config('common.flash_message') => 'Tạo mới người ký thành công'
            ];
        }

        return [
            config('common.flash_level_key') => config('admin.noty_status.error'),
            config('common.flash_message') => 'Tạo mới người ký thất bại'
        ];
    }

    public function ajaxUpdate(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'jobTitle' => 'required',
            'organization_id' => 'exists:organizations,id'
        ]);
        $params = $request->only(['name', 'jobTitle', 'organization_id']);

        try {
            $response = Signer::where('id', $request->input('id'))->update($params);

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
        DB::beginTransaction();

        try {
            $response = Signer::destroy($request->input('id'));

            if (is_array($request->input('id'))) {
                DB::table('signs')->whereIn('signer_id', $request->input('id'))->delete();
            } else {
                 DB::table('signs')->where('signer_id', $request->input('id'))->delete();
            }


            DB::commit();

            if ($response) {
                return [
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Xóa người ký thành công'
                ];
            }

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Xóa người ký thất bại'
            ];
        } catch (Exception $e) {
            logger()->error($e);

            DB::rollback();

            return [
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra'
            ];
        }
    }
}
