<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SunatController extends Controller
{
    public function query(){
        $ruc = request()->get('ruc');

        $sunat = new \jossmp\sunat\ruc([
            'representantes_legales' 	=> false,
            'cantidad_trabajadores' 	=> false,
            'establecimientos' 			=> false,
            'deuda' 					=> false,
        ]);

        $company = $sunat->consulta($ruc);

        return response()->json($company);
    }
}
