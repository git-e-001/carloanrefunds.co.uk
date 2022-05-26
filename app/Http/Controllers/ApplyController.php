<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateCustomerSignedDocs;
use App\Models\Address;
use App\Models\Agreement;
use App\Models\Customer;
use App\Models\Event;
use App\Models\EventLog;
use App\Models\Lender;
use App\Models\PartialLoan;
use App\Services\PdfDocumentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ApplyController extends Controller
{
    public function getIndex()
    {
        return redirect('apply/start');
    }

    public function getStart()
    {
        return redirect('apply/customer-info');
    }

    public function getCustomerInfo(Request $request)
    {
        return view('pages/apply/customer-info')->with('hide_start_claim', true);
    }

    public function postCustomerInfo(Request $request)
    {
        $this->validate($request,
            [
                'title'        => 'required',
                'first_name'   => 'required|string|min:2',
                'last_name'    => 'required|string|min:2',
                'middle_names' => 'string|nullable',
                'dob'          => 'required|date',

                'previous_aliases' => 'required',

                'aliases.*.first_name' => 'required_if:previous_aliases|string|min:2',
                'aliases.*.last_name'  => 'required_if:aliases.*.first_name|min:2',

                'address_line_1'   => 'required|string',
                'address_line_2'   => 'string|nullable',
                'address_line_3'   => 'string|nullable',
                'address_city'     => 'required|string',
                'address_county'   => 'string|nullable',
                'address_postcode' => 'required|string',

                'lived_another_address'       => 'required',
                'previous_addresses.*.line_1' => 'string|nullable',
                'previous_addresses.*.line_2' => 'string|nullable',
                'previous_addresses.*.line_3' => 'string|nullable',
                'previous_addresses.*.city'   => 'string|nullable',
                'previous_addresses.*.county' => 'string|nullable',

                'email' => 'required|email|confirmed',

                'telephone_home'   => 'numeric|digits:11|nullable',
                'telephone_work'   => 'numeric|digits:11|nullable',
                'telephone_mobile' => 'required|numeric|digits:11',

//                'in_iva'          => 'required',
//                'in_dmp'          => 'required',
                'should_be_aware' => 'required',

                'declared_bankrupt' => 'required',
                'bankrupt_petition' => 'required',
                'individual_voluntary_arrangement' => 'required',
                'individual_voluntary_arrangement_approved' => 'required',
                'debt_relief_order' => 'required',
                'arrangement_like' => 'required',
            ], [
                'dob.required' => 'The DOB field is required.',
                'dob.date'     => 'The DOB is not a valid date',
            ]);

        $utmSource = Session::get('utm_source', '');

        // validation passes, insert into database

        $customer = Customer::where('first_name', ucwords($request->first_name))
            ->where('last_name', ucwords($request->last_name))
            ->whereHas('currentAddress', function ($query) use ($request) {
                $query->where('postcode', $request->address_postcode);
            })
            ->first();

        if ($customer) {
            $utmSource = $customer->utm_source;
        }

        $customer = Customer::create([
            'email'               => $request->email,
            'title'               => $request->title,
            'first_name'          => ucwords($request->first_name),
            'last_name'           => ucwords($request->last_name),
            'middle_names'        => ucwords($request->middle_names),
            'previous_first_name' => ucwords($request->previous_first_name),
            'previous_last_name'  => ucwords($request->previous_last_name),
            'dob'                 => $request->dob,
            'telephone_home'      => $request->telephone_home,
            'telephone_work'      => $request->telephone_work,
            'telephone_mobile'    => $request->telephone_mobile,
            'in_iva'              => (bool)$request->in_iva,
            'in_dmp'              => (bool)$request->in_dmp,
            'should_be_aware'     => (bool)$request->should_be_aware,
            'declared_bankrupt'     => (bool)$request->declared_bankrupt,
            'bankrupt_petition'     => (bool)$request->bankrupt_petition,
            'individual_voluntary_arrangement'     => (bool)$request->individual_voluntary_arrangement,
            'individual_voluntary_arrangement_approved'     => (bool)$request->individual_voluntary_arrangement_approved,
            'debt_relief_order'     => (bool)$request->debt_relief_order,
            'arrangement_like'     => (bool)$request->arrangement_like,
            'utm_source'          => $utmSource
        ]);
        $customer->save();
        // log the customer ID in session for completion of app
        $request->session()->put('customer_id', $customer->id);

        // log current address
        $currentAddress = Address::create([
            'customer_id' => $customer->id,
            'line_1'      => ucwords($request->address_line_1),
            'line_2'      => $request->address_line_2 ? ucwords($request->address_line_2) : '',
            'line_3'      => ucwords($request->address_line_3),
            'city'        => ucwords($request->address_city),
            'county'      => $request->address_county ? ucwords($request->address_county) : '',
            'postcode'    => strtoupper($request->address_postcode) . '   ',
        ]);
        $currentAddress->save();
        $customer->current_address_id = $currentAddress->id;
        $customer->save();

        // log previous addresses

        foreach ($request->previous_addresses as $previousAddress) {
            if (isset($previousAddress['postcode']) && isset($previousAddress['line_1']) && isset($previousAddress['city'])) {
                $previousAddressModel = Address::create([
                    'customer_id' => $customer->id,
                    'line_1'      => ucwords($previousAddress['line_1']),
                    'line_2'      => isset($previousAddress['line_2']) ? $previousAddress['line_2'] ? ucwords($previousAddress['line_2']) : '' : '',
                    'line_3'      => ucwords($previousAddress['line_3']),
                    'city'        => ucwords($previousAddress['city']),
                    'county'      => isset($previousAddress['county']) ? $previousAddress['county'] ? ucwords($previousAddress['county']) : '' : '',
                    'postcode'    => strtoupper($previousAddress['postcode']) . '   ',
                ]);
                $previousAddressModel->save();
            }
        }

        return redirect('apply/esign');
    }

    public function getEsign(Request $request)
    {
        return view('pages/apply/esign')->with(['hide_start_claim' => true]);
    }

    public function getEsignValidation(Request $request)
    {
        return view('pages/apply/esign-validation')->with(['hide_start_claim' => true]);
    }

    public function validateEsignCustomer(Request $request)
    {
        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);

        if ($customer) {
            $validator = Validator::make($request->all(), [
                'last_name'     => 'required|in:' . strtolower($customer->last_name),
                'date_of_birth' => 'required|in:' . $customer->dob->toDateString(),
            ]);

            if ($validator->passes()) {
                return redirect('apply/esign');
            } else {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }
    }

    public function validateEsign(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loa_signature'      => 'required|signature',
            'contract_signature' => 'required|signature',
        ]);

        if ($validator->passes()) {
            return response()->json(['status' => 'success']);
        } else {
            $messages = $validator->errors();
            $errors   = [];

            if ($messages->first('loa_signature')) {
                $errors[] = $messages->first('loa_signature');
            }

            if ($messages->first('contract_signature')) {
                $errors[] = $messages->first('contract_signature');
            }

            return response()->json(['status' => 'error', 'messages' => $errors]);
        }
    }

    public function postEsign(Request $request)
    {
        // Decode the signature images
        $loaSig      = base64_decode(str_replace('data:image/png;base64,', '', $request->loa_signature));
        $contractSig = base64_decode(str_replace('data:image/png;base64,', '', $request->contract_signature));

        $loa_path = 'signatures/' . $request->customer->id . '/loa_sig.png';
        $con_path = 'signatures/' . $request->customer->id . '/contract_sig.png';

        // Save images
        Storage::put($loa_path, $loaSig);
        Storage::put($con_path, $contractSig);

        // capture marketing optins
        $request->customer->optin_email     = $request->optin_email == 1;
        $request->customer->optin_telephone = $request->optin_telephone == 1;
        $request->customer->optin_sms       = $request->optin_sms == 1;
        $request->customer->optin_post      = $request->optin_post == 1;

        $request->customer->esigned_ts = Carbon::now();
        EventLog::record(Event::APPLICATION_ESIGN, $request->customer->id);
        $request->customer->save();

        EventLog::whereIn('event_id', [Event::BRIGHTOFFICE_POTENTIAL_CASE_SUBMITTED, Event::APPLICATION_RESUME_LINK_DISPATCHED])
            ->where('customer_id', $request->customer->id)
            ->delete();

        $request->customer->AuthoritySign()->create([
            'url'       => Storage::url($loa_path),
            'base_path' => $loa_path,
            'type'      => 'loa_sig'
        ]);

        $request->customer->ContactSign()->create([
            'url'       => Storage::url($con_path),
            'base_path' => $con_path,
            'type'      => 'contract_sig'
        ]);

        // esign successful
        dispatch(new GenerateCustomerSignedDocs($request->customer));

        return redirect('apply/next-step');
    }

    public function getDocumentHtml(Request $request, string $documentId, PdfDocumentService $pdfDocumentService)
    {
        $agreement = Agreement::where('key', $documentId)->firstOrFail();

        if ($request->input('pdf', false)) {
            return $pdfDocumentService->generate($documentId, [
                'customer'  => $request->customer,
                'agreement' => $agreement
            ])->stream();
        }

        return view('docs/apply/' . $documentId)
            ->with('customer', $request->customer)
            ->with('agreement', $agreement);
    }

    public function getEsignComplete(Request $request)
    {
        return view('pages/apply/esign-complete');
    }

    public function getNextSteps(Request $request)
    {
        $customerId = $request->session()->get('customer_id');

        $customer = Customer::find($customerId);
        if (!$customer) {
            $customer = new \stdClass();
        }

        return view('pages/apply/next-step', [
            'customer' => $customer
        ]);
    }

    public function getPartialLoan(Request $request)
    {
        $partialLoans = PartialLoan::getPartialLoansForCustomer($request->customer->id)->get();
        $lenders      = Lender::getForDropdownList(true);

        return view('pages/apply/partial-loan', ['partialLoans' => $partialLoans, 'lenders' => $lenders]);
    }

    public function postPartialLoan(Request $request)
    {
        $this->validate($request,
            [
                'lender_name' => 'required|string',
                'loans'       => 'required|numeric|min:1',
            ]);

        $partialLoan = PartialLoan::create([
            'lender'      => $request->lender_name,
            'loans'       => $request->loans,
            'customer_id' => $request->customer->id,
        ]);
        $partialLoan->save();

        return redirect('apply/partial-loans');
    }

    public function deletePartialLoan(Request $request, int $partialLoanNumber)
    {
        $partialLoan = PartialLoan::getPartialLoansForCustomer($request->customer->id)
            ->skip($partialLoanNumber - 1)->firstOrFail();
        $partialLoan->delete();

        return redirect('apply/partial-loans');
    }

    public function getNoInfoLoan(Request $request)
    {
        $customer = Customer::find($request->session()->get('customer_id'));
        $lenders  = Lender::latest()->get();

        return view('lenders', compact('customer', 'lenders'));
    }
}
