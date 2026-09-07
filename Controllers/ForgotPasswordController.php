<?php

namespace App\Controllers;

class ForgotPasswordController
{
    public function show()
    {
        $message = '';
        include __DIR__ . '/../Views/forgot_password.php';
    }

    public function handleRequest()
    {
        $email = trim($_POST['email'] ?? '');
        $message = '';
        $success = false;

        if (empty($email)) {
            $message = 'Email obbligatoria';
            include __DIR__ . '/../Views/forgot_password.php';
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = 'Email non valida';
            include __DIR__ . '/../Views/forgot_password.php';
            return;
        }

        // Simula invio email (in produzione: inviare email reale)
        $success = true;
        $message = 'Se l\'email è registrata, riceverai le istruzioni per resettare la password';

        include __DIR__ . '/../Views/forgot_password.php';
    }
}
