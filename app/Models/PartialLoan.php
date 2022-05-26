<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartialLoan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'lender',
        'loans'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function getPartialLoansForCustomer(int $customerId) {
        return self::where('customer_id', $customerId)
            ->orderBy('lender')
            ->orderBy('id');
    }
}
