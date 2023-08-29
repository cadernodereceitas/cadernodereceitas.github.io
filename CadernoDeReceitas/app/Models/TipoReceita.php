<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoReceita extends Model
{
    use HasFactory;

    protected $table = 'tipos_receitas';

    protected $fillable = ['nome'];

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:50'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 50 caracteres'
        ];
    }
}
