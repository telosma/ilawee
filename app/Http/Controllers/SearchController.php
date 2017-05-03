<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType, Organization};
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;
use App\Http\Requests\AdvancedSearchRequest;
use Carbon\Carbon;

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
                "min_score" => 5,
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
                            "multi_match" => [
                                "query" => trim($request->input('query')),
                                "fields" => ["description", "content"],
                                "operator" => "and"
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
                            "pre_tags" => ["<span class=\"highlight\">"],
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
        // dd($documents);
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

    public function getAdvancedSearch()
    {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();

        return view('user.searching')->with([
            'doctypes' => $doctypes,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces
        ]);
    }

    public function ajaxGetResultSearch(AdvancedSearchRequest $request)
    {
        $perPage = 10;
        $page = $request->page ? $request->page : 1;

        $searchQuery = array (
            "body" => array(
                "min_score" => 5,
                "sort" => [ "_score" ],
                "query" => [
                    "bool" => [
                        "filter" => [
                        ],
                        "must" => [
                            [
                                "term" => [
                                    "confirmed" => [
                                        "value" => 1
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                "highlight" => [
                    "order" => "score",
                    "fields" => [
                        "description" => [
                            "force_source" => true,
                            "pre_tags" => ["<span class=\"highlight\">"],
                            "post_tags" => ["</span>"]
                        ]
                    ]
                ],
                'from' => ($page-1) * $perPage,
                'size' => $perPage
            )
        );

        $filterContent = array('range' => array('start_date' => array()));

        if ($request->has('from') && $request->has('to')) {
            if ($request->input('from') >= $request->input('to')) {
                return redirect()->back();
            }
        }

        if ($request->has('from')) {
            $filterContent['range']['start_date']['from'] = $request->input('from');
        }

        if ($request->has('to')) {
            $filterContent['range']['start_date']['to'] = $request->input('to');
        }

        if (count($filterContent['range']['start_date']) > 0) {
            $filterContent['range']['start_date']['format'] = "Y-m-d";
            $searchQuery['body']['query']['bool']['filter'] = $filterContent;
        }

        $multi_match = array(
            'multi_match' => array(
                "query" => $request->input('query'),
                "fields" => config('search.options.search_in.' . $request->input('field'))
            )
        );

        if ($request->input('match') === 'match_phrase') {
            $multi_match['multi_match']['type'] = "phrase";
        } else {
            $multi_match['multi_match']['operator'] = "and";
        }

        array_push($searchQuery['body']['query']['bool']['must'], $multi_match);

        // dd($searchQuery);
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        try {
            $documents = Document::complexSearch($searchQuery)->paginate($perPage);
            // dd($documents);
            if (empty($documents->hits['hits'])) {
                return [
                    'renderHtml' => '<span class="alert alert-info">' .
                                    'Không tìm thấy văn bản phù hợp' .
                                    '</span>'
                ];
            } else {
                return [
                    'renderHtml' => view('includes.elasticFilterList', [
                            'documents' => $documents->hits['hits'],
                            'links' => $documents->appends(Input::except('page')),
                        ])->render()
                ];
            }
        } catch (Exception $e) {
            return redirect()->route('home');
        }
    }
}
