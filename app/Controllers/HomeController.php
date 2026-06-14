<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Movie;

class HomeController extends Controller
{
    public function index(): void
    {
        $movieModel = new Movie();
        $destaques  = $movieModel->findAllOrdered();
        $destaques  = array_slice($destaques, 0, 6);
        $this->render('home.index', compact('destaques'));
    }

    public function about(): void
    {
        $this->render('home.about');
    }

    public function contact(): void
    {
        $mensagem   = '';
        $csrf_field = Csrf::field();
        $this->render('home.contact', compact('mensagem', 'csrf_field'));
    }

    public function contactSubmit(): void
    {
        Csrf::check();

        $nome    = trim($_POST['name']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $assunto = trim($_POST['subject'] ?? '');
        $texto   = trim($_POST['message'] ?? '');

        if ($nome && $email && $assunto && $texto) {
            $mensagem = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
        } else {
            $mensagem = "Por favor, preencha todos os campos.";
        }

        $csrf_field = Csrf::field();
        $this->render('home.contact', compact('mensagem', 'csrf_field'));
    }
}
