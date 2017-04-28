<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{DocType, Organization, Document};
use App\Http\Controllers\DocumentController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;
use DB;

class HomeController extends Controller
{
    use DocumentMethod;

    public function home(Request $request)
    {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();
        $perPage = 10;
        $rangeDay = 60;
        $lawStartInMonths = $this->getLawStartInMonth(Carbon::now()->month, 2016, $perPage);
        $newLaws = $this->getNewLawByPublish( Carbon::createFromFormat('Y-m-d', '2016-12-10')->subDays($rangeDay), $perPage );
        return view('user.index')->with([
            'doctypes' => $doctypes,
            'lawStartInMonths' => $lawStartInMonths->appends(Input::except('page')),
            'newLaws' => $newLaws->appends(Input::except('page')),
            'tab' => $request->tab,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces
        ]);
    }
}
