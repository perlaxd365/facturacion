<div x-data="newItem">

    {{-- Tipo de afectacion igv --}}
    <div class="mb-4">

        <x-wire-select
            label="Tipo de afectación"
            wire:model="item.tipAfeIgv"
            placeholder="Buscar tipo de afectación"
            :async-data="route('api.affectations')"
            option-label="name"
            option-value="id"
            required
        />

    </div>

    {{-- Detalle del producto --}}
    <div class="grid grid-cols-3 gap-4 mb-4">

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

        {{-- Cantidad --}}
        <div>
            <x-wire-input
                label="Cantidad"
                type="number"
                x-model="cantidad"
                x-on:change="calculateMtoPrecio()"
                placeholder="Cantidad"
                required />
        </div>

        {{-- Código --}}
        <div>
            <x-wire-input 
                label="Código"
                wire:model.defer="item.codProducto" 
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


    <div class="grid grid-cols-3 gap-4">

        {{-- Precio unitario --}}
        <x-wire-input
            label="Precio/Uni(Sin.IGV)"
            type="number"
            x-model="mtoValor"
            x-on:change="calculateMtoPrecio()"
            placeholder="Valor unitario"
            step="0.001"
            min="0.001"
            required />

        <x-wire-native-select
            label="Porcentaje IGV"
            x-model="porcentajeIgv"
            x-on:change="calculateMtoPrecio()"
            class="relative z-[5]">
            <option value="0" x-show="!affectationIgv">IGV 0%</option>
            <option value="18" x-show="affectationIgv">IGV 18%</option>
            <option value="10" x-show="affectationIgv">IGV 10%</option>
        </x-wire-native-select>

        <x-wire-input
            label="Precio/Uni(Inc.IGV)"
            type="number"
            x-model="mtoPrecio"
            x-on:change="calculateMtoValor()"
            placeholder="Precio/Uni(Inc.IGV)"
            step="0.001"
            min="0.001"
            required />

    </div>

</div>

@push('js')
    
    <script>

        function newItem(){
            return {
                affectations: [],
                
                mtoValor: @entangle('mtoValor').defer,
                mtoPrecio: @entangle('mtoPrecio').defer,

                //Tipo de afectacion de igv
                tipAfeIgv: @entangle('item.tipAfeIgv').defer,

                //Cantidad de items
                cantidad: @entangle('item.cantidad').defer,

                //Valor gratuito
                mtoValorGratuito: @entangle('item.mtoValorGratuito').defer,

                //Valor unitario sin igv
                mtoValorUnitario: @entangle('item.mtoValorUnitario').defer,

                // Valor unitario con igv
                mtoPrecioUnitario: @entangle('item.mtoPrecioUnitario').defer,

                //mtoValorUnitario * cantidad
                mtoBaseIgv: @entangle('item.mtoBaseIgv').defer,

                //Porcentaje de igv
                porcentajeIgv: @entangle('item.porcentajeIgv').defer,

                //mtoBaseIgv * porcentajeIgv / 100
                igv: @entangle('item.igv').defer,

                //Impuesto por bolsa plastica
                factorIcbper: @entangle('item.factorIcbper').defer,

                //factorIcbper * cantidad
                icbper: @entangle('item.icbper').defer,

                // igv + icbper
                totalImpuestos: @entangle('item.totalImpuestos').defer,

                // mtoValorUnitario * cantidad
                mtoValorVenta: @entangle('item.mtoValorVenta').defer,

                //Getters
                get affectation(){

                    if (this.affectations) {
                        return this.affectations.find(affectation => affectation.id == this.tipAfeIgv);
                    }

                    return null;

                },

                get affectationIgv(){

                    if (this.affectation) {
                        return this.affectation.igv;
                    }

                    return false;
                },

                get affectationFree(){

                    if (this.affectation) {
                        return this.affectation.free;
                    }

                    return false;
                },

                //Métodos
                calculateMtoPrecio(){

                    this.mtoValor = parseFloat(this.mtoValor).toFixed(3);
                    this.mtoPrecio = this.affectationIgv ? (this.mtoValor * (1 + this.porcentajeIgv / 100)).toFixed(3) : this.mtoValor;

                    if (this.affectationFree) {

                        this.mtoValorGratuito = this.mtoValor;
                        this.mtoValorUnitario = '0.000';
                        this.mtoPrecioUnitario = '0.000'    

                    } else {

                        this.mtoValorGratuito = '0.000';
                        this.mtoValorUnitario = this.mtoValor;
                        this.mtoPrecioUnitario = this.mtoPrecio;

                    }

                    this.mtoBaseIgv = (this.mtoValor * this.cantidad).toFixed(3);

                    this.calculateTotales();
                },

                calculateMtoValor(){
                    
                },

                calculateTotales(){
                    
                    this.igv = this.affectationIgv ? (this.mtoBaseIgv * this.porcentajeIgv / 100).toFixed(3) : "0.000";
                    this.icbper = (this.factorIcbper * this.cantidad).toFixed(3);
                    this.totalImpuestos = (parseFloat(this.igv) + parseFloat(this.icbper)).toFixed(3);

                    this.mtoValorVenta = this.mtoBaseIgv;
                },

                init(){
 
                    axios.get("{{route('api.affectations')}}")
                        .then(res => {
                            this.affectations = res.data;

                            console.log(this.affectations);
                        })

                    this.$watch('tipAfeIgv', (value) => {                        

                        if (value) {
                            this.porcentajeIgv = this.affectationIgv ? 18 : 0;
                            this.calculateMtoPrecio();
                        }

                    })
                },
            }
        }

    </script>

@endpush