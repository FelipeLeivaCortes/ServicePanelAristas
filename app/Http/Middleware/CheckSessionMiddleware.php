<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CheckSessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (is_null(Auth::user())) {
            return redirect()->route('login');
        }
     
        $user   = User::find(Auth::user()->id);
        
        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        if( $user->is_active == User::DISABLED ){
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('login')->with('error', 'La cuenta de tu usuario se encuentra deshabilitada. Comunícate con el administrador');
        }

        $company    = $user->branches[0]->company;
        
        if (!$company->isValidLicense()) {
            session()->invalidate();
            session()->regenerateToken();

            return redirect()->route('login')->with('error', 'La licencia de su empresa se encuentra vencida. Comuniquese con el administrador');
        }
        
        return $next($request);
    }
}