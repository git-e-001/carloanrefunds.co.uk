<?php

namespace App\Http\Controllers;

use App\Jobs\SendCustomerFinishEmail;
use App\Models\Event;
use App\Models\EventLog;
use App\Services\BrightOfficeService;
use Carbon\Carbon;
use App\Models\Loan;
use App\Models\State;
use App\Models\Lender;
use App\Models\Customer;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function getNoInfoLoan(Request $request)
    {
        $lenders = Lender::getForDropdownList();

        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);
        if (!$customer) {
            $customer = new \stdClass();
        }

        $loans = Loan::getLoansForCustomer($request->customer->id)->get();

        foreach ($loans as $loan) {
            $loan->capital = intval($loan->capital);
            $loan->year    = $loan->date->year;
            $loan->month   = $loan->date->month;
            $loan->deleted = false;
        }

        return view('pages/loans/no-info', [
            'loans'            => $loans,
            'lenders'          => $lenders,
            'customer'         => $customer,
            'hide_start_claim' => true
        ]);
    }

    public function postNoInfoLoan(Request $request, BrightOfficeService $brightOffice)
    {
        $loans = $request->input('loans');
        foreach ($loans as $loanInput) {
            $loan = Loan::find($loanInput['id']);
            if (!$loan) {
                $loan              = new Loan();
                $loan->customer_id = $request->customer->id;
            } else {
                if ($loanInput['deleted']) {
                    $loan->delete();
                    continue;
                }
            }

            $state = State::first();

            $loan->lender_id                       = $loanInput['lender_id'];
            $loan->lender_name                     = $loanInput['lender_name'] ? $loanInput['lender_name'] : '';
            $loan->agreement_id                    = 'LETTER';
            $loan->date                            = date('Y-m-d');
            $loan->capital                         = 0;
            $loan->previously_claimed              = $loanInput['previously_claimed'];
            $loan->single_repayment                = 0;
            $loan->rollovers                       = 0;
            $loan->missed_payment_rollover_offered = 0;
            $loan->state_id                        = $state->id;

            $loan->save();
        }

        // Submit to brightoffice
        $result = $brightOffice->submitToBrightOffice($request->customer);
        EventLog::record(Event::BRIGHTOFFICE_FULL_CASE_SUBMITTED, $request->customer->id, 'Result: ' . ($result ? 'success' : 'failure'));

        if ($result) {
            $url = url('submit/no-info-success');
        } else {
            $url = url('submit/error');
        }

        //dispatch(new SendCustomerFinishEmail($request->customer));

        return response()->json([
            'status' => 'success',
            'url'    => $url
        ]);
    }




    public function getLoan(Request $request, int $loanNumber = null)
    {
        $lenders = Lender::getForDropdownList();
        $states  = State::getForDropdownList();

        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);
        if (!$customer) {
            $customer = new \stdClass();
        }

        $loans = Loan::getLoansForCustomer($request->customer->id)->get();

        foreach ($loans as $loan) {
            $loan->capital = intval($loan->capital);
            $loan->year    = $loan->date->year;
            $loan->month   = $loan->date->month;
            $loan->deleted = false;
        }

        return view('pages/loans/overview', [
            'loans'            => $loans,
            'lenders'          => $lenders,
            'states'           => $states,
            'customer'         => $customer,
            'hide_start_claim' => true
        ]);
    }

    public function postLoan(Request $request, BrightOfficeService $brightOffice)
    {
        $loans = $request->input('loans');
        foreach ($loans as $loanInput) {


            $loan = Loan::find($loanInput['id']);
            if (!$loan) {
                $loan              = new Loan();
                $loan->customer_id = $request->customer->id;
            } else {
                if ($loanInput['deleted']) {
                    $loan->delete();
                    continue;
                }
            }

            $loan->lender_id                       = $loanInput['lender_id'];
            $loan->lender_name                     = $loanInput['lender_name'] ? $loanInput['lender_name'] : '';
            $loan->agreement_id                    = $loanInput['agreement_id'];
            $loan->date                            = Carbon::createFromDate($loanInput['year'], $loanInput['month']);
            $loan->capital                         = $loanInput['capital'];
            $loan->previously_claimed              = $loanInput['previously_claimed'];
            $loan->single_repayment                = $loanInput['single_repayment'];
            $loan->rollovers                       = $loanInput['rollovers'];
            $loan->missed_payment_rollover_offered = $loanInput['missed_payment_rollover_offered'];
            $loan->state_id                        = $loanInput['state_id'];

            $loan->save();
        }

        // Submit to brightoffice
        $result = $brightOffice->submitToBrightOffice($request->customer);
        EventLog::record(Event::BRIGHTOFFICE_FULL_CASE_SUBMITTED, $request->customer->id, 'Result: ' . ($result ? 'success' : 'failure'));

        if ($result) {
            $url = url('submit/success');
        } else {
            $url = url('submit/error');
        }

        dispatch(new SendCustomerFinishEmail($request->customer));

        return response()->json([
            'status' => 'success',
            'url'    => $url
        ]);
    }
}
