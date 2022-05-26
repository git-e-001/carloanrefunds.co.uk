<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Input;

class ForceHttps {

    public function handle($request, Closure $next)
    {
        app()->setLocale('en');

        $forceHttps = env('FORCE_HTTPS', true);
        if (substr($request->path(), 0, 7) === 'worker/') {
            return $next($request);
        }

        if($forceHttps) {
            // Handle cloudflare proxy
            $request->setTrustedProxies([ $request->getClientIp() ]);

            if (!$request->secure()) {
                return redirect()->secure($request->getRequestUri(), 301);
            }
        }

        return $next($request);
    }
}