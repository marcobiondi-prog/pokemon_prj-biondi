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

function validateEmail(string $email): bool
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
