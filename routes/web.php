<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // <- IMPORTANTE: Faltaba importar Request
use App\Models\Evento;
use App\Models\Tarea;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

Route::get('/', [HomeController::class, '__invoke']);

Route::middleware(['auth', 'verified'])->group(function () {

    // ==========================================
    // DASHBOARD
    // ==========================================
    Route::get('/dashboard', function () {
        $user = Auth::user();
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
            ->where('estado', 'pendiente') 
            ->orderBy('fecha_vencimiento', 'asc')
            ->get();
            
        $estadisticasSemana = [
            'dias' => ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            'tareas_completadas' => [2, 4, 3, 7, 5, 2, 0],
            'horas_invertidas' => [1.5, 3, 2, 5, 4, 1, 0]
        ];
        
        $tareasManana = [];
        
        return Inertia::render('Dashboard', [
            'userName' => $nombreAMostrar,
            'eventosHoyCount' => $eventosHoy->count(),
            'horasBloqueadas' => round($horasBloqueadas, 1),
            'proximosEventos' => $proximosEventos,
            'tareasHoy' => $tareasHoy,
            'tareasManana' => $tareasManana,
            'estadisticasSemana' => $estadisticasSemana,
        ]);
    })->name('dashboard');

    // ==========================================
    // TAREAS (DASHBOARD)
    // ==========================================
    Route::post('/tareas', function (Request $request) { // <- Corregido (Request $request)
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'nullable|string|max:50',
            'prioridad' => 'required|in:Baja,Media,Alta',
            'fecha_vencimiento' => 'required|date',
        ]);
        
        Tarea::create([
            'user_id' => Auth::id(),
            'titulo' => $validated['titulo'],
            'categoria' => $validated['categoria'] ?? 'General',
            'prioridad' => $validated['prioridad'],
            'fecha_vencimiento' => $validated['fecha_vencimiento'],
            'estado' => 'pendiente',
        ]);
        return back();
    })->name('tareas.store');

    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.update');

    // ==========================================
    // CALENDARIO Y EVENTOS
    // ==========================================
    
    // Vista del calendario
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

    // Posponer evento (Rutina separada correctamente)
    Route::put('/calendario/{evento}/posponer', function (Evento $evento) {
        if ($evento->user_id === Auth::id()) {
            $evento->update([
                'fecha_inicio' => Carbon::parse($evento->fecha_inicio)->addDay(),
                'fecha_fin' => Carbon::parse($evento->fecha_fin)->addDay()
            ]);
        }
        return back();
    })->name('calendario.posponer');

    // Eliminar evento desde el Dashboard (Rutina separada correctamente)
    Route::delete('/calendario/{evento}', function (Evento $evento) {
        if ($evento->user_id === Auth::id()) {
            $evento->delete();
        }
        return back();
    })->name('calendario.destroy');

    // CRUD eventos clásico
    Route::post('/eventos', [EventoController::class, 'store'])->name('eventos.store');
    Route::put('/eventos/{evento}', [EventoController::class, 'update'])->name('eventos.update');
    Route::delete('/eventos/{evento}', [EventoController::class, 'destroy'])->name('eventos.destroy');

    // ==========================================
    // PERFIL (BREEZE)
    // ==========================================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';