<div>
    @if ($value)
        <button wire:click="downloadCDR({{$row->id}})">
            <img class='h-6' src='/img/vouchers/xml_cdr.svg'/>
        </button>
    @else
        <button wire:click="sendSunat({{$row->id}})">
            <img class='h-6' src='/img/vouchers/get_cdr.svg'/>
        </button>
    @endif
</div>