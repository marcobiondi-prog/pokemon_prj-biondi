<?php $title = 'Password Dimenticata - Challenge App'; require __DIR__ . '/layouts/header.php'; ?>
        <div class="auth-container">
            <div class="auth-card">
                <h2>Password Dimenticata</h2>
                <p style="color: #666; margin-bottom: 30px;">Inserisci la tua email per ricevere le istruzioni di reset</p>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        ✓ <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($message) && !$success): ?>
                    <div class="alert alert-danger">
                        ⚠️ <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/pokemon/lan_challenge-/public/?url=forgot-password" class="form">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-control" placeholder="Inserisci la tua email">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 20px;">Invia Istruzioni</button>
                </form>

                <p style="text-align: center; margin-top: 20px;">
                    Ti ricordi la password? <a href="/pokemon/lan_challenge-/public/?url=login">Accedi</a>
                </p>
            </div>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
