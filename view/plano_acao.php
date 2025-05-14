<?php
require_once '../controller/ProjetoController.php';
require_once '../config.php';
session_start();

$controller = new ProjetoController($pdo);
$planos = $controller->exibirPlanoAcao();

// Buscar áreas do banco
$stmt = $pdo->query("SELECT * FROM areas_plano");
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

$planoEditar = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["adicionar"])) {
        $controller->adicionarPlanoAcao($_POST["area"], $_POST["passo1"], $_POST["passo2"], $_POST["passo3"], $_POST["como_irei_fazer"], $_POST["prazo"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["atualizar"])) {
        $controller->atualizarPlanoAcao($_POST["id"], $_POST["area"], $_POST["passo1"], $_POST["passo2"], $_POST["passo3"], $_POST["como_irei_fazer"], $_POST["prazo"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } elseif (isset($_POST["editar"])) {
        foreach ($planos as $plano) {
            if ($plano["id"] == $_POST["id"]) {
                $planoEditar = $plano;
                break;
            }
        }
    } elseif (isset($_POST["deletar"])) {
        $controller->deletarPlanoAcao($_POST["id"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Plano de Ação</title>
</head>
<body>
    <h1>Plano de Ação</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $planoEditar ? $planoEditar['id'] : ''; ?>">

        <select name="area" required>
            <option value="">Selecione a área</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= htmlspecialchars($area['nome']) ?>" <?= $planoEditar && $planoEditar['area'] === $area['nome'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="passo1" placeholder="Passo 1" value="<?php echo $planoEditar ? htmlspecialchars($planoEditar['passo1']) : ''; ?>">
        <input type="text" name="passo2" placeholder="Passo 2" value="<?php echo $planoEditar ? htmlspecialchars($planoEditar['passo2']) : ''; ?>">
        <input type="text" name="passo3" placeholder="Passo 3" value="<?php echo $planoEditar ? htmlspecialchars($planoEditar['passo3']) : ''; ?>">
        <input type="text" name="como_irei_fazer" placeholder="Como irei fazer?" value="<?php echo $planoEditar ? htmlspecialchars($planoEditar['como_irei_fazer']) : ''; ?>">
        <input type="date" name="prazo" required value="<?php echo $planoEditar ? htmlspecialchars($planoEditar['prazo']) : ''; ?>">

        <button type="submit" name="<?php echo $planoEditar ? 'atualizar' : 'adicionar'; ?>">
            <?php echo $planoEditar ? 'Atualizar' : 'Adicionar'; ?>
        </button>
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
                        <td><?php echo htmlspecialchars($plano['area']); ?></td>
                        <td><?php echo htmlspecialchars($plano['passo1']); ?></td>
                        <td><?php echo htmlspecialchars($plano['passo2']); ?></td>
                        <td><?php echo htmlspecialchars($plano['passo3']); ?></td>
                        <td><?php echo htmlspecialchars($plano['como_irei_fazer']); ?></td>
                        <td><?php echo htmlspecialchars($plano['prazo']); ?></td>
                        <td>
                            <button type="submit" name="editar">Editar</button>
                            <button type="submit" name="deletar">Deletar</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nenhum plano de ação cadastrado.</p>
    <?php endif; ?>
</body>
</html>
