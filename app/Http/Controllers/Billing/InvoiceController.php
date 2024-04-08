<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Document;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Services\SunatService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index(Company $company){

        return view('billing.documents.invoices', compact('company'));
    }

    public function factura(Company $company){

        $document = Document::find('01');
        return view('billing.documents.create', compact('company', 'document'));

    }

    public function boleta(Company $company){

        $document = Document::find('03');

        return view('billing.documents.create', compact('company', 'document'));
        
    }

    public function notaCredito(Company $company){

        $document = Document::find('07');

        return view('billing.documents.create', compact('company', 'document'));
        
    }

    public function notaDebito(Company $company){

        $document = Document::find('08');

        return view('billing.documents.create', compact('company', 'document'));
        
    }
}
