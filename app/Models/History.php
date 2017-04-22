<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Document};

class History extends Model
{
    protected $table = 'histories';
    protected $fillable = [
        'document_id',
        'user_id',
        'content',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
