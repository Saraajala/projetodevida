<?php
include('../config.php');

$usuario_id = $_POST['usuario_id'] ?? null;
$teste_id = $_POST['teste_id'] ?? null;

if (!$usuario_id || !$teste_id) {
  die("Parâmetros inválidos! Verifique o envio via POST.");
}

$query = "SELECT tipo, COUNT(*) AS quantidade 
          FROM respostas_teste 
          WHERE usuario_id = ? AND teste_id = ? 
          GROUP BY tipo";
$stmt = $pdo->prepare($query);
$stmt->execute([$usuario_id, $teste_id]);
$resultados = $stmt->fetchAll();

$dadosGrafico = [];
foreach ($resultados as $resultado) {
  $dadosGrafico[] = "['{$resultado['tipo']}', {$resultado['quantidade']}]";
}

$interpretacao = '';
if (isset($resultados[0])) {
  // Criar arrays auxiliares
  $contagem = [];
  foreach ($resultados as $resultado) {
    $contagem[$resultado['tipo']] = $resultado['quantidade'];
  }

  // Ordenar do mais frequente para o menos
  arsort($contagem);
  $tiposOrdenados = array_keys($contagem);

  $tipoMaior = $tiposOrdenados[0];
  $quantidadeMaior = $contagem[$tipoMaior];
  $tipoSegundo = $tiposOrdenados[1] ?? null;

  // Mapas de descrição
  $descricaoTipo = [
    'A' => "criatividade técnica, visão espacial e planejamento arquitetônico",
    'B' => "estética, conforto e ambientação visual",
    'C' => "expressão gráfica, comunicação visual e design digital",
    'D' => "lógica, cálculos e construção estrutural"
  ];

  $areaProfissional = [
    'A' => "Arquitetura",
    'B' => "Design de Interiores",
    'C' => "Design Gráfico",
    'D' => "Engenharia Civil"
  ];

  // Padrão geral
  $padraoGeral = "✦ As respostas mais frequentes estão concentradas na alternativa <b>$tipoMaior</b>, indicando forte inclinação para um perfil com foco em <b>{$descricaoTipo[$tipoMaior]}</b>.";

  if ($tipoSegundo) {
    $padraoGeral .= "<br>✦ O segundo tipo mais presente foi <b>$tipoSegundo</b>, sugerindo também afinidade com <b>{$descricaoTipo[$tipoSegundo]}</b>.";
  }

  $tiposMenores = array_diff(array_keys($contagem), [$tipoMaior, $tipoSegundo]);
  if (!empty($tiposMenores)) {
    $padraoGeral .= "<br>✦ Respostas menos frequentes nas alternativas: <b>" . implode(', ', $tiposMenores) . "</b>, o que pode indicar menor identificação com esses perfis.";
  }

  // Pontos em destaque (questões com tipo dominante)
  $queryQuestoes = "SELECT p.numero
FROM respostas_teste rt
JOIN respostas r ON rt.resposta_id = r.id
JOIN perguntas p ON r.pergunta_id = p.id
WHERE rt.usuario_id = ? AND rt.teste_id = ? AND rt.tipo = ?";
  $stmtQuestoes = $pdo->prepare($queryQuestoes);
  $stmtQuestoes->execute([$usuario_id, $teste_id, $tipoMaior]);
  $questoesDominantes = $stmtQuestoes->fetchAll(PDO::FETCH_COLUMN);

  // Montar texto com base nas questões dominantes
  if (!empty($questoesDominantes)) {
    $pontosEmDestaque = '✦ Questões em destaque: <b>' . implode(', ', $questoesDominantes) .
      '</b> foram marcadas com a alternativa <b>' . $tipoMaior . '</b>, reforçando seu padrão dominante.';
  } else {
    $pontosEmDestaque = '✦ Não foram encontradas questões com forte predominância de um tipo específico.';
  }

  // Conclusão
  $conclusao = "✦ Seu perfil indica uma afinidade marcante com a área de <b>{$areaProfissional[$tipoMaior]}</b>. Para explorar melhor esse caminho, recomendamos experimentar projetos, cursos ou leituras sobre o tema.<br>✦ Desenvolver ainda mais suas habilidades nessa direção pode abrir portas para uma carreira alinhada aos seus interesses e talentos.";

  // Unir tudo na interpretação final
  $interpretacao = "<b>PADRÃO GERAL:</b><br>$padraoGeral<br><br>
  <b>PONTOS EM DESTAQUE:</b><br>$pontosEmDestaque<br><br>
  <b>CONCLUSÃO:</b><br>$conclusao";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/estilo_grafico.css">
  <title>Gráfico de Resultados</title>

  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {
      'packages': ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Tipo', 'Quantidade'],
        <?= implode(',', $dadosGrafico) ?>
      ]);
      var options = {
  title: 'Distribuição de Respostas',
  chartArea: {
    width: '50%'
  },
  hAxis: {
    title: 'Quantidade',
    minValue: 0
  },
  vAxis: {
    title: 'Tipo'
  },
  colors: ['#671613', '#a83232', '#d9534f', '#f0ad4e'] // Cores para os tipos A, B, C, D
};

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
</head>

<body>
  <header class="header-inicio">
    <img src="../imagens/logo.png" alt="logo" class="logo">

    <nav>
      <ul class="menu-central">
        <li><a href="../view/plano_acao.php">Plano de ação</a></li>
        <li><a href="../view/form_planejamento.php">Planeamento do futuro</a></li>
      </ul>
    </nav>

    <div class="perfil-wrapper">
      <a href="../index.php" class="sair">Início</a>
      <a href="../view/perfil.php" class="icone-perfil-link">
        <img src="../imagens/usuario.png" alt="Perfil" class="icone-perfil">
      </a>
      <a href="logout.php" class="sair">Sair</a>
    </div>
  </header>

  <main>
    <br><br>
    <h1 class="texto-centro">RESULTADO DO TESTE</h1>
    <div class="resultado-grafico">
      <div id="chart_div" style="width: 900px; height: 500px;"></div>

      <br><br>

<div class="imagens-interpretacao">
      <div class="imagem">
        <img src="../imagens/interpretação1.png" alt="Arquitetura">
      </div>
      <div class="imagem">
        <img src="../imagens/interpretação2.png" alt="Design de Interiores">
      </div>
      <div class="imagem">
        <img src="../imagens/interpretação3.png" alt="Design Gráfico">
      </div>
    </div>

      <h2 class="texto-centro">INTERPRETAÇÃO DOS RESULTADOS</h2>
     
    </div>
 <p class="resultados"><?= $interpretacao ?></p>
    
<br><br>

    <!-- Botão para novo teste -->
    <div class="centro-botao">
    <a href="teste.php" class="novo-teste">REFAZER TESTE</a>
</div>
  </main>

  <br><br>

  <footer>© TODOS OS DIREITOS RESERVADOS</footer>
</body>

</html>
