<?php

namespace Core;

class Router
{
    private array $routes = [];

    public function add(string $method, string $path, string $handler): self
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
        ];

        return $this;
    }

    public function get(string $path, string $handler): self
    {
        return $this->add('GET', $path, $handler);
    }

    public function post(string $path, string $handler): self
    {
        return $this->add('POST', $path, $handler);
    }

    public function put(string $path, string $handler): self
    {
        return $this->add('PUT', $path, $handler);
    }

    public function delete(string $path, string $handler): self
    {
        return $this->add('DELETE', $path, $handler);
    }

    public function dispatch(string $method = '', string $url = ''): void
    {
        $method = $method ?: $_SERVER['REQUEST_METHOD'];
        $url = $url ?: $_GET['url'] ?? '';

        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $method, $url)) {
                $this->callHandler($route['handler']);
                return;
            }
        }

        http_response_code(404);
        echo '404 - Rotta non trovata';
    }

    private function matchRoute(array $route, string $method, string $url): bool
    {
        if ($route['method'] !== $method) {
            return false;
        }

        return $route['path'] === $url;
    }

    private function callHandler(string $handler): void
    {
        [$controller, $method] = explode('@', $handler);

        $controllerFile = __DIR__ . "/../app/Controllers/{$controller}.php";

        if (!file_exists($controllerFile)) {
            http_response_code(500);
            die("Controller {$controller} non trovato");
        }

        require_once $controllerFile;

        $controllerClass = "App\\Controllers\\{$controller}";

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            die("Classe {$controllerClass} non trovata");
        }

        $instance = new $controllerClass();

        if (!method_exists($instance, $method)) {
            http_response_code(500);
            die("Metodo {$method} non trovato in {$controllerClass}");
        }

        call_user_func([$instance, $method]);
    }
}
