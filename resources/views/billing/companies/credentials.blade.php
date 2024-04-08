<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Credenciales API',
    ]
]">

    <form action="{{route('billing.companies.credentials', $company)}}" method="POST">

        @csrf

        <x-wire-card>

            <div class="mb-4">
                <x-wire-input label="Usuario Sol secundario" 
                    name="user_sol" :value="old('user_sol', $company->user_sol)" 
                    placeholder="Ingrese su usuario sol secundario" />
            </div>

            <div class="mb-8">
                <x-wire-input label="Clave Sol" 
                    name="password_sol" 
                    :value="old('password_sol', $company->password_sol)" 
                    placeholder="Ingrese su clave sol" />
            </div>

            <div class="flex justify-end items-center">
                <x-button>
                    Actualizar
                </x-button>
            </div>

        </x-wire-card>

    </form>

</x-billing-layout>