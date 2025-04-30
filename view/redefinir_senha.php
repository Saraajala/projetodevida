<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Redefinir Senha</title>
  <link rel="stylesheet" href="../css/estilo_esqueci.css">
</head>
<body class="pagina-esqueci-senha">

<main class="esqueci-wrapper">
  <!-- Formulário à esquerda -->
  <div class="esqueci-form-box">
    <h1 class="esqueci-titulo">ESQUECEU A SENHA?</h1>
    <p class="esqueci-subtitulo">CADASTRE A NOVA SENHA:</p>
    
    <form action="../processa/processa_redefinicao.php" method="POST" class="esqueci-form">
  <label for="email" class="esqueci-label"></label>
  <input type="email" name="email" required placeholder="Digite seu e-mail" class="esqueci-input">

  <label for="nova_senha" class="esqueci-label"></label>
  <input type="password" name="nova_senha" required placeholder="Digite sua nova senha" class="esqueci-input">

  <label for="confirmar_senha" class="esqueci-label"></label>
  <input type="password" name="confirmar_senha" required placeholder="Confirme sua nova senha" class="esqueci-input">

  <button type="submit" class="esqueci-botao">SALVAR</button>
</form>
  </div>

  <!-- Galeria à direita -->
  <div class="esqueci-galeria">
    <img src="../imagens/img-esqueciasenha1.png" alt="Imagem 1" class="img-grande">
    <img src="../imagens/img-esqueciasenha2.png" alt="Imagem 2" class="img-media">
    <img src="../imagens/img-esqueciasenha3.png" alt="Imagem 3" class="img-pequena">
    <img src="../imagens/img-esqueciasenha4.png" alt="Imagem 4" class="img-media-grande">
  </div>
</main>

  <footer class="esqueci-footer">© TODOS OS DIREITOS RESERVADOS</footer>

</body>
</html>
