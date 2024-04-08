<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Agregar Usuario',
    ]
]">


    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush


    <x-wire-card x-data="{
        'userExists': {{old('userExists', 1)}},
        'is_admin': {{old('is_admin', 1)}}
    }">

        <form action="{{route('billing.users.store', $company)}}" method="POST">

            @csrf

            <div class="mb-4">
                <x-label class="mb-2">
                    ¿El usuario que agregará ya se encuentra registrado?
                </x-label>

                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" 
                            value="1" 
                            x-model="userExists" 
                            name="userExists" 
                            class="mr-1">
                        Sí
                    </label>

                    <label class="inline-flex items-center">
                        <input type="radio" 
                        value="0" 
                        x-model="userExists" 
                        name="userExists" 
                        class="mr-1">
                        No
                    </label>
                </div>
            </div>

            <div x-show="userExists == 1" class="mb-4">

                <x-wire-select
                    label="Usuario"
                    name="user_id"
                    placeholder="Seleccione algun usuario"
                    :async-data="[
                        'api' => route('api.users'),
                        'params' => [
                            'company_id' => $company->id,
                        ],
                    ]"
                    option-label="name"
                    option-value="id"
                />
            </div>
            
            <div x-show="userExists == 0" 
                style="display: none" 
                class="grid grid-cols-2 gap-6 mb-4">

                {{-- Nombre --}}
                <div>

                    <x-wire-input 
                        label="Nombre"
                        name="name" 
                        value="{{old('name')}}"
                        placeholder="Escribe el nombre del usuario" />

                </div>

                {{-- Email --}}
                <div>

                    <x-wire-input 
                        label="Email"
                        name="email" 
                        type="email" 
                        value="{{old('email')}}"
                        placeholder="Escribe el email del usuario" />

                </div>

                {{-- Contraseña --}}
                <div>

                    <x-wire-inputs.password
                        label="Contraseña"
                        name="password" 
                        type="password" 
                        placeholder="Escribe la contraseña del usuario" />

                </div>

                {{-- Confirmar Contraseña --}}
                <div>

                    <x-wire-inputs.password
                        label="Confirmar Contraseña"
                        name="password_confirmation" 
                        type="password" 
                        placeholder="Confirma la contraseña del usuario" />

                </div>

            </div>
            
            <div class="mb-4">

                <x-wire-native-select
                    label="Rol"
                    name="is_admin" 
                    x-model="is_admin">

                    <option value="1">Administrador</option>
                    <option value="0">Colaborador</option>

                </x-wire-native-select>
            </div>

            <template x-if="is_admin == 0">
                <div class="mb-4">
                    <x-wire-label class="mb-1">
                        Sucursales
                    </x-wire-label>

                    @foreach ($branches as $branch)

                        <div class="flex items-center space-x-2">
                            <x-checkbox name="branches[]" 
                                :value="$branch->id" 
                                :id="'branch-' . $branch->id"
                                :checked="in_array($branch->id, old('branches', []))" />

                            <label for="{{'branch-' . $branch->id}}">
                                {{$branch->name}}
                            </label>
                        </div>

                    @endforeach

                </div>
            </template>
            
            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>

        </form>

    </x-wire-card>

</x-billing-layout>