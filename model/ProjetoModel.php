<?php

class ProjetoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // USUÁRIO
    public function cadastrar($nome, $email, $senha, $data_nascimento,) {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento) VALUES (:nome, :email, :senha, :data_nascimento)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaCriptografada);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        return $stmt->execute();
    }

    public function login($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    
    }
    
    

    public function buscarUsuarioPorEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarSenha($email, $novaSenha) {
        $novaSenhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        return $stmt->execute([$novaSenhaCriptografada, $email]);
    }

    public function buscarPerfil($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarPerfil($usuario_id, $email, $senha, $data_nascimento, $foto_perfil, $sobre_mim) {
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET email = ?, senha = ?, data_nascimento = ?, foto_perfil = ?, sobre_mim = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$email, $senhaCriptografada, $data_nascimento, $foto_perfil, $sobre_mim, $usuario_id]);
    }

    // TESTES
    public function buscarPerguntasTeste() {
        return $this->pdo->query("SELECT * FROM perguntas_teste")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarRespostasTeste($usuario_id, $respostas) {
        $sql = "INSERT INTO respostas_teste (usuario_id, pergunta_id, resposta) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        foreach ($respostas as $pergunta_id => $resposta) {
            if (!$stmt->execute([$usuario_id, $pergunta_id, $resposta])) {
                return false;
            }
        }
        return true;
    }

    public function buscarResultadosTeste($usuario_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM resultados_teste WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agruparResultadosPorTipo($usuario_id) {
        $sql = "SELECT tipo_resultado, COUNT(*) as quantidade FROM resultados_teste WHERE usuario_id = ? GROUP BY tipo_resultado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // PLANO DE AÇÃO
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
        $stmt = $this->pdo->prepare("SELECT * FROM planos_acao WHERE usuario_id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // PROFISSÕES
    public function buscarProfissoes($termo) {
        $stmt = $this->pdo->prepare("SELECT * FROM profissoes WHERE nome LIKE ?");
        $stmt->execute(["%$termo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // FEEDBACK
    public function inserirFeedback($email, $opiniao) {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (email, opiniao) VALUES (?, ?)");
        return $stmt->execute([$email, $opiniao]);
    }
    
    public function listarFeedbacks() {
        $stmt = $this->pdo->query("SELECT email, opiniao FROM feedbacks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarFeedbacksPorUsuario($usuarioId) {
        $stmt = $this->pdo->prepare("SELECT * FROM feedbacks WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function buscarTodosFeedbacks() {
        $stmt = $this->pdo->query("SELECT * FROM feedbacks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function salvarFeedback($usuarioId, $email, $opiniao) {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (usuario_id, email, opiniao) VALUES (?, ?, ?)");
        return $stmt->execute([$usuarioId, $email, $opiniao]);
    }
    


}
?>