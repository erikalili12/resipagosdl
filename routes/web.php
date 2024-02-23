<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomLoginController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('residentes.login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', [HomeController::class, 'index'])->name('index');
    Route::post('/index', [HomeController::class, 'postIndex']);
    Route::get('/residentes', [HomeController::class, 'index'])->name('residentes.index');
    Route::get('/residentes/create', [HomeController::class, 'create'])->name('residentes.create');
    Route::post('/residentes/store', [HomeController::class, 'store'])->name('residentes.store');
    Route::get('/residentes/{id_resident}/edit', [HomeController::class, 'edit'])->name('residentes.edit');
    Route::put('/residentes/{id_resident}', [HomeController::class, 'update'])->name('residentes.update');
    Route::delete('/residentes/{id_resident}', [HomeController::class, 'destroy'])->name('residentes.destroy');
    Route::get('/residentes/search', [HomeController::class, 'search'])->name('residentes.search');
    
    Route::get('/login', [HomeController::class, 'Login'])->name('login');
    Route::post('/logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::get('/residentes/pdf', [HomeController::class, 'pdf'])->name('residentes.pdf');
    Route::get('/residentes/imprimir/{id}', [HomeController::class, 'imprimir'])->name('residentes.imprimir');
    Route::post('/changepassword/{userId}', [HomeController::class, 'changepassword'])->name('changepassword');
    // web.php
    Route::get('/generar-pdf', [HomeController::class, 'generarPDF'])->name('pdf.generar');
    Route::get('/generar-pdf/{id_resident}', [HomeController::class, 'generarPDF'])->name('generarPDF');


    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::get('/change-password', [HomeController::class, 'showChangePasswordForm'])->name('change-password');
    Route::get('/aviso-privacidad', function () {
        return view('/residentes/aviso-privacidad');
    })->name('aviso.privacidad');
    Route::get('/aviso-legal', function () {
        return view('/residentes/aviso-legal');
    })->name('aviso.legal');
});

// Authentication Routes
Auth::routes(['login' => false]); // Desactivar la ruta /login predeterminada
Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login'); // Utiliza el controlador personalizado
Route::post('/login', [CustomLoginController::class, 'login']);

Route::middleware(['auth', 'role:admin'])->group( function () {
    Route::get('/admin/index', [HomeController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'vigilante'])->get('/vigilante/search1', [HomeController::class, 'search1'])->name('vigilante.search1');
Route::middleware(['auth', 'vigilante.email'])->get('/index', [HomeController::class, 'index'])->name('index');


