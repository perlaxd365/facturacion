<?php

use App\Http\Controllers\CompanyController;
use App\Models\Company;
use App\Models\Guide;
use App\Services\SunatService;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('about', function () {
    return view('about');
})->name('about');

Route::get('services', function () {
    return view('services');
})->name('services');

Route::get('contact', function () {
    return view('contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    /* Route::get('/dashboard', function () {
        $department = \App\Models\Department::find(3);
        return view('dashboard', compact('department'));
    })->name('dashboard'); */

    Route::redirect('/dashboard', '/companies')->name('dashboard');;

    Route::resource('companies', CompanyController::class);
});

Route::get('prueba', function(){

    $file = file_get_contents('certificate/LLAMA-PE-CERTIFICADO-DEMO-20609278235.pfx');

    $results = [];
    openssl_pkcs12_read($file, $results, '12345678');

    return $results;

    $certificate = $results['pkey'] . $results['cert'];

    return $certificate;
});