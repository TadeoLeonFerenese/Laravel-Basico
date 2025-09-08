<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;
use Illuminate\Support\Facades\Route;
use App\Mail\JobPosted;

Route::get('test', function () {
    // Illuminate\Support\Facades\Mail::to('test@example.com')
    //     ->send (new \App\Mail\JobPosted());
    $job = Job::first();

    TranslateJob::dispatch($job);

    return 'Done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);



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
