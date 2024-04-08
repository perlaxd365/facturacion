<?php

namespace App\Http\Livewire\Companies;

use App\Enums\Regimen;
use App\Models\Company;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['provinceSelected', 'districtSelected'];

    public $company = [
        'domain' => '',
        'regimen' => '',
        'ruc' => '',
        'razonSocial' => '',
        'nombreComercial' => '',
    ];

    public $address = [
        'direccion' => '',
        'department_id' => null,
        'province_id' => null,
        'district_id' => null,
    ];

    public function updatedAddressDepartmentId(){
        $this->address['province_id'] = null;
        $this->address['district_id'] = null;
    }

    public function updatedAddressProvinceId(){
        $this->address['district_id'] = null;
    }

    public function searchRuc(){

        $sunat = new \jossmp\sunat\ruc([
            'representantes_legales' 	=> false,
            'cantidad_trabajadores' 	=> false,
            'establecimientos' 			=> false,
            'deuda' 					=> false,
        ]);
    
        $query = $sunat->consulta($this->company['ruc']);

        if ($query->success) {

            $this->company['razonSocial'] = $query->result->razon_social;
            $this->company['nombreComercial'] = $query->result->nombre_comercial;
            
            $department = Department::where('name', $query->result->departamento)->first();
            $province = Province::where('name', $query->result->provincia)->first();
            $district = District::where('name', $query->result->distrito)->first();

            $this->address['direccion'] = $query->result->direccion;
            $this->address['department_id'] = $department ? $department->id : null;

            $this->emit('provinceSelected', $province, $district);
        }
    }

    public function provinceSelected($province, $district){
        $this->address['province_id'] = $province ? $province['id'] : null;
        $this->emit('districtSelected', $district);
    }

    public function districtSelected($district){
        $this->address['district_id'] = $district ? $district['id'] : null;
    }

    public function store(){
        
        $this->validate([
            'company.domain' => ['required', 'regex:/^[a-z\d]+(-[a-z\d]+)*$/i', 'unique:companies,domain'],
            'company.regimen' => ['required', new Enum(Regimen::class)],
            'company.ruc' => ['required', new \App\Rules\ValidRuc],
            'company.razonSocial' => 'required',
            'company.nombreComercial' => 'required',
            'address.direccion' => 'required',
            'address.department_id' => 'required',
            'address.province_id' => 'required',
            'address.district_id' => 'required',
        ],[],[
            'company.domain' => 'dominio',
            'company.regimen' => 'régimen',
            'company.ruc' => 'RUC',
            'company.razonSocial' => 'razón social',
            'company.nombreComercial' => 'nombre comercial',
            'address.direccion' => 'dirección',
            'address.department_id' => 'departamento',
            'address.province_id' => 'provincia',
            'address.district_id' => 'distrito',
        ]);

        $company = Company::create($this->company);
        $company->address()->create($this->address);
        $company->users()->attach(auth()->id(), [
            'is_admin' => true,
        ]);

        $branch = $company->branches()->create([
            'name' => 'Principal',
        ]);

        $branch->address()->create($this->address);

        $branch->vouchers()->attach(1, ['serie' => 'F001', 'correlativo' => 1]);
        $branch->vouchers()->attach(2, ['serie' => 'B001', 'correlativo' => 1]);
        $branch->vouchers()->attach(3, ['serie' => 'FC01', 'correlativo' => 1]);
        $branch->vouchers()->attach(4, ['serie' => 'FD01', 'correlativo' => 1]);
        $branch->vouchers()->attach(5, ['serie' => 'BC01', 'correlativo' => 1]);
        $branch->vouchers()->attach(6, ['serie' => 'BD01', 'correlativo' => 1]);
        $branch->vouchers()->attach(7, ['serie' => 'T001', 'correlativo' => 1]);

        session()->flash('flash.banner', 'Empresa creada exitosamente.');

        return redirect()->route('companies.index');
    }

    public function render()
    {
        return view('livewire.companies.create');
    }
}
