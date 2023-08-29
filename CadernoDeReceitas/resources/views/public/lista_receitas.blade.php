@extends('general.basico')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> --}}
@endsection

@section('titulo', 'Receitas')

@section('conteudo')
    <main class="l-main">

        @foreach ($receitas as $receita)
            <div class="card" style="width: 500px;">
                <div class="row no-gutters">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">

                        @foreach ($receita->imagens as $imagem)
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{ $imagem->imagem }}">
                            </div>                            
                        @endforeach

                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title">{{ $receita->nome }}</h5>
                            {{-- @if (isset($receita->avaliacaoReceita) && $receita->avaliacaoReceita != 0)
                                <p class="card-text">{{ $receita->avaliacaoReceita }}  -  {{ $receita->tempo_preparo }} minutos</p>
                            @endif

                            @if (!isset($receita->avaliacaoReceita))
                                <p class="card-text">{{ $receita->tempo_preparo }} minutos</p>
                            @endif --}}
                            
                            <a href="{{ route('public.receita', $receita->id) }}" class="btn btn-primary">Saiba mais</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </main>

@endsection