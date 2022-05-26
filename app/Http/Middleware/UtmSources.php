<?php

namespace App\Http\Middleware;

use Closure;
use Input;

class UtmSources
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->input('utm_source')){
            $request->session()->put('utm_source', $request->input('utm_source'));
        }

        if($request->input('a')){
            $request->session()->put('utm_source', $request->input('a'));
        }

        return $next($request);
    }
}
