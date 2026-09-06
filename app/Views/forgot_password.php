<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Dimenticata - Challenge App</title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/public/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="navbar-brand">Challenge App</h1>
            <ul class="nav-menu">
                <li><a href="/pokemon/lan_challenge-/public/?url=login">Login</a></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=register">Register</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
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
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
