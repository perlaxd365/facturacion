<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Crear sucursal',
    ]
]">


    @livewire('billing.branches.create', ['company' => $company])
    {{-- <x-wire-card>

        <form action="{{route('billing.branches.store', $company)}}" method="POST">
            @csrf

            <div class="grid lg:grid-cols-3 gap-6 mb-4">

                <div>

                    <x-wire-input label="Código Establec. Anexo SUNAT:"
                        name="code" 
                        placeholder="Ingrese el código de la sucursal"
                        value="{{old('code')}}" />

                </div>

                <div class="lg:col-span-2">

                    <x-wire-input label="Nombre de Sucursal/Almacén"
                        name="name"
                        placeholder="Ingrese el nombre de la sucursal"
                        value="{{old('name')}}" />
                    
                </div>

                <div class="lg:col-span-3">

                    <x-wire-input label="Dirección"
                        name="direccion"
                        placeholder="Ingrese la dirección de la sucursal"
                        value="{{old('direccion')}}" />

                </div>

                <div>
                    <x-wire-input label="Departamento"
                        name="departamento" 
                        placeholder="Ingrese el departamento de la sucursal"
                        value="{{old('departamento')}}" />
                </div>

                <div>
                    <x-wire-input label="Provincia"
                        name="provincia" 
                        placeholder="Ingrese la provincia de la sucursal"
                        value="{{old('provincia')}}" />
                </div>

                <div>
                    <x-wire-input label="Distrito"
                        name="distrito" 
                        placeholder="Ingrese el distrito de la sucursal"
                        value="{{old('distrito')}}" />
                </div>

                <div>
                    <x-wire-input label="Teléfono"
                        name="phone" 
                        placeholder="Ingrese el teléfono de la sucursal"
                        value="{{old('phone')}}" />
                </div>

                <div>
                    <x-wire-input label="Email"
                        name="email"
                        placeholder="Ingrese el email de la sucursal"
                        value="{{old('email')}}" />
                </div>

                <div>
                    <x-wire-input label="Sitio web"
                        name="website" 
                        placeholder="Ingrese el sitio web de la sucursal"
                        value="{{old('website')}}" />
                </div>

            </div>

            <div class="flex justify-end items-center">
                <x-button type="submit">
                    Actualizar
                </x-button>
            </div>
        </form>

    </x-wire-card> --}}

</x-billing-layout>