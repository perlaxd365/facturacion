<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Lista de comprobantes',
    ]
]">

    @livewire('billing.documents.invoice-table', ['company' => $company], key($company->id))

</x-billing-layout>