<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceObserver
{
    public function creating(Invoice $invoice)
    {
        //Company
        $company = Company::whereHas('branches', function ($query) use ($invoice) {
            $query->where('id', $invoice->branch_id);
        })->first();

        $invoice->company = [
            'ruc' => $company->ruc,
            'razonSocial' => $company->razonSocial,
            'address' => [
                'direccion' => $company->address->direccion,
            ],
        ];

        //Client
        if ($invoice->client['tipoDoc'] == '-') {

            $client = $invoice->client;

            $client['tipoDoc'] = '0';
            $client['numDoc'] = $invoice->client['numDoc'] ? $invoice->client['numDoc'] : '-';

            $invoice->client = $client;
        }

        //Serie y correlativo
        $branch_voucher = DB::table('branch_voucher')
                            ->where('branch_id', $invoice->branch_id)
                            ->where('serie', $invoice->serie)
                            ->first();

        $correlativo = Invoice::where('branch_id', $invoice->branch_id)
                        ->where('serie', $invoice->serie)
                        ->where('production', $company->production)
                        ->max('correlativo');

        $invoice->correlativo = $correlativo ? $correlativo + 1 : $branch_voucher->correlativo;

        //Production
        $invoice->production = $company->production;

    }
}
