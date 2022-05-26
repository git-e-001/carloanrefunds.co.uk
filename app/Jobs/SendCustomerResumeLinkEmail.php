<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\EventLog;
use App\Models\Customer;
use Illuminate\Bus\Queueable;
use App\Mail\CustomerResumeLink;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCustomerResumeLinkEmail
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $customer;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $error = false;
        try {
            Mail::to($this->customer->email)
                ->send(new CustomerResumeLink($this->customer));
        } catch (\Swift_TransportException $e) {
            $error = $e->getMessage();
        }
        EventLog::record(Event::APPLICATION_RESUME_LINK_SENT, $this->customer->id, ($error === false) ? 'Successfully sent' : 'Failed sending: ' . $error);
//        EventLog::record(Event::APPLICATION_RESUME_LINK_SENT, $this->customer->id, "FAKE SEND ATTEMPT FOR DBEUG PURPOSES");
    }
}
