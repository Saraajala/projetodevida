<?php
session_start(); // Inicia a sessão

// Verificar se existe uma mensagem de erro na sessão
if (isset($_SESSION['erro_mensagem'])) {
    echo '<p style="color: red; text-align: center;">' . $_SESSION['erro_mensagem'] . '</p>';
    unset($_SESSION['erro_mensagem']); // Limpar a mensagem após exibição
}

include('../config.php');

$query = "SELECT p.id AS pergunta_id, p.pergunta, r.id AS resposta_id, r.resposta, r.tipo 
          FROM perguntas p 
          JOIN respostas r ON p.id = r.pergunta_id 
          ORDER BY p.id, r.id";
$result = $pdo->query($query);
$dados = $result->fetchAll(PDO::FETCH_ASSOC);

$perguntas = [];
foreach ($dados as $linha) {
    $perguntas[$linha['pergunta_id']]['texto'] = $linha['pergunta'];
    $perguntas[$linha['pergunta_id']]['respostas'][] = [
        'id' => $linha['resposta_id'],
        'texto' => $linha['resposta'],
        'tipo' => $linha['tipo']
    ];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Teste de Personalidade</title>
    <link rel="stylesheet" href="../css/estilo_teste.css">
</head>

<body>

    <header class="topo">
        <div class="logo">
            <img src="../imagens/logo.png" alt="Logo" class="logo-img">
        </div>
        <div class="perfil-wrapper">
            <a href="../index.php" class="sair">Início</a>
            <a href="../view/perfil.php" class="icone-perfil-link">
                <img src="../imagens/usuario.png" alt="Perfil" class="icone-perfil">
            </a>
            <a href="logout.php" class="sair">Sair</a>
        </div>
    </header>

    <div class="container-central">
        <form id="form-teste" method="POST" action="../processa/processar_teste.php">
            <?php $contador = 0; ?>
            <?php foreach ($perguntas as $idPergunta => $pergunta): ?>
                <fieldset class="pergunta" style="<?= $contador > 0 ? 'display:none;' : '' ?>">
                    <div class="pergunta-texto">
                        <legend><strong><?= $pergunta['texto'] ?></strong></legend>
                    </div>

                    <div class="respostas-container">
                        <?php foreach ($pergunta['respostas'] as $resposta): ?>
                            <label class="opcao" data-tipo="<?= $resposta['tipo'] ?>">
                                <input type="radio" name="respostas[<?= $idPergunta ?>]" value="<?= $resposta['id'] ?>" required>
                                <span><?= $resposta['texto'] ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
                <?php $contador++; ?>
            <?php endforeach; ?>

            <div id="navegacao">
                <button type="button" id="btn-anterior">Pergunta Anterior</button>
                <button type="button" id="btn-proximo">Próxima Pergunta</button>
                <input type="submit" id="btn-enviar" value="Enviar Respostas" style="display:none;">
                <button type="button" id="btn-finalizar">Finalizar Teste</button>
            </div>
        </form>
    </div>

    <footer>
        <p>© 2025 Todos os direitos reservados.</p>
    </footer>

    <script>
    let perguntas = document.querySelectorAll('.pergunta');
    let btnProximo = document.getElementById('btn-proximo');
    let btnAnterior = document.getElementById('btn-anterior');
    let btnEnviar = document.getElementById('btn-enviar');
    let btnFinalizar = document.getElementById('btn-finalizar');
    let indice = 0;

    // Inicializa os botões
    if (indice > 0) {
        btnAnterior.style.display = 'inline-block'; // Exibe o botão anterior na segunda pergunta
    }

    btnProximo.addEventListener('click', function() {
        if (indice < perguntas.length - 1) {
            perguntas[indice].style.display = 'none';
            indice++;
            perguntas[indice].style.display = 'block';

            if (indice === perguntas.length - 1) {
                btnProximo.style.display = 'none';
                btnFinalizar.style.display = 'inline-block';
                btnEnviar.style.display = 'inline-block';
            }

            // Exibe o botão "Anterior" a partir da segunda pergunta
            if (indice > 0) {
                btnAnterior.style.display = 'inline-block';
            }
        }
    });

    btnAnterior.addEventListener('click', function() {
        if (indice > 0) {
            perguntas[indice].style.display = 'none';
            indice--;
            perguntas[indice].style.display = 'block';

            if (indice === 0) {
                btnAnterior.style.display = 'none'; // Esconde o botão de "Anterior" na primeira pergunta
            }

            if (indice < perguntas.length - 1) {
                btnProximo.style.display = 'inline-block';
                btnFinalizar.style.display = 'inline-block';
            }
        }
    });

    btnFinalizar.addEventListener('click', function() {
        // Redireciona para o início do teste (página teste_personalidade.php)
        window.location.href = "teste_personalidade.php"; 
    });

    btnFinalizar.addEventListener('click', function () {
    const totalPerguntas = document.querySelectorAll('.pergunta').length;
    const respostasSelecionadas = document.querySelectorAll('input[type="radio"]:checked').length;

    if (respostasSelecionadas < totalPerguntas) {
        alert("teste não concluído, inicie novamente ou continue a navegar pelo site!");
        return; // Impede o redirecionamento
    }

    // Se todas estiverem respondidas, envia o formulário
    document.getElementById('formTeste').submit();
});
</script>

</body>

</html>
