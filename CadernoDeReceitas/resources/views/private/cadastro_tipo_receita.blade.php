@extends('general.basico')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/cadastro-receita-style.css') }}">
@endsection

@section('titulo', 'Cadastrar')

@section('conteudo')

    <div class="conteudo">
        <h1>Cadastro de Tipo de Receita</h1>
        <form class="formulario" name="formcadastro" method="post" action="{{ route('cadastrar_receita') }}">
            @csrf

            <label class="label-input-titulo">Nome do Tipo de Receita:
                <input class="input-titulo" type="text" name="nome" value="{{ $tipoReceita->nome ?? old('nome') }}">
            </label>
            {{ $errors->has('nome') ? $errors->first('nome') : '' }}

            <div class="botoes">
                <button id="enviar" class="botao-enviar" type="submit">ENVIAR</button>
            </div>
        </form>
    </div>
@endsection