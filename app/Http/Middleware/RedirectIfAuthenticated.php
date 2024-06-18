<?php
namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 'admin') {
                return redirect()->route('dashboard');
            } elseif ($user->role == 'petugas') {
                return redirect()->route('dashboard');
            } elseif ($user->role == 'masyarakat') {
                return redirect('/home'); // Or any other route for 'masyarakat' users
            }
        }

        return $next($request);
    }
}
