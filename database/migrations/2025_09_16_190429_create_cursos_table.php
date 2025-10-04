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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('url_imagen_de_portada')->nullable();
            
            // Categorización
            $table->enum('categoria', ['deportiva', 'pedagogica', 'disciplinaria', 'idiomatica', 'otra'])->default('otra');
            $table->enum('nivel', ['basico', 'intermedio', 'avanzado'])->default('basico');
            
            // Información de precio y capacidad
            $table->decimal('precio', 10, 2);
            
            // Detalles del curso
            $table->integer('cupos');
            $table->enum('certificacion', ['si', 'no'])->default('no');
            $table->json('requisitos')->nullable();
            $table->json('metas')->nullable();
            
            // Info
            $table->string('numero_de_contacto', 20);
            $table->string('direccion', 255);
            $table->string('email_contacto')->nullable();
            $table->json('redes_sociales')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Fechas
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            
            // Estado y visibilidad
            $table->enum('estado', ['borrador', 'publicado', 'finalizado', 'cancelado'])->default('borrador');
            $table->boolean('destacado')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
