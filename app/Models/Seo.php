<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'page_title',
        'page_description',
        'page_keywords',
        'og_title',
        'og_type',
        'og_url',
        'og_description',
        'og_image',
        'twitter_title',
        'twitter_site',
        'twitter_card',
        'twitter_description',
        'twitter_image',
        'page_scripts',
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
