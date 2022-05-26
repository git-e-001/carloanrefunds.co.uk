<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'customer_id',
        'detail',
        'event_ts',
    ];

    protected $dates = [
        'dob',
    ];

    public static function record(int $eventId, int $customerId = null, string $detail = null) {
        return self::create([
            'event_ts' => Carbon::now(),
            'event_id' => $eventId,
            'customer_id' => $customerId,
            'detail' => substr($detail, 0, 190)
        ]);
    }

}
