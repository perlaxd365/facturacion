<?php

namespace App\Http\Controllers\Billing;

use App\Enums\Regimen;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;

class CompanyController extends Controller
{
    public function information(Company $company)
    {
        return view('billing.companies.information', compact('company'));
    }

    public function credentials(Company $company)
    {
        return view('billing.companies.credentials', compact('company'));
    }

    public function credentialsStore(Request $request, Company $company){

        $data = $request->validate([
            'user_sol' => 'required',
            'password_sol' => 'required',
        ]);

        $company->update($data);

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Credenciales actualizadas correctamente.',
        ]);

        return redirect()->route('billing.companies.credentials', $company);

    }

    public function apiCredentials(Company $company){
        return view('billing.companies.api-credentials', compact('company'));
    }

    public function apiCredentialsStore(Request $request, Company $company){

        $data = $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
        ]);

        $company->update($data);

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Credenciales actualizadas correctamente.',
        ]);

        return redirect()->route('billing.companies.api-credentials', $company);

    }

    public function certificate(Company $company){
        return view('billing.companies.certificate', compact('company'));
    }

    public function certificateStore(Request $request, Company $company){

        $request->validate([
            'certificate' => 'required|file|mimes:pem,txt',
        ]);
            
        $name = 'certificate_' . $company->id . '.pem';
        $path = 'certificates/' . $name;

        /* Storage::put($path, $request->certificate); */

        Storage::putFileAs('certificates', $request->certificate, $name, 'public');

        $company->update([
            'certificate' => $request->certificate->get(),
            'certificate_path' => $path
        ]);

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Certificado actualizado correctamente.',
        ]);

        return redirect()->route('billing.companies.certificate', $company);
    }
}
