<?php
require_once '../controller/ProjetoController.php';
session_start();

$controller = new ProjetoController($pdo);
$planos = $controller->exibirPlanoAcao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["adicionar"])) {
        $controller->adicionarPlanoAcao($_POST["area"], $_POST["passo1"], $_POST["passo2"], $_POST["passo3"], $_POST["como_irei_fazer"], $_POST["prazo"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["atualizar"])) {
        $controller->atualizarPlanoAcao($_POST["id"], $_POST["area"], $_POST["passo1"], $_POST["passo2"], $_POST["passo3"], $_POST["como_irei_fazer"], $_POST["prazo"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plano de Ação</title>
</head>
<body>
    <h1>Plano de Ação</h1>

    <form method="POST">
        <input type="hidden" name="id">
        <input type="text" name="area" placeholder="Área" required>
        <input type="text" name="passo1" placeholder="Passo 1">
        <input type="text" name="passo2" placeholder="Passo 2">
        <input type="text" name="passo3" placeholder="Passo 3">
        <input type="text" name="como_irei_fazer" placeholder="Como irei fazer?">
        <input type="date" name="prazo" required>
        <button type="submit" name="adicionar">Adicionar</button>
    </form>

    <h2>Meus Planos de Ação</h2>
    <?php if (!empty($planos)): ?>
        <table border="1">
            <tr>
                <th>Área</th>
                <th>Passo 1</th>
                <th>Passo 2</th>
                <th>Passo 3</th>
                <th>Como Irei Fazer?</th>
                <th>Prazo</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($planos as $plano): ?>
                <tr>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($plano['id']); ?>">
                        <td><input type="text" name="area" value="<?php echo htmlspecialchars($plano['area']); ?>"></td>
                        <td><input type="text" name="passo1" value="<?php echo htmlspecialchars($plano['passo1']); ?>"></td>
                        <td><input type="text" name="passo2" value="<?php echo htmlspecialchars($plano['passo2']); ?>"></td>
                        <td><input type="text" name="passo3" value="<?php echo htmlspecialchars($plano['passo3']); ?>"></td>
                        <td><input type="text" name="como_irei_fazer" value="<?php echo htmlspecialchars($plano['como_irei_fazer']); ?>"></td>
                        <td><input type="date" name="prazo" value="<?php echo htmlspecialchars($plano['prazo']); ?>"></td>
                        <td><button type="submit" name="atualizar">Atualizar</button></td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum plano de ação cadastrado.</p>
    <?php endif; ?>
</body>
</html>
