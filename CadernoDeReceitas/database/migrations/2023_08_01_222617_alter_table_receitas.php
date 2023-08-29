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
        Schema::table('receitas', function(Blueprint $table) {
            $table->dropColumn('avaliacao');
            $table->dropColumn('quantidade_avaliacoes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('receitas', function(Blueprint $table) {
            $table->double('avaliacao', 3, 2)->default(0);
            $table->integer('quantidade_avaliacoes')->default(0);
        });
    }
};
