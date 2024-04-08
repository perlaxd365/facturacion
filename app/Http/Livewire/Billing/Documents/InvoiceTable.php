<?php

namespace App\Http\Livewire\Billing\Documents;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Invoice;
use App\Services\SunatService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class InvoiceTable extends DataTableComponent
{

    public $company;

    /* protected $model = Invoice::class; */

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),

            Column::make("Fecha", "fechaEmision")
                ->sortable()
                ->format(fn($value) => $value->format('d/m/Y'))
                ->collapseOnTablet(),

            Column::make("Serie", "serie")
                ->hideIf(true),

            Column::make("Correlativo", "correlativo")
                ->hideIf(true),

            Column::make('Comprobante', 'tipoDoc')
                ->format(
                    function($value, $row){

                        $tipoDoc = match ($value) {
                            '01' => 'Factura',
                            '03' => 'Boleta',
                            '07' => 'Nota de crédito',
                            '08' => 'Nota de débito',
                            '09' => 'Guía de remisión',
                            default => 'Otro',
                        };

                        return $tipoDoc . ': ' . $row->serie . '-' . $row->correlativo;
                    }
                ),

            Column::make("Cliente", "client")
                ->format(
                    fn($value) => $value['numDoc'] . '<br>' . $value['rznSocial']
                )
                ->html(),

            Column::make('PDF')
                ->label(
                    fn($row) => view('billing.documents.datatables.pdf', compact('row'))
                )->collapseOnTablet(),

            Column::make('XML', 'xml_path')
                ->format(
                    fn($value, $row) => view('billing.documents.datatables.xml', compact('value', 'row'))
                )->collapseOnTablet(),

            Column::make('CDR', 'sunat_cdr_path')
                ->format(
                    fn($value, $row) => view('billing.documents.datatables.cdr', compact('value', 'row'))
                )->collapseOnTablet(),

            Column::make('Sunat', 'send_xml')
                ->format(
                    fn($value, $row) => view('billing.documents.datatables.sunat', compact('value', 'row'))
                ),

            Column::make("sunat success", "sunat_success")
                ->hideIf(true),            
            
        ];
    }

    public function builder(): Builder
    {
        return Invoice::query()
            ->whereHas('branch', function ($query) {
                $query->where('company_id', $this->company->id);
            });
    }

    //Métodos
    public function downloadPDF(Invoice $invoice)
    {
        return Storage::download($invoice->pdf_path);
    }

    public function downloadXML(Invoice $invoice)
    {
        return Storage::download($invoice->xml_path);
    }

    public function downloadCDR(Invoice $invoice)
    {
        return Storage::download($invoice->sunat_cdr_path);
    }

    public function generateXml(Invoice $invoice)
    {
        $sunat = new SunatService($invoice, $this->company);
        $sunat->setSee();

        //Tipo de documento es 01 o 03
        if (in_array($invoice->tipoDoc, ['01', '03'])) {
            $sunat->setInvoice();
        }

        //Tipo de documento es 07 o 08
        if (in_array($invoice->tipoDoc, ['07', '08'])) {
            $sunat->setNote();
        }


        $sunat->generateXml();
    }

    public function sendSunat(Invoice $invoice)
    {
        $sunat = new SunatService($invoice, $this->company);
        $sunat->setSee();

        //Tipo de documento es 01 o 03
        if (in_array($invoice->tipoDoc, ['01', '03'])) {
            $sunat->setInvoice();
        }

        //Tipo de documento es 07 o 08
        if (in_array($invoice->tipoDoc, ['07', '08'])) {
            $sunat->setNote();
        }

        $sunat->send();
    }

    public function showDetail(Invoice $invoice)
    {
        
        if ($invoice->sunat_success) {
            $html = view('billing.documents.datatables.success', compact('invoice'))->render();
        }else{
            $html = view('billing.documents.datatables.error', compact('invoice'))->render();
        }

        $this->emit('sweetAlert', [
            'icon' => 'info',
            'title' => 'Detalle de la factura',
            'html' => $html
        ]);
    }
}
