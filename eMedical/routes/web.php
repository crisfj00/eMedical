<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientsController;


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


Route::resource('patients', PatientsController::class)->except(['edit','destroy'])->middleware('role:admin','verified');

require __DIR__.'/auth.php';
