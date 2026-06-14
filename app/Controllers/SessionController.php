<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CinemaSession;

class SessionController extends Controller
{
    public function index(): void
    {
        $model   = new CinemaSession();
        $sessoes = $model->findAllWithMovie();
        $this->render('sessions.index', compact('sessoes'));
    }

    public function show(string $id): void
    {
        $model  = new CinemaSession();
        $sessao = $model->findByIdWithMovie((int) $id);

        if (!$sessao) {
            http_response_code(404);
            echo "<h1>Sessão não encontrada.</h1>";
            return;
        }

        $this->render('sessions.show', compact('sessao'));
    }
}
