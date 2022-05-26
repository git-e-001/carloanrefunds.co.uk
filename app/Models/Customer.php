<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'title',
        'first_name',
        'last_name',
        'middle_names',
        'dob',
        'telephone_home',
        'telephone_work',
        'telephone_mobile',
        'in_iva',
        'in_dmp',
        'should_be_aware',
        'current_address_id',
        'previous_first_name',
        'previous_last_name',
        'utm_source',
        'declared_bankrupt',
        'bankrupt_petition',
        'individual_voluntary_arrangement',
        'individual_voluntary_arrangement_approved',
        'debt_relief_order',
        'arrangement_like',
    ];
    protected $dates = [
        'dob',
        'updated_at',
        'created_at',
    ];

    public function save(array $options = array())
    {
        if ($this->resume_token === null) {
            $this->resume_token = sha1(Str::random(16) . date('Y-m-d H:i:s'));
        }
        parent::save($options);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function previousAddresses()
    {
        return $this->hasMany(Address::class)->where('addresses.id', '<>', $this->current_address_id);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function currentAddress()
    {
        return $this->belongsTo(Address::class);
    }

    public function eventLog()
    {
        return $this->hasMany(EventLog::class);
    }

    public function getLoaPdfPath()
    {
        return Document::where('customer_id', $this->id)->where('name', 'loa')->firstOrFail()->filename;
    }

    public function getContractPdfPath()
    {
        return Document::where('customer_id', $this->id)->where('name', 'contract')->firstOrFail()->filename;
    }

    public function partialLoans()
    {
        return $this->hasMany(PartialLoan::class);
    }

    public function AuthoritySign(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'loa_sig');
    }

    public function ContactSign(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'contract_sig');
    }

}
