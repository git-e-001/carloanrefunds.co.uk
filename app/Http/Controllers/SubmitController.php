<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Loan;
use App\Models\Event;
use App\Models\EventLog;
use Illuminate\Http\Request;
use App\Services\BrightOfficeService;

class SubmitController extends Controller
{
    public function getSubmitSuccess(Request $request){
        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);
        if(!$customer){
            $customer = new \stdClass();
        }

        return view('pages/submit/success')->with(['customer' => $customer, 'hide_start_claim' => true]);
    }

    public function getNoInfoSubmitSuccess(Request $request){
        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);
        if(!$customer){
            $customer = new \stdClass();
        }

        return view('pages/submit/no-info-success')->with(['customer' => $customer, 'hide_start_claim' => true]);
    }

    public function getSubmitError(){
        return view('pages/submit/error');
    }
}
