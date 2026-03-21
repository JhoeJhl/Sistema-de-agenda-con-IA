<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validamos los datos que llegan de Vue
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'es_ia_generado' => 'boolean',
            'color' => 'nullable|string|max:7' // Más seguro en todas las versiones de Laravel
        ]);

        // 2. Si no hay fecha_fin, la igualamos a la de inicio
        if (empty($validated['fecha_fin'])) {
            $validated['fecha_fin'] = $validated['fecha_inicio'];
        }

        // 3. Creamos el evento asociado al usuario actual
        $request->user()->eventos()->create([
            'titulo' => $validated['titulo'],
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'es_ia_generado' => $request->boolean('es_ia_generado', false),
            'color' => $validated['color'] ?? '#6366f1'
        ]);

        // 4. Inertia recarga la página automáticamente
        return back()->with('success', 'Evento creado exitosamente.');
    }

    public function update(Request $request, Evento $evento)
    {
        if ($evento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar este evento.');
        }

        // Ahora validamos también el título y el color
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'color' => 'nullable|string|max:7'
        ]);

        // Actualizamos todos los datos del evento
        $evento->update([
            'titulo' => $validated['titulo'] ?? $evento->titulo,
            'descripcion' => $validated['descripcion'] ?? $evento->descripcion,
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'color' => $validated['color'] ?? $evento->color,
        ]);

        return back()->with('success', 'Evento actualizado.');
    }

    public function destroy(Evento $evento)
    {
        if ($evento->user_id !== Auth::id()) {
            abort(403);
        }

        $evento->delete();

        return back()->with('success', 'Evento eliminado.');
    }
}
