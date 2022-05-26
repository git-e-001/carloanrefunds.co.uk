<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'content',
    ];

    /**
     * @param $customer
     * @return mixed
     */
    public function contentWithVariables($customer)
    {
        $optinEmail = $customer->optin_email ? ' X ' : '&nbsp;&nbsp;&nbsp;';
        $optinSms = $customer->optin_sms ? ' X ' : '&nbsp;&nbsp;&nbsp;';
        $optinPost = $customer->optin_post ? ' X ' : '&nbsp;&nbsp;&nbsp;';
        $optinTelephone = $customer->optin_telephone ? ' X ' : '&nbsp;&nbsp;&nbsp;';

        $keyValue = [

            '<br>'               => '<br><div class="p-spacer">BR</div>',
            ':START-INDENTATION' => '<div class="indented">',
            ':END-INDENTATION'   => '</div>',

            '<br><div class="p-spacer">BR</div></li>' => '</li>',

            '<div class="indented"><br>' => '<div class="indented">',

            ':FIRST-NAME'       => $customer->first_name,
            ':LAST-NAME'        => $customer->last_name,
            ':ADDRESS-LINE-1'   => $customer->currentAddress->line_1,
            ':ADDRESS-LINE-2'   => $customer->currentAddress->line_2,
            ':ADDRESS-CITY'     => $customer->currentAddress->city,
            ':ADDRESS-POSTCODE' => $customer->currentAddress->postcode,

            ':OPTIN-EMAIL'     => $optinEmail,
            ':OPTIN-SMS'       => $optinSms,
            ':OPTIN-POST'      => $optinPost,
            ':OPTIN-TELEPHONE' => $optinTelephone,
        ];

        $content = $this->content;
        foreach ($keyValue as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }
}
