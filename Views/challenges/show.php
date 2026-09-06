<?php $title = 'Challenge'; require __DIR__ . '/../layouts/header.php'; ?>

<div class="challenge-detail">
    <div class="challenge-header">
        <h2><?php echo htmlspecialchars($challenge['title']); ?></h2>
        <p class="challenge-meta">
            Creato il: <?php echo htmlspecialchars($challenge['created_at']); ?>
        </p>
    </div>

    <div class="challenge-body">
        <p><?php echo htmlspecialchars($challenge['description']); ?></p>
    </div>

    <div class="challenge-actions">
        <a href="/pokemon/lan_challenge-/dashboard" class="btn btn-secondary">Torna al Dashboard</a>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
