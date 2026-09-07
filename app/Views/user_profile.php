<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Il Mio Account - Challenge App</title>
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
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
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
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>

    <script src="/pokemon/lan_challenge-/assets/js/user-menu.js?v=2"></script>
</body>
</html>
