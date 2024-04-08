<?php

namespace App\Http\Livewire\Billing\Branches;

use Livewire\Component;

class Create extends Component
{
    public $company;

    public $branch = [
        'name' => '',
        'code' => '',
        'phone' => '',
        'email' => '',
        'website' => '',
    ];

    public $address = [
        'department_id' => '',
        'province_id' => null,
        'district_id' => null,
        'direccion' => null,
    ];

    public function updatedAddressDepartmentId(){
        $this->address['province_id'] = null;
        $this->address['district_id'] = null;
    }

    public function updatedAddressProvinceId(){
        $this->address['district_id'] = null;
    }

    public function save()
    {
        $this->validate([
            'branch.name' => 'required',
            'branch.code' => 'required',
            'branch.phone' => 'nullable',
            'branch.email' => 'nullable',
            'branch.website' => 'nullable',

            'address.department_id' => 'required',
            'address.province_id' => 'required',
            'address.district_id' => 'required',
            'address.direccion' => 'required',
        ]);

        $branch = $this->company->branches()->create($this->branch);

        $branch->address()->create($this->address);

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Sucursal creada correctamente.',
        ]);

        return redirect()->route('billing.branches.edit', [$this->company, $branch]);
    }

    public function render()
    {
        return view('livewire.billing.branches.create');
    }
}
