<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'titulo',
        'categoria',
        'prioridad',
        'fecha_vencimiento',
        'estado'
    ];
    protected $casts = [
        'fecha_vencimiento' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}