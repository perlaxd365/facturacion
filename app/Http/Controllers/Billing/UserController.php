<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Rules\BranchesCompany;
use App\Rules\UserCompany;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {

        return view('billing.users.index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        $branches = $company->branches()->get();
        return view('billing.users.create', compact('company', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Company $company)
    {
        $rules = [
            'userExists' => 'required|boolean',
            'is_admin' => 'required|boolean',
        ];

        if ($request->userExists) {
            $rules['user_id'] = ['required','exists:users,id', new UserCompany($company->id)];
        }else{
            $rules['name'] = 'required';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = ['required', 'confirmed', 'min:8'];
        }

        if ($request->is_admin == 0) {
            $rules['branches'] = ['required', 'array', new BranchesCompany($company)];
        }

        $request->validate($rules);

        if ($request->userExists) {
            $user = User::find($request->user_id);
        }else{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        }

        if ($request->is_admin) {
            
            $company->users()->attach($user->id, [
                'is_admin' => $request->is_admin,
            ]);

        }else{
                
            $company->users()->attach($user->id);

            $user->branches()->attach($request->branches);

        }

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario creado correctamente',
        ]);

        return redirect()->route('billing.users.edit', [$company, $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company, User $user)
    {
        $is_admin = $company->users->where('id', $user->id)->first()->pivot->is_admin;

        $assigned_branches = $is_admin ? [] : $user->branches()
                            ->whereHas('company', function($query) use ($company) {
                                $query->where('id', $company->id);
                            })->pluck('branches.id')->toArray();

        $branches = $company->branches()->get();

        return view('billing.users.edit', compact('is_admin', 'assigned_branches', 'branches', 'company', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Company $company, User $user)
    {
        $rules = [
            'is_admin' => 'required|boolean',
        ];

        if ($request->is_admin == 0) {
            $rules['branches'] = ['required', 'array', new BranchesCompany($company)];
        }

        $request->validate($rules);

        //Actualizar la tabla pivot de la relacion user company para cambiar el rol
        $company->users()->updateExistingPivot($user->id, [
            'is_admin' => $request->is_admin,
        ]);

        //Eliminar la relacion de la tabla pivot de la relacion user branch
        $branches = $user->branches()
            ->whereHas('company', function($query) use ($company) {
                $query->where('id', $company->id);
            })->pluck('branches.id');

        $user->branches()->detach($branches);

        if (!$request->is_admin) {
            //Crear la relacion de la tabla pivot de la relacion user branch
            $user->branches()->attach($request->branches);
        }

        session()->flash('flash.sweetAlert', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Usuario actualizado correctamente',
        ]);

        return redirect()->route('billing.users.edit', [$company, $user]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
