<?php

namespace App\Core;

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../../app/Views/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewPath)) {
            die("View file not found: {$viewPath}");
        }

        require $viewPath;
    }

    protected function redirect(string $path): void
    {
        header("Location: /pokemon/lan_challenge-{$path}");
        exit;
    }

    protected function json(array $data, int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function abort(int $statusCode, string $message = ''): void
    {
        http_response_code($statusCode);
        die($message ?: "Error {$statusCode}");
    }
}
