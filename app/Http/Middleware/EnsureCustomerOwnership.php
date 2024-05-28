<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class EnsureCustomerOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $customer = $request->route('customer');

        if ($customer && $customer->id !== auth()->user()->customer->id) {
            throw new AccessDeniedHttpException('You are not authorized to access this resource.');
        }

        return $next($request);
    }
}
