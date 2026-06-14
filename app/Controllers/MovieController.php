<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;
use App\Models\Movie;
use App\Models\Review;
use App\Models\CinemaSession;

class MovieController extends Controller
{
    public function index(): void
    {
        $movieModel = new Movie();
        $busca      = trim($_GET['busca'] ?? '');

        $filmes = $busca
            ? $movieModel->search($busca)
            : $movieModel->findAllOrdered();

        $this->render('movies.index', compact('filmes', 'busca'));
    }

    public function show(string $id): void
    {
        $movieModel   = new Movie();
        $reviewModel  = new Review();
        $sessionModel = new CinemaSession();

        $filme = $movieModel->findById((int) $id);

        if (!$filme) {
            http_response_code(404);
            echo "<h1>Filme não encontrado.</h1>";
            return;
        }

        $avaliacoes = $reviewModel->findByMovie((int) $id);
        $media      = $reviewModel->averageByMovie((int) $id);
        $sessoes    = $sessionModel->findByMovie((int) $id);
        $csrf_field = Csrf::field();

        $this->render('movies.show', compact('filme', 'avaliacoes', 'media', 'sessoes', 'csrf_field'));
    }
}
