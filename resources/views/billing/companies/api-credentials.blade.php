<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Credenciales',
    ]
]">

    <form action="{{route('billing.companies.api-credentials.store', $company)}}" method="POST">
        @csrf

        <x-wire-card>

            <div class="mb-4">
                <x-wire-input label="Cliente id" 
                    name="client_id" 
                    :value="old('client_id', $company->client_id)" 
                    placeholder="Ingrese su cliente ID" />
            </div>

            <div class="mb-4">
                <x-wire-input label="Cliente secret" 
                    name="client_secret" 
                    :value="old('client_secret', $company->client_secret)" 
                    placeholder="Ingrese su cliente secret" />
            </div>

            <div class="flex justify-end items-center">
                <x-button>
                    Actualizar
                </x-button>
            </div>

        </x-wire-card>
    </form>

</x-billing-layout>