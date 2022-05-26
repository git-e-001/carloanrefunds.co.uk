<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(\string[][] $array)
 * @method static where(string $string, string $string1)
 */
class Fontawesome extends Model
{
    use HasFactory;

    protected $this = ['className'];

    public function fontawesome(){
        return $this->belongsTo(MenuItem::class);
    }
}
