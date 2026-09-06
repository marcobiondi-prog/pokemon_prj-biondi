<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Challenge;

class DashboardController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $challengeModel = new Challenge();
        $challenges = $challengeModel->all();

        $this->render('dashboard.index', [
            'user_email' => $_SESSION['email'] ?? 'User',
            'challenges' => $challenges,
        ]);
    }
}
