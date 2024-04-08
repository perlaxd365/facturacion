<div class="w-full text-xl space-y-5">
    <div class="flex justify-between">
    
        {{ match ($invoice->tipoDoc) {
            '01' => 'Factura',
            '03' => 'Boleta',
            '07' => 'Nota de crédito',
            '08' => 'Nota de débito',
            default => 'Otro',
        } }}
        <x-wire-badge primary :label="$invoice->serie . '-' . $invoice->correlativo" />

    </div>

    <div class="flex">
        <x-wire-icon name="check" class="w-6 h-6 text-green-500 mr-2" solid />
        Enviado a SUNAT
    </div>

    <div class="flex justify-between">
        Estado:

        @if ($invoice->cdr_code == '0')
            <x-wire-badge primary label="ACEPTADO" />
        @elseif ($invoice->cdr_code >= 2000 && $invoice->cdr_code <= 3999)
            <x-wire-badge danger label="RECHAZADO" />
        @else
            <x-wire-badge warning label="EXCEPCIÓN" />
        @endif
    </div>

    <div class="flex justify-between">
        Código:
        <x-wire-badge primary :label="$invoice->cdr_code" />
    </div>

    <div class="whitespace-normal">
        Descripción:
        {{ $invoice->cdr_description }}
    </div>

    @if ($invoice->cdr_notes)

        <div class="whitespace-normal bg-red-100">
            <div class="w-full">
                <p class="font-semibold">Observaciones:</p>
                <p class="font-semibold py-2">(Corregir estas observaciones en siguientes emisiones)</p>
                <ul>
                    @foreach ($invoice->cdr_notes as $note)
                        <li>{{ $note }}</li>
                    @endforeach
                </ul>
            </div>

        </div>

    @endif
</div>