<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageButton extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'btn_text',
        'btn_text_color',
        'btn_link',
        'btn_border_color',
        'btn_bg_color',
    ];
}
