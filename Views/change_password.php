<?php $title = 'Cambia Password - Challenge App'; $hideNavUserMenu = true; require __DIR__ . '/layouts/header.php'; ?>
        <div class="profile-container" style="max-width: 600px; margin: 0 auto;">
            <div class="dex-topbar">
                <div class="dex-tab dex-tab-user">
                    <?php include __DIR__ . '/layouts/account-tab.php'; ?>
                </div>
            </div>

            <h2>Cambia Password</h2>
            <p style="color: #666; margin-bottom: 30px;">Aggiorna la tua password di accesso</p>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    ✓ Password cambiata con successo!
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div>• <?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/pokemon/lan_challenge-/public/?url=user/change-password" class="form">
                <div class="form-group">
                    <label for="current_password">Password Attuale *</label>
                    <input type="password" id="current_password" name="current_password" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="new_password">Nuova Password *</label>
                    <input type="password" id="new_password" name="new_password" required class="form-control">
                    <small style="color: #666; display: block; margin-top: 5px;">
                        Minimo 6 caratteri
                    </small>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Conferma Nuova Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Cambia Password</button>
                <a href="/pokemon/lan_challenge-/public/?url=user/profile" class="btn btn-secondary" style="width: 100%; margin-top: 10px; text-align: center; display: inline-block;">
                    Torna al Profilo
                </a>
            </form>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
