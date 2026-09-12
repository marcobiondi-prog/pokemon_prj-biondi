<?php $title = 'Il Mio Account - Challenge App'; require __DIR__ . '/layouts/header.php'; ?>
        <div class="profile-container" style="max-width: 600px; margin: 0 auto;">
            <h2>Il Mio Account</h2>
            <p style="color: #666; margin-bottom: 30px;">Gestisci i tuoi dati personali</p>

            <?php if ($success): ?>
                <div class="alert alert-success">
                    ✓ Dati aggiornati con successo!
                </div>
            <?php endif; ?>

            <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div>• <?php echo htmlspecialchars($error); ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="/pokemon/lan_challenge-/public/?url=user/profile" class="form">
                <div class="form-row-2">
                    <div class="form-group">
                        <label for="nome">Nome *</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome *</label>
                        <input type="text" id="cognome" name="cognome" value="<?php echo htmlspecialchars($cognome); ?>" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 20px;">Salva Modifiche</button>
            </form>

            <hr style="margin: 40px 0;">

            <div style="margin-top: 30px;">
                <h3>Sicurezza</h3>
                <p style="color: #666; margin-bottom: 20px;">Gestisci la tua password</p>
                <a href="/pokemon/lan_challenge-/public/?url=user/change-password" class="btn btn-secondary" style="width: 100%;">
                    Cambia Password
                </a>
            </div>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
