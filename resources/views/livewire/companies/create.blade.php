<form wire:submit.prevent="store">
    <div class="space-y-4">
        <x-wire-input wire:model.defer="company.domain"
            label="Dominio" 
            placeholder="Ejemplo: midominio-123"
            hint="El dominio que elija será con el que accederá al sistema. Utiliza únicamente caracteres alfanuméricos y guiones (-)." />

        <x-wire-native-select 
            wire:model.defer="company.regimen" 
            label="Regimen" >

            <option value="">Seleccione un regimen</option>

            @foreach (\App\Enums\Regimen::cases() as $case)
                <option value="{{$case->value}}" @selected(old('regimen') == $case->value)>{{$case->name}}</option>
            @endforeach

        </x-wire-native-select>

        {{-- <x-wire-input 
            wire:model.defer="company.ruc"
            label="RUC"
            placeholder="Ingrese el RUC de la empresa" /> --}}
        <x-wire-input
            wire:model.defer="company.ruc"
            label="RUC"
            placeholder="Ingrese el RUC de la empresa"
            type="number"
            maxlength="11">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-wire-button
                        class="rounded-r-md"
                        icon="search"
                        primary
                        wire:click="searchRuc"
                    />
                </div>
            </x-slot>
        </x-wire-input>

        <x-wire-input 
            wire:model.defer="company.razonSocial"
            label="Razon social"
            placeholder="Ingrese la razón social de la empresa" />

        <x-wire-input 
            label="Nombre comercial"
            wire:model.defer="company.nombreComercial"
            placeholder="Ingrese el nombre comercial de la empresa" />

        <x-wire-input label="Dirección" 
            wire:model.defer="address.direccion" 
            placeholder="Ingrese la dirección de la empresa" />

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
                'params' => ['department_id' => $address['department_id']]
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
                'params' => ['province_id' => $address['province_id']]
            ]"
            option-label="name"
            option-value="id"
        />

        <div class="flex justify-end">
            <x-wire-button type="submit" dark>
                Guardar
            </x-wire-button>
        </div>

        {{-- <pre><code>{{ json_encode($company, JSON_PRETTY_PRINT) }}</code></pre> --}}
    </div>
</form>