<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../estilo.css">
  <title>Login</title>
</head>
<body class="pagina-cadastro">

  <div class="cadastro-wrapper2">
    
    <!-- Logo ao lado -->
    <div class="cadastro-logo">
      <img src="../imagens/logo.png" alt="Logo Sara Ajala Arquitetura">
    </div>

    <!-- Formulário de login -->
    <div class="cadastro-container cadastro-form-box">
      <h1>Login</h1>
      <form action="../processa/processa_login.php" method="POST" class="cadastro-form">
        <input type="email" name="email" placeholder="E-MAIL:" required>
        <input type="password" name="senha" placeholder="SENHA:" required>
        <button type="submit">ENTRAR</button>
      </form>

      <?php if (isset($_SESSION["msg"])): ?>
        <p style="color: <?= $_SESSION["msg"] === "sucesso" ? 'green' : 'red'; ?>">
          <?= $_SESSION["msg"] ?>
        </p>
        <?php unset($_SESSION["msg"]); ?>
      <?php endif; ?>

      <a href="redefinir_senha.php" class="cadastro-link">Esqueceu sua senha?</a>
    </div>
  </div>

  <!-- Footer fixado embaixo -->
  <footer class="cadastro-footer2">© TODOS OS DIREITOS RESERVADOS</footer>
</body>
</html>
