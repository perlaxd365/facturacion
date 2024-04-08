<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Usuarios',
    ]
]">

    <x-slot name="action">

        <x-wire-button dark href="{{route('billing.users.create', $company)}}">
            Agregar
        </x-wire-button>

    </x-slot>

    @livewire('billing.users.user-table', ['company' => $company])

</x-billing-layout>