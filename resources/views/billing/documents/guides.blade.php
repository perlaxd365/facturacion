<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Guías de remisión',
    ]
]">

    @livewire('billing.documents.guide-table', ['company' => $company], key($company->id))

</x-billing-layout>