<?php

use App\Http\Controllers\Billing\BranchController;
use App\Http\Controllers\Billing\CompanyController;
use App\Http\Controllers\Billing\DocumentController;
use App\Http\Controllers\Billing\UserController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Company $company) {
    
    return view('billing.dashboard', compact('company'));
    
})->name('dashboard');

Route::get('/companies/information', [CompanyController::class, 'information'])
    ->name('companies.information');

Route::post('/companies/information', [CompanyController::class, 'informationStore'])
    ->name('companies.information.store');

Route::get('/companies/credentials', [CompanyController::class, 'credentials'])
    ->name('companies.credentials');

Route::post('/companies/credentials', [CompanyController::class, 'credentialsStore'])
    ->name('companies.credentials.store');

Route::get('/companies/api-credentials', [CompanyController::class, 'apiCredentials'])
    ->name('companies.api-credentials');

Route::post('/companies/api-credentials', [CompanyController::class, 'apiCredentialsStore'])
    ->name('companies.api-credentials.store');

Route::get('/companies/certificate', [CompanyController::class, 'certificate'])
    ->name('companies.certificate');

Route::post('/companies/certificate', [CompanyController::class, 'certificateStore'])
    ->name('companies.certificate.store');

Route::resource('branches', BranchController::class);

Route::resource('users', UserController::class);

Route::get('documents/invoices', [DocumentController::class, 'invoices'])
        ->name('documents.invoices.index');

Route::get('documents/invoices/factura/create', [DocumentController::class, 'facturaCreate'])
        ->name('documents.invoices.factura.create');

Route::get('documents/invoices/boleta/create', [DocumentController::class, 'boletaCreate'])
        ->name('documents.invoices.boleta.create');

Route::get('documents/invoices/nota-credito/create', [DocumentController::class, 'notaCreditoCreate'])
        ->name('documents.invoices.nota-credito.create');

Route::get('documents/invoices/nota-debito/create', [DocumentController::class, 'notaDebitoCreate'])
        ->name('documents.invoices.nota-debito.create');

Route::get('documents/guias', [DocumentController::class, 'guides'])
    ->name('documents.guides.index');

Route::get('documents/guias/create', [DocumentController::class, 'guiaCreate'])
    ->name('documents.guides.create');