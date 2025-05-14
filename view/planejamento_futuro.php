<?php
// Incluindo o controlador que possui a função de buscar profissões
require_once 'C:\Turma2\xampp\htdocs\projetodevida\controller\ProjetoController.php'; // Ajuste o caminho conforme necessário
require_once 'C:\Turma2\xampp\htdocs\projetodevida\model\ProjetoModel.php'; // Certifique-se de incluir o modelo também

// Configurações do banco de dados
$host = 'localhost'; // Host do banco de dados
$dbname = 'projetodevida'; // Nome do banco de dados
$username = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

// Criando a conexão PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar com o banco de dados: " . $e->getMessage();
    exit;
}

// Instanciando o modelo e o controlador
$projetoModel = new ProjetoModel($pdo); // Passando a conexão PDO para o modelo
$controller = new ProjetoController($projetoModel); // Passando o modelo para o controlador
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planejamento de Futuro</title>
    <link rel="stylesheet" href="css/style.css"> <!-- CSS para estilizar a página -->
</head>
<body>
    <header>
        <!-- Aqui você pode incluir o header com navegação -->
    </header>

    <main>
        <section class="planejamento-futuro">
            <h2>Planejamento de Futuro</h2>

            <!-- Seção 1: Aprendendo a Fazer -->
            <div class="aprendendo-a-fazer">
                <h3>Aprendendo a Fazer</h3>
                <form method="POST" action="processar_planejamento.php">
                    <textarea name="aspiracoes" placeholder="Fale um pouco sobre suas aspirações, sonhos de infância e sonhos atuais." rows="5" required></textarea>
                </form>
            </div>

            <!-- Seção 2: Planejamento -->
            <div class="planejamento">
                <h3>Planejamento</h3>
                <textarea name="planejamento_atual" placeholder="O que você já está fazendo e o que ainda precisa fazer." rows="5" required></textarea>
            </div>

            <!-- Seção 3: Novas Metas -->
            <div class="novas-metas">
                <h3>Novas Metas</h3>
                <label for="curto-prazo">Curto Prazo:</label>
                <textarea name="curto_prazo" rows="3" placeholder="Metas a curto prazo" required></textarea>

                <label for="medio-prazo">Médio Prazo:</label>
                <textarea name="medio_prazo" rows="3" placeholder="Metas a médio prazo" required></textarea>

                <label for="longo-prazo">Longo Prazo:</label>
                <textarea name="longo_prazo" rows="3" placeholder="Metas a longo prazo" required></textarea>
            </div>

            <!-- Seção 4: Busca por Profissões -->
            <div class="busca-profissoes">
                <h3>Buscar Profissões</h3>
                <form method="GET" action="planejamento_futuro.php">
                    <input type="text" name="termo" placeholder="Digite uma profissão" required>
                    <button type="submit">Buscar</button>
                </form>

                <div class="resultados-busca">
                    <?php
                    if (isset($_GET['termo'])) {
                        // Chama a função de busca de profissões do controlador
                        $resultados = $controller->buscarProfissoes($_GET['termo']);
                        if (!empty($resultados)) {
                            foreach ($resultados as $profissao) {
                                echo "<div class='profissao-item'>";
                                echo "<h4>{$profissao['nome']}</h4>";
                                echo "<p>{$profissao['descricao']}</p>";
                                // Verifica se existe uma imagem associada
                                if (!empty($profissao['imagem'])) {
                                    echo "<img src='imagens/{$profissao['imagem']}' alt='{$profissao['nome']}'>";
                                }
                                echo "</div>";
                            }
                        } else {
                            echo "<p>Nenhuma profissão encontrada com esse termo.</p>";
                        }
                    }
                    ?>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <p>Todos os direitos reservados &copy; 2025</p>
    </footer>
</body>
</html>
