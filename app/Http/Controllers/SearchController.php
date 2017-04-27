<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Document, DocType};
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
            $typeId = $request->typeId;
            $perPage = 10;

            $documents = $this
                ->listLawByType($typeId)
                ->orderBy('effective', 'asc')
                ->paginate($perPage);

            return view('user.lawFilter')->with([
                'documents' => $documents->appends(Input::except('page')),
                'doctypes' => $doctypes
            ]);

        }

        return redirect()->route('home');
    }
}
