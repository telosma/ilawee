<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Document;

class Signer extends Model
{
    protected $table = 'signers';
    protected $fillable = [
        'name',
        'jobTitle',
        'organization_id',
    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'signs');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
