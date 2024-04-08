<?php

namespace App\Http\Livewire\Billing\Companies;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithFileUploads;

class Information extends Component
{
    use WithFileUploads;

    public $company, $address;
    public $square_image, $rectangle_image;

    protected $rules = [

        'square_image' => 'nullable|image',
        'rectangle_image' => 'nullable|image',

        'company.ruc' => ['required'],
        'company.razonSocial' => 'required',
        'company.nombreComercial' => 'required',
        'company.regimen' => ['required'],
        'company.phone' => 'nullable',
        'company.email' => 'nullable|email',
        
        'address.department_id' => 'required',
        'address.province_id' => 'required',
        'address.district_id' => 'required',
        'address.direccion' => 'required',
    ];

    //Ciclo de vida
    public function mount()
    {
        $this->address = $this->company->address;
    }

    public function updatedAddressDepartmentId(){
        $this->address->province_id = null;
        $this->address->district_id = null;
    }

    public function updatedAddressProvinceId(){
        $this->address->district_id = null;
    }

    public function store()
    {
        $rules = $this->rules;
        $rules['company.ruc'][] = new \App\Rules\ValidRuc;
        $rules['company.regimen'][] = new Enum(\App\Enums\Regimen::class);

        $this->validate($rules);

        if ($this->square_image) {
            
            if ($this->company->square_image_path) {
                Storage::delete($this->company->square_image_path);
            }

            $this->company->square_image_path = $this->square_image->store('companies');

        }

        if ($this->rectangle_image) {
            
            if ($this->company->rectangle_image_path) {
                Storage::delete($this->company->rectangle_image_path);
            }

            $this->company->rectangle_image_path = $this->rectangle_image->store('companies');

        }

        $this->company->save();
        $this->address->save();

        $this->emit('sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Información actualizada correctamente.'
        ]);

    }

    public function render()
    {
        return view('livewire.billing.companies.information');
    }
}
