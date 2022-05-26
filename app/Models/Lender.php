<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lender extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'promoted',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('non-other', function (Builder $builder) {
            $builder->where('name', '<>', 'Other');
        });
    }

    public static function getForDropdownList($namedNameMode = false) {
        // https://stackoverflow.com/a/29508402/817132
        if (!$namedNameMode) {
            return self::withoutGlobalScope('non-other')->orderBy('promoted', 'asc')->orderBy('name', 'ASC')->pluck('name', 'id');
        } else {
            return self::withoutGlobalScope('non-other')->orderBy('name', 'ASC')->pluck('name', 'name');
        }
    }
}
