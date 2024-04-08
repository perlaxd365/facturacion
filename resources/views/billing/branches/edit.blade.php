<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => 'Sucursales',
        'url' => route('billing.branches.index', $company),
    ],
    [
        'name' => $branch->name,
    ]
]">

    <div class="mb-4">
        @livewire('billing.branches.edit', ['branch' => $branch])
    </div>

    @livewire('billing.branches.vouchers', [
        'company' => $company,
        'branch' => $branch
    ])

</x-billing-layout>