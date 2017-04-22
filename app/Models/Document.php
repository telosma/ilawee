<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{FileStore, DocType, Organization, Singer, History, Document};

class Document extends Model
{
    protected $table = 'documents';
    protected $fillable = [
        'item_id',
        'doc_type_id',
        'limit',
        'notation',
        'fields',
        'publish_date',
        'start_date',
        'effective',
        'description',
        'source',
        'content',
        'confirmed',
    ];

    public function docType()
    {
        return $this->belongsTo(DocType::class, 'doc_type_id');
    }

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'publishings', 'document_id', 'organization_id');
    }

    public function relatedDocuments()
    {
        return $this->hasMany(RelatedDocument::class, 'document_id');
    }

    public function fileStore()
    {
        return $this->hasOne(FileStore::class, 'document_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class, 'document_id');
    }

    public function signers()
    {
        return $this->belongsToMany(Signer::class, 'signs', 'document_id', 'signer_id');
    }

    public function guideDocument()
    {
        return $this->belongsToMany(Document::class, 'related_documents', 'document_id', 'guide_doc_id');
    }

    public function baseDocument()
    {
        return $this->belongsToMany(Document::class, 'related_documents', 'document_id', 'base_doc_id');
    }
}
