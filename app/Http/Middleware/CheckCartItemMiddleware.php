<?php

namespace App\Http\Middleware;

use Cart;
use Closure;
use Illuminate\Http\Request;

class CheckCartItemMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cart_item = Cart::instance('cart')->count();
        if ($cart_item) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'Your cart is empty');
        }
    }
}
