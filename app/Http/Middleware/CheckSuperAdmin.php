<?php

namespace App\Http\Middleware;

use App\Models\SuperAdmin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
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

        $superAdmin = SuperAdmin::where('user_id', $user->id)->first();

        if ($superAdmin != null) {
            return $next($request);
        }

        return redirect('/');
    }
}
