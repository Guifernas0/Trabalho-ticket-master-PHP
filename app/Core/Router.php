<?php

namespace App\Core;

class Router
{
    private array $routes = [];

    public function get(string $path, string $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, string $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(string $method, string $uri): void
    {
        // Remove query string e normaliza a URI
        $uri = strtok($uri, '?');
        $uri = '/' . trim($uri, '/');
        if ($uri === '//') $uri = '/';

        foreach ($this->routes[$method] ?? [] as $route => $handler) {
            $pattern = preg_replace('/\{([a-zA-Z_]+)\}/', '(?P<$1>[^/]+)', $route);
            $pattern = "#^{$pattern}/?$#";

            if (preg_match($pattern, $uri, $matches)) {
                [$controllerName, $methodName] = explode('@', $handler);
                $controllerClass = "App\\Controllers\\{$controllerName}";

                if (!class_exists($controllerClass)) {
                    $this->abort(404);
                }

                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $controller = new $controllerClass();
                $controller->$methodName(...array_values($params));
                return;
            }
        }

        $this->abort(404);
    }

    private function abort(int $code): void
    {
        http_response_code($code);
        echo "<h1>Erro {$code} — Página não encontrada.</h1>";
        exit;
    }
}
