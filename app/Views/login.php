<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Challenge App</title>
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
                <h2>Bentornato</h2>

                <?php if (isset($_GET['registered']) && $_GET['registered'] == '1'): ?>
                    <div class="alert alert-success">
                        ✓ Registrazione avvenuta con successo!
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['reset']) && $_GET['reset'] == 'success'): ?>
                    <div class="alert alert-success">
                        ✓ Password reimpostata con successo! Accedi con la tua nuova password
                    </div>
                <?php endif; ?>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        ⚠️ <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="?url=login" class="form" id="loginForm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required class="form-control" placeholder="Inserisci la tua email">
                    </div>

                                    <div class="form-group">
                        <label for="password">Password</label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" required class="form-control" placeholder="Inserisci la tua password" style="padding-right: 40px;">
                            <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom: 20px;">Accedi</button>

                    <div style="text-align: right; margin-bottom: 20px;">
                        <a href="/pokemon/lan_challenge-/public/?url=forgot-password" style="color: #007bff; text-decoration: none; font-size: 14px;">
                            Password dimenticata?
                        </a>
                    </div>
                </form>

                <hr style="margin: 20px 0;">

                <p style="text-align: center; margin-top: 20px;">
                    Non hai un account? <a href="/pokemon/lan_challenge-/public/?url=register">Registrati</a>
                </p>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>

    <script>
    // Toggle password visibility
    const toggleBtn = document.getElementById('togglePassword');
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    }

    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email || !emailRegex.test(email)) {
            e.preventDefault();
            alert('Email non valida. Per favore, inserisci un\'email valida.');
            document.getElementById('email').focus();
            return false;
        }
    });
    </script>
</body>
</html>
