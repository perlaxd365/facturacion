<x-billing-layout :company="$company"
:breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => route('billing.dashboard', $company),
    ],
    [
        'name' => $document->description,
    ]
]">

    @if (in_array($document->id, ['01', '03']))
        
        @livewire('billing.documents.invoice-create', compact('company', 'document'))
        
    @endif

    @if (in_array($document->id, ['07', '08']))
        
        @livewire('billing.documents.note-create', compact('company', 'document'))
        
    @endif

    @if (in_array($document->id, ['09']))
            
        @livewire('billing.documents.guide-create', ['company' => $company])
        
    @endif
    

</x-billing-layout>