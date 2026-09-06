<?php

namespace App\Controllers;

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function getCurrentUser()
{
    return $_SESSION['user'] ?? null;
}

class ChallengeController
{
    public function create()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $user = getCurrentUser();
        include __DIR__ . '/../Views/create_challenge.php';
    }

    public function store()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $title = $_POST['title'] ?? '';
        $description = $_POST['description'] ?? '';

        if (empty($title) || empty($description)) {
            $_SESSION['error'] = 'Tutti i campi sono obbligatori';
            header('Location: /pokemon/lan_challenge-/public/?url=challenges/create');
            exit;
        }

        $_SESSION['success'] = 'Challenge creata con successo!';
        header('Location: /pokemon/lan_challenge-/public/');
        exit;
    }

    public function accept()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $_SESSION['success'] = 'Challenge accettata!';
        header('Location: /pokemon/lan_challenge-/public/');
        exit;
    }
}
