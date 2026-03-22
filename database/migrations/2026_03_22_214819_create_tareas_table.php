<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //Relacion con el usuario
            $table->string('titulo');
            $table->string('categoria')->nullable()->default('General');
            $table->enum('prioridad', ['Baja', 'Media', 'Alta'])->default('Media');
            $table->dateTime('fecha_vencimiento')->nullable();
            $table->enum('estado', ['pendiente', 'realizado', 'no_realizado'])->default('pendiente');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
