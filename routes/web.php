<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Route::get('/customers', function () {
//     return view('customers.index');
// });


Route::get('/customers/trash',[CustomerController::class,'trash'])->name('customers.trash');
Route::resource('customers',CustomerController::class);
