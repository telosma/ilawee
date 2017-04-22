<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Document, Signer};

class Organization extends Model
{
    public $timestamps = false;
    protected $table = 'organizations';
    protected $fillable = [
        'name',
        'type',
        'parent_id',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'publishings', 'organization_id', 'document_id');
    }

    public function signers()
    {
        return $this->hasMany(Signer::class);
    }
}
