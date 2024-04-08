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
        <x-wire-icon name="x" class="w-6 h-6 text-red-500" solid />
        Error al Enviar a SUNAT
    </div>

    <div class="flex justify-between">
        Código:
        <x-wire-badge primary :label="$invoice->cdr_code" />
    </div>

    <div class="whitespace-normal">
        {!!$invoice->sunat_error['message']!!}
    </div>
</div>