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
          @foreach ($tiposReceitas as $tipoReceita)
              <div class="col">
                <div class="card">
                    <a href="{{ route('private.tipoReceita', $tipoReceita->id) }}">
                      <div class="card-body">
                        <h5 class="card-title">{{ $tipoReceita->nome }}</h5>
                      </div>
                    </a>
                </div>
              </div>
          @endforeach
        </div>
      </div>

    </main>

@endsection