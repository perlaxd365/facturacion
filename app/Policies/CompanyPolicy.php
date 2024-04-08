<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CompanyPolicy
{
    
    public function belongsToUser(User $user, Company $company): bool
    {
        return $user->companies->contains($company);
    }

}
