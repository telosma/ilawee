<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Document};

class Upload extends Model
{
    public $timestamps = false;
    protected $table = 'uploads';
    protected $fillable = [
        'user_id',
        'document_id',
    ];

    public function doc()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
