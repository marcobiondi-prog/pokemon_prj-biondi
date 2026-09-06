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

class UserController
{
    public function profile()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $user = getCurrentUser();
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $cognome = trim($_POST['cognome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $telefono = trim($_POST['telefono'] ?? '');

            if (empty($nome) || empty($cognome)) {
                $errors[] = 'Nome e cognome sono obbligatori';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email non valida';
            }

            if (empty($errors)) {
                // Aggiorna la sessione
                $_SESSION['user']['name'] = $nome;
                $_SESSION['user']['cognome'] = $cognome;
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['telefono'] = $telefono;

                $success = true;
                $user = getCurrentUser();
            }
        }

        // Inizializza i campi
        $nome = $user['name'] ?? '';
        $cognome = $user['cognome'] ?? '';
        $email = $user['email'] ?? '';
        $telefono = $user['telefono'] ?? '';

        include __DIR__ . '/../Views/user_profile.php';
    }

    public function changePassword()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $user = getCurrentUser();
        $errors = [];
        $success = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $current_password = $_POST['current_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
                $errors[] = 'Tutti i campi sono obbligatori';
            }

            if ($new_password !== $confirm_password) {
                $errors[] = 'Le nuove password non corrispondono';
            }

            if (strlen($new_password) < 6) {
                $errors[] = 'La password deve avere almeno 6 caratteri';
            }

            if (empty($errors)) {
                $success = true;
                $_SESSION['message'] = 'Password cambiata con successo';
            }
        }

        include __DIR__ . '/../Views/change_password.php';
    }
}
