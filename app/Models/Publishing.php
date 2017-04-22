<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publishing extends Model
{
    protected $table = 'publishings';
    protected $fillable = [
        'document_id',
        'organization_id',
    ];
}
