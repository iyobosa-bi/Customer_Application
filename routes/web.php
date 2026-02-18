<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

// Route::get('/customers', function () {
//     return view('customers.index');
// });


Route::resource('customers',CustomerController::class);