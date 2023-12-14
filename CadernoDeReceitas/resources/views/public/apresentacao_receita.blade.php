@extends('general.basico')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/cadastro-receita-style.css') }}">
@endsection

@section('titulo', 'Cadastrar')

@section('conteudo')

    <div class="conteudo">
        <h1>{{ $receita->nome }}</h1>

        @if($receita->aprovada_por != null)

            @if($favoritada)
                <a href="{{ route('private.desfavoritar', $receita->id) }}">
                    <button type="button" class="btn btn-danger">Desfavoritar</button>
                </a>
            @else
                <a href="{{ route('private.favoritar', $receita->id) }}">
                    <button type="button" class="btn btn-success">Favoritar</button>
                </a>
            @endif
        @endif

        <br/>

        @for ($i = 1; $i <= 5; $i++)
            <a href="{{ route('private.avaliar', [$receita->id, $i]) }}">
                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios{{$i}}" value="{{$i}}" {{$avaliacao == $i ? 'checked' : ''}}>
                <label class="form-check-label" for="exampleRadios{{$i}}">
                    {{$i}}
                </label>
            </a>
        @endfor

        @if ($avaliacaoGeral > 0)
            <h4>{{ $avaliacaoGeral }}</h4>
        @endif

        @if (count($receita->imagens) >= 1)
            <div id="carouselImagensReceira" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @for ($i = 0; $i < count($receita->imagens); $i++)
                        <div class="carousel-item {{ $i == 0 ? 'active' : ''}}">
                            <img src="{{ asset('storage/'. $receita->imagens[$i]->imagem) }}" class="d-block w-100" alt="...">
                        </div>
                    @endfor
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagensReceira" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImagensReceira" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próxima</span>
                </button>
            </div>
        @endif

        <div class="d-flex justify-content-around">
            <div>Tempo de preparo: {{ $receita->tempo_preparo }} min</div>
            <div>Serve {{ $receita->porcoes }} {{$receita->porcoes == 1 ? 'porção' : 'porções'}}</div>
            @if ($receita->alcoolica)
                <div class="text-danger">ATENÇÃO! Esta receita é alcoólica</div>
            @endif
        </div>

        <h4 class="mt-4">Ingredientes</h4>
        <p>{{ $receita->ingredientes }}</p>

        <h4 class="mt-4">Modo de Preparo</h4>
        <p>{{ $receita->modo_preparo }}</p>

        @auth
            @if ($receita->aprovada_por == null)
                @if (auth()->user()->userAdmin || auth()->user()->superUser)
                    <a href="{{ route('private.aprovar_receita', $receita->id) }}">
                        <button type="button" class="btn btn-success">Aprovar</button>
                    </a>
                    <a href="{{ route('private.delete_receita', $receita->id) }}">
                        <button type="button" class="btn btn-danger">Rejeitar</button>
                    </a>
                @endif
                @if ($receita->user_id == auth()->user()->id)
                    <a href="{{ route('private.receita', $receita->id) }}">
                        <button type="button" class="btn btn-warning">Editar</button>
                    </a>
                @endif
            @endif
        @endauth

    </div>
@endsection