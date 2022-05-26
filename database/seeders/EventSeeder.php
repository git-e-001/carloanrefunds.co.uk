<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::firstOrNew([
            'id' => Event::APPLICATION_ESIGN,
            'category' => 'application',
            'name' => 'esign',
            'description' => 'Customer e-signed LOA and contract'
        ])->save();

        Event::firstOrNew([
            'id' => Event::BRIGHTOFFICE_POTENTIAL_CASE_SUBMITTED,
            'category' => 'brightoffice',
            'name' => 'potential_case_submitted',
            'description' => 'Potential case submitted to BrightOffice'
        ])->save();

        Event::firstOrNew([
            'id' => Event::BRIGHTOFFICE_FULL_CASE_SUBMITTED,
            'category' => 'brightoffice',
            'name' => 'full_case_submission',
            'description' => 'Full case submitted to BrightOffice'
        ])->save();

        Event::firstOrNew([
            'id' => Event::APPLICATION_LOA_GENERATED,
            'category' => 'application',
            'name' => 'loa_generated',
            'description' => 'LOA PDF generated'
        ])->save();

        Event::firstOrNew([
            'id' => Event::APPLICATION_CONTRACT_GENERATED,
            'category' => 'application',
            'name' => 'contract_generated',
            'description' => 'Contract PDF generated'
        ])->save();

        Event::firstOrNew([
            'id' => Event::APPLICATION_RESUME_LINK_DISPATCHED,
            'category' => 'application',
            'name' => 'resume_link_dispatched',
            'description' => 'Resume link dispatched for sending'
        ])->save();

        Event::firstOrNew([
            'id' => Event::APPLICATION_RESUME_LINK_SENT,
            'category' => 'application',
            'name' => 'resume_link_sent',
            'description' => 'Resume link sent'
        ])->save();
    }
}
