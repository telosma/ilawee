<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Document, FileStore, Signer, Organization, Upload};
use App\Http\Requests\Manager\CreateDocRequest;
use Carbon\Carbon;
use Storage;
use DB;
use Auth;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:manager');
    }

    public function ajaxCreate(CreateDocRequest $request)
    {
        try {
            DB::beginTransaction();
            if (Document::where('notation', $request->input('notation'))->where('confirmed', '<>', 2)->first()) {
                return redirect()->route('manager.index')->with([
                    config('common.flash_level_key') => config('admin.noty_status.error'),
                    config('common.flash_message') => 'Văn bản đã tồn tại'
                ]);
            }

            if ($request->input('publishDate') > $request->input('startDate')) {
                return redirect()->route('manager.index')->with([
                    config('common.flash_level_key') => config('admin.noty_status.error'),
                    config('common.flash_message') => 'Kiểm tra lại thời gian công bố, thời gian có hiệu lực'
                ]);
            }

            if ( ($request->has('endDate')) && ($request->input('endDate') <= $request->input('startDate')) ) {
                return redirect()->route('manager.index')->with([
                    config('common.flash_level_key') => config('admin.noty_status.error'),
                    config('common.flash_message') => 'Kiểm tra lại thời gian có hiệu lực và hết hiệu lực'
                ]);
            }

            $document = Document::create([
                'item_id' => NULL,
                'doc_type_id' => $request->input('type'),
                'limit' => $request->input('limit'),
                'notation' => $request->input('notation'),
                'fields' => $request->input('fields') ? $request->input('fields') : NULL,
                'publish_date' => $request->input('publishDate'),
                'start_date' => $request->input('startDate'),
                'effective' => $request->input('effective'),
                'description' => $request->input('description'),
                'source' => $request->input('source') ? $request->input('source') : 'Đang cập nhật',
                'content' => $request->input('content'),
                'confirmed' => 0,
                'view_count' => 0,
            ]);

            if ($document) {
                if ($request->file('docFile')) {
                    $fileName = $request->input('notation') . '-' . Carbon::now();
                    $path = Storage::putFileAs('doc_store', $request->file('docFile'), $fileName);
                    if (!$path) {
                        return redirect()->route('manager.index')->with([
                            config('common.flash_level_key') => config('admin.noty_status.waring'),
                            config('common.flash_message') => 'Có lỗi xảy ra, không lưu trữ được file đính kèm',
                        ]);
                    }

                    $file = FileStore::create([
                            'document_id' => $document->id,
                            'link' => $fileName,
                            'key' => str_random(10)
                        ]);
                }
                $signers = explode(",", $request->input('signer'));
                $document->signers()->attach($signers);

                foreach ($signers as $signer) {
                    $document->organizations()->attach(Signer::where('id', $signer)->first()->organization->id);
                }

                Upload::create([
                    'document_id' => $document->id,
                    'user_id' => Auth::user()->id,
                    'description' => Auth::user()->name . ' cập nhật văn bản ' . $document->notation
                ]);

                DB::commit();

                return redirect()->route('manager.index')->with([
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Đã cập nhật văn bản, chờ phê duyệt'
                ]);
            } else {
                DB::rollback();

                return redirect()->route('manager.index')->with([
                    config('common.flash_level_key') => config('admin.noty_status.success'),
                    config('common.flash_message') => 'Không tạo đưọc văn bản'
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();

            return view('manager.index')->with([
                config('common.flash_level_key') => config('admin.noty_status.error'),
                config('common.flash_message') => 'Đã có lỗi xảy ra'
            ]);
        }
    }
}
