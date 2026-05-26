document.addEventListener('DOMContentLoaded', function() {

    const inputIdentificacao = document.getElementById('identifier');
    const inputVisualizar = document.getElementById('visualizate');
    const inputPassword = document.getElementById('password');
    const formLogin = document.getElementById('form-login');
    const spanAlerta = document.getElementById('alerta-campos');
    const spanExclusivo = document.getElementById('span-exclusivo');

    inputIdentificacao.addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    inputIdentificacao.addEventListener('blur', function(e) {
        let valor = e.target.value;
        if (valor.length > 0) {
            e.target.value = valor.padStart(8, '0');
        }
    });

    inputVisualizar.addEventListener('change', function(e) {
        inputPassword.type = e.target.checked ? 'text' : 'password';
    });

    formLogin.addEventListener('submit', function(e) {
        const idValor = inputIdentificacao.value.trim();
        const senhaValor = inputPassword.value.trim();
        let mensagemErro = "";

        if (idValor === "") {
            mensagemErro = 'Atenção, o campo de identificação do usuário é de preenchimento obrigatório';
        } else if (senhaValor === "") {
            mensagemErro = 'Atenção, o campo de senha é de preenchimento obrigatório';
        }

        if (mensagemErro !== "") {
            e.preventDefault();
            spanExclusivo.innerText = mensagemErro;
            spanExclusivo.style.display = 'block';
            spanAlerta.style.display = 'block';
        } else {
            spanExclusivo.style.display = 'none';
            spanAlerta.style.display = 'none';
        }
    });

    formLogin.addEventListener('reset', function(e) {
        spanExclusivo.style.display = 'none';
        spanAlerta.style.display = 'none';
        inputPassword.type = 'password';
    });
});