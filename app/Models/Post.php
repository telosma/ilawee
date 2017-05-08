<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use App\Models\{User, Comment, Field};
use Str;
use Html2Text\Html2Text;
use Carbon\Carbon;

class Post extends Model
{
    use ElasticquentTrait;
    protected $table = 'posts';
    protected $fillable = [
        'user_id',
        'field_id',
        'title',
        'content',
    ];
    protected $appends = ['short_desc'];

    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and '
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    public function getByUser($id)
    {
        return Post::where('user_id', $id)->with('field')->withCount('comments')->get();
    }

    public function getShortDescAttribute()
    {
        $text =  Html2Text::convert($this->attributes['content']);
        return $this->attributes['short_desc'] = Str::words($text, 200);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('l jS F Y');
    }
}
