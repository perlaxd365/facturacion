<?php

namespace App\Http\Livewire\Billing\Documents;

use App\Models\Branch;
use App\Models\Guide as ModelsGuide;
use App\Services\SunatService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GuideCreate extends Component
{
    public $company, $branches;

    public $openModal = false;

    public $sending_method = 1;

    public $guide = [
        'tipoDoc' => '09',
        'serie' => '',
        'correlativo' => '',
        'fechaEmision' => '',
        'company' => [],
        'destinatario' => [
            'tipoDoc' => '6',
            'numDoc' => '',
            'rznSocial' => '',
        ],
        'envio' => [
            'codTraslado' => '01',
            'modTraslado' => '01',
            'fecTraslado' => '',
            'pesoTotal' => '',
            'undPesoTotal' => 'KGM',
            'partida' => [
                'ubigeo' => '',
                'direccion' => '',
            ],
            'llegada' => [
                'ubigeo' => '',
                'direccion' => '',
            ],
            'transportista' => [
                'tipoDoc' => '6',
                'numDoc' => '',
                'rznSocial' => '',
                'nroMtc' => '0001',
            ],
        ],
        'details' => [],
        'branch_id' => '',
    ];

    public $item = [
        'cantidad' => 1,
        'unidad' => 'NIU',
        'descripcion' => '',
        'codigo' => '',
    ];

    //Ciclo de vida
    public function mount()
    {
        $this->getBranches();
    }

    //Métodos
    public function getBranches()
    {
        $is_admin = DB::table('company_user')
            ->where('company_id', $this->company->id)
            ->where('user_id', auth()->user()->id)
            ->first()
            ->is_admin;

        $this->branches = Branch::where('company_id', $this->company->id)
            ->whereHas('vouchers', function ($query) {
                $query->where('document_id', '09');
            })
            ->when(!$is_admin, function ($query) {
                $query->whereHas('users', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            })
            ->get();

        if ($this->branches->count() == 1) {
            $this->guide['branch_id'] = $this->branches->first()->id;
            $this->getSerie();
        }
    }

    public function getSerie()
    {
        $this->validate([
            'guide.branch_id' => 'required'
        ]);

        //Serie
        $branch_voucher = DB::table('branch_voucher')
                        ->where('branch_id', $this->guide['branch_id'])
                        ->where('voucher_id', 7)
                        ->first();

        $this->guide['serie'] = $branch_voucher->serie;

        //Correlativo
        $correlativo = ModelsGuide::where('branch_id', $this->guide['branch_id'])
            ->where('serie', $this->guide['serie'])
            ->max('correlativo');

        $this->guide['correlativo'] = $correlativo ? $correlativo + 1 : $branch_voucher->correlativo;

        //Fecha de emision
        $this->guide['fechaEmision'] = date('Y-m-d');
        $this->guide['envio']['fecTraslado'] = date('Y-m-d');

        //Company
        $this->guide['company'] = [
            'ruc' => $this->company->ruc,
            'razonSocial' => $this->company->razonSocial,
            'address' => [
                'direccion' => $this->company->address->direccion,
            ],
        ];
    }

    public function addItem(){
        $this->validate([
            "item.cantidad" => "required|numeric|min:1",
            "item.unidad" => "required|exists:units,id",
            'item.descripcion' => 'required',
            'item.codigo' => 'nullable',
        ]);

        $this->guide['details'][] = $this->item;

        $this->reset(['item', 'openModal']);
    }

    public function deleteItem($index)
    {
        unset($this->guide['details'][$index]);
    }

    public function generateInvoice()
    {
        $this->validate([
            'guide.tipoDoc' => 'required|exists:documents,id',
            'guide.serie' => 'required',
            'guide.correlativo' => 'required',
            'guide.fechaEmision' => 'required|date',
            //Destinatario
            'guide.destinatario.tipoDoc' => 'required|exists:identities,id',
            'guide.destinatario.numDoc' => [
                ($this->guide['destinatario']['tipoDoc'] == '-' ? 'nullable' : 'required'),
                new \App\Rules\DocumentValidationRule($this->guide['destinatario']['tipoDoc'])
            ],
            'guide.destinatario.rznSocial' => 'required',

            //Envio
            'guide.envio.codTraslado' => 'required|exists:transfer_reasons,id',
            'guide.envio.modTraslado' => 'required|in:01,02',
            'guide.envio.fecTraslado' => 'required|date',
            'guide.envio.pesoTotal' => 'required|numeric|min:0',
            'guide.envio.undPesoTotal' => 'required|exists:units,id',
            'guide.envio.partida.ubigeo' => 'required|exists:districts,id',
            'guide.envio.partida.direccion' => 'required',
            'guide.envio.llegada.ubigeo' => 'required|exists:districts,id',
            'guide.envio.llegada.direccion' => 'required',

            //Transportista
            'guide.envio.transportista.tipoDoc' => 'required|exists:identities,id',
            'guide.envio.transportista.numDoc' => [
                ($this->guide['envio']['transportista']['tipoDoc'] == '-' ? 'nullable' : 'required'),
                new \App\Rules\DocumentValidationRule($this->guide['envio']['transportista']['tipoDoc'])
            ],
            'guide.envio.transportista.rznSocial' => 'required',

            'guide.details' => 'required|array|min:1',
            'guide.details.*.cantidad' => 'required|numeric|min:1',
            'guide.details.*.unidad' => 'required|exists:units,id',
            'guide.details.*.descripcion' => 'required',
            'guide.details.*.codigo' => 'nullable',
        ]);

        $invoice = ModelsGuide::create($this->guide);

        $sunat = new SunatService($invoice, $this->company);
        $sunat->setSeeApi();
        $sunat->setDespatch();

        switch ($this->sending_method) {
            case '1':
                
                $sunat->sendDespatch();

                break;
            
            case '2':

                $sunat->generateXmlDespatch();
                
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

        return redirect()->route('billing.documents.guides.index', $this->company);
    }

    public function render()
    {
        return view('livewire.billing.documents.guide-create');
    }
}
