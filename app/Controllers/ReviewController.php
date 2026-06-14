<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Review;
use App\Models\Movie;

class ReviewController extends Controller
{
    public function form(string $movieId): void
    {
        $this->requireAuth();

        $movieModel = new Movie();
        $filme      = $movieModel->findById((int) $movieId);

        if (!$filme) {
            $this->redirect('/movies');
        }

        $csrf_field = Csrf::field();
        $this->render('reviews.form', compact('filme', 'csrf_field'));
    }

    public function store(): void
    {
        $this->requireAuth();
        Csrf::check();

        $userId  = Session::get('user_id');
        $movieId = (int) ($_POST['movie_id'] ?? 0);
        $rating  = (int) ($_POST['rating']   ?? 3);
        $comment = trim($_POST['comment']    ?? '');

        $model = new Review();
        $model->store($userId, $movieId, $rating, $comment);

        $this->redirect("/movies/{$movieId}");
    }

    public function delete(string $id): void
    {
        $this->requireAuth();
        Csrf::check();

        $userId = Session::get('user_id');
        $model  = new Review();

        $review = $model->findById((int) $id);

        if ($review && $model->belongsToUser((int) $id, $userId)) {
            $model->delete((int) $id);
            $this->redirect("/movies/{$review['movie_id']}");
        } else {
            $this->redirect('/movies');
        }
    }
}
