<?php

namespace App\Rules;

use App\Models\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BranchesCompany implements ValidationRule
{
    public $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $branches = $this->company->branches()->pluck('id');

        foreach ($value as $branch) {

            if (!$branches->contains($branch)) {
                $fail("Una o más sucursales no pertenecen a la empresa seleccionada.");
            }

        }
    }
}
