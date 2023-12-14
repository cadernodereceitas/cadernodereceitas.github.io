@extends('general.basico')

@section('estilo')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('titulo', 'Home')

@section('conteudo')
    <main class="l-main">

        <!--========== HOME ==========-->
        <section class="home" id="home">
            <div class="home__container bd-container bd-grid">
                <div class="home__data">
                    <h1 class="home__title">O sabor da<br>família</h1>
                    <h2 class="home__subtitle">Suas receitas sempre<br>com você.</h2>
                    <a href="{{ route('public.login') }}" class="button">Cadastre-se</a>
                </div>
                <img src="{{ asset('img/home.png') }}" alt="" class="home__img">
            </div>
        </section>

        <!--========== RECEITAS ==========-->
        <section class="receitas section bd-container" id="receitas">
            <span class="secao-subtitulo">Receitas</span>
            <h2 class="secao-titulo">O que pretende prepar hoje?</h2>

            <div class="receitas__container bd-grid">
                <div class="receitas__content">
                    <img src="{{ asset('img/prato1.png') }}" alt="" class="receitas__img">
                    <h3 class="receitas__name">Entrada</h3>
                    <span class="receitas__detail">Convidar</span>
                    <a href="{{ route('public.lista_receitas', 1) }}" class="button receitas__button">Ver</a>
                </div>

                <div class="receitas__content">
                    <img src="{{ asset('img/prato2.png') }}" alt="" class="receitas__img">
                    <h3 class="receitas__name">Principal</h3>
                    <span class="receitas__detail">Conquistar</span>
                    <a href="{{ route('public.lista_receitas', 2) }}" class="button receitas__button">Ver</a>
                </div>

                <div class="receitas__content">
                    <img src="{{ asset('img/prato3.png') }}" alt="" class="receitas__img">
                    <h3 class="receitas__name">Sobremesa</h3>
                    <span class="receitas__detail">Marcar</span>
                    <a href="{{ route('public.lista_receitas', 3) }}" class="button receitas__button">Ver</a>
                </div>
            </div>
        </section>

        <!--========== CADASTRO DE RECEITA ==========-->
        <section class="cadastro_receitas section bd-container" id="cadastro_receitas">
            <div class="cadastro_receitas__container  bd-grid">
                <div class="cadastro_receitas__data">
                    <span class="secao-subtitulo cadastro_receitas__initial">Cadastro de Receita</span>
                    <h2 class="secao-titulo cadastro_receitas__initial">Você sempre preparado para surpreender</h2>
                    <p class="cadastro_receitas__description">Salve aqui suas melhores receitas, compartilhe e tenha suas receitas com você sempre que precisar.</p>
                    <a href="{{ route('private.cadastro_receita') }}" class="button">Cadastrar receita</a>
                </div>

                <img src="{{ asset('img/cadastro-receita.jpg') }}" alt="" class="cadastro_receitas__img">
            </div>
        </section>
    </main>

@endsection