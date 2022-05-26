<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'lender_id',
        'agreement_id',
        'state_id',
        'date',
        'lender_name',
        'capital',
        'previously_claimed',
        'single_repayment',
        'rollovers',
        'missed_payment_rollover_offered',
    ];

    protected $dates = [
        'date'
    ];

    public function lender()
    {
        return $this->belongsTo(Lender::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public static function getLoansForCustomer(int $customerId) {
        return self::where('customer_id', $customerId)
            ->orderBy('lender_id')
            ->orderBy('date')
            ->orderBy('id');
    }
}
