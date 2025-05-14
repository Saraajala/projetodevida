<?php
require_once 'C:/Turma2/xampp/htdocs/projetodevida/model/ProjetoModel.php';

class ProjetoController
{
    private $projetoModel;

    public function __construct($pdo)
    {
        $this->projetoModel = new ProjetoModel($pdo);
    }

    // USUÁRIO
    public function cadastrar($nome, $email, $senha, $data_nascimento)
    {
        // Verificar se o email já está cadastrado
        $usuarioExistente = $this->projetoModel->buscarUsuarioPorEmail($email);
    
        if ($usuarioExistente) {
            // Se o email já existe, retornar a mensagem de erro
            return [
                'sucesso' => false,
                'mensagem' => 'Este e-mail já está cadastrado.'
            ];
        }
    
        // Tentar cadastrar o novo usuário
        $resultado = $this->projetoModel->cadastrar($nome, $email, $senha, $data_nascimento);
    
        if ($resultado) {
            // Redirecionar para o index.php após sucesso
            header("Location: /projetodevida/index.php?msg=sucesso_cadastro");
            exit; // Importante para garantir que o código pare de executar aqui
        } else {
            // Retornar erro caso o cadastro falhe
            return [
                'sucesso' => false,
                'mensagem' => 'Erro ao cadastrar usuário.'
            ];
        }
    }

    public function login($email, $senha)
    {
        session_start(); // garante que a sessão esteja ativa

        $usuario = $this->projetoModel->login($email);

        if (!$usuario) {
            $_SESSION['msg'] = "erro usuario";
            return;
        }

        if (!password_verify($senha, $usuario['senha'])) {
            $_SESSION['msg'] = "erro senha";
            return;
        }

        // Salva ID do usuário e redireciona para index.php
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['msg'] = "sucesso";
        header('Location: ../index.php'); // voltar para a página inicial
        exit;
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: ../inicio.php");
    }

    public function redefinirSenhaDireta()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $novaSenha = $_POST["nova_senha"];
            $confirmarSenha = $_POST["confirmar_senha"];

            if ($novaSenha !== $confirmarSenha) {
                header("Location: ../esqueci_senha.php?msg=senhas_nao_conferem");
                exit();
            }

            $usuario = $this->projetoModel->buscarUsuarioPorEmail($email);
            if ($usuario) {
                $resultado = $this->projetoModel->atualizarSenha($email, $novaSenha);
                header("Location: ../login.php?msg=" . ($resultado ? "senha_redefinida" : "erro_redefinir"));
            } else {
                header("Location: ../esqueci_senha.php?msg=email_nao_encontrado");
            }
        }
    }
    
    public function atualizarPerfil()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Recupera os dados enviados
            $usuarioId = $_SESSION['usuario_id'];
            $email = $_POST['email'];
            $dataNascimento = $_POST['data_nascimento'];
            $sobreMim = $_POST['sobre_mim'];
            $senha = $_POST['senha'];
    
            // Trata o upload da imagem
            $nomeArquivoFinal = null;
            if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
                // Obtemos a extensão do arquivo
                $extensao = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
                // Geramos um nome único para o arquivo
                $nomeArquivoFinal = uniqid('perfil_', true) . '.' . $extensao;
                // Caminho de destino para a pasta "imagens"
                $caminhoDestino = "../imagens/" . $nomeArquivoFinal;
    
                // Verifica se a pasta existe, caso contrário cria
                if (!file_exists('../imagens')) {
                    mkdir('../imagens', 0777, true);
                }
    
                // Move o arquivo para o destino
                if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoDestino)) {
                    // Sucesso no upload
                } else {
                    echo "Erro ao mover a imagem.";
                    $nomeArquivoFinal = null; // Se houve erro, não define o arquivo
                }
            }
    
            // Se a senha não foi preenchida, ela não será alterada
            if (empty($senha)) {
                $senha = null;
            }
    
            // Chama o Model para atualizar os dados no banco
            $this->projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $nomeArquivoFinal);
    
            // Atualiza sessão com os novos dados
            $_SESSION['email'] = $email;
            $_SESSION['data_nascimento'] = $dataNascimento;
            $_SESSION['sobre_mim'] = $sobreMim;
            if ($nomeArquivoFinal) {
                $_SESSION['foto_perfil'] = $nomeArquivoFinal;
            }
    
            // Redireciona para a página de perfil
            header("Location: ../view/perfil.php");
            exit;
        }
    }

    public function perfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: ../view/login.php");
            exit;
        }

        $usuarioId = $_SESSION['usuario_id'];
        $dados = $this->projetoModel->buscarUsuarioPorId($usuarioId);

        if ($dados) {
            // Atualiza os dados da sessão com as informações atuais do banco
            $_SESSION['email'] = $dados['email'];
            $_SESSION['data_nascimento'] = $dados['data_nascimento'];
            $_SESSION['foto_perfil'] = $dados['foto_perfil'] ?? 'padrao.png';
            $_SESSION['sobre_mim'] = $dados['sobre_mim'] ?? '';
        }

        include '../view/perfil.php';
    }


 // PROFISSÕES
 public function buscarProfissoes($termo) {
    return $this->model->buscarProfissoes($termo);
}


    public function adicionarPlanoAcao($area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
    
        $usuario_id = $_SESSION["usuario_id"];
        $res = $this->projetoModel->adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
    
        if ($res) {
            header("Location: plano_acao.php?msg=sucesso");
        } else {
            header("Location: plano_acao.php?msg=erro");
        }
        exit();
    }
    
    public function atualizarPlanoAcao($id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
    
        $usuario_id = $_SESSION["usuario_id"];
        $res = $this->projetoModel->atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
    
        if ($res) {
            header("Location: plano_acao.php?msg=atualizado");
        } else {
            header("Location: plano_acao.php?msg=erro_atualizar");
        }
        exit();
    }
    
    public function exibirPlanoAcao()
    {
        if (!isset($_SESSION["usuario_id"])) {
            return [];
        }
        return $this->projetoModel->buscarPlanoAcao($_SESSION["usuario_id"]);
    }

    public function deletarPlanoAcao($id) {
        return $this->projetoModel->deletarPlanoAcao($id);
        return $model->deletarPlanoAcao($id);
    }    
    

    // FEEDBACK
    public function salvarFeedback()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            echo "Você precisa estar logado para enviar feedback.";
            return;
        }

        $usuarioId = $_SESSION['usuario_id'];
        $email = $_POST['email'] ?? '';
        $opiniao = $_POST['opiniao'] ?? '';

        if (!empty($email) && !empty($opiniao)) {
            // Corrigido aqui:
            $this->projetoModel->salvarFeedback($usuarioId, $email, $opiniao);
            header("Location: view/meus_feedbacks.php");
            exit;
        } else {
            echo "Preencha todos os campos.";
        }
    }

    // TESTES
    public function testePersonalidade()
    {
        $perguntas = $this->projetoModel->buscarPerguntas();
        $respostas = $this->projetoModel->buscarRespostas();
    
        // Verificar o conteúdo das variáveis
        var_dump($perguntas); // Verifique se as perguntas estão sendo recuperadas corretamente
        var_dump($respostas);  // Verifique se as respostas estão sendo recuperadas corretamente
    
        // Organiza as respostas por pergunta_id
        $respostasPorPergunta = [];
        foreach ($respostas as $resposta) {
            $respostasPorPergunta[$resposta['pergunta_id']][] = $resposta;
        }
    
        // Passa os dados para a view
        include 'views/teste_personalidade.php';
    }

    public function buscarResultadosTeste($usuario_id)
    {
        return $this->projetoModel->buscarResultadosTeste($usuario_id);
    }

    public function salvarRespostasTeste($usuario_id, $respostas)
    {
        return $this->projetoModel->salvarRespostasTeste($usuario_id, $respostas);
    }

    public function buscarPerguntasTeste()
    {
        return $this->projetoModel->buscarPerguntas();
    }

    public function agruparResultadosPorTipo($usuario_id)
    {
        return $this->projetoModel->agruparResultadosPorTipo($usuario_id);
    }

    public function buscarRespostas()
    {
        return $this->projetoModel->buscarRespostas();
    }
}
