<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambia Password - Challenge App</title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/assets/css/style.css?v=8">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/pokemon/lan_challenge-/public/"><img src="/pokemon/lan_challenge-/assets/img/logo.png?v=1" alt="Challenge App" class="navbar-brand"></a>
            <div class="user-menu">
                <button type="button" class="user-menu-toggle">
                    <span class="user-avatar"><?php echo htmlspecialchars(strtoupper(substr($user['name'] ?? 'U', 0, 1))); ?></span>
                    <?php echo htmlspecialchars($user['name'] ?? 'Utente'); ?>
                    <svg class="caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div class="user-menu-dropdown">
                    <a href="/pokemon/lan_challenge-/public/" class="user-menu-item">
                        <span class="user-menu-item-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0-8-8"></path><path d="M12 12 8 10"></path><path d="M12 12V6"></path></svg>
                        </span>
                        Dashboard
                    </a>
                    <a href="/pokemon/lan_challenge-/public/?url=challenges/create" class="user-menu-item">
                        <span class="user-menu-item-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
                        </span>
                        Crea Challenge
                    </a>
                    <a href="/pokemon/lan_challenge-/public/?url=user/profile" class="user-menu-item">
                        <span class="user-menu-item-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </span>
                        Il Mio Profilo
                    </a>
                    <div class="user-menu-divider"></div>
                    <a href="/pokemon/lan_challenge-/public/?url=logout" class="user-menu-item logout">
                        <span class="user-menu-item-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        </span>
                        Esci
                    </a>
                </div>
            </div>
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

    <script src="/pokemon/lan_challenge-/assets/js/user-menu.js?v=2"></script>
</body>
</html>
