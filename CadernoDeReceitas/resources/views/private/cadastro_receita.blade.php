@extends('general.basico')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/cadastro-receita-style.css') }}">
@endsection

@section('titulo', 'Cadastrar')

@section('conteudo')

    <div class="conteudo">
        <h1>Cadastro de Nova Receita</h1>
        <form class="formulario" name="formcadastro" method="post" action="{{ route('cadastrar_receita') }}" enctype="multipart/form-data">
            @csrf

            <label class="label-input-titulo">Título da Receita:
                <input class="input-titulo" type="text" name="nome" value="{{ $receita->nome ?? old('nome') }}">
            </label>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}

            <label class="label-input-titulo">Tempo de Preparo:
                <input class="input-titulo" type="text" name="tempo_preparo" value="{{ $receita->tempo_preparo ?? old('tempo_preparo') }}">
            </label>
            {{ $errors->has('tempo_preparo') ? $errors->first('tempo_preparo') : '' }}

            <label class="label-input-titulo">Alcoólica:
                <input class="input-titulo" type="checkbox" name="alcoolica" {{ ($receita->alcoolica ?? old('alcoolica')) ? 'checked' : '' }}>
            </label>

            <div class="div-tipo-receita">
                <label class="label-tipo-receita">Tipo de Receita: </label>
                <select class="dropdown" name="tipo_receita_id">
                    <option value="">Selecionar...</option>
                    @foreach ($tiposReceitas as $tipoReceita)
                        <option value="{{ $tipoReceita->id }}" {{ isset($receita->tipo_receita_id) && $receita->tipo_receita_id == $tipoReceita->id ? 'selected' : '' }}>{{ $tipoReceita->nome }}</option>
                    @endforeach
                </select>
                {{ $errors->has('tipo_receita_id') ? $errors->first('tipo_receita_id') : '' }}
            </div>

            <label class="label-input">Ingredientes:
                <textarea id="ingredientes" name="ingredientes">{{ $receita->ingredientes ?? old('ingredientes') }}</textarea>
            </label>
            {{ $errors->has('ingredientes') ? $errors->first('ingredientes') : '' }}

            <label class="label-input">Modo de Preparo:
                <textarea id="modo_preparo" name="modo_preparo">{{ $receita->modo_preparo ?? old('modo_preparo') }}</textarea>
            </label>
            {{ $errors->has('modo_preparo') ? $errors->first('modo_preparo') : '' }}

            <label class="titulo-input" for="imagem">Imagem:</label>
            <input id="imagem" class="imagem" name="imagem" type="file" multiple="multiple">
            <div class="botoes">
                <button id="enviar" class="botao-enviar" type="submit">ENVIAR</button>
            </div>
        </form>
    </div>
@endsection