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
        Schema::create('pessoas_fisicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->unique()->constrained('pessoas')->onDelete('cascade'); //fk one-to-one
            $table->string('cpf', 19)->unique();
            $table->string('rg', 20)->unique()->nullable();
            $table->string('identidade_estrangeiro', 20)->unique()->nullable();
            $table->date('data_nascimento')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas_fisicas');
    }
};
