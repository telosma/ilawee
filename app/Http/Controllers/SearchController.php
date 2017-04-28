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
        if ($request->has('typeId')) {

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

        return redirect()->route('home');
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
}
