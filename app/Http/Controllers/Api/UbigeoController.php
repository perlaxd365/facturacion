<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{

    public function index(Request $request){

        //Department - Province - District
        return District::with(['province.department'])
            ->when($request->search, function ($query, $search) {

                $terms = explode(' - ', $search);

                if (count($terms) == 3) {
                    
                    $query->whereHas('province', function ($query) use ($terms) {
                        $query->whereHas('department', function ($query) use ($terms) {
                            $query->where('name', 'like', '%' . $terms[0] . '%');
                        })->where('name', 'like', '%' . $terms[1] . '%');
                    })->where('name', 'like', '%' . $terms[2] . '%');

                }elseif (count($terms) == 2) {
                        
                        $query->whereHas('province', function ($query) use ($terms) {
                            $query->whereHas('department', function ($query) use ($terms) {
                                $query->where('name', 'like', '%' . $terms[0] . '%');
                            })->where('name', 'like', '%' . $terms[1] . '%');
                        });
                }else{

                    $query->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhereHas('province', function ($query) use ($search) {
                                $query->where('name', 'like', '%' . $search . '%')
                                    ->orWhereHas('department', function ($query) use ($search) {
                                        $query->where('name', 'like', '%' . $search . '%');
                                    });
                            });
                    });
                }

            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
                fn ($query) => $query->limit(10)
            )
            ->get()
            ->map(function ($district) {
                return [
                    'id' => $district->id,
                    'name' => $district->province->department->name . ' - ' . $district->province->name . ' - ' . $district->name,
                ];
            });
    }

    public function departments(Request $request)
    {
        return Department::select('id', 'name')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->get();

    }

    public function provinces(Request $request)
    {
        return Province::select('id', 'name', 'department_id')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->exists('department_id'), function ($query) use ($request) {
                $query->where('department_id', $request->department_id);
            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->get();
    }

    public function districts(Request $request){
        return District::select('id', 'name')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($request->exists('province_id'), function ($query) use ($request) {
                $query->where('province_id', $request->province_id);
            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->get();
    }
}
