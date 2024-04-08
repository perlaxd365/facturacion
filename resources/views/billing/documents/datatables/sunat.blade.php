<div>

    @if ($value)

        <button wire:click="showDetail({{$row->id}})"
            class="flex items-center space-x-2">

            @if ($row->sunat_success)
                
                <x-wire-icon name="check-circle" class="w-6 h-6 text-green-500" solid />
                <x-wire-icon name="chevron-down" class="w-3 h-3 text-green-500" />

            @else
                
                <x-wire-icon name="x-circle" class="w-6 h-6 text-red-500" solid />
                <x-wire-icon name="chevron-down" class="w-3 h-3 text-red-500" />

            @endif

        </button>

    @else
        <button wire:click="sendSunat({{$row->id}})">
            <img class='h-6' src='/img/vouchers/get_cdr.svg'/>
        </button>
    @endif

</div>