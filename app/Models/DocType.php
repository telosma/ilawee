<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class DocType extends Model
{
    protected $table = 'doc_types';
    protected $fillable = [
        'name',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'doc_type_id');
    }
}
