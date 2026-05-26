document.addEventListener('DOMContentLoaded', function() {
    const btnLimpar = document.getElementById('btn-limpar');
    const inputNome = document.getElementById('nome');
    const inputCodigo = document.getElementById('codigo');
    const inputCnpj = document.getElementById('cnpj_filtro');
    const eventoInput = new Event('input');
    const inputsCnpj = document.querySelectorAll('.mascara-cnpj');
    const inputsCodigo = document.querySelectorAll('.mascara-codigo');
    const botoesExcluir = document.querySelectorAll('.btn-excluir-trigger');
    const modalExclusao = document.getElementById('modal-exclusao');
    const botoesFecharExclusao = document.querySelectorAll('.id-fechar-exclusao');
    const formExclusao = document.getElementById('form-exclusao');
    const textoCnpj = document.getElementById('texto-cnpj-exclusao');
    const textoNome = document.getElementById('texto-nome-exclusao');

    btnLimpar.addEventListener('click', function(e) {
        inputNome.value = "";
        inputCodigo.value = "";
        inputCnpj.value = "";
    });
    
    inputsCodigo.forEach(function(input) {
        input.addEventListener('input', function(e) {
            
            let valor = e.target.value.replace(/\D/g, '');
            
            valor = valor.substring(0, 6);
            
            if (valor.length > 3) {
                valor = valor.replace(/(\d{3})(\d+)/, '$1.$2');
            }
            
            e.target.value = valor;
        });
    });
    
    inputsCnpj.forEach(function(input) {
        input.addEventListener('input', function(e) {
            
            let valor = e.target.value.replace(/\D/g, '');
            
            valor = valor.substring(0, 14);

            valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");
            valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
            valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");
            valor = valor.replace(/(\d{4})(\d)/, "$1-$2");

            e.target.value = valor;
        });
    });

    inputsCnpj.forEach(function(input) {
        if (input.value) {
            input.dispatchEvent(eventoInput);
        }
    });

    botoesExcluir.forEach(btn => {
        btn.addEventListener('click', function() {
            const idCliente = this.getAttribute('data-id');
            const nomeCliente = this.getAttribute('data-nome');
            const cnpjCliente = this.getAttribute('data-cnpj');

            textoCnpj.textContent = cnpjCliente;
            textoNome.textContent = nomeCliente;

            formExclusao.action = `/clientes/${idCliente}`;

            modalExclusao.style.display = 'flex';
        });
    });

    botoesFecharExclusao.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            modalExclusao.style.display = 'none';
        });
    });
});