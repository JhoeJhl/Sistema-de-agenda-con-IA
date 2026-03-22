<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Evento;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

Route::get('/', [HomeController::class, '__invoke']);

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard

    Route::get('/dashboard', function () {
        $user = Auth::user();
        // Extre el primer usuario
        $nombreAMostrar = explode(' ', $user->name)[0];
        $userId = $user->id;
        $hoyInicio = Carbon::today();
        $hoyFin = Carbon::today()->endOfDay();
        $eventosHoy = Evento::where('user_id', $userId)
            ->whereBetween('fecha_inicio', [$hoyInicio, $hoyFin])
            ->orderBy('fecha_inicio', 'asc')
            ->get();
        $proximosEventos = Evento::where('user_id', $userId)
            ->where('fecha_inicio', '>=', now())
            ->orderBy('fecha_inicio', 'asc')
            ->take(4)
            ->get();
        $horasBloqueadas = 0;
        foreach ($eventosHoy as $evento) {
            $inicio = Carbon::parse($evento->fecha_inicio);
            $fin = Carbon::parse($evento->fecha_fin ?? $evento->fecha_inicio);
            $horasBloqueadas += $inicio->diffInMinutes($fin) / 60;
        }
        $tareasHoy = Tarea::where('user_id', $userId)
            ->whereDate('fecha_vencimiento', \Carbon\Carbon::today())
            ->where('estado', 'pendiente') // Solo mostramos las que faltan por hacer
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();

        $tareasManana = Tarea::where('user_id', $userId)
            ->whereDate('fecha_vencimiento', \Carbon\Carbon::tomorrow())
            ->where('estado', 'pendiente')
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();
        return Inertia::render('Dashboard', [
            'userName' => $nombreAMostrar,
            'eventosHoyCount' => $eventosHoy->count(),
            'horasBloqueadas' => round($horasBloqueadas, 1),
            'proximosEventos' => $proximosEventos,
            'tareasHoy' => $tareasHoy,
            'tareasManana' => $tareasManana,
        ]);
    })->name('dashboard');

    // Calendario
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
                'description' => $evento->descripcion,
            ];
        });

        return Inertia::render('Calendar/Index', ['eventos' => $eventosFormateados]);
    })->name('calendario.index');

    // CRUD eventos
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    // Profile breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
