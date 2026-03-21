<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    public function store(Request $request)
    {
        // Validacion datos Vue
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'es_ia_generado' => 'boolean',
            'color' => 'nullable|string|max:7' 
        ]);
        
        // Igual fecha fin a fecha inicio si no existe fecha fin
        if (empty($validated['fecha_fin'])) {
            $validated['fecha_fin'] = $validated['fecha_inicio'];
        }

        // Creacion del evento usuario actual
        $request->user()->eventos()->create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
            'es_ia_generado' => $request->boolean('es_ia_generado', false),
            'color' => $validated['color'] ?? '#6366f1'
        ]);
        return back()->with('success', 'Evento creado exitosamente.');
    }

    public function update(Request $request, Evento $evento)
    {
        if ($evento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar este evento.');
        }

        // Validacion de datos
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'color' => 'nullable|string|max:7'
        ]);

        // Actualizacion de datos del evento
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
