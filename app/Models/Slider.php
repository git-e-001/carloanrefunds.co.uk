<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

/**
 * @method static create(array $array)
 * @method static where(string $string, int $int)
 * @method static latest()
 * @method static status()
 */
class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'btn_text',
        'btn_link',
        'btn_color',
        'order',
        'status'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        self::creating(function (Slider $slider) {
            $slider->slug = slug($slider->title . '-' . time());
        });

        self::updating(function (Slider $slider) {
            $slider->slug = slug($slider->title . '-' . time());
        });
    }
}
