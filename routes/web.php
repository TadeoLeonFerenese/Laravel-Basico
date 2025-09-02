<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);


//!COMENTARIO
// ['required', 'regex:/.*\d.*/']
// esto sirve para decirle al validator que en el campo de salary solo se debe agregar un sueldo con
// el formato ($numeros y coma)
//!COMENTARIO 2
// Route::resource() es un método que crea automáticamente las 7 rutas RESTful más comunes:
// GET /jobs - index (lista todos los jobs)
// GET /jobs/create - create (muestra form de creación)
// POST /jobs - store (guarda nuevo job)
// GET /jobs/{job} - show (muestra un job)
// GET /jobs/{job}/edit - edit (muestra form de edición)
// PUT/PATCH /jobs/{job} - update (actualiza un job)
// DELETE /jobs/{job} - destroy (elimina un job)
