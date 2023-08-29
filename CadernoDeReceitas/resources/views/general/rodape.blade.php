<!--========== FOOTER ==========-->
<footer class="footer section bd-container">
    <div class="footer__container bd-grid">
        <div class="footer__content">
            <a href="{{ route('home') }}" class="footer__logo">Caderno de <br> Receitas</a>
            <span class="footer__description">O sabor da família</span>
            <div>
                <a href="#" class="footer__social"><i class='bx bxl-facebook'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-instagram'></i></a>
                <a href="#" class="footer__social"><i class='bx bxl-twitter'></i></a>
            </div>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Receitas</h3>
            <ul>
                @foreach ($tiposReceitas as $tipoReceita)
                    <li><a href="{{ route('public.lista_receitas', $tipoReceita->id) }}" class="footer__link">{{ $tipoReceita->nome }}</a></li>
                @endforeach
                {{-- <li><a href="entrada.html" class="footer__link">Entrada</a></li>
                <li><a href="principal.html" class="footer__link">Principal</a></li>
                <li><a href="sobremesas.html" class="footer__link">Sobremesa</a></li> --}}
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Cadastrar</h3>
            <ul>
                <li><a href="{{ route('public.login') }}" class="footer__link">Usuário</a></li>
                <li><a href="#" class="footer__link">Receita</a></li>
            </ul>
        </div>

        <div class="footer__content">
            <h3 class="footer__title">Endereço</h3>
            <ul>
                <li>Campus Trindade</li>
                <li>Sala 102, Térreo</li>
                <li>CEP 88040-900</li>
                <li>Florianópolis - SC</li>
            </ul>
        </div>
    </div>

    <p class="footer__copy">&#169; 2023 Tiozões. Todos os direitos reservados</p>
</footer>