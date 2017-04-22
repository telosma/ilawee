<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class FileStore extends Model
{
    protected $table = 'file_stores';
    protected $fillable = [
        'link',
        'key',
        'document_id',
    ];

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
