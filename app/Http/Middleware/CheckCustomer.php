<?php

namespace App\Http\Middleware;

use App\Models\Customer;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user();

        $customer = Customer::where('user_id', $user->id)->first();

        if ($customer != null) {
            return $next($request);
        }

        return redirect('/');
    }
}
