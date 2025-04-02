</head>
<body>
    <h2>Atualizar Perfil</h2>
    <form action="controller/ProjetoController.php?action=atualizarPerfil" method="POST" enctype="multipart/form-data">
        <input type="email" name="email" placeholder="E-mail" value="<?php echo $_SESSION['email']; ?>" required>
        <input type="password" name="senha" placeholder="Nova Senha">
        <input type="date" name="data_nascimento" value="<?php echo $_SESSION['data_nascimento']; ?>" required>
        <input type="file" name="foto_perfil" accept="image/*">
        <textarea name="sobre_mim" placeholder="Sobre mim"><?php echo $_SESSION['sobre_mim']; ?></textarea>
        <button type="submit">Atualizar</button>
    </form>
    <a href="perfil.php">Voltar ao Perfil</a>
</body>
</html>