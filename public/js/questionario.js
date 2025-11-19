document.addEventListener('DOMContentLoaded', function() {
    const etapas = document.querySelectorAll('#questionario-form .etapa');
    let etapaAtual = 0;

    const modal = document.getElementById('modal-alerta');
    const modalMensagem = document.getElementById('modal-mensagem');
    const modalFechar = document.querySelector('.modal-fechar');
    const btnModalOk = document.querySelector('.btn-modal-ok');

    function mostrarModal(mensagem) {
        modalMensagem.textContent = mensagem;
        modal.style.display = 'flex'; 
    }

    function fecharModal() {
        modal.style.display = 'none';
    }

    modalFechar.addEventListener('click', fecharModal);
    btnModalOk.addEventListener('click', fecharModal);
    modal.addEventListener('click', function(event) {
        if (event.target === modal) {
            fecharModal();
        }
    });

    function mostrarEtapa(index) {
        etapas.forEach((etapa, i) => {
            etapa.classList.toggle('etapa-ativa', i === index);
        });

        const btnVoltar = etapas[index].querySelector('.btn-voltar');
        if (btnVoltar) {
            btnVoltar.style.display = (index === 0) ? 'none' : 'inline-block';
        }
    }

    function validarEtapa(etapa) {
        const radios = etapa.querySelectorAll('input[type="radio"]');
        if (radios.length === 0) {
            return true;
        }

        const respondido = Array.from(radios).some(r => r.checked);
        if (!respondido) {
            
            mostrarModal('Por favor, selecione uma nota para continuar.');

            etapa.classList.add('shake');
            setTimeout(() => etapa.classList.remove('shake'), 500);
            return false;
        }
        return true;
    }

    document.querySelectorAll('.btn-proximo').forEach(button => {
        button.addEventListener('click', () => {
            if (validarEtapa(etapas[etapaAtual])) {
                etapaAtual++;
                if (etapaAtual < etapas.length) {
                    mostrarEtapa(etapaAtual);
                }
            }
        });
    });

    document.querySelectorAll('.btn-voltar').forEach(button => {
        button.addEventListener('click', () => {
            etapaAtual--;
            if (etapaAtual >= 0) {
                mostrarEtapa(etapaAtual);
            }
        });
    });

    mostrarEtapa(etapaAtual);
});