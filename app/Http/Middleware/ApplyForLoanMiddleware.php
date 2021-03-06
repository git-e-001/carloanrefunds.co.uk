<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApplyForLoanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('customer_id')){
            return  redirect()->route('apply.customer.info');
        }
        return $next($request);
    }
}
