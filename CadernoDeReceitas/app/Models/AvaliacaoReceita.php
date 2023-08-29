<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoReceita extends Model
{
    use HasFactory;

    protected $table = 'avaliacoes_receitas';

    protected $fillable = ['user_id', 'receita_id', 'avaliacao'];
}
