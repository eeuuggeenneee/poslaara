<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransactionController;
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
});

Route::get('/pos', function () {
    return view('livewire.sale-management');
})->name('pos');

Route::get('/inventory', function () {
    return view('livewire.product-management');
})->name('inventory');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/complete-transaction', [TransactionController::class, 'completeTransaction'])->name('completeTransaction');
