<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public function update(Request $request, Tarea $tarea)
    {
        // verificacion si pertenece la tarea al usuario
        if ($tarea->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado');
        }
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,realizado,no_realizado',
        ]);
        $tarea->update([
            'estado' => $validated['estado']
        ]);
        return back()->with('success', 'Tarea actualizada correctamente.');
    }
}
