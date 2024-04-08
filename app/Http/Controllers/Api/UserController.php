<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        return User::select('id', 'name', 'email')
            ->orderBy('name')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->when($request->company_id, function ($query, $company_id) {
                
                $query->whereDoesntHave('companies', function ($query) use ($company_id) {
                    $query->where('company_id', $company_id);
                });

            })
            ->get();
    }
}
