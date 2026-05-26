document.addEventListener('DOMContentLoaded', function() {    
    const eventoInput = new Event('input');

    const btnNovo = document.getElementById('btn-novo');
    if (btnNovo) {
        btnNovo.addEventListener('click', function(e) {
            document.getElementById('modalCriar').style.display = 'flex';
        });
    }

    const botoesEditar = document.querySelectorAll('.btn-editar');
    botoesEditar.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).style.display = 'flex';
        });
    });

    const botoesFechar = document.querySelectorAll('.btn-fechar');
    botoesFechar.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            const modal = this.closest('.modal-overlay');
            if (modal) {
                modal.style.display = 'none';
            }
        });
    });

    const inputsNome = document.querySelectorAll('input[name="name"]');
    inputsNome.forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^a-zA-ZÀ-ÿ\s]/g, '');
        });
    });

    const inputsRg = document.querySelectorAll('.mascara-rg');
    inputsRg.forEach(function(input) {
        input.addEventListener('input', function(e) {
            
            let valor = e.target.value.replace(/[^a-zA-Z0-9]/g, '');

            valor = valor.substring(0, 17);

            if (valor.length > 2) {
                valor = valor.replace(/^([a-zA-Z0-9]{2})([a-zA-Z0-9]+)/, '$1.$2');
            }
            if (valor.length > 6) {
                valor = valor.replace(/^([a-zA-Z0-9]{2})\.([a-zA-Z0-9]{3})([a-zA-Z0-9]+)/, '$1.$2.$3');
            }
            if (valor.length > 10) {
                valor = valor.replace(/^([a-zA-Z0-9]{2})\.([a-zA-Z0-9]{3})\.([a-zA-Z0-9]{3})([a-zA-Z0-9]+)/, '$1.$2.$3-$4');
            }

            e.target.value = valor;
        });
    });

    const inputsCep = document.querySelectorAll('.mascara-cep');
    inputsCep.forEach(function(input) {
        input.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    });

    const inputsTelefone = document.querySelectorAll('.mascara-telefone');
    inputsTelefone.forEach(function(input) {
        input.addEventListener('input', function(e) {
            
            let valor = e.target.value.replace(/\D/g, '');
            
            valor = valor.substring(0, 10);

            if (valor.length > 2) {
                valor = valor.replace(/^(\d{2})(\d+)/, '($1)$2');
            }
            if (valor.length > 8) {
                valor = valor.replace(/^(\(\d{2}\))(\d{4})(\d+)/, '$1$2-$3');
            }

            e.target.value = valor;
        });
    });

    inputsTelefone.forEach(input => {
        if (input.value) {
            input.dispatchEvent(eventoInput);
        }
    });

    const inputsCelular = document.querySelectorAll('.mascara-celular');
    inputsCelular.forEach(function(input) {
        input.addEventListener('input', function(e) {
            
            let valor = e.target.value.replace(/\D/g, '');
            
            valor = valor.substring(0, 11);

            if (valor.length > 2) {
                valor = valor.replace(/^(\d{2})(\d+)/, '($1)$2');
            }
            if (valor.length > 9) {
                valor = valor.replace(/^(\(\d{2}\))(\d{5})(\d+)/, '$1$2-$3');
            }

            e.target.value = valor;
        });
    });

    inputsCelular.forEach(input => {
        if (input.value) {
            input.dispatchEvent(eventoInput);
        }
    });
});