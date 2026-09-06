<?php $title = 'Dashboard'; require __DIR__ . '/../layouts/header.php'; ?>

<div class="dashboard">
    <h2>Benvenuto, <?php echo htmlspecialchars($user_email); ?></h2>

    <div class="dashboard-actions">
        <a href="/pokemon/lan_challenge-/challenge/create" class="btn btn-primary">Crea Nuova Challenge</a>
    </div>

    <h3>Le Tue Challenge</h3>

    <?php if (empty($challenges)): ?>
        <div class="alert alert-info">
            Non hai ancora creato nessuna challenge. <a href="/pokemon/lan_challenge-/challenge/create">Creane una</a>
        </div>
    <?php else: ?>
        <div class="challenges-grid">
            <?php foreach ($challenges as $challenge): ?>
                <div class="challenge-card">
                    <h4><?php echo htmlspecialchars($challenge['title']); ?></h4>
                    <p><?php echo htmlspecialchars(substr($challenge['description'], 0, 100)) . '...'; ?></p>
                    <p class="challenge-date"><?php echo htmlspecialchars($challenge['created_at']); ?></p>
                    <a href="/pokemon/lan_challenge-/challenge/<?php echo $challenge['id']; ?>" class="btn btn-secondary">Visualizza</a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
