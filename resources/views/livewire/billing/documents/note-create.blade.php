<div>

    @empty($invoice['serie'])
        
        @if ($branches->count() == 0)

            <h1 class="text-center text-2xl font-semibold text-gray-700">¡Ups! Parece que no tiene ninguna serie agregada para este tipo de documento</h1>
            
            <div class="flex justify-center">
                <img src="{{asset('img/no-funciona.svg')}}" alt="" class="max-w-sm">
            </div>

            <div class="mt-4">
                <x-wire-button primary>
                    Agregar una serie
                </x-wire-button>
            </div>

        @else

            <x-wire-card>

                <div class="mb-4">

                    <x-wire-native-select label="Sucursal" wire:model="invoice.branch_id">

                        <option value="" disabled selected>Seleccione una sucursal</option>

                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach

                    </x-wire-native-select>

                </div>

                <div class="flex justify-end">
                    <x-wire-button dark wire:click="startInvoice">
                        Continuar
                    </x-wire-button>
                </div>

            </x-wire-card>
            
        @endif

    @else


        {{-- Datos de la factura --}}
        <div class="mb-6">
            <div class="grid lg:grid-cols-6 lg:items-center gap-4">

                {{-- Serie y correlativo --}}
                <div class="lg:col-span-2 lg:order-2">

                    <div class="border-2 border-gray-600 border-dashed p-4">

                        <p class="text-center font-semibold mb-2">R.U.C. N° {{ $company->ruc }}</p>

                        <p class="text-center font-semibold uppercase mb-2">
                            {{ $this->document->description }} ELECTRÓNICA
                        </p>
                        
                        <div class="flex justify-center items-center">

                            <x-wire-input value="{{ $invoice['serie'] }}" 
                                class="text-center cursor-default"
                                disabled
                                readonly 
                                onfocus="this.blur()" />

                            <span class="mx-2">-</span>

                            <x-wire-input value="{{ str_pad($invoice['correlativo'], 8, '0', STR_PAD_LEFT) }}"
                                class="text-center cursor-default"
                                disabled
                                readonly 
                                onfocus="this.blur()" />
                        </div>

                    </div>

                </div>

                {{-- Información de la empresa --}}
                <div class="lg:col-span-4 lg:order-1">

                    <div class="lg:flex lg:items-center">

                        <div class="lg:order-2 lg:flex-1">

                            <p class="text-lg lg:text-2xl text-center lg:text-left font-semibold mb-2">
                                {{ $company->razonSocial }}
                            </p>

                            <p class="text-center lg:text-left">{{ $company->address->direccion }}</p>
                        </div>

                        <div class="lg:order-1 lg:mr-4 lg:flex-shrink-0">
                            <div class="flex justify-center mt-4 lg:mt-0">
                                <img src="{{ $company->squareImage }}" class="w-36" alt="">
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        {{-- Cliente --}}
        <div class="grid gap-4 lg:grid-cols-6 mb-4">

            {{-- Razon social --}}
            <div class="lg:col-span-3">
                <x-wire-input placeholder="Cliente" 
                    icon="user" 
                    wire:model.defer="invoice.client.rznSocial" />
            </div>

            {{-- Documento de identidad --}}
            <div class="lg:col-span-3">
                <div class="flex">

                    {{-- Tipo de documento --}}
                    <div class="w-64">
                        <x-wire-select class="mr-2" 
                            wire:model.defer="invoice.client.tipoDoc" 
                            placeholder="Tipo de documento"
                            :async-data="[
                                'api' => route('api.identities'),
                            ]" 
                            option-label="name" 
                            option-value="id" />
                    </div>

                    {{-- Numero de documento --}}
                    <div class="flex-1">
                        <x-wire-input placeholder="Documento"
                        wire:model.defer="invoice.client.numDoc" />
                    </div>
                </div>
            </div>

            {{-- Dirección --}}
            <div class="lg:col-span-6">
                <x-wire-input placeholder="Dirección"
                    icon="home"
                    wire:model.defer="invoice.client.address.direccion" />
            </div>
        </div>

        {{-- Datos de factura --}}
        <div class="grid gap-4 lg:grid-cols-6 mb-16">
            
            <div class="lg:col-span-6 grid gap-4 lg:grid-cols-2">

                <div>
                    
                    <x-wire-native-select 
                        label="Tipo doc. afectado" 
                        wire:model="voucher_id">

                        @foreach ($vouchers as $voucher)
                            
                            <option value="{{$voucher->id}}">

                                @if (in_array($voucher->id, [3, 4]))
                                    Factura
                                @endif

                                @if (in_array($voucher->id, [5, 6]))
                                    Boleta
                                @endif

                            </option>
                
                        @endforeach
                
                    </x-wire-native-select>
                </div>

                {{-- Fecha de emisión --}}
                <div>
                    <x-wire-input label="F. de Emisión" placeholder="Fecha de emisión" type="date"
                        max="{{ date('Y-m-d') }}" min="{{ date('Y-m-d', strtotime('-3 days')) }}"
                        wire:model.defer="invoice.fechaEmision" />
                </div>

            </div>

            {{-- Anulación de la operación --}}
            <div class="lg:col-span-4">
                <x-wire-select 
                    wire:model="invoice.codMotivo" 
                    placeholder="Seleccione un motivo" 
                    :async-data="[
                        'api' => $invoice['tipoDoc'] == '07' ? route('api.credit-note-types') : route('api.debit-note-types'),
                    ]"
                    option-label="name"
                    option-value="code" />
            </div>

            {{-- Tipo de moneda --}}
            <div class="lg:col-span-2">
                <x-wire-select 
                    placeholder="Seleccione una moneda"
                    wire:model.defer="invoice.tipoMoneda"
                    :async-data="route('api.currencies')"
                    option-label="name" 
                    option-value="id" />
            </div>

            {{-- Documento que modifica --}}
            <div class="lg:col-span-6">

                <div class="flex justify-center space-x-4">
                    <span class="text-sm mt-2">
                        Documento que modifica
                    </span>

                    {{-- Serie --}}
                    <div class="w-32">
                        <x-wire-inputs.maskable 
                            wire:model.defer="serie"
                            mask="['AXXX']"
                            class="uppercase placeholder:normal-case"
                            placeholder="Serie" />
                    </div>

                    <span class="mt-2">-</span>

                    {{-- Correlativo --}}
                    <div class="w-32">
                        <x-wire-input 
                            wire:model.defer="correlativo"
                            placeholder="Correlativo"
                            type="number" />
                    </div>

                    <div class="mt-0.5">
                        <x-wire-button primary icon="search" wire:click="searchInvoice" />
                    </div>
                </div>

            </div>
        </div>

        {{-- Productos --}}
        <form wire:submit.prevent="addItem">
            <x-wire-modal.card blur title="Agregar un item" 
                wire:model.defer="openModal">
                
                @include('billing.documents.includes.item')
        
                <x-slot name="footer">
        
                    <div class="flex justify-end">
                        <x-wire-button flat class="mr-2" x-on:click="close">
                            Cancelar
                        </x-wire-button>
        
                        <x-wire-button primary type="submit" wire:target="addItem">
                            Agregar
                        </x-wire-button>
                    </div>
        
                </x-slot>
        
            </x-wire-modal.card>
        </form>

        <div class="mb-4">
            <x-wire-errors title="Solucionar el siguiente error" only="invoice.details" />
        </div>

        @if (count($invoice['details']))
            <div class="relative overflow-x-auto mb-2">
                <table class="w-full">
                    <thead class="bg-slate-200 font-semibold">
                        <tr>
                            <th class="px-4 py-2">
                                CANT
                            </th>

                            <th class="px-4 py-2">
                                CÓDIGO
                            </th>

                            <th class="px-4 py-2">
                                DESCRIPCION
                            </th>

                            <th class="px-4 py-2">
                                V. UNIT
                            </th>

                            <th class="px-4 py-2">
                                V. TOTAL
                            </th>

                            <th class="px-4 py-2">
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($invoice['details'] as $index => $product)
                            
                            <tr class="space-x-4" wire:key="product-{{$index}}">
                                <td class="py-1 !w-24">
                                    <x-wire-input disabled readonly class="bg-white text-right text-gray-950" value="{{$product['cantidad'] . ' ' . $product['unidad']}}" />
                                </td>

                                <td class="py-1 !w-36">
                                    <x-wire-input disabled readonly class="bg-white text-gray-950" value="{{$product['codProducto'] ? $product['codProducto'] : 'S/C' }}" />
                                </td>

                                <td class="py-1 min-w-[16rem]">
                                    <x-wire-input disabled readonly class="bg-white text-gray-900" value="{{$product['descripcion']}}" />
                                </td>

                                <td class="py-1 !w-36">
                                    <x-wire-input disabled readonly class="bg-white text-gray-900 text-right" value="{{in_array($product['tipAfeIgv'], ['10', '20', '30', '40']) ? $product['mtoValorUnitario'] : $product['mtoValorGratuito']}}" />
                                </td>

                                <td class="py-1 !w-36">
                                    <x-wire-input disabled readonly class="bg-white text-gray-900 text-right" value="{{$product['mtoValorVenta']}}" />
                                </td>

                                <td width="10px">
                                
                                    {{-- <div class="flex justify-center"> --}}
                                    
                                    <x-wire-button flat red
                                        icon="x-circle" 
                                        wire:click="deleteItem({{$index}})" />
                                    {{-- </div> --}}
                                    
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>

            <x-wire-button
                label="Agregar otro item"
                class="w-full" dark icon="plus" outline
                wire:click="$set('openModal', true)"  />
        @else
            
            <div class="flex justify-center">
                <button class="w-80" wire:click="$set('openModal', true)">

                    <i class="fa-solid fa-inbox text-6xl text-gray-400"></i>

                    <div class="border border-dashed border-gray-400 p-2 mt-4 flex justify-center items-center">
                        
                        <span wire:loading.remove wire:target="$set('openModal', true)" class="pt-0.5">
                            <i class="fa-solid fa-plus"></i>
                        </span>

                        <div wire:loading wire:target="$set('openModal', true)">

                            <x-spinner size="4" />

                        </div>

                        <span class="ml-2">
                            Agregar un item
                        </span>
                    </div>

                </button>

            </div>

        @endif

        <div class="flex flex-col items-end mt-4 space-y-2">
                
            {{-- Oper. Gravadas --}}
            @if ($invoice['mtoOperGravadas'])
                
                <div class="flex items-center">

                    <span class="mr-2 text-sm">
                        Oper. Gravadas:
                    </span>

                    <x-wire-input class="text-right" 
                        value="{{number_format($invoice['mtoOperGravadas'], 2)}}"
                        disabled 
                        readonly />

                </div>

            @endif
            
            {{-- Oper. Exoneradas --}}
            @if ($invoice['mtoOperExoneradas'])
                
                <div class="flex items-center">

                    <span class="mr-2 text-sm">
                        Oper. Exoneradas:
                    </span>

                    <x-wire-input class="text-right" 
                        value="{{number_format($invoice['mtoOperExoneradas'],2)}}"
                        disabled 
                        readonly />

                </div>

            @endif

            {{-- Oper. Inafectas --}}
            @if ($invoice['mtoOperInafectas'])
                
                <div class="flex items-center">

                    <span class="mr-2 text-sm">
                        Oper. Inafectas:
                    </span>

                    <x-wire-input class="text-right" 
                        value="{{number_format($invoice['mtoOperInafectas'],2)}}"
                        disabled 
                        readonly />

                </div>

            @endif

            {{-- Oper. Exportacion --}}
            @if ($invoice['mtoOperExportacion'])
                
                <div class="flex items-center">

                    <span class="mr-2 text-sm">
                        Oper. Exportacion:
                    </span>

                    <x-wire-input class="text-right" 
                        value="{{number_format($invoice['mtoOperExportacion'],2)}}"
                        disabled 
                        readonly />

                </div>

            @endif
            
            {{-- IGV --}}
            <div class="flex items-center">

                <span class="mr-2 text-sm">
                    IGV:
                </span>

                <x-wire-input class="text-right" 
                    value="{{number_format($invoice['mtoIGV'],2)}}"
                    disabled 
                    readonly />

            </div>

            {{-- Icbper --}}
            @if ($invoice['icbper'])
                
                <div class="flex items-center">

                    <span class="mr-2 text-sm">
                        Icbper:
                    </span>

                    <x-wire-input class="text-right" 
                        value="{{number_format($invoice['icbper'],2)}}"
                        disabled 
                        readonly />

                </div>

            @endif

            {{-- Precio Venta --}}
            <div class="flex items-center">

                <span class="mr-2 text-sm">
                    Precio Venta:
                </span>

                <x-wire-input class="text-right" 
                    value="{{number_format($invoice['mtoImpVenta'],2)}}"
                    disabled 
                    readonly />

            </div> 

        </div>

        <div class="mt-4 space-y-2 mb-8">

            @foreach ($invoice['legends'] as $legend)
                
                <div class="border border-gray-300 rounded overflow-hidden text-sm flex">

                    @if ($legend['code'] == '1000')
                        
                        <div class="p-2 bg-white border-r border-gray-300">
                            <span class="font-bold">IMPORTE EN LETRAS
                        </div>
                        
                    @endif

                    <div class="p-2 flex-1 uppercase">
                        {{$legend['value']}}
                    </div>
                </div>

            @endforeach

        </div>

        {{-- Modo de envio --}}
        <div>
            <p class="font-semibold">SELECCIONA EL MODO DE ENVÍO:</p>

            <hr class="mt-2 mb-4">
        
            <div class="flex space-x-6">

                <x-wire-radio 
                    label="Enviar a SUNAT ahora mismo"
                    value="1"
                    id="sending_method_2"
                    wire:model.defer="sending_method" />

                <x-wire-radio 
                    label="Solo Firmar digitalmente"
                    value="2"
                    id="sending_method_1"
                    wire:model.defer="sending_method" />

                <x-wire-radio 
                    label="Solo Gurdar la Venta"
                    value="3"
                    id="sending_method_3"
                    wire:model.defer="sending_method" />

            </div>
        </div>

        <div class="mt-4 flex justify-end">
            <x-wire-button primary wire:click="generateInvoice" wire:target="generateInvoice">
                Emitir nota
            </x-wire-button>
        </div>   

        {{-- <pre><code>{{ json_encode($invoice, JSON_PRETTY_PRINT) }}</code></pre> --}}

    @endempty

</div>
