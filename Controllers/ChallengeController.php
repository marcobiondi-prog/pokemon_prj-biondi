<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Challenge;

class ChallengeController extends Controller
{
    public function create(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($title) || empty($description)) {
                $this->render('challenges.create', ['error' => 'Tutti i campi sono obbligatori']);
                return;
            }

            $challengeModel = new Challenge();
            $challengeModel->create([
                'title' => $title,
                'description' => $description,
                'user_id' => $_SESSION['user_id'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $this->redirect('/dashboard');
        }

        $this->render('challenges.create');
    }

    public function show(string $id): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/login');
        }

        $challengeModel = new Challenge();
        $challenge = $challengeModel->find((int) $id);

        if (!$challenge) {
            $this->abort(404, 'Challenge not found');
        }

        $this->render('challenges.show', ['challenge' => $challenge]);
    }
}
