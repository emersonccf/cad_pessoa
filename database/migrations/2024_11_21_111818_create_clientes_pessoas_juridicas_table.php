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
        Schema::create('clientes_pessoas_juridicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_juridica_id')->constrained('pessoas_juridicas')->onDelete('cascade'); //fk one-to-one
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_pessoas_juridicas');
    }
};
