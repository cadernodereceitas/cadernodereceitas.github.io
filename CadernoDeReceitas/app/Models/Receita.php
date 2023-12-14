<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $table = 'receitas';

    protected $fillable = ['nome', 'tipo_receita_id', 'ingredientes', 'modo_preparo', 'alcoolica', 'tempo_preparo', 'user_id', 'cadastrada_em', 'aprovada', 'aprovada_por', 'aprovada_em', 'porcoes'];

    public function tipoReceita()
    {
        return $this->belongsTo(TipoReceita::class);
    }

    public function imagens()
    {
        return $this->hasMany(ImagemReceita::class, 'receita_id', 'id');
    }

    public function avaliacoes()
    {
        return $this->hasMany(AvaliacaoReceita::class, 'receita_id', 'id');
    }

    public function favoritada()
    {
        return $this->hasMany(Favorito::class, 'receita_id', 'id');
    }

    public function listaFavoritada($user_id)
    {
        return $this->hasMany(Favorito::class, 'receita_id', 'id')->where('favoritos.user_id', $user_id)->get();
    }

    public function avaliacaoReceita()
    {
        if(isset($this->avaliacoes) && sizeof($this->avaliacoes) > 0)
        {
            return $this->avaliacoes->sum('avaliacao') / sizeof($this->avaliacoes);
        }
        else
        {
            return 0;
        }
    }

    public function rules()
    {
        return [
            'nome' => 'required|min:3|max:50',
            'tipo_receita_id' => 'exists:tipos_receitas,id',
            'ingredientes' => 'required|min:3|max:2000',
            'modo_preparo' => 'required|min:3|max:2000',
            'tempo_preparo' => 'integer',
            'imagem' => 'required|file|mimes:png,jpg,jpeg'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'tipo_receita_id.exists' => 'O tipo de receita informado não existe',
            'ingredites.min' => 'O campo ingredientes deve possuir ao menos 3 caracteres',
            'ingredientes.max' => 'O campo ingredientes deve ter no máximo 2000 caracteres',
            'modo_preparo.required' => 'O campo modo de preparo é obrigatório',
            'modo_preparo.min' => 'O campo modo de preparo deve possuir ao menos 3 caracteres',
            'modo_preparo.max' => 'O campo modo de preparo deve ter no máximo 2000 caracteres',
            'tempo_preparo.integer' => 'O campo tempo de preparo deve ser preenchido com um número inteiro',
            'imagem.mimes' => 'O arquivo deve ser uma imagem nos formatos png, jpg ou jpeg'
        ];
    }
}
