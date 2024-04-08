<div>
    @empty($guide['serie'])

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

                    <x-wire-native-select label="Sucursal" wire:model.defer="guide.branch_id">

                        <option value="" disabled selected>Seleccione una sucursal</option>

                        @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                        @endforeach

                    </x-wire-native-select>

                </div>

                <div class="flex justify-end">
                    <x-wire-button dark wire:click="getSerie">
                        Continuar
                    </x-wire-button>
                </div>

            </x-wire-card>
            
        @endif
        
    @else

        {{-- Empresa emisora --}}
        <section class="mb-6">

            <div class="grid lg:grid-cols-6 lg:items-center gap-4">

                {{-- Serie y correlativo --}}
                <div class="lg:col-span-2 lg:order-2">

                    <div class="border-2 border-gray-600 border-dashed p-4">

                        <p class="text-center font-semibold mb-2">R.U.C. N° {{ $company->ruc }}</p>

                        <p class="text-center font-semibold uppercase mb-2">
                            GUIA DE REMISIÓN ELECTRÓNICA
                        </p>

                        <div class="flex justify-center items-center">
                            <x-wire-input value="{{ $guide['serie'] }}" 
                                class="text-center cursor-default"
                                disabled
                                readonly 
                                onfocus="this.blur()" />

                            <span class="mx-2">-</span>

                            <x-wire-input value="{{ str_pad($guide['correlativo'], 8, '0', STR_PAD_LEFT) }}"
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

        </section>

        {{-- Datos de la guía --}}
        <section class="space-y-6 mb-16">
        
            {{-- Destinatario --}}
            <article>
                <header class="flex items-center border-b border-gray-200 pb-2 mb-4">
                    <x-wire-badge.circle xl primary label="1" />
                    <h1 class="ml-3 font-semibold text-sm">DESTINATARIO</h1>
                </header>

                <div class="grid gap-4 lg:grid-cols-4 mb-4">
                    {{-- Razon social --}}
                    <div class="lg:col-span-2">
                        <x-wire-input 
                            wire:model.defer="guide.destinatario.rznSocial"
                            placeholder="Razón social"
                            icon="user" />
                    </div>
    
                    {{-- Tipo de documento --}}
                    <div class="lg:col-span-1">
                        <x-wire-select class="mr-2" 
                            wire:model.defer="guide.destinatario.tipoDoc" 
                            placeholder="Tipo de documento"
                            :async-data="[
                                'api' => route('api.identities'),
                            ]" 
                            option-label="name" 
                            option-value="id" />
                    </div>

                    {{-- Numero de documento --}}
                    <div class="lg:col-span-1">
                        <x-wire-input
                        wire:model.defer="guide.destinatario.numDoc"
                        placeholder="Documento" />
                    </div>
      
                </div>
            </article>

            {{-- Envío --}}
            <article>
                <header class="flex items-center border-b border-gray-200 pb-2 mb-4">
                    <x-wire-badge.circle xl primary label="2" />
                    <h1 class="ml-3 font-semibold text-sm">DATOS DE ENVÍO</h1>
                </header>

                <div class="grid grid-cols-3 gap-4">
                    {{-- Motivo del Traslado --}}
                    <x-wire-select 
                        label="Motivo del Traslado"
                        wire:model.defer="guide.envio.codTraslado" 
                        placeholder="Motivo de traslado"
                        :async-data="[
                            'api' => route('api.transfer-reasons'),
                        ]"
                        option-label="name" 
                        option-value="id" />

                    {{-- Modalidad de traslado --}}
                    <x-wire-native-select
                        label="Modalidad de traslado"
                        wire:model.defer="guide.envio.modTraslado">
                        <option value="01">Transporte público</option>
                        <option value="02">Transporte privado</option>
                    </x-wire-native-select>

                    {{-- Fecha de traslado --}}
                    <x-wire-input
                        type="date"
                        label="Fecha inicial de traslado"
                        placeholder="Fecha inicial de traslado"
                        wire:model.defer="guide.envio.fecTraslado"
                    />

                    {{-- Peso total --}}
                    <x-wire-input
                        label="Peso total"
                        placeholder="Peso total"
                        wire:model.defer="guide.envio.pesoTotal"
                    />

                    {{-- Unidad de peso total --}}
                    <x-wire-select
                        label="Unidad"
                        wire:model.defer="guide.envio.undPesoTotal"
                        placeholder="Buscar unidades"
                        :async-data="[
                            'api' => route('api.units'),
                            'params' => [
                                'undPeso' => 1
                            ]
                        ]"
                        option-label="name"
                        option-value="id"
                        required
                    />
                </div>
            </article>

            {{-- Datos de transportista --}}
            <article>
                <header class="flex items-center border-b border-gray-200 pb-2 mb-4">
                    <x-wire-badge.circle xl primary label="3" />
                    <h1 class="ml-3 font-semibold text-sm">DATOS DE TRANSPORTISTA</h1>
                </header>

                <div class="grid grid-cols-3 gap-4">
                    <x-wire-select class="mr-2"
                        label="Tipo de documento"
                        wire:model.defer="guide.envio.transportista.tipoDoc" 
                        placeholder="Tipo de documento"
                        :async-data="[
                            'api' => route('api.identities'),
                        ]" 
                        option-label="name" 
                        option-value="id" />

                    <x-wire-input
                        label="Número de documento"
                        placeholder="Número de documento"
                        wire:model.defer="guide.envio.transportista.numDoc" />

                    <x-wire-input
                        label="Nombre o razón social"
                        placeholder="Nombre o razón social"
                        wire:model.defer="guide.envio.transportista.rznSocial" />
                </div>
            </article>

            {{-- Punto de partida --}}
            <article>
                <header class="flex items-center border-b border-gray-200 pb-2 mb-4">
                    <x-wire-badge.circle xl primary label="4" />
                    <h1 class="ml-3 font-semibold text-sm">PUNTO DE PARTIDA</h1>
                </header>

                <div class="grid grid-cols-2 gap-4">
                    <x-wire-input
                        wire:model.defer="guide.envio.partida.direccion"
                        placeholder="Ingrese el punto de partida"
                        label="Dirección" />

                    <x-wire-select
                        wire:model.defer="guide.envio.partida.ubigeo"
                        label="Ubigeo"
                        placeholder="Buscar ubigeo"
                        :async-data="route('api.ubigeos.index')"
                        option-label="name"
                        option-value="id" />
                </div>
            </article>

            {{-- Punto de llegada --}}
            <article>
                <header class="flex items-center border-b border-gray-200 pb-2 mb-4">
                    <x-wire-badge.circle xl primary label="5" />
                    <h1 class="ml-3 font-semibold text-sm">PUNTO DE LLEGADA</h1>
                </header>

                <div class="grid grid-cols-2 gap-4">
                    <x-wire-input
                        wire:model.defer="guide.envio.llegada.direccion"
                        placeholder="Ingrese el punto de llegada"
                        label="Dirección" />

                    <x-wire-select
                        wire:model.defer="guide.envio.llegada.ubigeo"
                        label="Ubigeo"
                        placeholder="Buscar ubigeo"
                        :async-data="route('api.ubigeos.index')"
                        option-label="name"
                        option-value="id" />
                </div>
            </article>

        </section>

        {{-- Productos --}}
        <section class="mb-8">

            <div wire:key="details">
                @if (count($guide['details']))

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
                                    </th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($guide['details'] as $index => $product)
                                    
                                    <tr class="space-x-4" wire:key="product-{{$index}}">
                                        <td class="py-1 !w-24">
                                            <x-wire-input disabled readonly class="bg-white text-right text-gray-950" value="{{$product['cantidad'] . ' ' . $product['unidad']}}" />
                                        </td>
        
                                        <td class="py-1 !w-36">
                                            <x-wire-input disabled readonly class="bg-white text-gray-950" value="{{$product['codigo'] ? $product['codigo'] : 'S/C' }} " />
                                        </td>
        
                                        <td class="py-1 min-w-[16rem]">
                                            <x-wire-input disabled readonly class="bg-white text-gray-900" value="{{$product['descripcion']}}" />
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
            </div>

            <form wire:submit.prevent="addItem">
                <x-wire-modal.card blur title="Agregar un item" wire:model.defer="openModal">
                    
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        {{-- Cantidad --}}
                        <div>
                            <x-wire-input
                                label="Cantidad"
                                type="number"
                                wire:model.defer="item.cantidad"
                                placeholder="Cantidad"
                                required />
                        </div>
                    
                        {{-- Unidad --}}
                        <div>
                            <x-wire-select
                                label="Unidad"
                                wire:model.defer="item.unidad"
                                placeholder="Buscar unidades"
                                :async-data="route('api.units')"
                                option-label="name"
                                option-value="id"
                                required
                            />
                        </div>
                    
                        {{-- Código --}}
                        <div>
                            <x-wire-input 
                                label="Código"
                                wire:model.defer="item.codigo" 
                                placeholder="Código (opcional)" />
                        </div>
                    
                        {{-- Descripción --}}
                        <div class="col-span-3">
                            <x-wire-input 
                                label="Descripción"
                                wire:model.defer="item.descripcion"
                                placeholder="Descripción detallada"
                                required />
                        </div>
                    </div>
            
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
        </section>

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

        <div class="flex justify-end">
            <x-wire-button primary wire:click="generateInvoice" wire:target="generateInvoice">
                Emitir guía de remisión
            </x-wire-button>
        </div> 
    @endempty
</div>
