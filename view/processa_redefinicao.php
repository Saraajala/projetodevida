<?php
require_once 'C:\Turma2\xampp\htdocs\projetodevida\model\ProjetoModel.php';
require_once 'C:\Turma2\xampp\htdocs\projetodevida\config.php'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $novaSenha = trim($_POST["nova_senha"]);
    $confirmarSenha = trim($_POST["confirmar_senha"]);

    // Validar se as senhas são iguais
    if ($novaSenha !== $confirmarSenha) {
        $_SESSION["msg"] = "Senhas não coincidem!";
        $_SESSION["tipo_msg"] = "erro";
        header("Location: esqueci_senha.php");
        exit();
    }

    $projetoModel = new ProjetoModel($pdo);
    
    // Verificar se o e-mail existe no banco
    $usuario = $projetoModel->buscarUsuarioPorEmail($email);
    
    if ($usuario) {
        // Criptografar nova senha
        $novaSenhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);
        $resultado = $projetoModel->atualizarSenha($email, $novaSenhaCriptografada);

        if ($resultado) {
            $_SESSION["msg"] = "Senha redefinida com sucesso!";
            $_SESSION["tipo_msg"] = "sucesso";
            header("Location: login.php");
            exit();
        } else {
            $_SESSION["msg"] = "Erro ao redefinir senha!";
            $_SESSION["tipo_msg"] = "erro";
            header("Location: esqueci_senha.php");
            exit();
        }
    } else {
        $_SESSION["msg"] = "E-mail não encontrado!";
        $_SESSION["tipo_msg"] = "erro";
        header("Location: esqueci_senha.php");
        exit();
    }
}
?>