<?php

class LoginController
{
    public function showLoginForm()
    {
        include 'view/auth/login.php';
    }

    public function authenticate($login, $senha)
    {
        $usuario = new Usuario();
        $usuario = $usuario->getOneByCpf($login);

        if(! isset($usuario['id'])) {
            die('Usuário/senha incorreto [1]');
        }

        if(! password_verify($senha, $usuario['senha'])) {
            die('Usuário/senha incorreto [2]');
        }

        session_start();
        $_SESSION['usuario'] = $usuario;

        header('Location: ?rota=usuario.index');

    }

    public function logout()
    {
        session_destroy();
        header('Location: ?rota=login');

    }
}
