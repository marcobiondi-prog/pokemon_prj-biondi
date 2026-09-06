<?php $title = 'Crea Challenge'; require __DIR__ . '/../layouts/header.php'; ?>

<div class="challenge-form">
    <h2>Crea una Nuova Challenge</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/pokemon/lan_challenge-/challenge/create" class="form">
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" id="title" name="title" required class="form-control">
        </div>

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea id="description" name="description" required class="form-control" rows="6"></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Crea Challenge</button>
            <a href="/pokemon/lan_challenge-/dashboard" class="btn btn-secondary">Annulla</a>
        </div>
    </form>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
