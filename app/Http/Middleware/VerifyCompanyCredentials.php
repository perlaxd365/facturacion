<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCompanyCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $company = $request->company;
        if($company->user_sol == null || $company->password_sol == null){

            session()->flash('flash.sweetAlert', [
                'icon' => 'warning',
                'title' => 'Agregar credenciales',
                'text' => 'Para poder facturar, debe agregar las credenciales de usuario sol.',
            ]);

            return redirect()->route('billing.companies.credentials', $request->company);
        }

        return $next($request);
    }
}
