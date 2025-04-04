<?php
require_once 'C:/Turma2/xampp/htdocs/projetodevida/model/ProjetoModel.php';
session_start();

class ProjetoController {
    private $projetoModel;

    public function __construct($pdo) {
        $this->projetoModel = new ProjetoModel($pdo);
    }

    // Cadastro de usuário
    public function cadastrar($nome, $email, $data_nascimento, $senha) {
        $resultado = $this->projetoModel->cadastrar($nome, $email, $data_nascimento, $senha);
        echo $resultado ? "Usuário cadastrado com sucesso!" : "Erro ao cadastrar usuário!";
    }

    // Login de usuário
    public function login($email, $senha) {
        $usuario = $this->projetoModel->login($email, $senha);
        if ($usuario) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["nome"] = $usuario["nome"];
            header("Location: ../index.php");
            exit();
        } else {
            echo "Login inválido!";
        }
    }

    // Logout
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        exit();
    }

    // Redefinição de senha
    public function redefinirSenhaDireta() {
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
                $novaSenhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);
                $resultado = $this->projetoModel->atualizarSenha($email, $novaSenhaCriptografada);
                header("Location: ../login.php?msg=" . ($resultado ? "senha_redefinida" : "erro_redefinir"));
                exit();
            } else {
                header("Location: ../esqueci_senha.php?msg=email_nao_encontrado");
                exit();
            }
        }
    }

    // Exibir e atualizar perfil
    public function exibirPerfil($usuario_id) {
        return $this->projetoModel->buscarPerfil($usuario_id);
    }

    public function atualizarPerfil($usuario_id, $email, $senha, $data_nascimento, $foto_perfil, $sobre_mim) {
        $resultado = $this->projetoModel->atualizarPerfil($usuario_id, $email, $senha, $data_nascimento, $foto_perfil, $sobre_mim);
        echo $resultado ? "Perfil atualizado com sucesso!" : "Erro ao atualizar perfil.";
    }

    // Testes e gráficos
    public function buscarPerguntasTeste() {
        return $this->projetoModel->buscarPerguntasTeste();
    }

    public function salvarRespostasTeste($usuario_id, $respostas) {
        $resultado = $this->projetoModel->salvarRespostasTeste($usuario_id, $respostas);
        echo $resultado ? "Respostas salvas com sucesso!" : "Erro ao salvar respostas.";
    }

    public function gerarGraficoResultados($usuario_id) {
        $resultados = $this->projetoModel->buscarResultadosTeste($usuario_id);
        echo json_encode($resultados);
    }

    // Buscar profissões
    public function buscarProfissoes($termo) {
        return $this->projetoModel->buscarProfissoes($termo);
    }

    // Plano de ação
    public function adicionarPlanoAcao($area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo) {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
        
        $usuario_id = $_SESSION["usuario_id"];
        $resultado = $this->projetoModel->adicionarPlanoAcao($usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
        echo $resultado ? "Plano de ação adicionado com sucesso!" : "Erro ao adicionar plano!";
    }

    public function atualizarPlanoAcao($id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo) {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return;
        }
        
        $usuario_id = $_SESSION["usuario_id"];
        $resultado = $this->projetoModel->atualizarPlanoAcao($id, $usuario_id, $area, $passo1, $passo2, $passo3, $como_irei_fazer, $prazo);
        echo $resultado ? "Plano de ação atualizado com sucesso!" : "Erro ao atualizar plano!";
    }

    public function exibirPlanoAcao() {
        if (!isset($_SESSION["usuario_id"])) {
            echo "Usuário não autenticado!";
            return [];
        }
        
        $usuario_id = $_SESSION["usuario_id"];
        return $this->projetoModel->buscarPlanoAcao($usuario_id);
    }

    // Feedback
    public function salvarFeedback() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $opiniao = $_POST['opiniao'];
    
            $this->projetoModel->inserirFeedback($email, $opiniao);
            header("Location: ../index.php?msg=feedback_enviado");
            exit();
        }
    }
}
