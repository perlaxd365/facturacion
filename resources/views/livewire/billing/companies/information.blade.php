<form wire:submit.prevent="store">

    {{-- Imagen cuadrada --}}
    <div>
        <h2 class="text-lg font-semibold mb-2">Logotipo cuadrado</h2>

        <div class="md:flex">

            <img class="h-24 w-24 object-cover object-center shadow" 
                src="{{ $square_image ? $square_image->temporaryUrl() : $company->square_image }}">

            <div class="ml-3 hidden lg:block">
                <p class="text-lg font-semibold">Logo en formato cuadrado</p>
                <p class="text-sm">Tamaño sugerido: 150 x 150 px</p>
            </div>

            <div class="ml-auto mt-4 md:mt-0">
                <label class="btn btn-gray">
 
                    <i class="fa-solid fa-upload mr-2"></i>
                    <span>
                        Subir logo
                    </span>

                    <input class="hidden" wire:model="square_image" name="square_image" type="file" accept="image/*">
                </label>
            </div>
        </div>
    </div>

    <hr class="my-6">

    {{$company->rectangle_image}}

    {{-- Imagen rectangular --}}
    <div>
        <h2 class="text-lg font-semibold mb-2">Logotipo rectangulo</h2>

        <div class="md:flex">
            
            <div>
                <img class="w-[210px] h-[100.2px] lg:w-[350px] lg:h-[167px] object-contain object-center shadow" 
                src="{{ $rectangle_image ? $rectangle_image->temporaryUrl() : $company->rectangle_image }}" alt="">
            </div>

            <div class="ml-3 hidden lg:block">
                <p class="text-lg font-semibold">Logo en formato cuadrado</p>
                <p class="text-sm">Tamaño sugerido: 350 x 167 px</p>
            </div>

            <div class="ml-auto mt-4 md:mt-0">
            
                <label class="btn btn-gray">
                    <i class="fa-solid fa-upload mr-2"></i>
                    
                    <span>Subir logo</span>

                    <input class="hidden" wire:model="rectangle_image" type="file" accept="image/*">

                </label>

            </div>
        </div>
    </div>

    <hr class="my-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <x-wire-input label="RUC" 
            wire:model.defer="company.ruc"
            placeholder="Ingrese el RUC de la empresa" />
        
        <x-wire-input label="Razon social" 
            wire:model.defer="company.razonSocial" 
            placeholder="Ingrese la razón social de la empresa" />
        
        <x-wire-input label="Nombre comercial" 
            wire:model.defer="company.nombreComercial"
            placeholder="Ingrese el nombre comercial de la empresa" />
        
        <div class="col-span-3">
            <x-wire-input label="Dirección" 
            wire:model.defer="address.direccion" 
            placeholder="Ingrese la dirección de la empresa" />
        </div>

        <x-wire-select
            wire:model="address.department_id"
            label="Buscar departamento"
            placeholder="Seleccione un departamento"
            :async-data="route('api.departments')"
            option-label="name"
            option-value="id"
        />

        <x-wire-select
            wire:model="address.province_id"
            label="Buscar provincia"
            placeholder="Seleccione una provincia"
            :async-data="[
                'api' => route('api.provinces'),
                'params' => ['department_id' => $address->department_id]
            ]"
            option-label="name"
            option-value="id"
        />
        
        <x-wire-select
            wire:model="address.district_id"
            label="Buscar distrito"
            placeholder="Seleccione un distrito"
            :async-data="[
                'api' => route('api.districts'),
                'params' => ['province_id' => $address->province_id]
            ]"
            option-label="name"
            option-value="id"
        />

        <x-wire-native-select 
            label="Regimen" 
            wire:model.defer="company.regimen">

            <option value="">Seleccione un regimen</option>

            @foreach (\App\Enums\Regimen::cases() as $case)
                <option value="{{$case->value}}">{{$case->name}}</option>
            @endforeach

        </x-wire-native-select>

    
        <x-wire-input 
            label="Telefono" 
            wire:model.defer="company.phone" 
            placeholder="Ingrese el telefono de la empresa" />

        <x-wire-input label="Email" 
            wire:model.defer="company.email" 
            placeholder="Ingrese el email de la empresa" />
        
    </div>
    
    <div class="flex justify-end mt-4">
        <x-wire-button dark type="sumbit" wire:target="store">
            Guardar
        </x-wire-button>
    </div>
</form>