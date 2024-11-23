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
        Schema::create('clientes_pessoas_fisicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_fisica_id')->constrained('pessoas_fisicas')->onDelete('cascade'); //fk one-to-one
            $table->decimal('desconto',8,2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes_pessoas_fisicas');
    }
};
