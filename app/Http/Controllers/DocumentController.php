<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType};
use Carbon\Carbon;

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
    public function show($id)
    {
        // $document = Document::with('fileStore')->findOrFail($id);

        // $results = Document::complexSearch(array(
        //     'body' => array(
        //         "query" => [
        //             "match" => [
        //                 "description" => "sử dụng nguồn tăng bội "
        //             ]
        //         ],
        //         "highlight" => [
        //             "order" => "score",
        //             "fields" => [
        //                 "description" => [
        //                     "force_source" => true,
        //                     "fragment_size" => 150,
        //                     "number_of_fragments" => 3,
        //                     "pre_tags" => ["<em class=\" highlight\">"],
        //                     "post_tags" => ["</em>"],
        //                     "highlight_query"=> [
        //                         "bool"=> [
        //                             "must"=> [
        //                                 "match"=> [
        //                                     "description"=> [
        //                                         "query"=> "sử dụng nguồn tăng bội"
        //                                     ]
        //                                 ]
        //                             ],
        //                             "should"=> [
        //                                 "match_phrase"=> [
        //                                     "content"=> [
        //                                         "query"=> "tăng bội",
        //                                         "slop"=> 1,
        //                                         "boost"=> 10.0
        //                                     ]
        //                                 ]
        //                             ],
        //                             "minimum_should_match"=> 0
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     )
        // )
        // )->paginate(10);
        // // $hits = $results->getHits()['hits'];
        // dd($results);
        // // dd($results->getHits()['hits'][0]['highlight']);
        // // foreach ($results as $res) {
        // //     print_r($res);
        // // }
        $doctypes = DocType::all();
        $document = Document::with(['fileStore', 'docType'])->findOrFail($id);
        $document['publish_day'] = Carbon::parse($document->publish_date)->day;
        $document['publish_month'] = Carbon::parse($document->publish_date)->month;
        $document['publish_year'] = Carbon::parse($document->publish_date)->year;

        return view('user.detail')->with([
            'document' => $document,
            'doctypes' => $doctypes
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

    public function down($code, $name)
    {
        Document::where();
    }

    public function getLawByNotation($notation)
    {
        if ($notation != "Không số") {
            return Document::with('fileStore')->where('notation', $notation)->get();
        }

        return Document::findOrFail($notation);
    }
}
