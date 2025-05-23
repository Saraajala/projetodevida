<?php
require_once '../controller/ProjetoController.php';
require_once '../config.php';

session_start();

if (empty($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// $controller = new ProjetoController($pdo);
$model = new ProjetoModel($pdo);
$controller = new ProjetoController($pdo);

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
        // Buscar planos para encontrar o plano a editar
        $planos = $controller->buscarPlanoAcao();
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

// Buscar planos para exibir (se não veio do editar, para evitar recarregar dados desatualizados)
if (!$planoEditar) {
    $planos = $controller->buscarPlanoAcao($_SESSION['usuario_id']);
}

// Buscar áreas do banco para o select
$stmt = $pdo->query("SELECT * FROM areas_plano");
$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Plano de Ação</title>
    <link rel="stylesheet" href="../css/estilo_plano.css">
</head>
<body>
    <header class="header-sobre">
        <img src="../imagens/logo.png" alt="logo" class="logo">

        <nav>
            <ul class="menu-central">
                <li><a href="teste_personalidade.php">Teste de personalidade</a></li>
                <li><a href="form_planejamento.php">Planeamento do futuro</a></li>
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

    <div >
        <img class="imagem-planodeacao" src="../imagens/planoo.png" alt="">
        <h1 class="titulo-plano">PLANO DE AÇÃO</h1>
    </div>


<section class="estabelecendo">   
<h2>ESTABELECENDO METAS</h2>
</section>

<section class="tabela-metas">
    <form method="POST">
        <input type="hidden" name="id" value="<?= $planoEditar ? htmlspecialchars($planoEditar['id']) : '' ?>">

        <select name="area" required>
            <option value="">Selecione a área</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= htmlspecialchars($area['nome']) ?>" <?= ($planoEditar && $planoEditar['area'] === $area['nome']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="passo1" placeholder="Passo 1" value="<?= $planoEditar ? htmlspecialchars($planoEditar['passo1']) : '' ?>" required>
        <input type="text" name="passo2" placeholder="Passo 2" value="<?= $planoEditar ? htmlspecialchars($planoEditar['passo2']) : '' ?>" required>
        <input type="text" name="passo3" placeholder="Passo 3" value="<?= $planoEditar ? htmlspecialchars($planoEditar['passo3']) : '' ?>" required>
        <input type="text" name="como_irei_fazer" placeholder="Como irei fazer?" value="<?= $planoEditar ? htmlspecialchars($planoEditar['como_irei_fazer']) : '' ?>" required>
        <input type="date" name="prazo" placeholder="Prazo" required value="<?= $planoEditar ? htmlspecialchars($planoEditar['prazo']) : '' ?>">
<br><br>
<div class="btn-wrapper">
        <button type="submit" name="<?= $planoEditar ? 'atualizar' : 'adicionar' ?>">
            <?= $planoEditar ? 'Atualizar' : 'Adicionar' ?>
        </button>
    </div>
    </form>

   <br><br>

    <?php if (!empty($planos)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Passo 1</th>
                    <th>Passo 2</th>
                    <th>Passo 3</th>
                    <th>Como Irei Fazer?</th>
                    <th>Prazo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planos as $plano): ?>
                    <tr>
                        <td><?= htmlspecialchars($plano['area']) ?></td>
                        <td><?= htmlspecialchars($plano['passo1']) ?></td>
                        <td><?= htmlspecialchars($plano['passo2']) ?></td>
                        <td><?= htmlspecialchars($plano['passo3']) ?></td>
                        <td><?= htmlspecialchars($plano['como_irei_fazer']) ?></td>
                        <td><?= htmlspecialchars($plano['prazo']) ?></td>
                        <td>
                            <form method="POST" style="display:inline-block;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($plano['id']) ?>">
                                <button type="submit" name="editar">Editar</button>
                            </form>
                            <form method="POST" style="display:inline-block;" onsubmit="return confirm('Tem certeza que deseja deletar este plano?');">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($plano['id']) ?>">
                                <button type="submit" name="deletar">Deletar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="plano">Nenhum plano de ação cadastrado.</p>
    <?php endif; ?>
</section>

<footer>
    <p>© 2025 Todos os direitos reservados.</p>
</footer>

</body>
</html>
