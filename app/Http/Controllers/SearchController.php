<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType, Organization};
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;

class SearchController extends Controller
{
    use DocumentMethod;

    public function filterByType(Request $request)
    {

            $doctypes = DocType::all();
            $governments = Organization::where('type', config('common.type.trunguong'))->get();
            $ministries = Organization::where('type', config('common.type.bonganh'))->get();
            $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
            $typeId = $request->typeId;
            $perPage = 10;

            $documents = $this
                ->listLawByType($typeId)
                ->orderBy('effective', 'asc')
                ->paginate($perPage);

            return view('user.lawFilter')->with([
                'documents' => $documents->appends(Input::except('page')),
                'doctypes' => $doctypes,
                'governments' => $governments,
                'ministries' => $ministries,
                'provinces' => $provinces
            ]);

    }

    public function filterByOrganization(Request $request, $orId)
    {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();

        $organization = Organization::with(['documents' => function($query) {
            return $query->where('confirmed', true);

        }])->findOrFail($orId);

        if (count($organization->documents) < 1) {
            return view('user.lawFilter')->with([
                'documents' => $organization->documents()->paginate(10),
                'doctypes' => $doctypes,
                'governments' => $governments,
                'ministries' => $ministries,
                'provinces' => $provinces,
                config('common.flash_message') => "Tạm thời dữ liệu pháp luật của " . $organization->name . " chưa đưọc cập nhật",
                config('common.flash_level_key') => 'success'
        ]);
            // print_r("Tạm thời dữ liệu pháp luật của " . $organization->name . " chưa đưọc cập nhật");
        } else {
            $perPage = 10;
            return view('user.lawFilter')->with([
                'documents' => $organization->documents()->paginate($perPage),
                'doctypes' => $doctypes,
                'governments' => $governments,
                'ministries' => $ministries,
                'provinces' => $provinces
            ]);
            // dd($organization->documents()->paginate(2));
        }
        // $documents = $organization->documents;
    }

    public function normalSearch(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        $perPage = 10;
        $documents = Document::complexSearch(array(
            'body' => array(
                "min_score" => 3,
                "sort" => [
                    "_score"
                ],
                // "query" => [
                //     "match" => [
                //         "description" => trim($request->input('query'))
                //     ]
                // ],
                "query" => [
                    "bool" => [
                        // "filter" => [
                        //     "term" => [ "confirmed" => true ]
                        // ],
                        "must" => [
                            "match" => [
                                "description" => trim($request->input('query'))
                            ]
                        ],
                        // "filter" => [
                        //     "range" => [
                        //                 "start_date" => [
                        //                     "gte" => "2017-04-18",
                        //                     "format"=> "yyyy-MM-dd"
                        //                 ]
                        //             ]
                        // ]
                    ]
                ],
                "highlight" => [
                    "order" => "score",
                    "fields" => [
                        "description" => [
                            "force_source" => true,
                            // "fragment_size" => 150,
                            // "number_of_fragments" => 3,
                            "pre_tags" => ["<span class=\" highlight\">"],
                            "post_tags" => ["</span>"],
                            // "highlight_query"=> [
                            //     "bool"=> [
                            //         "must"=> [
                            //             "match"=> [
                            //                 "description"=> [
                            //                     "query"=> "sử dụng nguồn tăng bội"
                            //                 ]
                            //             ]
                            //         ]
                            //         "should"=> [
                            //             "match_phrase"=> [
                            //                 "content"=> [
                            //                     "query"=> "tăng bội",
                            //                     "slop"=> 1,
                            //                     "boost"=> 10.0
                            //                 ]
                            //             ]
                            //         ],
                            //         "minimum_should_match"=> 0
                                // ]
                            // ]
                        ]
                    ]
                ],
                'from' => ($page-1) * $perPage,
                'size' => $perPage
            )
        )
        )->paginate($perPage);
        // $documents->appends(Input::except('page'));
        // dd($documents->getHits());
        // dd($documents->hits['hits']);
        // foreach ($documents->hits['hits'] as $document) {
        //     dd($document);
        // }
        return view('user.elasticLawSearch')->with([
            'doctypes' => $doctypes,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces,
            'documents' => $documents->hits['hits'],
            'links' => $documents->appends(Input::except('page')),
        ]);
    }
}
