@extends('general.basico')

@section('estilo')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('titulo', 'Login')

@section('conteudo')
    <div class="container">
    	<div class="conteudo primeiro_conteudo">
    		<div class="primeira_coluna">
    			<h2 class="titulo titulo-primeiro">Bem Vindo de Volta</h2>
    			<p class="descricao descricao-primeiro">Mantenha-se conectado conosco</p>
    			<p class="descricao descricao-primeiro">Por favor, logue-se com as suas informações pessoais</p>
    			<button id="entrar" class="botao botao-primeiro">Entrar</button>
    		</div>
    		<div class="segunda_coluna">
    			<h2 class="titulo titulo-segundo">Criar Conta</h2>
    			<div class="midias_sociais">
    				<ul class="lista_midias_sociais">
    					<a class="link-midia-social" href="http://pt-br.facebook.com">
    						<li class="item-midia-social"><i class="fab fa-facebook-f"></i></li>
    					</a>
    					<a class="link-midia-social" href="http://myaccount.google.com">
    						<li class="item-midia-social"><i class="fab fa-google-plus-g"></i></li>
    					</a>
    					<a class="link-midia-social" href="http://br.linkedin.com">
    						<li class="item-midia-social"><i class="fab fa-linkedin-in"></i></li>
    					</a>
    				</ul>
    			</div>
    			<p class="descricao descricao-segundo">ou use seu email para o registro:</p>
    			<form class="formulario" method="post" action="{{ route('public.register') }}" name="inscricao" id="forminscricao" >
					@csrf
    				<label class="label-input">
    					<i class="fas fa-user icone"></i>
    					<input type="text" name="name" placeholder="Nome" value="{{ old('name') }}">
						{{ $errors->has('name') ? $errors->first('name') : '' }}
    				</label>
    				<label class="label-input">
    					<i class="fas fa-envelope icone"></i>
    					<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						{{ $errors->has('email') ? $errors->first('email') : '' }}
    				</label>
    				<label class="label-input">
    					<i class="fas fa-lock icone"></i>
    					<input type="password" name="password" form="forminscricao" placeholder="Senha" value="{{ old('password') }}">
						{{ $errors->has('password') ? $errors->first('password') : '' }}
    				</label>
    				<button class="botao botao-segundo" type="submit">Increver-se</button>
    			</form>
    		</div>
    	</div>
    	<div class="conteudo segundo_conteudo">
    		<div class="primeira_coluna">
    			<h2 class="titulo titulo-segundo">Olá Amigo</h2>
    			<p class="descricao descricao-primeiro">Insira seus dados pessoais</p>
    			<p class="descricao descricao-primeiro">e comece a sua jornada conosco</p>
    			<button id="inscrever" class="botao botao-primeiro">Inscreva-se</button>
    		</div>
    		<div class="segunda_coluna">
    			<h2 class="titulo titulo-segundo">Pegue seu Caderno</h2>
    			<div class="midias_sociais">
    				<ul class="lista_midias_sociais">
    					<a class="link-midia-social" href="http://pt-br.facebook.com">
    						<li class="item-midia-social"><i class="fab fa-facebook-f"></i></li>
    					</a>
    					<a class="link-midia-social" href="http://myaccount.google.com">
    						<li class="item-midia-social"><i class="fab fa-google-plus-g"></i></li>
    					</a>
    					<a class="link-midia-social" href="http://br.linkedin.com">
    						<li class="item-midia-social"><i class="fab fa-linkedin-in"></i></li>
    					</a>
    				</ul>
    			</div>
    			<p class="descricao descricao-segundo">ou use seu email:</p>
    			<form class="formulario" id="formlogin" name="login" method="post" action="{{ route('public.login') }}">
					@csrf
    				<label class="label-input">
    					<i class="fas fa-envelope icone"></i>
    					<input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
						{{ $errors->has('email') ? $errors->first('email') : '' }}
    				</label>
    				<label class="label-input">
    					<i class="fas fa-lock icone"></i>
    					<input type="password" name="password" placeholder="Senha" value="{{ old('password') }}">
						{{ $errors->has('password') ? $errors->first('password') : '' }}
    				</label>
    				<a class="senha" href="#">Esqueceu sua senha?</a>
    				<button class="botao botao-segundo" form="formlogin" type="submit" value='Submit'>Entrar</button>
    			</form>
    		</div>
    	</div>
    </div>

    <script src="{{ asset('js/login.js') }}"></script>

@endsection