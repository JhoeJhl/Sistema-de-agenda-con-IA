<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Rutas del calendario
    Route::get('/calendario', function () {
        $eventosDb = App\Models\Evento::where('user_id', Illuminate\Support\Facades\Auth::id())->get();
        $eventosFormateados = $eventosDb->map(function ($evento) {
            return [
                'id' => $evento->id,
                'title' => $evento->titulo,
                'start' => $evento->fecha_inicio,
                'end' => $evento->fecha_fin,
                'backgroundColor' => $evento->es_ia_generado ? '#8b5cf6' : '#6366f1',
                'borderColor' => $evento->es_ia_generado ? '#8b5cf6' : '#6366f1',
            ];
        });
        return Inertia::render('Calendar/Index', ['eventos' => $eventosFormateados]);
    })->name('calendario.index');

    // eventos
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');
    
    // Dashboard 
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Ruta Calendario
    Route::get('/calendario', function () {
        return Inertia::render('Calendar/Index');
    })->name('calendario.index');

    // Profile breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
