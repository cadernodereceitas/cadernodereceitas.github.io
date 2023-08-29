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
        Schema::create('avaliacoes_receitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('receita_id');
            $table->double('avaliacao', 3, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receita_id')->references('id')->on('receitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('avaliacoes_receitas');
        Schema::enableForeignKeyConstraints();
    }
};
