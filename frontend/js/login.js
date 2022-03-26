var botaoEntrar = document.querySelector("#entrar");
var botaoIncrever = document.querySelector("#inscrever");
var body = document.querySelector("body");

botaoEntrar.addEventListener("click", function()
{
    body.className = "entrar-js"
});

botaoIncrever.addEventListener("click", function()
{
    body.className = "inscrever-js"
});

/* ALERTA INSCRIÇÃO */

function AlertaInscricao()
{
	if (inscricao.usuario.value == "" || inscricao.email.value == "" || inscricao.senha.value == "")
    {
        window.alert("Campo(s) obrigatório(s) não foi(am) preenchido(s)!")
    }
    else if (inscricao.usuario.value == inscricao.senha.value)
	{
		window.alert("Não digite o mesmo valor em ambos os campos");
	}
}

function AlertaSenhaInscricao()
{
	if (inscricao.senha.value == "")
	{
		window.alert("Campo Obrigatório");
	}
}

function AlertaUsuarioInscricao()
{
	if (inscricao.usuario.value =="")
	{
		window.alert("Campo Obrigatório");
	}
}

function AlertaEmailInscricao()
{
	if (inscricao.email.value =="")
	{
		window.alert("Campo Obrigatório");
	}
}

/* LOGIN */


function AlertaLogin()
{
	if (login.senha.value == "" || login.email.value == "")
    {
        window.alert("Campo(s) obrigatório(s) não foi(am) preenchido(s)!")
    }
}


function AlertaSenhaLogin()
{
	if (login.senha.value == "")
	{
		window.alert("Campo Obrigatório");
	}
}

function AlertaEmailLogin()
{
	if (login.email.value =="")
	{
		window.alert("Campo Obrigatório");
	}
}