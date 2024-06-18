<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsPetugas
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
        if (Auth::guard('admin')->check()) {
            $userRoles = Auth::guard('admin')->user()->roles;

            if ($userRoles == 'petugas' || $userRoles == 'admin' || $userRoles == 'ketuarw') {
                return $next($request);
            }
        }

        return redirect()->route('admin.login');
    }
}
