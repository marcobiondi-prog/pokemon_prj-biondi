<?php

namespace App\Controllers;

use App\Core\Controller;

class AuthController extends Controller
{
    public function loginForm(): void
    {
        $this->render('auth.login');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $this->render('auth.login', ['error' => 'Email e password sono obbligatori']);
            return;
        }

        // TODO: Validare le credenziali usando il Model User
        $_SESSION['user_id'] = 1;
        $_SESSION['email'] = $email;

        $this->redirect('/dashboard');
    }

    public function registerForm(): void
    {
        $this->render('auth.register');
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if (empty($email) || empty($password) || empty($password_confirm)) {
            $this->render('auth.register', ['error' => 'Tutti i campi sono obbligatori']);
            return;
        }

        if ($password !== $password_confirm) {
            $this->render('auth.register', ['error' => 'Le password non corrispondono']);
            return;
        }

        // TODO: Creare il nuovo utente usando il Model User
        $_SESSION['user_id'] = 2;
        $_SESSION['email'] = $email;

        $this->redirect('/dashboard');
    }

    public function logout(): void
    {
        session_destroy();
        $this->redirect('/login');
    }
}
