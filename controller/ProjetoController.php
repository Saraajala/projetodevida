<?php
require_once 'C:\Turma2\xampp\htdocs\projetodevida\model\ProjetoModel.php';

class ProjetoController
{
    private $projetoModel;

    public function __construct($projetoModel)
    {
        $this->projetoModel = $projetoModel;
    }

    // USUÁRIO
    // public function cadastrar($nome, $email, $senha, $data_nascimento)
    // {
    //     $usuarioExistente = $this->projetoModel->buscarUsuarioPorEmail($email);

    //     if ($usuarioExistente) {
    //         return [
    //             'sucesso' => false,
    //             'mensagem' => 'Este e-mail já está cadastrado.'
    //         ];
    //     }

    //     $resultado = $this->projetoModel->cadastrar($nome, $email, $senha, $data_nascimento);

    //     if ($resultado) {
    //         header("Location: /projetodevida/index.php?msg=sucesso_cadastro");
    //         exit;
    //     } else {
    //         return [
    //             'sucesso' => false,
    //             'mensagem' => 'Erro ao cadastrar usuário.'
    //         ];
    //     }
    // }
public function cadastrar($nome, $email, $senha, $data_nascimento)
{
    // Call the method on the model, not on PDO
    $usuarioExistente = $this->projetoModel->buscarUsuarioPorEmail($email);

    if ($usuarioExistente) {
        return [
            'sucesso' => false,
            'mensagem' => 'Este e-mail já está cadastrado.'
        ];
    }

    $resultado = $this->projetoModel->cadastrar($nome, $email, $senha, $data_nascimento);

    if ($resultado) {
        return [
            'sucesso' => true,
            'mensagem' => 'Cadastro realizado com sucesso!',
            'id' => $this->projetoModel->getLastInsertId()
        ];
    } else {
        return [
            'sucesso' => false,
            'mensagem' => 'Erro ao cadastrar usuário.'
        ];
    }
}
        // public function login($email, $senha)
        // {
        //     session_start();

        //     $usuario = $this->projetoModel->login($email);

        //     if (!$usuario) {
        //         $_SESSION['msg'] = "erro usuario";
        //         return;
        //     }

        //     if (!password_verify($senha, $usuario['senha'])) {
        //         $_SESSION['msg'] = "erro senha";
        //         return;
        //     }

        //     $_SESSION['usuario_id'] = $usuario['id'];
        //     $_SESSION['msg'] = "sucesso";
        //     header('Location: ../index.php');
        //     exit;
        // }
        public function login($email, $senha)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    // Call the method on the model, not on PDO
    $usuario = $this->projetoModel->login($email);

    if (!$usuario) {
        $_SESSION['msg'] = "erro usuario";
        return;
    }

    if (!password_verify($senha, $usuario['senha'])) {
        $_SESSION['msg'] = "erro senha";
        return;
    }

    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['msg'] = "sucesso";
    header('Location: ../index.php');
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
            $usuarioId = $_SESSION['usuario_id'];
            $email = $_POST['email'];
            $dataNascimento = $_POST['data_nascimento'];
            $sobreMim = $_POST['sobre_mim'];
            $senha = $_POST['senha'];

            $nomeArquivoFinal = null;
            if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
                $extensao = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
                $nomeArquivoFinal = uniqid('perfil_', true) . '.' . $extensao;
                $caminhoDestino = "../imagens/" . $nomeArquivoFinal;

                if (!file_exists('../imagens')) {
                    mkdir('../imagens', 0777, true);
                }

                if (!move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoDestino)) {
                    $nomeArquivoFinal = null;
                }
            }

            if (empty($senha)) {
                $senha = null;
            }

            $this->projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $sobreMim, $nomeArquivoFinal);

            $_SESSION['email'] = $email;
            $_SESSION['data_nascimento'] = $dataNascimento;
            $_SESSION['sobre_mim'] = $sobreMim;
            if ($nomeArquivoFinal) {
                $_SESSION['foto_perfil'] = $nomeArquivoFinal;
            }

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
            $_SESSION['email'] = $dados['email'];
            $_SESSION['data_nascimento'] = $dados['data_nascimento'];
            $_SESSION['foto_perfil'] = $dados['foto_perfil'] ?? 'padrao.png';
            $_SESSION['sobre_mim'] = $dados['sobre_mim'] ?? '';
        }

        include '../view/perfil.php';
    }

     public function adicionarPlanoAcao($area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (empty($_SESSION["usuario_id"])) {
            // Melhor redirecionar para login ou página de erro
            header("Location: login.php?msg=nao_autenticado");
            exit();
        }

        $usuario_id = $_SESSION["usuario_id"];

        $res = $this->projetoModel->adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);

        header("Location: plano_acao.php?msg=" . ($res ? "sucesso" : "erro"));
        exit();
    }

    public function atualizarPlanoAcao($id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (empty($_SESSION["usuario_id"])) {
            header("Location: login.php?msg=nao_autenticado");
            exit();
        }

        $usuario_id = $_SESSION["usuario_id"];

        $res = $this->projetoModel->atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);

        header("Location: plano_acao.php?msg=" . ($res ? "atualizado" : "erro_atualizar"));
        exit();
    }

public function buscarPlanoAcao()
{
    if (empty($_SESSION["usuario_id"])) {
        header("Location: login.php?msg=nao_autenticado");
        exit();
    }

    $usuarioId = $_SESSION['usuario_id'];

    // Call the method on the model, not on PDO directly
    return $this->projetoModel->buscarPlanoAcao($usuarioId);
}

    public function deletarPlanoAcao($id)
{
    if (empty($_SESSION["usuario_id"])) {
        header("Location: login.php?msg=nao_autenticado");
        exit();
    }

    $usuario_id = $_SESSION["usuario_id"];
    $res = $this->projetoModel->deletarPlanoAcao($id, $usuario_id);

    header("Location: plano_acao.php?msg=" . ($res ? "deletado" : "erro_deletar"));
    exit();
}

    // PROFISSÕES
    public function buscarProfissoes($filtro)
    {
        return $this->projetoModel->buscarProfissoes($filtro);
    }

    public function buscarPlanejamento($usuario_id)
    {
        return $this->projetoModel->buscarPorUsuario($usuario_id);
    }

    public function salvarPlanejamento($usuario_id, $dados)
    {
        return $this->projetoModel->salvarPlanejamento(
            $usuario_id,
            $dados['aprendendo'] ?? '',
            $dados['fazendo'] ?? '',
            $dados['preciso'] ?? '',
            $dados['meta_curto'] ?? '',
            $dados['meta_medio'] ?? '',
            $dados['meta_longo'] ?? ''
        );
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

        $respostasPorPergunta = [];
        foreach ($respostas as $resposta) {
            $respostasPorPergunta[$resposta['pergunta_id']][] = $resposta;
        }

        include '../view/teste_personalidade.php';
    }
}
