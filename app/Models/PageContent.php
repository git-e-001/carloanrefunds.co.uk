<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find($content_id)
 */
class PageContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'body',
        'bg_color',
        'order',
        'status',
    ];

    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }
}
