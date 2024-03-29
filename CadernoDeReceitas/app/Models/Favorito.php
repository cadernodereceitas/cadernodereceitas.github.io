<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'receita_id'];

    public function receitas()
    {
        return $this->belongsTo(Receita::class, 'receita_id', 'id');
    }
}
