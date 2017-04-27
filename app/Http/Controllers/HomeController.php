<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{DocType, Organization, Document};
use App\Http\Controllers\DocumentController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Traits\DocumentMethod;

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

    public function treeView()
    {
        $doctypes = DocType::all();
        $organizations = Organization::take(70)->get();
        $organizations->map(function($organization) {
            $organization->key = (string)$organization->id;
            // $organization->url = route('home');
            if ($organization->type == config('common.type.trunguong')) {
                $organization->parent = config('common.type.key.trunguong');

            } elseif ($organization->type == config('common.type.bonganh')) {
                $organization->parent = config('common.type.key.bonganh');
            } else {
                $organization->parent = config('common.type.key.diaphuong');
            }

            return $organization;
        });
        $organization = new Organization();
        $organization['key'] = 'O';
        $organization['name'] = 'CSDL Quốc Gia';
        // $organization['url'] = route('home');
        $organizations->push($organization);
        // $organizations = [
        //     {'key' : "1", 'name' : 'CSDL Quốc Gia', 'url' : route('home')},
        //     {'key' : "2", 'parent' => "1", 'name' : 'Trung Ương', 'url' : route('home')},
        //     {'key' : "3", 'parent' => "1", 'name' : 'Bộ Ngành', 'url' : route('home')},
        //     {'key' : "3", 'parent' => "1", 'name' : 'Địa Phương', 'url' : route('home')}
        // ];
        return view('user.tree')->with(['organizations' => $organizations, 'doctypes' => $doctypes]);
    }
}
