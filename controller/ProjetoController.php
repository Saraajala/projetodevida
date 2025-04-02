<?php
require_once 'C:/Turma2/xampp/htdocs/projetodevida/model/ProjetoModel.php';
session_start();

class ProjetoController {
    private $projetoModel;

    public function __construct($pdo) {
        $this->projetoModel = new ProjetoModel($pdo);
    }

    public function cadastrar($nome, $email, $data_nascimento, $senha) {
        $resultado = $this->projetoModel->cadastrar($nome, $email, $data_nascimento, $senha);
        if ($resultado) {
            echo "Usuário cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar usuário!";
        }
    }

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

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ../login.php");
        exit();
    }

    public function esqueciSenha($email) {
        $token = $this->projetoModel->gerarTokenRedefinicao($email);
        if ($token) {
            $link = "http://seusite.com/redefinir_senha.php?token=" . $token;
            mail($email, "Redefinição de Senha", "Clique no link para redefinir sua senha: " . $link);
            echo "E-mail de recuperação enviado!";
        } else {
            echo "Erro ao processar recuperação de senha.";
        }
    }

    public function redefinirSenha($token, $novaSenha) {
        $resultado = $this->projetoModel->redefinirSenha($token, $novaSenha);
        if ($resultado) {
            echo "Senha redefinida com sucesso!";
        } else {
            echo "Erro ao redefinir senha!";
        }
    }
}

?>