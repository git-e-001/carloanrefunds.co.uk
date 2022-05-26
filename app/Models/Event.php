<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    const APPLICATION_ESIGN = 1;
    const BRIGHTOFFICE_POTENTIAL_CASE_SUBMITTED = 2;
    const BRIGHTOFFICE_FULL_CASE_SUBMITTED = 3;
    const APPLICATION_LOA_GENERATED = 4;
    const APPLICATION_CONTRACT_GENERATED = 5;
    const APPLICATION_RESUME_LINK_DISPATCHED = 6;
    const APPLICATION_RESUME_LINK_SENT = 7;
}
