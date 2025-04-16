<?php
require_once '../config/conexao.php';
require_once '../controller/ProjetoController.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

$controller = new ProjetoController($pdo);

// Buscar o último resultado registrado
$stmt = $pdo->prepare("SELECT * FROM resultados WHERE usuario_id = ? ORDER BY id DESC LIMIT 1");
$stmt->execute([$usuario_id]);
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$resultado) {
    echo "Nenhum resultado encontrado.";
    exit;
}

// Preparar dados para o gráfico (agrupando por tipo de resultado)
$dadosGrafico = [];
$controllerResult = $controller->buscarResultadosTeste($usuario_id);
foreach ($controllerResult as $res) {
    $tipo = $res['tipo_resultado'];
    if (!isset($dadosGrafico[$tipo])) {
        $dadosGrafico[$tipo] = 0;
    }
    $dadosGrafico[$tipo]++;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados do Quiz</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Resultado', 'Quantidade'],
                <?php foreach ($dadosGrafico as $tipo => $quantidade): ?>
                    ['<?php echo $tipo; ?>', <?php echo $quantidade; ?>],
                <?php endforeach; ?>
            ]);

            var options = {
                title: 'Resultados do Quiz',
                chartArea: {width: '60%'},
                hAxis: {
                    title: 'Quantidade',
                    minValue: 0
                },
                vAxis: {
                    title: 'Tipo de Resultado'
                }
            };

            var chart = new google.visualization.BarChart(document.getElementById('grafico_resultado'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Gráfico dos Resultados do Quiz</h1>
    <div id="grafico_resultado" style="width: 100%; height: 500px;"></div>

    <h2>Interpretação</h2>
    <p><strong>Tipo de Resultado:</strong> <?php echo htmlspecialchars($resultado['tipo_resultado']); ?></p>
    <p><strong>Descrição:</strong> <?php echo htmlspecialchars($resultado['descricao']); ?></p>

    <p><a href="teste_personalidade.php">Refazer Teste</a></p>
<p><a href="perfil.php">Voltar ao Perfil</a></p>
</body>
</html>
