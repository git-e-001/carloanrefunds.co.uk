<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventLog;
use App\Models\Customer;
use Illuminate\Console\Command;

class ProcessPotentialCases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applications:process-potentials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find any e-signed applications which have not been submitted in full and submit as potentials';

    private $brightOfficeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(\App\Services\BrightOfficeService $brightOfficeService)
    {
        parent::__construct();

        $this->brightOfficeService = $brightOfficeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $potentialCaseCustomers = Customer::where('created_at', '<=', Carbon::now()->subMinutes(30))
            // and not yet submitted full
            ->whereDoesntHave('eventLog', function($query) {
                $query->where('event_id', Event::BRIGHTOFFICE_FULL_CASE_SUBMITTED);
            })
            // and not yet submitted potential
            ->whereDoesntHave('eventLog', function($query) {
                $query->where('event_id', Event::BRIGHTOFFICE_POTENTIAL_CASE_SUBMITTED);
            })
            ->get();

        foreach ($potentialCaseCustomers as $customer) {
            $this->info("Processing potential case for customer " . $customer->id);

            $result = $this->brightOfficeService->submitToBrightOffice($customer, true);
            EventLog::record(Event::BRIGHTOFFICE_POTENTIAL_CASE_SUBMITTED, $customer->id, 'Result: ' . ($result ? 'success' : 'failure'));

            if ($result) {
                $this->info("Successfully processed potential case for customer " . $customer->id);
            } else {
                $this->error("Failed to process potential case for customer " . $customer->id);
            }
        }
    }
}
