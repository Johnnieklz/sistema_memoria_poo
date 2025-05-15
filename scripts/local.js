// Script para localStorage e tema

    // Aplica tema salvo no localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const tema = localStorage.getItem('tema') || 'claro';
        aplicarTema(tema);
    });

    function alternarTema() {
        const temaAtual = document.body.classList.contains('tema-escuro') ? 'escuro' : 'claro';
        const novoTema = temaAtual === 'escuro' ? 'claro' : 'escuro';
        aplicarTema(novoTema);
        localStorage.setItem('tema', novoTema);
    }

    function aplicarTema(tema) {
        if (tema === 'escuro') {
            document.body.classList.add('tema-escuro');
            document.body.style.backgroundColor = '#121212';
            document.body.style.color = 'white';
        } else {
            document.body.classList.remove('tema-escuro');
            document.body.style.backgroundColor = 'white';
            document.body.style.color = 'black';
        }
    }

