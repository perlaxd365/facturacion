<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidRuc implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $sunat = new \jossmp\sunat\ruc([
            'representantes_legales' 	=> false,
            'cantidad_trabajadores' 	=> false,
            'establecimientos' 			=> false,
            'deuda' 					=> false,
        ]);

        $search = $sunat->consulta($value);

        if (!$search->success){
            $fail('El :attribute ingresado no es válido.');
        }

    }
}
