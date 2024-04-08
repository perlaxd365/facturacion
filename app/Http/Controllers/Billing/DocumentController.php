<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('company.credentials')->except('invoices', 'guides');
        /* $this->middleware('company.api-credentials')->only('guiaCreate'); */
        $this->middleware('company.certificate')->except('invoices', 'guides');
    }

    public function invoices(Company $company){
        return view('billing.documents.invoices', compact('company'));
    }

    public function guides(Company $company){
        return view('billing.documents.guides', compact('company'));
    }

    //Crear documentos
    public function facturaCreate(Company $company){

        $document = Document::find('01');
        return view('billing.documents.create', compact('company', 'document'));

    }

    public function boletaCreate(Company $company){

        $document = Document::find('03');

        return view('billing.documents.create', compact('company', 'document'));
        
    }

    public function notaCreditoCreate(Company $company){

        $document = Document::find('07');

        return view('billing.documents.create', compact('company', 'document'));
        
    }

    public function notaDebitoCreate(Company $company){

        $document = Document::find('08');

        return view('billing.documents.create', compact('company', 'document'));
        
    }

    public function guiaCreate(Company $company)
    {
        $document = Document::find('09');
        return view('billing.documents.create', compact('company', 'document'));
    }
}
