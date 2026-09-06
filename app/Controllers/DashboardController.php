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
        $challenges = [
            [
                'id' => 1,
                'title' => 'Challenge di Esempio',
                'description' => 'Questa è una challenge di esempio per mostrarti come funziona l\'applicazione.',
                'created_at' => '2026-09-06'
            ],
            [
                'id' => 2,
                'title' => 'Un\'altra Challenge',
                'description' => 'Ecco un\'altra challenge di esempio per mostrati l\'interfaccia.',
                'created_at' => '2026-09-05'
            ]
        ];

        include __DIR__ . '/../Views/dashboard.php';
    }
}
