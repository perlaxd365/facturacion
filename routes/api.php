<?php

use App\Http\Controllers\Api\SunatController;
use App\Http\Controllers\Api\SunatTableController;
use App\Http\Controllers\Api\UbigeoController;
use App\Http\Controllers\Api\UserController;
use App\Models\Document;
use App\Models\Identity;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Users
Route::get('users', [UserController::class, 'index'])->name('api.users');

//Ubigeo
Route::get('ubigeos', [UbigeoController::class, 'index'])->name('api.ubigeos.index');
Route::get('departments', [UbigeoController::class, 'departments'])->name('api.departments');
Route::get('provinces', [UbigeoController::class, 'provinces'])->name('api.provinces');
Route::get('districts', [UbigeoController::class, 'districts'])->name('api.districts');

//Sunat
Route::get('/sunat/ruc', [SunatController::class, 'query'])->name('api.sunat.ruc');

//Sunat Tables
Route::get('operations', [SunatTableController::class, 'operations'])->name('api.operations');
Route::get('identities', [SunatTableController::class, 'identities'])->name('api.identities');
Route::get('currencies', [SunatTableController::class, 'currencies'])->name('api.currencies');
Route::get('affectations', [SunatTableController::class, 'affectations'])->name('api.affectations');
Route::get('units', [SunatTableController::class, 'units'])->name('api.units');
Route::get('credit-note-types', [SunatTableController::class, 'creditNoteTypes'])->name('api.credit-note-types');
Route::get('debit-note-types', [SunatTableController::class, 'debitNoteTypes'])->name('api.debit-note-types');
Route::get('transfer-reasons', [SunatTableController::class, 'transferReasons'])->name('api.transfer-reasons');