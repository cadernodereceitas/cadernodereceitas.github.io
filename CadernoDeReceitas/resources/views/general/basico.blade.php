@php
    session_start()
@endphp

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
        {{-- <link rel="stylesheet" href="{{ asset('css/header_footer_styles.css') }}"> --}}
        {{-- <link rel="stylesheet" href="{{ asset('css/novo_header_footer.css') }}"> --}}
        @yield('estilo')
        <script src="https://kit.fontawesome.com/87b682e9bf.js" crossorigin="anonymous"></script>
		<link rel="icon" type="imagem/gif" href="{{ asset('img/favicon.gif') }}"/>
        <title>Caderno de Receitas - @yield('titulo')</title>
    </head>

    <body>
        @include('general.topo')
        @yield('conteudo')
        @include('general.rodape')
        
        <!--========== SCROLL REVEAL ==========-->
        <script src="https://unpkg.com/scrollreveal"></script>
    
        <!--========== MAIN JS ==========-->
        <script src="{{ asset('js/main.js') }}"></script>

        <!--========== BOOTSTRAP ==========-->
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> --}}
    </body>
</html>