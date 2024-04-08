<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCompanyApiCredentials
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $company = $request->company;
        if($company->client_id == null || $company->client_secret == null){

            session()->flash('flash.sweetAlert', [
                'icon' => 'warning',
                'title' => 'Agregar api credenciales',
                'text' => 'Para poder emitir guías debes agregar las api credenciales proporcionado por SUNAT.',
            ]);

            return redirect()->route('billing.companies.api-credentials', $request->company);
        }

        return $next($request);
    }
}
