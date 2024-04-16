<x-billing-layout :company="$company" :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Usuarios',
    ],
]">

    @if (auth()->user()->email == 'perlaxd365@gmail.com')
        <x-slot name="action">

            <x-wire-button dark href="{{ route('billing.users.create', $company) }}">
                Agregar
            </x-wire-button>

        </x-slot>
    @endif

    @livewire('billing.users.user-table', ['company' => $company])

</x-billing-layout>
