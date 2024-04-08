<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Affectation;
use App\Models\CreditNoteType;
use App\Models\Currency;
use App\Models\DebitNoteType;
use App\Models\Document;
use App\Models\Identity;
use App\Models\Operation;
use App\Models\TransferReason;
use App\Models\Unit;
use Illuminate\Http\Request;

class SunatTableController extends Controller
{
    

    public function operations(Request $request){
        return Operation::select('id', 'description as name')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->when($request->exists('tipoDoc'), function ($query) use ($request) {
        
                $query->whereHas('documents', function($query) use ($request){

                    $query->where('document_id', $request->tipoDoc);

                });
            })
            ->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', [])),
            )
            ->get();
    }

    public function identities(Request $request){
        return Identity::select('id', 'description as name')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })
            ->when($request->exists('tipoOperacion') && $request->exists('tipoDoc'), function ($query) use ($request) {
        
                $query->whereHas('operations', function($query) use ($request){

                    $query->where('operation_id', $request->tipoOperacion)
                        ->where('document_id', $request->tipoDoc);

                });
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->get();
    }

    public function currencies(Request $request){
        return Currency::select('id', 'description as name', 'order')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->orderBy('order', 'asc')
            ->get();
    }

    public function affectations(Request $request){
        return Affectation::select('id', 'description as name', 'igv', 'free')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )->get();
    }

    public function units(Request $request){
        return Unit::select('id', 'description as name', 'order')
        ->when($request->search, function ($query, $search) {
            $query->where('description', 'like', '%' . $search . '%');
        })
        /* ->when($request->undPeso, function($query, $undPeso){
            $query->where('undPeso', $undPeso);
        }) */
        ->when(
            $request->exists('undPeso'),
            fn ($query) => $query->where('undPeso', $request->undPeso),
        )
        ->when(
            $request->exists('selected'),
            fn ($query) => $query->whereIn('id', $request->input('selected', [])),
        )
        ->orderBy('order', 'asc')
        ->get();
    }

    public function creditNoteTypes(Request $request){
        return CreditNoteType::select('code', 'description as name')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('code', $request->input('selected', []))
            )->get();
    }

    public function debitNoteTypes(Request $request){
        return DebitNoteType::select('code', 'description as name')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('code', $request->input('selected', []))
            )->get();
    }

    public function transferReasons(Request $request){
        return TransferReason::select('id', 'description as name', 'order')
            ->when($request->search, function ($query, $search) {
                $query->where('description', 'like', '%' . $search . '%');
            })->when(
                $request->exists('selected'),
                fn ($query) => $query->whereIn('id', $request->input('selected', []))
            )
            ->orderBy('order', 'asc')
            ->get();
    }
}
