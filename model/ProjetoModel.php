<?php

class ProjetoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $email, $data_nascimento, $senha) {
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $data_nascimento, $senhaHash]);
    }

    public function login($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    public function gerarTokenRedefinicao($email) {
        $token = bin2hex(random_bytes(50));
        $sql = "UPDATE usuarios SET token_recuperacao = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$token, $email]);
        return $token;
    }

    public function redefinirSenha($token, $novaSenha) {
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET senha = ?, token_recuperacao = NULL WHERE token_recuperacao = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$senhaHash, $token]);
    }
}


?>