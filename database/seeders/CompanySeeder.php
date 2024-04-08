<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file_get_contents(public_path('certificate\LLAMA-PE-CERTIFICADO-DEMO-20609278235.pfx'));

        $results = [];
        openssl_pkcs12_read($file, $results, '12345678');
        $certificate = $results['pkey'] . $results['cert'];
        $path = 'certificates/certificate_1.pem';
        Storage::put($path, $certificate);

        $sunat = new \jossmp\sunat\ruc([
            'representantes_legales' 	=> false,
            'cantidad_trabajadores' 	=> false,
            'establecimientos' 			=> false,
            'deuda' 					=> false,
        ]);

        $query = $sunat->consulta("20609278235");

        $company = Company::create([
            'domain' => 'codersfree',
            'regimen' => \App\Enums\Regimen::Mype,
            'ruc' => '20609278235',
            'razonSocial' => $query->result->razon_social,
            'nombreComercial' => $query->result->nombre_comercial,
            'phone' => '987601368',
            'email' => 'victor@codersfree.com',
            'user_sol' => '47159103',
            'password_sol' => '123456789',
            'client_id' => '5cb30fab-ec3a-4c16-9f33-829370be98fb',
            'client_secret' => '+qT3iwPK0KnGzz6bAi4rxQ==',
            'certificate' => $certificate,
            'certificate_path' => $path,
        ]);

        $department = \App\Models\Department::where('name', $query->result->departamento)->first();
        $province = \App\Models\Province::where('name', $query->result->provincia)->first();
        $district = \App\Models\District::where('name', $query->result->distrito)->first();

        $company->address()->create([
            'department_id' => $department->id,
            'province_id' => $province->id,
            'district_id' => $district->id,
            'direccion' => $query->result->direccion,
        ]);

        $branch = $company->branches()->create([
            'name' => 'Principal',
        ]);

        $branch->address()->create([
            'department_id' => $department->id,
            'province_id' => $province->id,
            'district_id' => $district->id,
            'direccion' => $query->result->direccion,
        ]);

        $branch->vouchers()->attach(1, ['serie' => 'F001', 'correlativo' => 1]);
        $branch->vouchers()->attach(2, ['serie' => 'B001', 'correlativo' => 1]);
        $branch->vouchers()->attach(3, ['serie' => 'FC01', 'correlativo' => 1]);
        $branch->vouchers()->attach(4, ['serie' => 'FD01', 'correlativo' => 1]);
        $branch->vouchers()->attach(5, ['serie' => 'BC01', 'correlativo' => 1]);
        $branch->vouchers()->attach(6, ['serie' => 'BD01', 'correlativo' => 1]);
        $branch->vouchers()->attach(7, ['serie' => 'T001', 'correlativo' => 1]);

        $company->users()->attach(1, [
            'is_admin' => true,
        ]);
    }
}
