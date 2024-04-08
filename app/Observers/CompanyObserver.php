<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class CompanyObserver
{
    public function created(Company $company){

        $certificate = file_get_contents('certificate/LLAMA-PE-CERTIFICADO-DEMO.pem');
        
        $name = 'certificate_' . $company->id . '.pem';
        $path = 'certificates/' . $name;
        
        Storage::put($path, $certificate);

        $company->user_sol = 'MODDATOS';
        $company->password_sol = 'MODDATOS';
        $company->client_id = 'test-85e5b0ae-255c-4891-a595-0b98c65c9854';
        $company->client_secret = 'test-Hty/M6QshYvPgItX2P0+Kw==';
        $company->certificate = $certificate;
        $company->certificate_path = $path;

        $company->save();

    }
}
