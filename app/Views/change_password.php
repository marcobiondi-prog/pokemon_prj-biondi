<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia Password - Challenge App</title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/public/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="navbar-brand">Challenge App</h1>
            <ul class="nav-menu">
                <li><a href="/pokemon/lan_challenge-/public/">Dashboard</a></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=user/profile">Profilo</a></li>
                <li><strong><?php echo htmlspecialchars($user['name'] ?? 'Utente'); ?></strong></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=logout">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <div class="profile-container" style="max-width: 600px; margin: 40px auto;">
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
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
