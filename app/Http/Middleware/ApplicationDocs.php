<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Customer;

class ApplicationDocs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $customerId = $request->session()->get('customer_id');

        // no customer ID in session
        if ($customerId === null) {
            abort(201, 'Your application session is empty.');
        }

        $customer = Customer::find($customerId);
        // customer ID in session, but not found in database.
        // this is a service failure safety check.
        if ($customer === null) {
            abort(500, 'Unable to retrieve your application data.');
        }

        // pull the customer model into the request
        $request->merge([
            'customer' => $customer
        ]);

        return $next($request);
    }
}
