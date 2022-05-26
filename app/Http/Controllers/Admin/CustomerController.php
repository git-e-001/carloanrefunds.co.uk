<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerApplyRequest;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all Lender
        $customers = Customer::latest();

        if ($keyword) {
            $keyword   = '%' . $keyword . '%';
            $customers = $customers->where('title', 'like', $keyword)
                ->orWhere('first_name', 'like', $keyword)
                ->orWhere('last_name', 'like', $keyword)
                ->orWhere('middle_names', 'like', $keyword)
                ->orWhere('dob', 'like', $keyword)
                ->orWhere('previous_first_name', 'like', $keyword)
                ->orWhere('previous_last_name', 'like', $keyword)
                ->orWhere('telephone_home', 'like', $keyword)
                ->orWhere('telephone_mobile', 'like', $keyword)
                ->orWhere('telephone_work', 'like', $keyword)
                ->orWhere('email', 'like', $keyword);
        }

        $customers = $customers->paginate($perPage);

        //Show All Slides
        return view('admin.pages.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.pages.customers.create');
    }

    public function store(CustomerApplyRequest $request)
    {
        Customer::create([
            'title'               => $request->title,
            'first_name'          => ucwords($request->first_name),
            'last_name'           => ucwords($request->last_name),
            'middle_names'        => ucwords($request->middle_names),
            'dob'                 => $request->dob,
            'previous_first_name' => ucwords($request->previous_first_name),
            'previous_last_name'  => ucwords($request->previous_last_name),
            'telephone_home'      => $request->telephone_home,
            'telephone_mobile'    => $request->telephone_mobile,
            'telephone_work'      => $request->telephone_work,
            'email'               => $request->email,
            'in_iva'              => $request->in_iva,
            'in_dmp'              => $request->in_dmp,
            'should_be_aware'     => $request->should_be_aware,
            'utm_source'          => $request->utm_source
        ]);

        return redirect()->back()->with('success', 'Successfully Created');
    }

    public function show(Customer $customer)
    {
        return view('admin.pages.customers.details', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.pages.customers.edit', compact('customer'));
    }

    public function update(CustomerApplyRequest $request, Customer $customer)
    {
        $customer->update([
            'title'               => $request->title,
            'first_name'          => ucwords($request->first_name),
            'last_name'           => ucwords($request->last_name),
            'middle_names'        => ucwords($request->middle_names),
            'dob'                 => $request->dob,
            'previous_first_name' => ucwords($request->previous_first_name),
            'previous_last_name'  => ucwords($request->previous_last_name),
            'telephone_home'      => $request->telephone_home,
            'telephone_mobile'    => $request->telephone_mobile,
            'telephone_work'      => $request->telephone_work,
            'email'               => $request->email,
            'in_iva'              => $request->in_iva,
            'in_dmp'              => $request->in_dmp,
            'should_be_aware'     => $request->should_be_aware,
            'utm_source'          => $request->utm_source
        ]);

        return redirect()->back()->with('success', 'Successfully updated');
    }

    public function destroy(Customer $customer)
    {
        $customer->documents()->delete();
        $customer->loans()->delete();
        $customer->currentAddress()->delete();
        $customer->previousAddresses()->delete();
        $customer->eventLog()->delete();
        $customer->partialLoans()->delete();
        $customer->delete();

        return redirect()->back()->with('success', 'Successfully deleted');
    }
}
