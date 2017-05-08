<?php

namespace App\Traits;
use App\Models\{DocType, Organization, Document, Field, Post};

trait Common {
    protected function getDataMenu ()
    {
        $doctypes = DocType::all();
        $governments = Organization::where('type', config('common.type.trunguong'))->get();
        $ministries = Organization::where('type', config('common.type.bonganh'))->get();
        $provinces = Organization::where('type', config('common.type.diaphuong'))->get();

        return [
            'doctypes' => $doctypes,
            'governments' => $governments,
            'ministries' => $ministries,
            'provinces' => $provinces
        ];
    }
}
