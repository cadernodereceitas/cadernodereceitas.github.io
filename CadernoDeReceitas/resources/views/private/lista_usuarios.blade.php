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
            <table border="1" style="width:80%; margin:auto">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!$user->userAdmin)
                                    <a href="{{ route('private.promover_userAdmin', $user->id) }}">Promover a userAdmin</a>
                                @else
                                    <a href="{{ route('private.rebaixar_userAdmin', $user->id) }}">Remover permissão de userAdmin</a>
                                @endif
                            </td>
                            <td><a href="{{ route('private.promover_superUser', $user->id) }}">Promover a superUser</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>

    </main>

@endsection