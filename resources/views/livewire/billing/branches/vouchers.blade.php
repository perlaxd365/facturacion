<div>
    
    <x-wire-card>

        <div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
            <span class="font-medium">¡Alerta de información!</span> Si no generas un número de serie para cada documento, no podrás emitir todos los comprobantes de pago disponibles.
        </div>

        <div class="flex items-center mb-8">
            <hr class="w-12" />
            
            <span class="mx-4 text-xl font-semibold">Documentos y series</span>

            <hr class="flex-1" />
        </div>

        <form class="mb-4" wire:submit.prevent="save">

            <div class="grid grid-cols-4 gap-6">

                <div class="col-span-4 lg:col-span-1">
                    <x-wire-native-select wire:model="voucher_id">

                        <option value="" selected disabled>Tipo de documento</option>

                        @foreach ($this->vouchers as $voucher)
                            
                            <option value="{{ $voucher->id }}">{{ $voucher->name }}</option>

                        @endforeach

                    </x-wire-native-select>
                </div>

                <div class="col-span-2 lg:col-span-1">

                    <x-wire-inputs.maskable 
                        wire:model.defer="serie"
                        mask="['AXXX']"
                        class="w-full uppercase placeholder:normal-case"
                        placeholder="Número de serie" />

                </div>

                <div class="col-span-2 lg:col-span-1">

                    <x-wire-input wire:model="correlativo" type="number" placeholder="Correlativo" />

                </div>

                <div class="col-span-4 lg:col-span-1 pt-[0.5px]">
                    <button class="w-full btn btn-outline-gray flex justify-center">
                        Agregar comprobante
                    </button>
                </div>

            </div>

        </form>

        <div x-data="{
            deleteVoucher(id) {
                 
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: '¡No podrás revertir esto!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        @this.delete(id);

                    }
                })

            }
        }">


            @foreach ($branch->vouchers()->get() as $voucher)
                
                <div class="grid grid-cols-4 gap-6 items-center py-3 border-t" wire:key="{{$voucher->id}}">

                    <div class="col-span-4 lg:col-span-1">
                        {{ $voucher->name }}
                    </div>

                    <div class="flex lg:justify-center col-span-2 lg:col-span-1">
                        Serie: {{ $voucher->pivot->serie }}
                    </div>

                    <div class="flex justify-end lg:justify-center col-span-2 lg:col-span-1">
                        Correlativo: {{ $voucher->pivot->correlativo }}
                    </div>

                    <div class="col-span-4 lg:col-span-1">
                    
                        <button class="btn btn-outline-red w-full flex justify-center"
                            x-on:click="deleteVoucher({{$voucher->id}})">
                            Eliminar
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    </x-wire-card>

</div>
