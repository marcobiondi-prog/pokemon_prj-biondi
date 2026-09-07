<?php

namespace App\Controllers;

class DashboardController
{
    public function index()
    {
        if (!isLoggedIn()) {
            header('Location: /pokemon/lan_challenge-/public/?url=login');
            exit;
        }

        $user = getCurrentUser();
        $challenges = getChallengesByUser((int) $user['id']);

        include __DIR__ . '/../Views/dashboard.php';
    }
}
