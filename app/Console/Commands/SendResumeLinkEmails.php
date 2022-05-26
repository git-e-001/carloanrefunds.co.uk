<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventLog;
use App\Models\Customer;
use Illuminate\Console\Command;
use App\Jobs\SendCustomerResumeLinkEmail;

class SendResumeLinkEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applications:send-resume-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends resume link emails to all mid-flow applications that have been inactive for 30 minutes';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $customers = Customer::whereNotNull('email')
            // customer's record has not been modified in last 30 minutes
            ->where('updated_at', '<=', Carbon::now()->subMinutes(30))
            // never chase if the customer's record was last updated more than 3 days ago
            ->where('updated_at', '>', Carbon::now()->subDays(3))
            // and not yet had resume link emailed
            ->whereDoesntHave('eventLog', function($query) {
                $query->where('event_id', Event::APPLICATION_RESUME_LINK_DISPATCHED);
            })
            // where no loan details have been modified in last 30 minutes
//            ->whereDoesntHave('loans', function($query) {
//                $query->where('updated_at', '>=', Carbon::now()->subMinutes(30));
//            })
            // and not yet submitted full
            ->whereDoesntHave('eventLog', function($query) {
                $query->where('event_id', Event::BRIGHTOFFICE_FULL_CASE_SUBMITTED);
            })
            ->get();

        // Handle this first, in case queue driver is "sync" and send attempts take a long time.
        foreach ($customers as $customer) {
            EventLog::record(Event::APPLICATION_RESUME_LINK_DISPATCHED, $customer->id, 'Logged for rate limiting');
        }

        // Keep this in a separate loop...
        foreach ($customers as $customer) {
            $this->info("Dispatching send resume link email for customer " . $customer->id);
            dispatch(new SendCustomerResumeLinkEmail($customer));
        }
    }
}
