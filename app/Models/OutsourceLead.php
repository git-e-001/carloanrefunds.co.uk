<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutsourceLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'name',
        'surname',
        'email',
        'phone',
        'permission_given',
        'date'
    ];
}
