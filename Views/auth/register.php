<?php $title = 'Register'; require __DIR__ . '/../layouts/header.php'; ?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Registrazione</h2>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/pokemon/lan_challenge-/register" class="form">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirm">Conferma Password</label>
                <input type="password" id="password_confirm" name="password_confirm" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Registrati</button>
        </form>

        <p class="mt-3">
            Hai già un account? <a href="/pokemon/lan_challenge-/login">Accedi</a>
        </p>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
