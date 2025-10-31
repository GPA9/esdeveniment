<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // dades taula que pujarem a la base de dades
        Schema::create('esdeveniments', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcio')->nullable();
            $table->date('data'); 
            $table->time('hora'); 
            $table->integer('num_max_assistents')->nullable();
            $table->integer('edat_minima')->nullable();
            $table->string('imatge')->nullable(); 
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('esdeveniments');
    }
};