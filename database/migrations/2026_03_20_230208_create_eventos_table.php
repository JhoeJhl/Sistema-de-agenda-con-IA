<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('titulo')->default('Evento sin título');
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->string('categoria')->default('general');
            $table->string('color')->default('#6366f1');
            $table->boolean('es_ia_generado')->default(false);

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('eventos');

        //Aqui agregar logica para poder recuperar todos los datos guardados y no perder nada 
    }
};
