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
                'mensagem' => 'Usuário cadastrado com sucesso!'
            ];
        } else {
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
            $usuarioId = $_SESSION['usuario_id'];
            $email = $_POST['email'] ?? '';
            $dataNascimento = $_POST['data_nascimento'] ?? '';
            $sobreMim = $_POST['sobre_mim'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $fotoPerfil = null;

            if (!empty($_FILES['fotoPerfil']['name']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
                $ext = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);
                $nomeArquivo = uniqid() . '.' . $ext;
                $caminho = 'assets/img/perfis/' . $nomeArquivo;

                if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminho)) {
                    $fotoPerfil = $nomeArquivo;
                }
            }

            $this->projetoModel->atualizarPerfil($usuarioId, $email, $senha, $dataNascimento, $fotoPerfil, $sobreMim);
            header("Location: /usuario/perfil");
        }
    }

    // PROFISSÕES
    public function buscarProfissoes($termo)
    {
        return $this->projetoModel->buscarProfissoes($termo);
    }

    // PLANO DE AÇÃO
    public function adicionarPlanoAcao($area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
        $usuario_id = $_SESSION["usuario_id"];
        $res = $this->projetoModel->adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
        echo $res ? "Plano de ação adicionado com sucesso!" : "Erro ao adicionar plano!";
    }

    public function atualizarPlanoAcao($id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo)
    {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
        $usuario_id = $_SESSION["usuario_id"];
        $res = $this->projetoModel->atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
        echo $res ? "Plano de ação atualizado com sucesso!" : "Erro ao atualizar plano!";
    }

    public function exibirPlanoAcao()
    {
        if (!isset($_SESSION["usuario_id"])) {
            return [];
        }
        return $this->projetoModel->buscarPlanoAcao($_SESSION["usuario_id"]);
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
    public function buscarResultadosTeste($usuario_id)
    {
        return $this->projetoModel->buscarResultadosTeste($usuario_id);
    }
}
