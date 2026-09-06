<?php

namespace App\Controllers;

class ChallengeController
{
    public function create()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $user = getCurrentUser();
        include __DIR__ . '/../Views/create_challenge.php';
    }

    public function store()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if (empty($title) || empty($description)) {
            $_SESSION['error'] = 'Tutti i campi sono obbligatori';
            header('Location: ?url=challenges/create');
            exit;
        }

        $_SESSION['success'] = 'Challenge creata con successo!';
        header('Location: ?url=');
        exit;
    }

    public function accept()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $_SESSION['success'] = 'Challenge accettata!';
        header('Location: ?url=');
        exit;
    }
}
