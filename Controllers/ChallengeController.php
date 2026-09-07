<?php

namespace App\Controllers;

class ChallengeController
{
    public function create()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $user = getCurrentUser();
        $opponents = getOtherUsers((int) $user['id']);
        include __DIR__ . '/../Views/create_challenge.php';
    }

    public function store()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $user = getCurrentUser();
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $challengedId = (int) ($_POST['challenged_id'] ?? 0);

        if (empty($title) || empty($description) || !$challengedId || !findUserById($challengedId)) {
            $_SESSION['error'] = 'Tutti i campi sono obbligatori';
            header('Location: ?url=challenges/create');
            exit;
        }

        saveChallenge([
            'title' => $title,
            'description' => $description,
            'challenger_id' => (int) $user['id'],
            'challenged_id' => $challengedId,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $_SESSION['success'] = 'Challenge creata con successo!';
        header('Location: ?url=');
        exit;
    }

    public function accept()
    {
        if (!isLoggedIn()) {
            header('Location: ?url=login');
            exit;
        }

        $user = getCurrentUser();
        $challengeId = (int) ($_POST['challenge_id'] ?? 0);
        $challenge = findChallengeById($challengeId);

        if (!$challenge || (int) $challenge['challenged_id'] !== (int) $user['id'] || $challenge['status'] !== 'pending') {
            $_SESSION['error'] = 'Impossibile accettare questa challenge';
            header('Location: ?url=');
            exit;
        }

        updateChallenge($challengeId, ['status' => 'accepted']);

        $_SESSION['success'] = 'Challenge accettata!';
        header('Location: ?url=');
        exit;
    }
}
