<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = 1; // Troque pelo ID real do usuário logado
    $teste_id = time(); // Usando timestamp como ID único para cada tentativa

    // Loop para inserir as respostas no banco de dados
    foreach ($_POST['respostas'] as $pergunta_id => $resposta_id) {
        // Consultando a resposta selecionada e o tipo
        $stmt = $pdo->prepare("SELECT tipo, resposta FROM respostas WHERE id = ?");
        $stmt->execute([$resposta_id]);
        $res = $stmt->fetch();

        // Inserindo a resposta na tabela respostas_teste
        $query = "INSERT INTO respostas_teste (usuario_id, resposta_id, tipo, resposta, teste_id) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$usuario_id, $resposta_id, $res['tipo'], $res['resposta'], $teste_id]);
    }

    // Após inserir as respostas, redireciona para a página de gráfico
    // Envia os dados via POST para o gráfico
    echo "<form id='envio' method='POST' action='../view/grafico.php'>
            <input type='hidden' name='usuario_id' value='$usuario_id'>
            <input type='hidden' name='teste_id' value='$teste_id'>
          </form>
          <script>document.getElementById('envio').submit();</script>";
    exit();
}
?>
