<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'line_1',
        'line_2',
        'line_3',
        'city',
        'county',
        'postcode',
        'type'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
