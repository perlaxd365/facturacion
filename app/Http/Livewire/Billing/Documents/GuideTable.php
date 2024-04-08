<?php

namespace App\Http\Livewire\Billing\Documents;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Guide;
use App\Services\SunatService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class GuideTable extends DataTableComponent
{
    public $company;

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

            Column::make("Destinatario", "destinatario")
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
                )->collapseOnTablet(),

            Column::make("sunat success", "sunat_success")
                ->hideIf(true),
            
        ];
    }

    public function builder(): Builder
    {
        return Guide::query()
            ->whereHas('branch', function ($query) {
                $query->where('company_id', $this->company->id);
            });
    }

    //Métodos
    public function downloadPDF(Guide $guide)
    {
        return Storage::download($guide->pdf_path);
    }

    public function downloadXML(Guide $guide)
    {
        return Storage::download($guide->xml_path);
    }

    public function downloadCDR(Guide $guide)
    {
        return Storage::download($guide->sunat_cdr_path);
    }

    public function generateXml(Guide $guide)
    {
        $sunat = new SunatService($guide, $this->company);
        $sunat->setSeeApi();
        $sunat->setDespatch();
        $sunat->generateXmlDespatch();
    }

    public function sendSunat(Guide $guide)
    {
        $sunat = new SunatService($guide, $this->company);
        $sunat->setSeeApi();
        $sunat->setDespatch();
        $sunat->sendDespatch();
    }
}
