<?php

namespace App\Http\Livewire\Billing\Branches;

use Livewire\Component;

class Edit extends Component
{

    public $branch, $address;

    protected $rules = [
        'branch.name' => 'required',
        'branch.code' => 'required',
        'branch.phone' => 'nullable',
        'branch.email' => 'nullable',
        'branch.website' => 'nullable',

        'address.department_id' => 'required',
        'address.province_id' => 'required',
        'address.district_id' => 'required',
        'address.direccion' => 'required',
    ];

    public function mount($branch)
    {
        $this->branch = $branch;
        $this->address = $branch->address;
    }

    public function updatedAddressDepartmentId(){
        $this->address->province_id = null;
        $this->address->district_id = null;
    }

    public function updatedAddressProvinceId(){
        $this->address->district_id = null;
    }

    public function save(){
        $this->validate();
        
        $this->branch->save();
        $this->address->save();

        $this->emit('sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La sucursal se actualizó correctamente.'
        ]);
    }

    public function render()
    {
        return view('livewire.billing.branches.edit');
    }
}
