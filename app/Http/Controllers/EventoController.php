<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Evento;
use Illuminate\Support\Facades\Auth;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventoRequest $request)
    {
        // 1. Validamos los datos que llegan de Vue
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            // Si no mandan fecha_fin, usamos la de inicio para que no haya error
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'es_ia_generado' => 'boolean'
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
            // 'descripcion' y 'categoria' los podemos añadir luego
        ]);

        // 4. Inertia recarga la página automáticamente con el nuevo evento
        return back()->with('success', 'Evento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventoRequest $request, Evento $evento)
    {
        // 1. Asegurarnos que el usuario solo modifique SUS eventos
        if ($evento->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para modificar este evento.');
        }

        // 2. Validar las nuevas fechas que llegan del Drag & Drop
        $validated = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // 3. Actualizar en la base de datos
        $evento->update([
            'fecha_inicio' => $validated['fecha_inicio'],
            'fecha_fin' => $validated['fecha_fin'],
        ]);

        // 4. Devolver una respuesta silenciosa (Inertia no necesita recargar toda la vista si el evento ya se movió en el frontend)
        return back()->with('success', 'Fechas actualizadas.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evento $evento)
    {
        if ($evento->user_id !== Auth::id()) {
            abort(403);
        }
        
        $evento->delete();
        
        return back()->with('success', 'Evento eliminado.');
    }
}
