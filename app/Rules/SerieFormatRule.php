<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SerieFormatRule implements ValidationRule
{

    public $voucher_id;

    public function __construct($voucher_id)
    {
        $this->voucher_id = $voucher_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //Si voucher_id es 1,  3 o 4 debe tener 4 caracteres alfanumericos y empezar con F
        if (in_array($this->voucher_id, [1, 3, 4])) {
            if (!preg_match('/^F[A-Za-z0-9]{3}$/', $value)) {
                $fail('El formato de la serie es incorrecto.');
            }
        }

        //Si voucher_id es 2, 5 o 6 debe tener 4 caracteres numericos y empezar con B
        if (in_array($this->voucher_id, [2, 5, 6])) {
            if (!preg_match('/^B[A-Za-z0-9]{3}$/', $value)) {
                $fail('El formato de la serie es incorrecto.');
            }
        }

        //Si voucher_id es 7 debe tener 4 caracteres numericos y empezar con T
        if ($this->voucher_id == 7) {
            if (!preg_match('/^T[A-Za-z0-9]{3}$/', $value)) {
                $fail('El formato de la serie es incorrecto.');
            }
        }
    }
}
