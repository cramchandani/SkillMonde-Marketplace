<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'checkout/callback/cashfree',
        'checkout/callback/paytabs',
        'callback/paytabs',
        'callback/jazzcash',
        'callback/paytr',
        'callback/xendit',
        'account/deposit/callback/paytabs',
        'callback/mollie/checkout',
        'callback/mollie/deposit',
        'callback/epoint/success',
        'callback/epoint/failed',
        'callback/epoint/results'
    ];

    
    public function handle($request, Closure $next)
    {
        unset($request['_token']);
        return parent::handle($request, $next);
    }
}
