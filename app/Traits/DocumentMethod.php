<?php

namespace App\Traits;
use App\Models\{Document};

trait DocumentMethod {

    protected function listLawByType($typeId)
    {
        return Document::where('doc_type_id', $typeId)
            ->with(['fileStore', 'docType']);
    }

    protected function getLawStartInMonth($month, $year, $paginate)
    {
        return Document::whereMonth('start_date', $month)
            ->whereYear('start_date', $year)->with(['fileStore', 'docType'])
            ->orderBy('start_date')->paginate($paginate);
    }

    protected function getNewLawByPublish($time, $perPage)
    {
        return Document::whereDate('publish_date', '>', $time)
            ->with(['fileStore', 'docType'])->orderBy('start_date')->paginate($perPage);
    }
}
