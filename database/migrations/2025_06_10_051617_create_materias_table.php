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
        Schema::create('materias', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('nombre', 100); // varchar(100) NOT NULL
            $table->string('codigo', 20)->unique(); // varchar(20) NOT NULL UNIQUE
            $table->integer('creditos'); // int(11) NOT NULL
            $table->string('requisitos', 255)->nullable(); // varchar(255) DEFAULT NULL
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};