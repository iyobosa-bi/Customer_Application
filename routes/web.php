<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Route::get('/customers', function () {
//     return view('customers.index');
// });




Route::get('/customers/trash',[CustomerController::class,'trash'])->name('customers.trash');

Route::get('/customers/{customer}/restore', [CustomerController::class,'restore'])->name(name: 'customers.restore');
Route::delete('/customers/{customer}/forceDelete', [CustomerController::class,'forceDelete'])->name(name: 'customers.forcedestroy');

Route::get('/',[CustomerController::class,'index']);
Route::resource('customers',CustomerController::class);


