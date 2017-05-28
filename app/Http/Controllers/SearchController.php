<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType, Organization};
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;
use App\Http\Requests\AdvancedSearchRequest;
use Carbon\Carbon;
use Validator;

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
        $validator = Validator::make($request->all(), [
            'query' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->with([
                            config('common.flash_message') => 'Yêu cầu nhập từ khóa',
                            config('common.flash_level_key') => 'warning'
                        ])
                        ->withInput();
        }
        $page = $request->page ? $request->page : 1;
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        $perPage = 20;
        $documents = Document::complexSearch(array(
            'body' => array(
                "min_score" => 2,
                "sort" => [
                    "_score"
                ],
                "query" => [
                    "bool" => [
                        "filter" => [
                                "term" => [
                                    "confirmed" => 1
                                ]
                        ],
                        "must" => [
                            "multi_match" => [
                                "query" => trim($request->input('query')),
                                // "analyzer" => 'vi_analyzer',
                                "fields" => ["content", "description", "notaion"],
                                "fuzziness" => "2"
                            ]
                        ],
                    ]
                ],
                "highlight" => [
                    "order" => "score",
                    "fields" => [
                        "description" => [
                            "force_source" => true,
                            "fragment_size" => 150,
                            "number_of_fragments" => 3,
                            "pre_tags" => ["<span class=\"highlight\">"],
                            "post_tags" => ["</span>"]
                        ]
                    ]
                ],
                "from" => ($page-1) * $perPage,
                "size" => $perPage
            )
        )
        )->paginate($perPage);
        return view('user.elasticLawSearch')->with([
            'doctypes' => $doctypes,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces,
            'documents' => $documents->hits['hits'],
            'links' => $documents->appends(Input::except('page')),
            'old_query' => $request->input('query'),
            'total' => $documents->hits['total'],
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
        // if ($request->has('from') && $request->has('to')) {
        //     if ($request->input('from') >= $request->input('to')) {
        //         return [
        //             config('common.flash_message') => $request->from,
        //             config('common.flash_level_key') => 'warning'
        //         ];
        //     }
        // }
        if ($request->has('from') && $request->has('to')) {
            if ($request->input('from') >= $request->input('to')) {
                return [
                    config('common.flash_message') => 'Thời gian ban hành phải sớm hơn thời gian có hiệu lực',
                    config('common.flash_level_key') => 'warning'
                ];
            }
        }
        $perPage = 20;
        $page = $request->page ? $request->page : 1;

        $searchQuery = array (
            "body" => array(
                "min_score" => 2,
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

        if ($request->has('from')) {
            $filterContent['range']['start_date']['gte'] = $request->input('from');
        }

        if ($request->has('to')) {
            $filterContent['range']['start_date']['lte'] = $request->input('to');
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
                    'renderHtml' => "",
                ];
            } else {
                return [
                    'renderHtml' => view('includes.elasticFilterList', [
                            'documents' => $documents->hits['hits'],
                            'links' => $documents->appends(Input::except('page')),
                            'total' => $documents->hits['total'],
                        ])->render()
                ];
            }
        } catch (Exception $e) {
            return redirect()->route('home');
        }
    }
}
