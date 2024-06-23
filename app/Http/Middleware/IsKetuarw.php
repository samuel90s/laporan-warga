<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsKetuarw
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

            // Allow access for 'ketuarw', 'admin', or 'petugas' roles
            if (in_array($userRoles, ['ketuarw', 'admin', 'petugas'])) {
                return $next($request);
            }
        }

        return redirect()->route('admin.masuk');
    }
}
