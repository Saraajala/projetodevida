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
    $maisResposta = max(array_column($resultados, 'quantidade'));
    $tipoMaior = array_column($resultados, 'tipo')[array_search($maisResposta, array_column($resultados, 'quantidade'))];

    if ($tipoMaior == 'A') {
        $interpretacao = "Você tem perfil para ser arquiteto!";
    } elseif ($tipoMaior == 'B') {
        $interpretacao = "Você tem o perfil de designer de interiores.";
    } else {
        $interpretacao = "Considere explorar outras profissões, como design gráfico ou engenharia.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Resultados</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
      google.charts.load('current', {'packages':['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tipo', 'Quantidade'],
          <?= implode(',', $dadosGrafico) ?>
        ]);

        var options = {
          title: 'Distribuição de Respostas',
          chartArea: {width: '50%'},
          hAxis: {
            title: 'Quantidade',
            minValue: 0
          },
          vAxis: {
            title: 'Tipo'
          }
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <h1>Resultado do Teste</h1>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    <h2>Interpretação</h2>
    <p><?= $interpretacao ?></p>

     <!-- Botão para novo teste -->
     <form method="POST" action="teste.php">
        <button type="submit">Novo Teste</button>
    </form>
</body>
</html>
