<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCompanyCertificate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $company = $request->company;

        if($company->certificate == null || $company->certificate_path == null){

            session()->flash('flash.sweetAlert', [
                'icon' => 'warning',
                'title' => 'Agregar certificado',
                'text' => 'Para poder facturar con esta empresa, debes agregar el certificado digital.',
            ]);

            return redirect()->route('billing.companies.certificate', $request->company);
        }

        return $next($request);
    }
}
