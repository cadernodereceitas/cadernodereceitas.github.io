<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\TipoReceita;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        TipoReceita::create([
            'nome' => 'Entrada'
        ]);

        TipoReceita::create([
            'nome' => 'Principal'
        ]);

        TipoReceita::create([
            'nome' => 'Sobremesa'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        TipoReceita::where('nome', 'Entrada')->first()->delete();
        TipoReceita::where('nome', 'Principal')->first()->delete();
        TipoReceita::where('nome', 'Sobremesa')->first()->delete();
    }
};
