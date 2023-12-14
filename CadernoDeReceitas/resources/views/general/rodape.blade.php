<!--========== FOOTER ==========-->
<footer class="footer section bd-container">
    <div class="rodape__container bd-grid">
        <div class="footer__content">
            <a href="{{ route('home') }}" class="rodape__logo">Caderno de <br> Receitas</a>
            <span class="rodape__descricao">O sabor da família</span>
            <div>
                <a href="#" class="rodape__social"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="rodape__social"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="rodape__social"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>

        <div class="footer__content">
            <h3 class="rodape__titulo">Receitas</h3>
            <ul>
                @foreach ($tiposReceitas as $tipoReceita)
                    <li><a href="{{ route('public.lista_receitas', $tipoReceita->id) }}" class="rodape__link">{{ $tipoReceita->nome }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="rodape__titulo">Cadastrar</h3>
            <ul>
                <li><a href="{{ route('public.login') }}" class="rodape__link">Usuário</a></li>
                <li><a href="{{ route('private.cadastro_receita') }}" class="rodape__link">Receita</a></li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="rodape__titulo">Endereço</h3>
            <ul>
                <li>Campus Trindade</li>
                <li>Sala 102, Térreo</li>
                <li>CEP 88040-900</li>
                <li>Florianópolis - SC</li>
            </ul>
        </div>
    </div>

    <p class="rodape__copia">&#169; 2023 Tiozões. Todos os direitos reservados</p>
</footer>