<!--========== HEADER ==========-->
<header class="l-header" id="header">
    <nav class="nav bd-container">
        <a href="{{ route('home') }}" class="navegacao__logo">Caderno de Receitas</a>

        <div class="navegacao__menu" id="nav-menu">
            <ul class="navegacao__lista">
                <li class="navegacao__item"><a href="{{ route('home') }}" class="navegacao__link {{ Route::currentRouteNamed('home') ? 'link-ativo' : ''}}">Home</a></li>
                    <li class="navegacao__item"><a href="{{ route('public.lista_receitas') }}" class="navegacao__link2 {{ Route::currentRouteNamed('public.lista_receitas') ? 'link-ativo' : ''}}">Receitas</a>
                        <ul class="navegacao__sub-lista">
                            @foreach ($tiposReceitas as $tipoReceita)
                                <li class="navegacao__sub-item"><a href="{{ route('public.lista_receitas', $tipoReceita->id) }}" class="navegacao__link">{{ $tipoReceita->nome }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                <li class="navegacao__item"><a href="{{ route('private.cadastro_receita') }}" class="navegacao__link {{ Route::currentRouteNamed('private.cadastro_receita') ? 'link-ativo' : ''}}">Cadastrar Receita</a></li>

                @auth
                    <li class="navegacao__item"><a href="#" class="navegacao__link2">{{ Auth::user()->name }}</a>
                        <ul class="navegacao__sub-lista">
                            <li class="navegacao__sub-item"><a href="{{ route('private.receitas') }}" class="navegacao__link {{ Route::currentRouteNamed('private.receitas') ? 'link-ativo' : ''}}">Minhas Receitas</a></li>
                            <li class="navegacao__sub-item"><a href="{{ route('private.favoritas') }}" class="navegacao__link {{ Route::currentRouteNamed('private.favoritas') ? 'link-ativo' : ''}}">Favoritos</a></li>
                            
                            @if ( Auth::user()->userAdmin || Auth::user()->superUser )
                                <li class="navegacao__sub-item"><a href="{{ route('private.lista_analisar_receita') }}" class="navegacao__link">Analisar Receitas</a></li>
                                <li class="navegacao__sub-item"><a href="{{ route('private.tipoReceita') }}" class="navegacao__link">Cadastrar Tipo de Receita</a></li>
                            @endif

                            @if ( Auth::user()->superUser )
                                <li class="navegacao__sub-item"><a href="{{ route('private.lista_usuarios') }}" class="navegacao__link">Alterar Status Usuário</a></li>
                            @endif

                            <li class="navegacao__sub-item"><a href="{{ route('logout') }}" class="navegacao__link">Sair</a></li>

                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="navegacao__item"><a href="{{ route('public.login') }}" class="navegacao__link {{ Route::currentRouteNamed('public.login') ? 'link-ativo' : ''}}">Login</a></li>
                @endguest
            </ul>
        </div>

        <div class="navegacao__toggle" id="nav-toggle">
            <i class='bx bx-menu'></i>
        </div>
    </nav>
</header>