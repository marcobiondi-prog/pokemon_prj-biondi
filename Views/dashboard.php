<?php $title = 'Dashboard - Challenge App'; require __DIR__ . '/layouts/header.php'; ?>
        <div class="dashboard">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    echo htmlspecialchars($_SESSION['success']);
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php
                    echo htmlspecialchars($_SESSION['error']);
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <h2>Benvenuto, <?php echo htmlspecialchars($user['name'] ?? 'Utente'); ?>!</h2>

            <div class="dashboard-actions">
                <a href="/pokemon/lan_challenge-/public/?url=challenges/create" class="btn btn-primary">
                    + Crea Nuova Challenge
                </a>
            </div>

            <h3>Le Tue Challenge</h3>

            <?php if (empty($challenges)): ?>
                <div class="alert alert-info">
                    <p>Non hai ancora creato nessuna challenge.</p>
                    <p><a href="/pokemon/lan_challenge-/public/?url=challenges/create">Creane una ora</a></p>
                </div>
            <?php else: ?>
                <div class="challenges-grid">
                    <?php foreach ($challenges as $challenge): ?>
                        <div class="challenge-card">
                            <h4><?php echo htmlspecialchars($challenge['title']); ?></h4>
                            <p><?php echo htmlspecialchars($challenge['description']); ?></p>
                            <p class="challenge-date">Creato il: <?php echo htmlspecialchars(explode(' ', $challenge['created_at'])[0]); ?></p>
                            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                <a href="#" class="btn btn-secondary">Visualizza</a>
                                <form method="POST" action="?url=challenges/delete" onsubmit="return confirm('Eliminare questa challenge?');">
                                    <input type="hidden" name="challenge_id" value="<?php echo (int) $challenge['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Elimina</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
