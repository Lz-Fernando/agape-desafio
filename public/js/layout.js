document.addEventListener('DOMContentLoaded', function() {
    
    const botoesToggle = document.querySelectorAll('.toggle-submenu');

    botoesToggle.forEach(botao => {
        botao.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const submenu = document.getElementById(targetId);

            this.classList.toggle('ativo');

            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
            } else {
                submenu.style.display = 'block';
            }
        });
    });
});