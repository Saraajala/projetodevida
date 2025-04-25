const perguntas = document.querySelectorAll('.pergunta');
const btnsProxima = document.querySelectorAll('.btn-proxima');
const btnEnviar = document.querySelector('.btn-enviar');
let perguntaAtual = 0;

perguntas[perguntaAtual].classList.add('active');

btnsProxima.forEach((btn, index) => {
    btn.addEventListener('click', () => {
        perguntas[perguntaAtual].classList.remove('active');
        perguntaAtual++;

        if (perguntaAtual < perguntas.length) {
            perguntas[perguntaAtual].classList.add('active');
        } else {
            btnEnviar.style.display = 'block'; // Mostrar botão enviar
        }
    });
});
