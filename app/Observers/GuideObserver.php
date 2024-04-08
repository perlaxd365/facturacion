<?php

namespace App\Observers;

use App\Models\Guide;
use Illuminate\Support\Facades\DB;

class GuideObserver
{
    public function creating(Guide $guide){
        $branch_voucher = DB::table('branch_voucher')
            ->where('branch_id', $guide->branch_id)
            ->where('serie', $guide->serie)
            ->first();

        $correlativo = Guide::where('branch_id', $guide->branch_id)
            ->where('serie', $guide->serie)
            ->max('correlativo');

        $guide->correlativo = $correlativo ? $correlativo + 1 : $branch_voucher->correlativo;

        if ($guide->destinatario['tipoDoc'] == '-') {

            $destinatario = $guide->destinatario;

            $destinatario['tipoDoc'] = '0';
            $destinatario['numDoc'] = $guide->destinatario['numDoc'] ? $guide->destinatario['numDoc'] : '-';

            $guide->destinatario = $destinatario;
        }

        if ($guide->envio['transportista']['tipoDoc'] == '-') {

            $transportista = $guide->envio['transportista'];

            $transportista['tipoDoc'] = '0';
            $transportista['numDoc'] = $guide->envio['transportista']['numDoc'] ? $guide->envio['transportista']['numDoc'] : '-';

            $guide->envio['transportista'] = $transportista;
        }
    }
}
