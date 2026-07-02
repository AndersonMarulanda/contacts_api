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
        Schema::create('contacts', function (Blueprint $table) {

            // Llave primaria
            $table->id();

            // Llave foránea hacia la tabla users
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Nombre del contacto
            $table->string('nombre');

            // Teléfono (no puede repetirse)
            $table->string('telefono')->unique();

            // Correo electrónico (opcional)
            $table->string('email')->nullable();

            // Fechas de creación y actualización
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
