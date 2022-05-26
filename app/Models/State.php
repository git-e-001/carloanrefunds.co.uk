<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public static function getForDropdownList() {
        // https://stackoverflow.com/a/29508402/817132
        return self::all(['id', 'description'])->pluck('description', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];
}
