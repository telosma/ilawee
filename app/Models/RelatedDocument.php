<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedDocument extends Model
{
    protected $table = 'related_documents';
    protected $fillable = [
        'document_id',
        'guide_doc_id',
        'base_doc_id',
    ];
}
