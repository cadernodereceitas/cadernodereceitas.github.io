@extends('general.basico')

@section('estilo')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('titulo', 'Receitas')

@section('conteudo')
    <main class="l-main">

      <div style="margin-top: 150px">
        <div class="row row-cols-1 row-cols-md-2 g-4">
          @foreach ($receitas as $receita)
              <div class="col">
                <div class="card">

                  <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                      @foreach ($receita->imagens as $imagem)
                        <div class="carousel-item">
                          <img class="d-block w-100" src="{{ asset('storage/' . $imagem->imagem) }}">
                        </div>
                      @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Próximo</span>
                    </button>
                  </div>

                <a href="{{ route('public.receita', $receita->id) }}">
                  <div class="card-body">
                    <h5 class="card-title">{{ $receita->nome }}</h5>
                    <p>Tempo de preparo de {{ $receita->tempo_preparo }} minutos</p>
                    <p>Serve {{ $receita->porcoes }} porções</p>
                  </div>
                </a>
                </div>
              </div>
          @endforeach
        </div>
      </div>

    </main>

@endsection