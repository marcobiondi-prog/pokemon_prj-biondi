<?php

// Funzioni di utilità per autenticazione

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function getCurrentUser()
{
    return $_SESSION['user'] ?? null;
}

function login(string $email, string $password): bool
{
    // Dati di test (senza database)
    $users = [
        [
            'id' => 1,
            'email' => 'user@example.com',
            'password' => '123456', // In produzione: password_hash()
            'name' => 'Mario Rossi'
        ],
        [
            'id' => 2,
            'email' => 'test@test.com',
            'password' => 'test123',
            'name' => 'Test User'
        ]
    ];

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name']
            ];
            return true;
        }
    }

    return false;
}

function logout(): void
{
    session_destroy();
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /pokemon/lan_challenge-/public/?url=login');
        exit;
    }
}

function redirectToDashboard(): void
{
    header('Location: /pokemon/lan_challenge-/public/');
    exit;
}

function redirectToLogin(): void
{
    header('Location: /pokemon/lan_challenge-/public/?url=login');
    exit;
}
