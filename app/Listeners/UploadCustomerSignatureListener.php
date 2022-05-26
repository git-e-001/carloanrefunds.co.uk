<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadCustomerSignatureListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $customer                      = $event->data['customer'];
        $letter_of_authority_signature = $event->data['letter_of_authority_signature'];
        $contract_signature            = $event->data['contract_signature'];

        // Check if the the signature directory exists for the specific customer
        if (!File::exists(public_path('signatures/' . $customer->id))) {
            // Create the signature directory for the specific customer
            File::makeDirectory(public_path('signatures/' . $customer->id), 0777, true);
        }

        // Decode the signature images
        $loaSig      = base64_decode(str_replace('data:image/png;base64,', '', $letter_of_authority_signature));
        $contractSig = base64_decode(str_replace('data:image/png;base64,', '', $contract_signature));

        if (config('app.env') != 'local' && !config('app.debug')) {
            Storage::disk('s3')->put('signatures/' . $customer->id . '/loa_sig.png', $loaSig, 'public');
            Storage::disk('s3')->put('signatures/' . $customer->id . '/contract_sig.png', $contractSig, 'public');
        } else {
            file_put_contents(public_path('signatures/' . $customer->id . '/loa_sig.png'), $loaSig);
            file_put_contents(public_path('signatures/' . $customer->id . '/contract_sig.png'), $contractSig);
        }
    }
}
