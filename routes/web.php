<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Agrupamos TODAS las rutas protegidas aquí
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Rutas del calendario (Extrae y formatea)
    Route::get('/calendario', function () {
        $eventosDb = Evento::where('user_id', Auth::id())->get();

        $eventosFormateados = $eventosDb->map(function ($evento) {
            return [
                'id' => (string) $evento->id,
                'title' => $evento->titulo,
                'start' => Carbon::parse($evento->fecha_inicio)->format('Y-m-d\TH:i:s'),
                'end' => $evento->fecha_fin ? Carbon::parse($evento->fecha_fin)->format('Y-m-d\TH:i:s') : null,
                'backgroundColor' => $evento->color ?? '#6366f1',
                'borderColor' => $evento->color ?? '#6366f1',
            ];
        });

        return Inertia::render('Calendar/Index', ['eventos' => $eventosFormateados]);
    })->name('calendario.index');

    // Guardar, actualizar y eliminar eventos
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    // Profile breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
