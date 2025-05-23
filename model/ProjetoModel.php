<?php
include_once 'C:\Turma2\xampp\htdocs\projetodevida\config.php'; // Se for o caso


class ProjetoModel
{
     private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    // USUÁRIO
    public function cadastrar($nome, $email, $senha, $data_nascimento)
    {
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nome, email, senha, data_nascimento) VALUES (:nome, :email, :senha, :data_nascimento)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaCriptografada);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        return $stmt->execute();
    }

    public function login($email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



public function buscarUsuarioPorEmail($email) {
    $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function atualizarSenha($email, $novaSenha)
    {
        $novaSenhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("UPDATE usuarios SET senha = ? WHERE email = ?");
        return $stmt->execute([$novaSenhaCriptografada, $email]);
    }

    public function buscarPerfil($usuario_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

 public function atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $fotoPerfil = null)
{
    try {
        $sql = "UPDATE usuarios SET 
                email = :email, 
                data_nascimento = :data_nascimento, 
                sobre_mim = :sobre_mim";
        
        // Adiciona a senha apenas se foi fornecida
        if ($senha !== null) {
            $sql .= ", senha = :senha";
        }
        
        // Adiciona a foto apenas se foi fornecida
        if ($fotoPerfil !== null) {
            $sql .= ", foto_perfil = :foto_perfil";
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        
        // Bind dos parâmetros obrigatórios
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_nascimento', $dataNascimento);
        $stmt->bindParam(':sobre_mim', $sobreMim);
        $stmt->bindParam(':id', $usuarioId);
        
        // Bind dos parâmetros condicionais
        if ($senha !== null) {
            $stmt->bindParam(':senha', $senha);
        }
        if ($fotoPerfil !== null) {
            $stmt->bindParam(':foto_perfil', $fotoPerfil);
        }
        
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Erro ao atualizar perfil: " . $e->getMessage());
        return false;
    }
}
    public function buscarUsuarioPorId($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // TESTES
    // Busca todas as perguntas do teste
    public function buscarPerguntas()
    {
        $stmt = $this->pdo->query("SELECT id, texto FROM perguntas");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarRespostas()
    {
        try {
            $stmt = $this->pdo->query("SELECT id, pergunta_id, texto FROM respostas");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro ao buscar respostas: " . $e->getMessage());
        }
    }


    // Pode ser usado como sinônimo de buscarPerguntas()
    public function buscarPerguntasTeste()
    {
        return $this->buscarPerguntas();
    }

    // Salva as respostas que o usuário marcou no teste
    public function salvarRespostasTeste($usuario_id, $respostas)
    {
        // Alteração para usar a coluna resposta_id
        $sql = "INSERT INTO respostas_teste (usuario_id, resposta_id, resposta) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);

        // Inserir as respostas na tabela
        foreach ($respostas as $resposta_id => $resposta) {
            if (!$stmt->execute([$usuario_id, $resposta_id, $resposta])) {
                return false;
            }
        }
        return true;
    }

    // Busca os resultados individuais do teste
    public function buscarResultadosTeste($usuario_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM resultados WHERE usuario_id = ? ORDER BY id DESC");
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agrupa resultados por tipo (ex: tipo de personalidade ou estilo)
    public function agruparResultadosPorTipo($usuario_id)
    {
        $sql = "SELECT tipo_resultado, COUNT(*) as quantidade FROM resultados_teste WHERE usuario_id = ? GROUP BY tipo_resultado";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // PLANO DE AÇÃO

    // Adiciona um novo plano de ação
    public function adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        $sql = "INSERT INTO planos_acao (usuario_id, area, passo1, passo2, passo3, como_irei_fazer, prazo)
            VALUES (:usuario_id, :area, :passo1, :passo2, :passo3, :como_irei_fazer, :prazo)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':area' => $area,
            ':passo1' => $passo1,
            ':passo2' => $passo2,
            ':passo3' => $passo3,
            ':como_irei_fazer' => $como_irei_fazer,
            ':prazo' => $prazo
        ]);
    }

    // Atualiza um plano de ação existente
    public function atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        $sql = "UPDATE planos_acao
            SET area = :area, passo1 = :passo1, passo2 = :passo2, passo3 = :passo3,
                como_irei_fazer = :como_irei_fazer, prazo = :prazo
            WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':area' => $area,
            ':passo1' => $passo1,
            ':passo2' => $passo2,
            ':passo3' => $passo3,
            ':como_irei_fazer' => $como_irei_fazer,
            ':prazo' => $prazo,
            ':id' => $id,
            ':usuario_id' => $usuario_id
        ]);
    }

    public function buscarPlanoAcao($usuarioId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM planos_acao WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Deleta um plano de ação por ID
    public function deletarPlanoAcao($id, $usuario_id)
    {
        $sql = "DELETE FROM planos_acao WHERE id = :id AND usuario_id = :usuario_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id, ':usuario_id' => $usuario_id]);
    }



    // PROFISSÕES
public function buscarTodasProfissoes() {
    $stmt = $this->pdo->query("SELECT * FROM profissao ORDER BY nome");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function buscarProfissaoPorId($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM profissao WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function buscarProfissoes($filtro) {
    $sql = "SELECT * FROM profissao WHERE LOWER(nome) LIKE LOWER(:filtro) ORDER BY nome";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':filtro', '%' . $filtro . '%');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // Buscar planejamento do usuário
    public function buscarPorUsuario($usuario_id)
    {
        $sql = "SELECT * FROM planejamento WHERE usuario_id = :usuario_id LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvarPlanejamento($usuario_id, $aprendendo, $fazendo, $preciso, $meta_curto, $meta_medio, $meta_longo)
    {
        // Verifica se já existe registro para o usuário
        $existente = $this->buscarPorUsuario($usuario_id);

        if ($existente) {
            // Atualizar
            $sql = "UPDATE planejamento SET aprendendo = :aprendendo, fazendo = :fazendo, preciso = :preciso,
                meta_curto = :meta_curto, meta_medio = :meta_medio, meta_longo = :meta_longo,
                data_atualizacao = NOW()
                WHERE usuario_id = :usuario_id";
            $stmt = $this->pdo->prepare($sql);
        } else {
            // Inserir
            $sql = "INSERT INTO planejamento (usuario_id, aprendendo, fazendo, preciso, meta_curto, meta_medio, meta_longo)
                VALUES (:usuario_id, :aprendendo, :fazendo, :preciso, :meta_curto, :meta_medio, :meta_longo)";
            $stmt = $this->pdo->prepare($sql);
        }

        // Vincular todos os parâmetros sempre
        $stmt->bindValue(':usuario_id', $usuario_id, PDO::PARAM_INT);
        $stmt->bindValue(':aprendendo', $aprendendo, PDO::PARAM_STR);
        $stmt->bindValue(':fazendo', $fazendo, PDO::PARAM_STR);
        $stmt->bindValue(':preciso', $preciso, PDO::PARAM_STR);
        $stmt->bindValue(':meta_curto', $meta_curto, PDO::PARAM_STR);
        $stmt->bindValue(':meta_medio', $meta_medio, PDO::PARAM_STR);
        $stmt->bindValue(':meta_longo', $meta_longo, PDO::PARAM_STR);
        return $stmt->execute();
    }


    // FEEDBACK
    public function inserirFeedback($email, $opiniao)
    {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (email, opiniao) VALUES (?, ?)");
        return $stmt->execute([$email, $opiniao]);
    }

    public function listarFeedbacks()
    {
        $stmt = $this->pdo->query("SELECT email, opiniao FROM feedbacks ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarFeedbacksPorUsuario($usuarioId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM feedbacks WHERE usuario_id = ?");
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarTodosFeedbacks()
    {
        $stmt = $this->pdo->query("SELECT * FROM feedbacks");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarFeedback($usuarioId, $email, $opiniao)
    {
        $stmt = $this->pdo->prepare("INSERT INTO feedbacks (usuario_id, email, opiniao) VALUES (?, ?, ?)");
        return $stmt->execute([$usuarioId, $email, $opiniao]);
    }
    public function LastInsertId()
{
    $stmt = $this->pdo->prepare("SELECT LAST_INSERT_ID FROM usuarios ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
