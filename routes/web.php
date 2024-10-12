<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;

// VIEW ROUTES
Route::get('/', [FirebaseController::class, 'login'])
->name('view.login');

Route::get('/register', [FirebaseController::class, 'register'])
->name('view.register');

Route::get('/loaders', [FirebaseController::class, 'loaders'])
->name('view.loaders');

Route::get('/dashboard', [FirebaseController::class, 'fetchExpenses'])->name('view.dashboard');

Route::get('/customer', [FirebaseController::class, 'user'])
->name('view.user');

Route::get('/customerInfo',[FirebaseController::class, 'updateInfo'])
->name('view.updateInfo');

Route::get('/customerInfo{key}',[FirebaseController::class, 'customerInfo'])
->name('view.customerInfo');

Route::get('/editProfile{key}',[FirebaseController::class, 'editProfile'])
->name(name: 'view.editProfile');

Route::get('/logout', [FirebaseController::class, 'logout'])
->name('view.logout');


// FIREBASE ROUTES
Route::post('/store',[FirebaseController::class, 'store'])
->name( 'firebase.store');

Route::post('/login',[FirebaseController::class, 'checkLogin'])
->name( 'firebase.checkLogin');

Route::put('/edit/{key}',[FirebaseController::class, 'edit'])
->name( 'firebase.edit');