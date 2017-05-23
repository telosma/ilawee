<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType, Organization, FileStore};
use Carbon\Carbon;
use App\Events\ViewDocumentHandler;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {

        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        $document = Document::with([
            'fileStore',
            'docType',
            'guideDocument' => function($query) {
                return $query->with('docType');
            },
            'baseDocument' => function($query) {
                return $query->with('docType');
            }
            ])->findOrFail($id);

        $event = new ViewDocumentHandler();
        $event->handler($document);

        $document['publish_day'] = Carbon::parse($document->publish_date)->day;
        $document['publish_month'] = Carbon::parse($document->publish_date)->month;
        $document['publish_year'] = Carbon::parse($document->publish_date)->year;

        return view('user.detail')->with([
            'document' => $document,
            'doctypes' => $doctypes,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces,
            'tab' => $request->tab
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function download($key, $id)
    {
        $file = FileStore::findOrFail($id);
        if ($file->key == $key && is_file(storage_path('app/doc_store/' . basename($file->link)))) {
            $name = $file->document->name;

            return response()->download(storage_path('app/doc_store/' . basename($file->link)));
        }

        return redirect()->back();
    }

    public function getPdf($key, $id)
    {
        $file = FileStore::findOrFail($id);
        if ($file->key == $key && is_file(storage_path('app/doc_store/' . basename($file->link)))) {
            $name = $file->document->name;
            $path = storage_path('app/doc_store/' . basename($file->link));
            return response(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$name.'"'
]           );
        }
    }

    public function getLawByNotation($notation)
    {
        if ($notation != "Không số") {
            return Document::with('fileStore')->where('notation', $notation)->get();
        }

        return Document::findOrFail($notation);
    }
}
