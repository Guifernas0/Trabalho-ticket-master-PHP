<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\Session;
use App\Core\Controller;

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function loginForm(): void
    {
        $mensagem = Session::getFlash('mensagem');
        $this->render('auth.login', compact('mensagem'));
    }

    public function login(): void
    {
        $mensagem = "";

        $email = $_POST['email'] ?? '';
        $senha = $_POST['password'] ?? '';

        $usuario = $this->userModel->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['password_hash'])) {
            Session::set('user_id', $usuario['id']);
            Session::set('usuario', $usuario['name']);
            $this->redirect('/movies');
        } else {
            $mensagem = "E-mail ou senha inválidos.";
            $this->render('auth.login', compact('mensagem'));
        }
    }

    public function registerForm(): void
    {
        $mensagem = Session::getFlash('mensagem');
        $this->render('auth.register', compact('mensagem'));
    }

    public function register(): void
    {
        $mensagem = "";

        $nome  = $_POST['name']     ?? '';
        $email = $_POST['email']    ?? '';
        $senha = $_POST['password'] ?? '';

        if ($this->userModel->buscarPorEmail($email)) {
            $mensagem = "Este e-mail já está cadastrado.";
        } else {
            $this->userModel->criarUsuario($nome, $email, $senha);
            $mensagem = "Usuário cadastrado com sucesso! Agora você já pode fazer login.";
        }

        $this->render('auth.register', compact('mensagem'));
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect('/login');
    }

    public function resetPasswordForm(): void
    {
        $mensagem = Session::getFlash('mensagem');
        $this->render('auth.reset-password', compact('mensagem'));
    }

    public function resetPasswordRequest(): void
    {
        $mensagem = "E-mail de recuperação enviado com sucesso!";
        $this->render('auth.reset-password', compact('mensagem'));
    }
}
