<?php
require_once 'C:\Turma2\xampp\htdocs\projetodevida\config.php';
require_once 'C:\Turma2\xampp\htdocs\projetodevida\controller\ProjetoController.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// Código para salvar as respostas na tabela 'respostas_teste' (já mostrado antes)

// Contar a quantidade de cada tipo de resposta
$contagem = [
    'A' => 0,
    'B' => 0,
    'C' => 0,
    'D' => 0
];

// Buscar as respostas do usuário da tabela 'respostas_teste' para contar o tipo
$stmt = $pdo->prepare("SELECT tipo FROM respostas_teste WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$respostas_teste = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Contar as ocorrências de cada tipo de resposta
foreach ($respostas_teste as $resposta) {
    $tipo = $resposta['tipo'];
    if (isset($contagem[$tipo])) {
        $contagem[$tipo]++;
    }
}

// Identificar o tipo com maior contagem
$tipoResultado = array_keys($contagem, max($contagem))[0];

// Identificar o tipo com maior contagem (o tipo mais frequente)
$tipoResultado = array_keys($contagem, max($contagem))[0];

// Aqui você pode, por exemplo, exibir o resultado ou salvar no banco de dados
// Exemplo de exibição
echo "Tipo de resultado mais frequente: " . $tipoResultado;

// Identificar o tipo com maior contagem
$tipoResultado = array_keys($contagem, max($contagem))[0];

// Interpretar o resultado
$interpretacoes = [
    'A' => ['tipo' => 'Criativo(a)', 'descricao' => 'Você tem grande potencial artístico, visual e inventivo.'],
    'B' => ['tipo' => 'Lógico(a)', 'descricao' => 'Você se destaca pelo raciocínio analítico e clareza na resolução de problemas.'],
    'C' => ['tipo' => 'Prático(a)', 'descricao' => 'Você é objetivo(a), direto(a) e foca na execução de ideias.'],
    'D' => ['tipo' => 'Planejador(a)', 'descricao' => 'Você se organiza com facilidade e gosta de estruturar soluções.']
];


// Salvar o resultado na tabela `resultados`
$stmt = $pdo->prepare("INSERT INTO resultados (usuario_id, tipo_resultado, descricao) VALUES (?, ?, ?)");
$stmt->execute([
    $usuario_id,
    $interpretacoes[$tipoResultado]['tipo'],
    $interpretacoes[$tipoResultado]['descricao']
]);

// Redirecionar para a página de resultado
header("Location: resultado_teste.php");
exit;
