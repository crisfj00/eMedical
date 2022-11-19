<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\PrescriptionsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

Route::post('api/fetch-doctors', [PrescriptionsController::class, 'fetchDoctors']);

Route::resource('patients', PatientsController::class)->except(['edit','destroy','create'])->middleware('role:admin','verified');

Route::resource('prescriptions', PrescriptionsController::class)->except(['edit'])->middleware('role:patient','verified');

Route::resource('prescriptions', PrescriptionsController::class)->except(['create','destroy','show'])->middleware('role:doctor','verified');


Route::resource('doctors', DoctorsController::class)->except(['edit'])->middleware('role:admin','verified');

//Route::resource('doctors', DoctorsController::class)->except(['index','destroy'])->middleware('role:doctor','verified');

require __DIR__.'/auth.php';


#create, read, update, destroy, index