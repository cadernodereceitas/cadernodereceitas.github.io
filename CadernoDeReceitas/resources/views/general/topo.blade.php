<!--========== HEADER ==========-->
<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="{{ route('home') }}" class="nav__logo">Caderno de Receitas</a>

        <div class="nav__menu" id="nav-menu">
            <ul class="nav__list">
                <li class="nav__item"><a href="{{ route('home') }}" class="nav__link {{ Route::currentRouteNamed('home') ? 'active-link' : ''}}">Home</a></li>
                    <li class="nav__item"><a href="{{ route('public.lista_receitas') }}" class="nav__link2 {{ Route::currentRouteNamed('public.lista_receitas') ? 'active-link' : ''}}">Receitas</a>
                        <ul class="nav__sub-list">
                            @foreach ($tiposReceitas as $tipoReceita)
                                <li class="nav__sub-item"><a href="{{ route('public.lista_receitas', $tipoReceita->id) }}" class="nav__link">{{ $tipoReceita->nome }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                <li class="nav__item"><a href="{{ route('private.cadastro_receita') }}" class="nav__link {{ Route::currentRouteNamed('private.cadastro_receita') ? 'active-link' : ''}}">Cadastrar Receita</a></li>

                @auth
                    <li class="nav__item"><a href="#" class="nav__link2">{{ Auth::user()->name }}</a>
                        <ul class="nav__sub-list">
                            <li class="nav__sub-item"><a href="{{ route('private.receitas') }}" class="nav__link {{ Route::currentRouteNamed('private.receitas') ? 'active-link' : ''}}">Minhas Receitas</a></li>
                            <li class="nav__sub-item"><a href="{{ route('private.favoritas') }}" class="nav__link {{ Route::currentRouteNamed('private.favoritas') ? 'active-link' : ''}}">Favoritos</a></li>
                            
                            {{-- @if ( Auth::user()->userAdmin || Auth::user()->superUser )
                                <li class="nav__sub-item"><a href="#" class="nav__link">Analisar Receitas</a></li>
                                <li class="nav__sub-item"><a href="#" class="nav__link">Cadastrar Tipo de Receita</a></li>
                            @endif

                            @if ( Auth::user()->superUser )
                                <li class="nav__sub-item"><a href="#" class="nav__link">Alterar Status Usuário</a></li>
                            @endif --}}

                            <li class="nav__sub-item"><a href="{{ route('logout') }}" class="nav__link">Sair</a></li>

                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav__item"><a href="{{ route('public.login') }}" class="nav__link {{ Route::currentRouteNamed('public.login') ? 'active-link' : ''}}">Login</a></li>
                @endguest
            </ul>
        </div>

        <div class="nav__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>