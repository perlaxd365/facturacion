<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentValidationRule implements ValidationRule
{

    public $tipoDoc;

    public function __construct($tipoDoc)
    {
        
        $this->tipoDoc = $tipoDoc;

    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        //DNI
        if ($this->tipoDoc == 1 && !is_numeric($value)) {
            $fail('El DNI debe ser numérico');
        }

        if ($this->tipoDoc == 1 && strlen($value) != 8) {
            $fail('El DNI debe tener 8 caracteres');
        }

        //RUC
        if ($this->tipoDoc == 6 && !is_numeric($value)) {
            $fail('El RUC debe ser numérico');
        }

        if ($this->tipoDoc == 6 && strlen($value) != 11) {
            $fail('El RUC debe tener 11 caracteres');
        }

        if ($this->tipoDoc == 6 && substr($value, 0, 2) != '10' && substr($value, 0, 2) != '20') {
            $fail('El RUC debe empezar con 10 o 20');
        }

    }
}
