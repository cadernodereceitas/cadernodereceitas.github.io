<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemReceita extends Model
{
    use HasFactory;

    protected $table = 'imagens_receitas';

    protected $fillable = ['receita_id', 'imagem'];
}
