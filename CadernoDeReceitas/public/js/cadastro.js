var botaoEnviar = document.querySelector("#enviar");
var body = document.querySelector("body");

class Receita {
    constructor(titulo, tiporeceita, ingredientes, modo_preparo) {
        this._titulo = titulo;
        this._tiporeceita = tiporeceita;
        this._ingredientes = ingredientes;
        this._modo_preparo = modo_preparo;
    }

    get titulo () {
        return this._titulo;
    }

    get tiporeceita () {
        return this._tiporeceita;
    }

    get ingredientes () {
        return this._ingredientes;
    }

    get modo_preparo () {
        return this._modo_preparo;
    }
}


botaoEnviar.addEventListener("click", function()
{
    body.className = "enviar-js"
});


/* ALERTA INSCRIÇÃO */

function AlertaCadastro() {
	if (formcadastro.titulo.value == "" || formcadastro.tiporeceita.value == "selecionar" || formcadastro.ingredientes.value == "" || formcadastro.preparo.value == "")
    {
        window.alert("Campo(s) obrigatório(s) não foi(am) preenchido(s)! Por favor preencher: título, tipo de receita, ingredientes e modo de preparo.")
    }

    else {
        window.alert("Cadastro realizado com sucesso!")
        let nova_receita = new Receita('formcadastro.titulo.value', 'formcadastro.tiporeceita.value', 'formcadastro.ingredientes.value', 'formcadastro.preparo.value');
        console.log('titulo: ' + nova_receita.titulo)
        //apenas um teste
    }
}
