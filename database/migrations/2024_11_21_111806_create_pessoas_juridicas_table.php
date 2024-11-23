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
        Schema::create('pessoas_juridicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade'); //fk one-to-one
            $table->string('razao_social', 100);
            $table->string('cnpj', 19)->unique();
            $table->string('rg_ie', 20)->unique()->nullable();
            $table->string('tipo_contribuinte', 30)->nullable();
            $table->string('isento_ie_estadual', 30)->nullable();
            $table->string('responsavel', 80)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pessoas_juridicas');
    }
};
