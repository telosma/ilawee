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

    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class, 'parent_id');
    }

    public function documentsThrough($take = null)
    {
        $result = $this->hasManyThrough( Document::class, Organization::class)->orderBy('created_at', 'desc');
        switch ($take) {
            case 'all':
                return $result;
            case null:
                return $result->limit(5);
            default:
                return $result->limit($take);
        }
    }

    public function allDocumentsThrough()
    {
        return $result = $this->hasManyThrough( Document::class, Organization::class,
            'parent_id', 'organization_id')->orderBy('created_at', 'desc')->with('fileStore');
    }

    public function getSubOrganization($id)
    {
        return $this->where('parent_id', $id)->get();
    }
}
