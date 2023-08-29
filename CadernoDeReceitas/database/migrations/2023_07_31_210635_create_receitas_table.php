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
        Schema::create('tipos_receitas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->timestamps();
        });

        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->unsignedBigInteger('tipo_receita_id');
            $table->text('ingredientes');
            $table->text('modo_preparo');
            $table->boolean('alcoolica')->default(false);
            $table->double('avaliacao', 3, 2)->default(0);
            $table->integer('quantidade_avaliacoes')->default(0);
            $table->integer('tempo_preparo');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('cadastrada_em');
            $table->boolean('aprovada')->default(false);
            $table->unsignedBigInteger('aprovada_por')->nullable();
            $table->dateTime('aprovada_em')->nullable();
            $table->timestamps();

            $table->foreign('tipo_receita_id')->references('id')->on('tipos_receitas');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('aprovada_por')->references('id')->on('users');
        });

        Schema::create('imagens_receitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receita_id');
            $table->string('imagem', 100);
            $table->timestamps();

            $table->foreign('receita_id')->references('id')->on('receitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('tipos_receitas');
        Schema::dropIfExists('receitas');
        Schema::dropIfExists('imagens_receitas');
        Schema::enableForeignKeyConstraints();
    }
};
