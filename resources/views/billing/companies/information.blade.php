<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Información',
    ]
]">

    <x-wire-card>

        <div class="p-4">

            @livewire('billing.companies.information', ['company' => $company], key($company->id))

        </div>

    </x-wire-card>

</x-billing-layout>