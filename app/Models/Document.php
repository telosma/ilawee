<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use App\Models\{FileStore, DocType, Organization, Singer, History, Document};
use Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use ElasticquentTrait;
    use SoftDeletes;

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
        'end_date',
    ];
    protected $dates = ['deleted_at'];
    protected $appends = [
        'short_description',
    ];
    // protected $indexSettings = [
    //     'analysis' => [
    //         'char_filter' => [
    //             'replace' => [
    //                 'type' => 'mapping',
    //                 'mappings' => [
    //                     '&=> and '
    //                 ],
    //             ],
    //         ],
    //         'filter' => [
    //             'word_delimiter' => [
    //                 'type' => 'word_delimiter',
    //                 'split_on_numerics' => false,
    //                 'split_on_case_change' => true,
    //                 'generate_word_parts' => true,
    //                 'generate_number_parts' => true,
    //                 'catenate_all' => true,
    //                 'preserve_original' => true,
    //                 'catenate_numbers' => true,
    //             ]
    //         ],
    //         'analyzer' => [
    //             'default' => [
    //                 'type' => 'custom',
    //                 'char_filter' => [
    //                     'html_strip',
    //                     'replace',
    //                 ],
    //                 'tokenizer' => 'whitespace',
    //                 'filter' => [
    //                     'lowercase',
    //                     'word_delimiter',
    //                 ],
    //             ],
    //         ],
    //     ],
    // ];
    protected $mappingProperties = array(
        'description' => array(
            'type' => 'string',
            'analyzer' => 'vi_analyzer',
            'store' => true
        ),
        'publish_date' => array(
            'type' => 'date',
            'format' => 'yyyy-MM-dd || strict_date_optional_time||epoch_millis',
            'store' => true
        ),
        'content' => array(
            'type' => 'string',
            'analyzer' => 'vi_analyzer',
            'store' => true
        ),
        'start_date' => array(
            'type' => 'date',
            'format' => 'yyyy-MM-dd || strict_date_optional_time||epoch_millis',
            'store' => true
        ),
        'doc_type_id' => array(
            'type' => 'integer'
        ),
        'limit' => array(
            'type' => 'string'
        ),
        'fields' => array(
            'type' => 'string'
        ),
        'notation' => array(
            'type' => 'string'
        ),
        'effective' => array(
            'type' => 'string'
        ),
        'source' => array(
            'type' => 'string'
        ),
        'confirmed' => array(
            'type' => 'integer'
        ),
        'view_count' => array(
            'type' => 'integer'
        )
    );

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

    // public function getStartDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d-m-Y');
    // }

    // public function getPublishDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d-m-Y');
    // }

    public function getShortDescriptionAttribute()
    {
        return $this->attributes['short_description'] = Str::words($this->attributes['description'], 300);
    }
}
