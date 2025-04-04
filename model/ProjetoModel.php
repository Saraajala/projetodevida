<?php

class ProjetoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function cadastrar($nome, $email, $data_nascimento, $senha) {
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nome, email, data_nascimento, senha) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $data_nascimento, $senhaCriptografada]);
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

    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($email, $novaSenha) {
        $novaSenhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$novaSenhaCriptografada, $email]);
    }

    public function buscarPerfil($usuario_id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarPerfil($usuario_id, $email, $senha, $data_nascimento, $foto_perfil, $sobre_mim) {
        $sql = "UPDATE usuarios SET email = ?, senha = ?, data_nascimento = ?, foto_perfil = ?, sobre_mim = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$email, password_hash($senha, PASSWORD_BCRYPT), $data_nascimento, $foto_perfil, $sobre_mim, $usuario_id]);
    }

    public function buscarPerguntasTeste() {
        $sql = "SELECT * FROM perguntas_teste";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarRespostasTeste($usuario_id, $respostas) {
        foreach ($respostas as $pergunta_id => $resposta) {
            $sql = "INSERT INTO respostas_teste (usuario_id, pergunta_id, resposta) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            if (!$stmt->execute([$usuario_id, $pergunta_id, $resposta])) {
                return false;
            }
        }
        return true;
    }

    public function buscarResultadosTeste($usuario_id) {
        $sql = "SELECT * FROM resultados_teste WHERE usuario_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarProfissoes($termo) {
        $sql = "SELECT * FROM profissoes WHERE nome LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["%$termo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo) {
        $sql = "INSERT INTO planos_acao (usuario_id, area, passo1, passo2, passo3, como_irei_fazer, prazo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo]);
    }

    public function atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo) {
        $sql = "UPDATE planos_acao SET area = ?, passo1 = ?, passo2 = ?, passo3 = ?, como_irei_fazer = ?, prazo = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo, $id, $usuario_id]);
    }

    public function buscarPlanoAcao($usuario_id) {
        $sql = "SELECT * FROM planos_acao WHERE usuario_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserirFeedback($email, $opiniao) {
        $sql = "INSERT INTO feedback (email, opiniao) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$email, $opiniao]);
    }
}

?>