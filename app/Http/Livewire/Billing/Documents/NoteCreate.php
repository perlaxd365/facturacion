<?php

namespace App\Http\Livewire\Billing\Documents;

use App\Models\Branch;
use App\Models\CreditNoteType;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Services\SunatService;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Luecano\NumeroALetras\NumeroALetras;

class NoteCreate extends Component
{

    public $company, $document;
    public $branches;
    public $vouchers;
    public $voucher_id;

    public $serie, $correlativo;

    public $openModal = false;

    public $mtoValor = '0.000';
    public $mtoPrecio = '0.000';

    public $sending_method = 1;

    public $invoice = [
        'tipoDoc' => '',
        'serie' => '',
        'correlativo' => '',
        'fechaEmision' => '',
        'tipDocAfectado' => '',
        'numDocfectado' => 'F001-111',
        'codMotivo' => '01',
        'desMotivo' => 'Anulación de la operación',
        'tipoMoneda' => 'PEN',

        'client' => [
            'tipoDoc' => '6',
            'numDoc' => '',
            'rznSocial' => '',
            'address' => [
                'direccion' => '',
            ],
        ],

        'company' => [],

        //Montos
        'mtoOperGravadas' => 0,
        'mtoOperExoneradas' => 0,
        'mtoOperInafectas' => 0,
        'mtoOperExportacion' => 0,
        'mtoOperGratuitas' => 0,

        //Impuestos
        'mtoIGV' => 0,
        'mtoIGVGratuitas' => 0,
        'icbper' => 0,
        'totalImpuestos' => 0,

        //Totales
        'valorVenta' => 0,
        'subTotal' => 0,
        'redondeo' => 0,
        'mtoImpVenta' => 0,

        //Productos
        'details' => [
        ],

        //Leyendas
        'legends' => [
            [
                'code' => '1000',
                'value' => 'CERO  CON 00/100',
            ]
        ],

        'branch_id' => "",
    ];

    public $item = [
        'codProducto' => '',
        'unidad' => 'NIU',
        'descripcion' => '',

        //Cantidad de items
        'cantidad' => 1,

        // Valor gratuido
        'mtoValorGratuito' => "0.000",

        //Valor unitario sin igv
        'mtoValorUnitario' => "0.000",

        // Valor unitario con igv
        'mtoPrecioUnitario' => "0.000",

        //mtoValorUnitario * cantidad
        'mtoBaseIgv' => "0.000",

        //Porcentaje de igv
        'porcentajeIgv' => 18,

        //mtoBaseIgv * porcentajeIgv / 100
        'igv' => "0.000",

        //Impuesto por bolsa plastica
        'factorIcbper' => "0.000",

        //factorIcbper * cantidad
        'icbper' => "0.000",

        // Gravado Op. Onerosa - Catalog. 07
        'tipAfeIgv' => 10,

        // igv + icbper
        'totalImpuestos' => "0.000",

        // mtoValorUnitario * cantidad
        'mtoValorVenta' => "0.000",
    ];

    //Ciclos de vida
    public function mount(){
        $this->getBranches();
    }

    public function updatedVoucherId($value){

        $branch_voucher = DB::table('branch_voucher')
                            ->where('branch_id', $this->invoice['branch_id'])
                            ->where('voucher_id', $value)
                            ->first();

        $this->invoice['serie'] = $branch_voucher->serie;

        //Correlativo
        $correlativo = Invoice::where('branch_id', $this->invoice['branch_id'])
                        ->where('serie', $this->invoice['serie'])
                        ->max('correlativo');

        $this->invoice['correlativo'] = $correlativo ? $correlativo + 1 : $branch_voucher->correlativo;

        if (in_array($value, [3, 4])) {
            $this->invoice['tipDocAfectado'] = '01';
        }

        if (in_array($value, [5, 6])) {
            $this->invoice['tipDocAfectado'] = '03';
        }
    }

    public function updatedInvoiceCodMotivo($value){
        if ($value) {
            $creditNoteType = CreditNoteType::where('code', $value)->first();
            $this->invoice['desMotivo'] = $creditNoteType->description;
        }
    }

    //Métodos
    public function getBranches(){
        $is_admin = DB::table('company_user')
                        ->where('company_id', $this->company->id)
                        ->where('user_id', auth()->user()->id)
                        ->first()->is_admin;

        $this->branches = Branch::where('company_id', $this->company->id)
                    ->whereHas('vouchers', function ($query) {
                        $query->where('document_id', $this->document->id);
                    })
                    ->when(!$is_admin, function($query){
                        $query->whereHas('users', function($query){
                            $query->where('user_id', auth()->id());
                        });
                    })
                    ->get();

        if($this->branches->count() == 1){
            $this->invoice['branch_id'] = $this->branches->first()->id;
            $this->startInvoice();
        }
    }

    public function startInvoice()
    {
        $this->validate([
            'invoice.branch_id' => 'required'
        ]);

        //Tipo de documento
        $this->invoice['tipoDoc'] = $this->document->id;

        //Series
        $this->vouchers = Voucher::where('document_id', $this->document->id)
                            ->whereHas('branches', function($query){
                                $query->where('branch_id', $this->invoice['branch_id']);
                            })
                            ->get();

        $this->voucher_id = $this->vouchers->first()->id;

        $branch_voucher = DB::table('branch_voucher')
                            ->where('branch_id', $this->invoice['branch_id'])
                            ->where('voucher_id', $this->voucher_id)
                            ->first();
        
        $this->invoice['serie'] = $branch_voucher->serie;
        
        //Correlativo
        $correlativo = Invoice::where('branch_id', $this->invoice['branch_id'])
                        ->where('serie', $this->invoice['serie'])
                        ->max('correlativo');

        $this->invoice['correlativo'] = $correlativo ? $correlativo + 1 : $branch_voucher->correlativo;

        //Fecha de emisión
        $this->invoice['fechaEmision'] = date('Y-m-d');

        //Tipo de documento afectado
        if (in_array($this->voucher_id, [3, 4])) {
            $this->invoice['tipDocAfectado'] = '01';
        }

        if (in_array($this->voucher_id, [5, 6])) {
            $this->invoice['tipDocAfectado'] = '03';
        }

        //Company
        $this->invoice['company'] = [
            'ruc' => $this->company->ruc,
            'razonSocial' => $this->company->razonSocial,
            'address' => [
                'direccion' => $this->company->address->direccion,
            ],
        ];

    }

    public function addItem()
    {

        $this->validate([
            "item.codProducto" => "nullable",
            "item.unidad" => "required|exists:units,id",
            "item.descripcion" => "required",
            "item.cantidad" => "required|numeric|min:1",
            "item.mtoValorGratuito" => "required|numeric|min:0",
            "item.mtoValorUnitario" => "required|numeric|min:0",
            "item.mtoPrecioUnitario" => "required|numeric|min:0",
            "item.mtoBaseIgv" => "required|numeric|min:0",
            "item.porcentajeIgv" => "required|numeric|in:0,10,18",
            "item.igv" => "required|numeric|min:0",
            "item.factorIcbper" => "required|numeric|in:0,0.20",
            "item.icbper" => "required|numeric|min:0",
            "item.tipAfeIgv" => "required|exists:affectations,id",
            "item.totalImpuestos" => "required|numeric|min:0",
            "item.mtoValorVenta" => "required|numeric|min:0",
        ]);

        $this->invoice['details'][] = $this->item;

        $this->getTotales();
        $this->getLegends();

        $this->reset('openModal', 'item', 'mtoValor', 'mtoPrecio');
    }

    public function deleteItem($index)
    {
        unset($this->invoice['details'][$index]);

        $this->getTotales();
        $this->getLegends();
    }

    public function getTotales()
    {
        $this->invoice['mtoOperGravadas'] = collect($this->invoice['details'])
            ->where('tipAfeIgv', '10')
            ->sum('mtoValorVenta');

        $this->invoice['mtoOperExoneradas'] = collect($this->invoice['details'])
            ->where('tipAfeIgv', '20')
            ->sum('mtoValorVenta');

        $this->invoice['mtoOperInafectas'] = collect($this->invoice['details'])
            ->where('tipAfeIgv', '30')
            ->sum('mtoValorVenta');

        $this->invoice['mtoOperExportacion'] = collect($this->invoice['details'])
            ->where('tipAfeIgv', '40')
            ->sum('mtoValorVenta');

        $this->invoice['mtoOperGratuitas'] = collect($this->invoice['details'])
            ->whereNotIn('tipAfeIgv', ['10', '20', '30', '40'])
            ->sum('mtoValorVenta');

        $this->invoice['mtoIGV'] = collect($this->invoice['details'])
            ->whereIn('tipAfeIgv', ['10', '20', '30', '40'])
            ->sum('igv');

        $this->invoice['mtoIGVGratuitas'] = collect($this->invoice['details'])
            ->whereNotIn('tipAfeIgv', ['10', '20', '30', '40'])
            ->sum('igv');

        $this->invoice['icbper'] = collect($this->invoice['details'])
            ->sum('icbper');

        $this->invoice['totalImpuestos'] = $this->invoice['mtoIGV'] + $this->invoice['icbper'];

        /* Totales */
        $this->invoice['valorVenta'] = collect($this->invoice['details'])
            ->whereIn('tipAfeIgv', ['10', '20', '30', '40'])
            ->sum('mtoValorVenta');

        $this->invoice['subTotal'] = $this->invoice['valorVenta'] + $this->invoice['totalImpuestos']; 
        
        $this->invoice['mtoImpVenta'] = floor($this->invoice['subTotal'] * 10) / 10;

        $this->invoice['redondeo'] =  $this->invoice['subTotal'] - $this->invoice['mtoImpVenta'];

    }

    public function getLegends()
    {
        $formatter = new NumeroALetras();

        $legends = [];

        $legends[] = [
            'code' => '1000',
            'value' => $formatter->toInvoice($this->invoice['mtoImpVenta'], 2)
        ];

        $this->invoice['legends'] = $legends;
    }

    public function searchInvoice(){

        $this->validate([
            'invoice.tipDocAfectado' => 'required|in:01,03',
            'serie' => [
                'required',
                'regex:/^[' . substr($this->invoice['serie'], 0, 1) . ']{1}[0-9]{3}$/'
            ],
            'correlativo' => 'required|numeric|digits_between:1,8',
        ]);

        $invoice = Invoice::where('branch_id', $this->invoice['branch_id'])
                        ->where('serie', $this->serie)
                        ->where('correlativo', $this->correlativo)
                        ->first();

        if ($invoice) {

            $this->invoice['details'] = $invoice->details->toArray();

            $this->getTotales();
            $this->getLegends();

        } else {
            
            $this->emit('sweetAlert', [
                'icon' => 'error',
                'title' => 'Oops...',
                'text' => 'Parece que no existe el comprobante.'
            ]);
        }
        

    }

    public function generateInvoice(){

        $this->validate([
            'invoice.tipoDoc' => 'required|exists:documents,id',
            'invoice.serie' => 'required',
            'invoice.correlativo' => 'required',
            'invoice.fechaEmision' => 'required|date',

            'invoice.tipDocAfectado' => 'required|in:01,03',
            'serie' => [
                'required',
                'regex:/^[' . substr($this->invoice['serie'], 0, 1) . ']{1}[0-9]{3}$/'
            ],
            'correlativo' => 'required|numeric|digits_between:1,8',

            'invoice.codMotivo' => 'required|exists:credit_note_types,id',
            'invoice.desMotivo' => 'required',

            'invoice.tipoMoneda' => 'required|exists:currencies,id',

            'invoice.client.tipoDoc' => 'required|exists:identities,id',
            'invoice.client.numDoc' => [
                ($this->invoice['client']['tipoDoc'] == '-' ? 'nullable' : 'required'),
                new \App\Rules\DocumentValidationRule($this->invoice['client']['tipoDoc'])
            ],
            'invoice.client.rznSocial' => 'required',
            'invoice.client.address.direccion' => 'required',
            
            //Productos
            'invoice.details' => 'required|array|min:1',
            'invoice.details.*.codProducto' => 'nullable',
            'invoice.details.*.unidad' => 'required|exists:units,id',
            'invoice.details.*.descripcion' => 'required',
            'invoice.details.*.cantidad' => 'required|numeric|min:1',    
            'invoice.details.*.mtoValorGratuito' => 'required|numeric|min:0',
            'invoice.details.*.mtoValorUnitario' => 'required|numeric|min:0',
            'invoice.details.*.mtoPrecioUnitario' => 'required|numeric|min:0',
            'invoice.details.*.mtoBaseIgv' => 'required|numeric|min:0',
            'invoice.details.*.porcentajeIgv' => 'required|numeric|in:0,10,18',
            'invoice.details.*.igv' => 'required|numeric|min:0',
            'invoice.details.*.factorIcbper' => 'required|numeric|in:0,0.20',
            'invoice.details.*.icbper' => 'required|numeric|min:0',
            'invoice.details.*.tipAfeIgv' => 'required|exists:affectations,id',
            'invoice.details.*.totalImpuestos' => 'required|numeric|min:0',
            'invoice.details.*.mtoValorVenta' => 'required|numeric|min:0',
        ],[
            'invoice.client.address.direccion.required_if' => 'El campo dirección es obligatorio para este tipo de operación',
            'invoice.details.required' => 'Debe agregar al menos un item',
        ],[
            'invoice.tipoOperacion' => 'tipo de operación',
            'invoice.fechaEmision' => 'fecha de emisión',
            'invoice.formaPago' => 'forma de pago',
            'invoice.tipoMoneda' => 'tipo de moneda',
            'invoice.client.tipoDoc' => 'tipo de documento',
            'invoice.client.numDoc' => 'documento',
            'invoice.client.rznSocial' => 'razón social',
            'invoice.client.address.direccion' => 'dirección',
        ]);

        $this->invoice['numDocfectado'] = strtoupper($this->serie) . '-' . $this->correlativo;

        $invoice = Invoice::create($this->invoice);

        $sunat = new SunatService($invoice, $this->company);
        $sunat->setSee();
        $sunat->setNote();

        switch ($this->sending_method) {
            case '1':
                
                $sunat->send();

                break;
            
            case '2':

                $sunat->generateXml();
                
                session()->flash('flash.sweetAlert', [
                    'icon' => 'warning',
                    'title' => 'Factura generada',
                    'text' => 'La factura se generó correctamente',
                    'footer' => 'La factura se firmo pero no se envio a sunat'
                ]);

                break;

            case '3':

                //La factura se guardo pero no se envio a sunat
                session()->flash('flash.sweetAlert', [
                    'icon' => 'warning',
                    'title' => 'Factura generada',
                    'text' => 'La factura se generó correctamente',
                    'footer' => 'La factura no se firmo ni se envio a sunat'
                ]);

                break;
        }

        //Generar PDF
        $sunat->generatePdfReport();

        return redirect()->route('billing.documents.invoices.index', $this->company);

    }

    public function render()
    {
        return view('livewire.billing.documents.note-create');
    }
}
