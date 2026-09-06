<?php

namespace App\Models;

use Core\Database;

class Challenge
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function create(int $challengerId, int $challengedId, string $title): bool
    {
        $stmt = $this->db->query(
            "INSERT INTO challenges (challenger_id, challenged_id, title) VALUES (?, ?, ?)",
            [$challengerId, $challengedId, $title]
        );

        return $stmt->rowCount() > 0;
    }

    public function resolveChallenge(int $challengeId, int $currentUserId): bool
    {
        // Verifica che la sfida esista, sia pending e che l'utente loggato sia lo sfidato
        $stmt = $this->db->query(
            "SELECT * FROM challenges WHERE id = ? AND challenged_id = ? AND status = 'pending'",
            [$challengeId, $currentUserId]
        );

        $challenge = $stmt->fetch();
        if (!$challenge) {
            return false;
        }

        // Calcolo Randomico dell'esito
        $scoreChallenger = random_int(1, 100);
        $scoreChallenged = random_int(1, 100);
        $winnerId = null;
        $isDraw = 0;

        if ($scoreChallenger > $scoreChallenged) {
            $winnerId = $challenge['challenger_id'];
        } elseif ($scoreChallenged > $scoreChallenger) {
            $winnerId = $challenge['challenged_id'];
        } else {
            $isDraw = 1; // Pareggio
        }

        // Aggiornamento atomico dello stato della sfida
        $update = $this->db->query(
            "UPDATE challenges SET status = 'completed', winner_id = ?, is_draw = ?, challenger_score = ?, challenged_score = ? WHERE id = ?",
            [$winnerId, $isDraw, $scoreChallenger, $scoreChallenged, $challengeId]
        );

        return $update->rowCount() > 0;
    }

    public function getAllWithUsers(): array
    {
        $sql = "SELECT c.*, u1.username AS challenger_name, u2.username AS challenged_name, u3.username AS winner_name
                FROM challenges c
                JOIN users u1 ON c.challenger_id = u1.id
                JOIN users u2 ON c.challenged_id = u2.id
                LEFT JOIN users u3 ON c.winner_id = u3.id
                ORDER BY c.created_at DESC";

        return $this->db->query($sql)->fetchAll();
    }
}
