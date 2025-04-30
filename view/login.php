<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/estilo_login.css">
  <title>Login</title>
</head>
<body class="pagina-login">
  <main>
    <div class="login-wrapper">
      <div class="login-logo">
        <img src="../imagens/logo.png" alt="Logo Sara Ajala Arquitetura">
      </div>
      <div class="login-container login-form-box">
        <h1>LOGIN</h1>
        <form action="../processa/processa_login.php" method="POST" class="login-form">
          <input type="email" name="email" placeholder="E-MAIL:" required>
          <input type="password" name="senha" placeholder="SENHA:" required>
          <button type="submit">ENTRAR</button>
        </form>
        <a href="redefinir_senha.php" class="login-link">Esqueceu sua senha?</a>
      </div>
    </div>
  </main>

  <footer class="login-footer">© TODOS OS DIREITOS RESERVADOS</footer>
</body>

</html>
