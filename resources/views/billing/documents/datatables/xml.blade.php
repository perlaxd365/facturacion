<div>
    @if ($value)
        <button wire:click="downloadXML({{$row->id}})">
            <img class='h-6' src='/img/vouchers/xml_cpe.svg'/>
        </button>
    @else
        <button wire:click="generateXml({{$row->id}})">
            <img class='h-6' src='/img/vouchers/get_cdr.svg'/>
        </button>
    @endif
</div>