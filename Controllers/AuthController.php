<?php

namespace App\Controllers;

class AuthController
{
    private array $users = [
        [
            'id' => 1,
            'email' => 'user@example.com',
            'password' => '123456',
            'name' => 'Mario',
            'cognome' => 'Rossi',
            'telefono' => ''
        ],
        [
            'id' => 2,
            'email' => 'test@test.com',
            'password' => 'test123',
            'name' => 'Test',
            'cognome' => 'User',
            'telefono' => ''
        ]
    ];

    private string $usersFile;

    public function __construct()
    {
        $this->usersFile = __DIR__ . '/../users.json';
        $this->loadUsers();
    }

    private function loadUsers()
    {
        if (file_exists($this->usersFile)) {
            $data = json_decode(file_get_contents($this->usersFile), true);
            if (is_array($data)) {
                $this->users = array_merge($this->users, $data);
            }
        }
    }

    private function saveUsers()
    {
        // Salva solo gli utenti custom (non i default)
        $customUsers = array_slice($this->users, 2);
        file_put_contents($this->usersFile, json_encode($customUsers, JSON_PRETTY_PRINT));
    }

    public function showLogin()
    {
        if (isLoggedIn()) {
            header('Location: ?url=');
            exit;
        }

        $error = '';
        include __DIR__ . '/../Views/login.php';
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $error = '';

        // Validazione
        if (empty($email) || empty($password)) {
            $error = 'Inserisci email e password';
            include __DIR__ . '/../Views/login.php';
            return;
        }

        // Valida email inline
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error = 'Email non valida';
            include __DIR__ . '/../Views/login.php';
            return;
        }

        // Cerca utente nei dati di test
        foreach ($this->users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                // Verifica password (senza hashing per test)
                if ($user['password'] === $password) {
                    // Login riuscito
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'name' => $user['name'],
                        'cognome' => $user['cognome'],
                        'email' => $user['email'],
                        'telefono' => $user['telefono']
                    ];

                    header('Location: ?url=');
                    exit;
                } else {
                    $error = 'Email o password non corretti';
                    include __DIR__ . '/../Views/login.php';
                    return;
                }
            }
        }

        // Email non trovata
        $error = 'Email o password non corretti';
        include __DIR__ . '/../Views/login.php';
    }

    public function showRegister()
    {
        if (isLoggedIn()) {
            header('Location: ?url=');
            exit;
        }

        $error = '';
        include __DIR__ . '/../Views/register.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ?url=register');
            exit;
        }

        $nome = trim($_POST['nome'] ?? '');
        $cognome = trim($_POST['cognome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $password = $_POST['password'] ?? '';
        $conferma_password = $_POST['conferma_password'] ?? '';

        $error = '';

        // Validazioni
        if (empty($nome) || empty($cognome)) {
            $error = 'missing_name';
            include __DIR__ . '/../Views/register.php';
            return;
        }

        if (empty($email)) {
            $error = 'email_required';
            include __DIR__ . '/../Views/register.php';
            return;
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $error = 'email_invalid';
            include __DIR__ . '/../Views/register.php';
            return;
        }

        // Controllo email duplicata
        foreach ($this->users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                $error = 'email_exists';
                include __DIR__ . '/../Views/register.php';
                return;
            }
        }

        if (empty($password)) {
            $error = 'password_required';
            include __DIR__ . '/../Views/register.php';
            return;
        }

        if ($password !== $conferma_password) {
            $error = 'password_mismatch';
            include __DIR__ . '/../Views/register.php';
            return;
        }

        // Registrazione riuscita - salva nuovo utente
        $newUser = [
            'id' => count($this->users) + 1,
            'email' => $email,
            'password' => $password,
            'name' => $nome,
            'cognome' => $cognome,
            'telefono' => $telefono
        ];

        $this->users[] = $newUser;
        $this->saveUsers();

        // Login automatico
        $_SESSION['user_id'] = $newUser['id'];
        $_SESSION['user'] = [
            'id' => $newUser['id'],
            'name' => $newUser['name'],
            'cognome' => $newUser['cognome'],
            'email' => $newUser['email'],
            'telefono' => $newUser['telefono']
        ];

        // Reindirizza al dashboard con messaggio di successo
        header('Location: ?url=');
        exit;
    }

    public function logout()
    {
        session_destroy();
        header('Location: ?url=login');
        exit;
    }
}
