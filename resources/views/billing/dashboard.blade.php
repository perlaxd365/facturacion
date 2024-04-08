<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Dashboard',
    ]
]">


    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <x-wire-card class="flex items-center">
            
            <x-wire-avatar lg :src="auth()->user()->profile_photo_url" />

            <div class="ml-4">
                <h2 class="text-lg font-semibold">
                    Bienvenido, {{ auth()->user()->name }}
                </h2>

                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="hover:text-blue-500 text-sm">
                        Cerrar sesión
                    </button>
                </form>
            </div>
            
        </x-wire-card>

        <x-wire-card class="flex flex-col items-center justify-center">

            <h2 class="text-xl font-semibold">
                {{ $company->nombreComercial }}
            </h2>

        </x-wire-card>

    </div>

</x-billing-layout>