<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'categoria',
        'es_ia_generado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
