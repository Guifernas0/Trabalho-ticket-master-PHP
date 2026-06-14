<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        $viewPath = ROOT . '/app/Views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            die("View não encontrada: {$view}");
        }

        require ROOT . '/app/Views/layouts/header.php';
        require $viewPath;
        require ROOT . '/app/Views/layouts/footer.php';
    }

    protected function redirect(string $path): void
    {
        $url = (str_starts_with($path, 'http') ? $path : BASE_URL . $path);
        header("Location: {$url}");
        exit;
    }

    protected function isAuthenticated(): bool
    {
        return Session::has('user_id');
    }

    protected function requireAuth(): void
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }
    }
}