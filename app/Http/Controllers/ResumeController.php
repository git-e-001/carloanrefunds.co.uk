<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function getResume(Request $request, string $resumeToken)
    {
        $customer = Customer::where('resume_token', $resumeToken)->firstOrFail();

        $request->session()->get('customer_id');
        $request->session()->put('customer_id', $customer->id);
        if (!$customer->esigned_ts) {
            return redirect('/apply/esign-validation');
        } else {
            return redirect('/apply/next-step');
        }
    }
}
