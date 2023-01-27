<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();
/*********************login/Register/logout Routes***************************************************************************/
Route::get('/login', [App\Http\Controllers\loginController::class, 'index'])->name('login');
Route::post('/loginUser', [App\Http\Controllers\loginController::class, 'loginUser'])->name('loginUser');
Route::get('/register', [App\Http\Controllers\loginController::class, 'registerIndex'])->name('register');
Route::post('/registerUser', [App\Http\Controllers\loginController::class, 'registerUser'])->name('registerUser');
Route::post('logout', [App\Http\Controllers\loginController::class, 'logout'])->name('logout');
/*********************login/Register/logout Routes***************************************************************************/

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    Route::get('home', [\App\Http\Controllers\UserController::class, 'homeIndex'])->name('home');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

/*********************Customer Routes***************************************************************************/
    Route::get('/customerSignupPage', [App\Http\Controllers\Customers\CustomerController::class, 'customerSignupPage'])->name('customerSignup');
    Route::post('/customerUpdatePage/id={id?}', [App\Http\Controllers\Customers\CustomerController::class, 'customerUpdatePage'])->name('customerUpdatePage');
    Route::post('/customerRegister', [App\Http\Controllers\Customers\CustomerController::class, 'customerRegister'])->name('Customers.registerCustomer');
    Route::get('/listCustomers', [App\Http\Controllers\Customers\CustomerController::class, 'listCustomers'])->name('Customers.listCustomers');
    Route::post('/customer/{id?}', [App\Http\Controllers\Customers\CustomerController::class, 'CustomerUpdate'])->name('Customer.update');
/*********************Customer Routes***************************************************************************/
});
