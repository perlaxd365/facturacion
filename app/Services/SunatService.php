<?php

namespace App\Services;

use DateTime;
use Exception;
use Greenter\Api;
use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Despatch\Direction;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\Note;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Report\HtmlReport;
use Greenter\Report\PdfReport;
use Greenter\Report\Resolver\DefaultTemplateResolver;
use Greenter\Report\XmlUtils;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\Xml\Builder\DespatchBuilder;
use Greenter\XMLSecLibs\Sunat\SignedXml;
use Illuminate\Support\Facades\Storage;

class SunatService
{

    public $invoice, $company;
    public $see;
    public $api;
    public $voucher;
    public $result;

    public function __construct($invoice, $company){
        $this->invoice = $invoice;
        $this->company = $company;
    }

    public function getClient(){
        return (new Client())
            ->setTipoDoc($this->invoice->client['tipoDoc'])
            ->setNumDoc($this->invoice->client['numDoc'])
            ->setRznSocial($this->invoice->client['rznSocial'])
            ->setAddress(
                (new Address())
                    ->setDireccion($this->invoice->client['address']['direccion'])
            );
    }

    public function getCompany(){
        return (new Company())
            ->setRuc($this->company->ruc)
            ->setRazonSocial($this->company->razonSocial)
            ->setNombreComercial($this->company->nombreComercial)
            ->setAddress(
                (new Address())
                    ->setUbigueo($this->company->address->district_id)
                    ->setDepartamento($this->company->address->department->name)
                    ->setProvincia($this->company->address->province->name)
                    ->setDistrito($this->company->address->district->name)
                    ->setUrbanizacion('-')
                    ->setDireccion($this->company->address->direccion)
            );

            /* return (new \Greenter\Model\Company\Company())
                ->setRuc('20609278235')
                ->setRazonSocial('GREENTER S.A.C.'); */
    }

    //Sale
    public function setInvoice()
    {
        $this->voucher = (new Invoice())
            ->setUblVersion('2.1')
            ->setTipoOperacion($this->invoice->tipoOperacion) // Venta - Catalog. 51
            ->setTipoDoc($this->invoice->tipoDoc) // Factura - Catalog. 01 
            ->setSerie($this->invoice->serie)
            ->setCorrelativo($this->invoice->correlativo) // Zona horaria: Lima
            ->setFechaEmision($this->invoice->fechaEmision) // Zona horaria: Lima
            ->setFormaPago(new FormaPagoContado()) // FormaPago: Contado
            ->setTipoMoneda($this->invoice->tipoMoneda) // Sol - Catalog. 02
            ->setCompany($this->getCompany())
            ->setClient($this->getClient())

            //MtoOper
            ->setMtoOperGravadas($this->invoice->mtoOperGravadas)
            ->setMtoOperExoneradas($this->invoice->mtoOperExoneradas)
            ->setMtoOperInafectas($this->invoice->mtoOperInafectas)
            ->setMtoOperExportacion($this->invoice->mtoOperExportacion)
            ->setMtoOperGratuitas($this->invoice->mtoOperGratuitas)

            //Impuestos
            ->setMtoIGV($this->invoice->mtoIGV)
            ->setMtoIGVGratuitas($this->invoice->mtoIGVGratuitas)
            ->setIcbper($this->invoice->icbper)
            ->setTotalImpuestos($this->invoice->totalImpuestos)

            //Totales
            ->setValorVenta($this->invoice->valorVenta)
            ->setSubTotal($this->invoice->subTotal)
            ->setRedondeo($this->invoice->redondeo)
            ->setMtoImpVenta($this->invoice->mtoImpVenta)

            //Productos
            ->setDetails($this->getSaleDetails())

            //Leyendas
            ->setLegends($this->getLegends());
    }

    public function setNote()
    {
        $this->voucher = (new Note())
            ->setUblVersion('2.1')
            ->setTipoDoc($this->invoice->tipoDoc) // Factura - Catalog. 01
            ->setSerie($this->invoice->serie)
            ->setCorrelativo($this->invoice->correlativo)
            ->setFechaEmision($this->invoice->fechaEmision)
            ->setTipDocAfectado($this->invoice->tipDocAfectado)
            ->setNumDocfectado($this->invoice->numDocfectado)
            ->setCodMotivo($this->invoice->codMotivo)
            ->setDesMotivo($this->invoice->desMotivo)
            ->setTipoMoneda($this->invoice->tipoMoneda)
            ->setCompany($this->getCompany())
            ->setClient($this->getClient())

            //MtoOper
            ->setMtoOperGravadas($this->invoice->mtoOperGravadas)
            ->setMtoOperExoneradas($this->invoice->mtoOperExoneradas)
            ->setMtoOperInafectas($this->invoice->mtoOperInafectas)
            ->setMtoOperExportacion($this->invoice->mtoOperExportacion)
            ->setMtoOperGratuitas($this->invoice->mtoOperGratuitas)

            //Impuestos
            ->setMtoIGV($this->invoice->mtoIGV)
            ->setMtoIGVGratuitas($this->invoice->mtoIGVGratuitas)
            ->setIcbper($this->invoice->icbper)
            ->setTotalImpuestos($this->invoice->totalImpuestos)

            //Totales
            ->setSubTotal($this->invoice->subTotal)
            ->setRedondeo($this->invoice->redondeo)
            ->setMtoImpVenta($this->invoice->mtoImpVenta)

            //Productos
            ->setDetails($this->getSaleDetails())

            //Leyendas
            ->setLegends($this->getLegends());
    }

    public function getSaleDetails(){
        $details = [];

        foreach ($this->invoice->details as $item) {

            $details[] = (new SaleDetail())
                ->setCodProducto($item['codProducto'])
                ->setUnidad($item['unidad'])
                ->setDescripcion($item['descripcion'])
                ->setCantidad($item['cantidad'])
                ->setMtoValorGratuito($item['mtoValorGratuito'])
                ->setMtoValorUnitario($item['mtoValorUnitario'])
                ->setMtoBaseIgv($item['mtoBaseIgv'])
                ->setPorcentajeIgv($item['porcentajeIgv'])
                ->setIgv($item['igv'])
                ->setFactorIcbper($item['factorIcbper'])
                ->setIcbper($item['icbper'])
                ->setTipAfeIgv($item['tipAfeIgv'])
                ->setTotalImpuestos($item['totalImpuestos'])
                ->setMtoValorVenta($item['mtoValorVenta'])
                ->setMtoPrecioUnitario($item['mtoPrecioUnitario']);
        }

        return $details;
    }

    public function getLegends(){
        $legends = [];

        foreach ($this->invoice->legends as $legend) {

            $legends[] = (new Legend())
                ->setCode($legend['code']) // Catalog. 52
                ->setValue($legend['value']);
        }

        return $legends;
    }

    //Despatch
    public function setDespatch(){
        $this->voucher = (new Despatch())
            ->setVersion('2022')
            ->setTipoDoc('09')
            ->setSerie($this->invoice->serie)
            ->setCorrelativo($this->invoice->correlativo)
            ->setFechaEmision($this->invoice->fechaEmision)
            ->setCompany($this->getCompany())
            ->setDestinatario($this->getDestinatario())
            ->setEnvio($this->getEnvio())
            ->setDetails($this->getDespatchDetails());
    }

    public function getDestinatario(){
        return (new Client())
            ->setTipoDoc($this->invoice->destinatario['tipoDoc'])
            ->setNumDoc($this->invoice->destinatario['numDoc'])
            ->setRznSocial($this->invoice->destinatario['rznSocial']);
    }

    public function getEnvio(){
        return (new Shipment())
            ->setCodTraslado('01') // Cat.20 - Venta
            ->setModTraslado('01') // Cat.18 - Transp. Publico
            /* ->setFecTraslado(new DateTime()) */
            ->setFecTraslado(new DateTime($this->invoice->envio['fecTraslado']))
            ->setPesoTotal(12.5)
            ->setUndPesoTotal('KGM')
            ->setLlegada(new Direction('150101', 'AV LIMA'))
            ->setPartida(new Direction('150203', 'AV ITALIA'))
            ->setTransportista($this->getTransportista());
    }

    public function getTransportista(){
        return (new Transportist())
            ->setTipoDoc('6')
            ->setNumDoc('20000000002')
            ->setRznSocial('TRANSPORTES S.A.C')
            ->setNroMtc('0001');
    }

    public function getDespatchDetails(){
        $details = [];

        foreach ($this->invoice->details as $item) {
            $details[] = (new DespatchDetail())
                ->setCantidad($item['cantidad'])
                ->setUnidad($item['unidad'])
                ->setDescripcion($item['descripcion'])
                ->setCodigo($item['codigo']);
        }

        return $details;
    }

    //Sunat
    public function setSee()
    {
        $endpoint = $this->company->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA;

        $this->see = new See();
        $this->see->setCertificate($this->company->certificate);
        $this->see->setService($endpoint);
        $this->see->setClaveSOL($this->company->ruc, $this->company->user_sol, $this->company->password_sol);
    }

    public function setSeeApi()
    {

        $this->api = new \Greenter\Api($this->company->production ? [
            'auth' => 'https://api-seguridad.sunat.gob.pe/v1',
            'cpe' => 'https://api-cpe.sunat.gob.pe/v1',
        ] : [
            'auth' => 'https://gre-test.nubefact.com/v1',
            'cpe' => 'https://gre-test.nubefact.com/v1',
        ]);

        $this->api->setBuilderOptions([
                'strict_variables' => true,
                'optimizations' => 0,
                'debug' => true,
                'cache' => false,
            ])
            ->setApiCredentials(
                $this->company->production ? $this->company->client_id : 'test-85e5b0ae-255c-4891-a595-0b98c65c9854', 
                $this->company->production ? $this->company->client_secret : 'test-Hty/M6QshYvPgItX2P0+Kw=='
            )
            ->setClaveSOL(
                $this->company->ruc, 
                $this->company->production ? $this->company->user_sol : 'MODDATOS', 
                $this->company->production ? $this->company->password_sol : 'MODDATOS'
            )
            ->setCertificate($this->company->certificate);
    }

    //Enviar a Sunat
    public function send(){

        $this->result = $this->see->send($this->voucher);

        $this->invoice->send_xml = true;
        $this->invoice->sunat_success = $this->result->isSuccess();
        $this->invoice->save();
        
        // Guardar XML firmado digitalmente.
        $xml = $this->see->getFactory()->getLastXml();
        $this->invoice->hash = (new XmlUtils())->getHashSign($xml);
        $this->invoice->xml_path = 'invoices/xml/' . $this->voucher->getName() . '.xml';
        Storage::put($this->invoice->xml_path, $xml, 'public');
        
        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$this->invoice->sunat_success) {
                
            $this->invoice->sunat_error = [
                'code' => $this->result->getError()->getCode(),
                'message' => $this->result->getError()->getMessage()
            ];
            $this->invoice->save();

            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Codigo Error: ' . $this->invoice->sunat_error['code'],
                'text' => $this->invoice->sunat_error['message']
            ]);

            return;
            
        }

        // Guardamos el CDR
        $this->invoice->sunat_cdr_path = "invoices/cdr/R-{$this->voucher->getName()}.zip";
        Storage::put($this->invoice->sunat_cdr_path, $this->result->getCdrZip(), 'public');
        $this->invoice->save();

        //Lectura del CDR
        $this->readCdr();
    }

    public function sendDespatch(){
        $this->result = $this->api->send($this->voucher);

        $this->invoice->send_xml = true;
        $this->invoice->sunat_success = $this->result->isSuccess();
        $this->invoice->save();

        // Guardar XML firmado digitalmente.
        $xml = $this->api->getLastXml();
        $this->invoice->hash = (new XmlUtils())->getHashSign($xml);
        $this->invoice->xml_path = 'guides/xml/' . $this->voucher->getName() . '.xml';
        Storage::put($this->invoice->xml_path, $xml, 'public');

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$this->invoice->sunat_success) {

            $this->invoice->sunat_error = [
                'code' => $this->result->getError()->getCode(),
                'message' => $this->result->getError()->getMessage()
            ];
            $this->invoice->save();

            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Codigo Error: ' . $this->invoice->sunat_error['code'],
                'text' => $this->invoice->sunat_error['message']
            ]);

            return;
            
        }
        
        //Ticket
        $ticket = $this->result->getTicket();
        $this->result = $this->api->getStatus($ticket);

        // Guardamos el CDR
        $this->invoice->sunat_cdr_path = "guides/cdr/R-{$this->voucher->getName()}.zip";
        Storage::put($this->invoice->sunat_cdr_path, $this->result->getCdrZip(), 'public');
        $this->invoice->save();
        
        //Lectura del CDR
        $this->readCdr();
    }

    public function sendXml($xml_path = null){

        $xmlSigned = Storage::get($xml_path ?? $this->invoice->xml_path);
        $this->result = $this->see->sendXmlFile($xmlSigned);

        $this->invoice->send_xml = true;
        $this->invoice->sunat_success = $this->result->isSuccess();
        $this->invoice->save();

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$this->invoice->sunat_success) {

            $this->invoice->sunat_error = [
                'code' => $this->result->getError()->getCode(),
                'message' => $this->result->getError()->getMessage()
            ];
            $this->invoice->save();

            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Codigo Error: ' . $this->invoice->sunat_error['code'],
                'text' => $this->invoice->sunat_error['message']
            ]);

            return;
        }

        // Guardamos el CDR
        $this->invoice->sunat_cdr_path = "invoices/cdr/R-{$this->voucher->getName()}.zip";
        Storage::put($this->invoice->sunat_cdr_path, $this->result->getCdrZip(), 'public');        
        $this->invoice->save();

        //Lectura del CDR
        $this->readCdr();
    }

    //Generar XML
    public function generateXml(){
        $xml = $this->see->getXmlSigned($this->voucher);

        $this->invoice->hash = (new XmlUtils())->getHashSign($xml);
        $this->invoice->xml_path = 'invoices/xml/' . $this->voucher->getName() . '.xml';

        Storage::put($this->invoice->xml_path, $xml, 'public');
        
        $this->invoice->save();
    }

    public function generateXmlDespatch(){

        //Generar XML
        $builder = new DespatchBuilder();
        $xml = $builder->build($this->voucher);

        //Firmar XML
        $signer = new SignedXml();
        $signer->setCertificate(Storage::get("certificates/certificate_{$this->company->id}.pem"));
        $xmlSigned = $signer->signXml($xml);

        //Guardar XML
        $this->invoice->hash = (new XmlUtils())->getHashSign($xmlSigned);
        $this->invoice->xml_path = 'guides/xml/' . $this->voucher->getName() . '.xml';
        Storage::put($this->invoice->xml_path, $xmlSigned, 'public');
        $this->invoice->save();
    }

    //Lectura del CDR
    public function readCdr(){
        $cdr = $this->result->getCdrResponse();

        $this->invoice->cdr_code = (int)$cdr->getCode();
        $this->invoice->cdr_notes = count($cdr->getNotes()) ? $cdr->getNotes() : null;
        $this->invoice->cdr_description = $cdr->getDescription();

        $this->invoice->save();

        if ($this->invoice->cdr_code === 0) {

            session()->flash('flash.sweetAlert', [
                'icon' => 'success',
                'title' => 'ESTADO: ACEPTADA',
                'text' => $this->invoice->cdr_notes ? 'OBSERVACIONES: ' . implode(', ', $cdr->getNotes()) : null,
                'footer' => $this->invoice->cdr_description,
            ]);

        } else if ($this->invoice->cdr_code >= 2000 && $this->invoice->cdr_code <= 3999) {

            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'ESTADO: RECHAZADA',
                'footer' => $this->invoice->cdr_description,
            ]);

        } else {
            /* Esto no debería darse, pero si ocurre, es un CDR inválido que debería tratarse como un error-excepción. */
            /*code: 0100 a 1999 */
            session()->flash('flash.sweetAlert', [
                'icon' => 'error',
                'title' => 'Excepción',
                'footer' => $this->invoice->cdr_description,
            ]);
        }
        
    }

    //Reportes
    public function generateHtmlReport(){

        $report = new HtmlReport(resource_path('views/sunat/template'), ['strict_variables' => true]);
        $report->setTemplate((new DefaultTemplateResolver())->getTemplate($this->voucher));

        $params = [
            'system' => [
                'logo' => $this->company->rectangle_image_path ? Storage::get($this->company->rectangle_image_path) : file_get_contents('img/logos/logo.png'), // Logo de Empresa
                'hash' => $this->invoice->hash, // Valor Resumen 
            ],
            'user' => [
                'header'     => "Telf: <b>{$this->company->phone}</b>", // Texto que se ubica debajo de la dirección de empresa
                'extras'     => [
                    // Leyendas adicionales
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'     ],
                    ['name' => 'VENDEDOR'         , 'value' => auth()->user()->name],
                ],
                'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
            ]
        ];

        $html = $report->render($this->voucher, $params);

        return $html;
    }

    public function generatePdfReport(){

        $htmlReport = new HtmlReport(resource_path('views/sunat/template'), ['strict_variables' => true]);
        $htmlReport->setTemplate((new DefaultTemplateResolver())->getTemplate($this->voucher));

        $report = new PdfReport($htmlReport);
        $report->setOptions( [
            'no-outline',
            'viewport-size' => '1280x1024',
            'page-width' => '21cm',
            'page-height' => '29.7cm',
        ]);
        $report->setBinPath(env('WKHTMLTOPDF_BINARIES')); // Ruta relativa o absoluta de wkhtmltopdf

        $params = [
            'system' => [
                'logo' => $this->company->rectangle_image_path ? Storage::get($this->company->rectangle_image_path) : file_get_contents('img/logos/logo.png'), // Logo de Empresa
                'hash' => $this->invoice->hash, // Valor Resumen 
            ],
            'user' => [
                'header'     => "Telf: <b>{$this->company->phone}</b>", // Texto que se ubica debajo de la dirección de empresa
                'extras'     => [
                    // Leyendas adicionales
                    ['name' => 'CONDICION DE PAGO', 'value' => 'Efectivo'     ],
                    ['name' => 'VENDEDOR'         , 'value' => 'GITHUB SELLER'],
                ],
                'footer' => '<p>Nro Resolucion: <b>3232323</b></p>'
            ]
        ];

        $pdf = $report->render($this->voucher, $params);

        if ($pdf) {
            $this->invoice->pdf_path = 'invoices/pdf/' . $this->voucher->getName() . '.pdf';
            Storage::put($this->invoice->pdf_path, $pdf, 'public');

            $this->invoice->save();
        }
    }
}