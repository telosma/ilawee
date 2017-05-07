<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use RemoteImageUploader\Factory;
use Exception;

class UploadController extends Controller
{

    public function storageImage(Request $request)
    {
        try {
            $result = Factory::create(config('upload.image_upload.host'), config('upload.image_upload.auth'))
                ->upload($request->upload->path());

            return [
                'status' => true,
                'url' => $result,
                'message' => 'upload image Flickr success',
            ];
        } catch (Exception $ex) {
            return [
                'status' => false,
                'url' => '',
                'message' => 'upload image to Flickr fail',
            ];
        }
    }

    public function storageImageCKEditor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image',
            'CKEditorFuncNum' => 'required',
        ]);
        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());

            return view('uploadCKEditor', [
                'CKEditorFuncNum' => $request->CKEditorFuncNum,
                'data' => [
                    'url' => null,
                    'message' => $message,
                ],
            ]);
        }
        $data = $this->storageImage($request);
        $result = [
            'message' => $data['message'],
            'url' => '',
        ];
        if ($data['status']) {
            $thumb = getThumb($data['url'], config('upload.image_upload.max_with'));
            if ($thumb['status']) {
                $result['url'] = $thumb['thumbnail'];
            } else {
                $result['url'] = $data['url'];
            }
        }

        return view('uploadCKEditor', [
            'CKEditorFuncNum' => $request->CKEditorFuncNum,
            'data' => $result,
        ]);
    }
}
