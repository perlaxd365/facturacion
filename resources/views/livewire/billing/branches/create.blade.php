<div>

    <x-wire-card>

        <form wire:submit.prevent="save">

            <div class="grid lg:grid-cols-3 gap-6 mb-4">


                    <x-wire-input 
                        placeholder="Ingrese el código de la sucursal"
                        label="Código Establec. Anexo SUNAT:"
                        wire:model.defer="branch.code" />

                <div class="lg:col-span-2">

                    <x-wire-input
                        placeholder="Ingrese el nombre de la sucursal"
                        label="Nombre de Sucursal/Almacén" 
                        wire:model.defer="branch.name" />

                </div>

                <div class="lg:col-span-3">

                    <x-wire-input
                        placeholder="Ingrese la dirección de la sucursal"
                        label="Dirección" 
                        wire:model.defer="address.direccion" />

                </div>

                <x-wire-select 
                    label="Buscar departamento"
                    placeholder="Seleccione un departamento" 
                    wire:model="address.department_id" 
                    :async-data="route('api.departments')" 
                    option-label="name" 
                    option-value="id" />

                <x-wire-select
                    label="Buscar provincia"
                    placeholder="Seleccione una provincia"
                    wire:model="address.province_id" 
                    :async-data="[
                        'api' => route('api.provinces'),
                        'params' => ['department_id' => $address['department_id']],
                    ]" 
                    option-label="name" 
                    option-value="id" />

                <x-wire-select 
                    label="Buscar distrito"
                    placeholder="Seleccione un distrito" 
                    wire:model="address.district_id" 
                    :async-data="[
                        'api' => route('api.districts'),
                        'params' => ['province_id' => $address['province_id']],
                    ]" 
                    option-label="name" 
                    option-value="id" />

                <x-wire-input
                    label="Teléfono"
                    placeholder="Ingrese el teléfono de la sucursal"
                    wire:model.defer="branch.phone" />

                <x-wire-input
                    label="Correo Electrónico"
                    placeholder="Ingrese el email de la sucursal"
                    wire:model.defer="branch.email" />

                <x-wire-input 
                    label="Página Web" 
                    placeholder="Ingrese el sitio web de la sucursal"
                    wire:model.defer="branch.website" />


            </div>

            <div class="flex justify-end">

                <x-wire-button type="submit" dark wire:target="save">
                    Agregar Sucursal
                </x-wire-button>
            </div>

        </form>

    </x-wire-card>

</div>