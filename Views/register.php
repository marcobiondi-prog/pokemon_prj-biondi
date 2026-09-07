<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione - Challenge App</title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/assets/css/style.css?v=8">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/pokemon/lan_challenge-/public/"><img src="/pokemon/lan_challenge-/assets/img/logo.png?v=1" alt="Challenge App" class="navbar-brand"></a>
            <ul class="nav-menu">
                <li><a href="/pokemon/lan_challenge-/public/?url=login">Login</a></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=register">Register</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <div class="auth-container">
            <div class="auth-card">
                <h2>Crea un Account</h2>

                <?php
                $errorMessages = [
                    'email_exists' => 'Questa email è già registrata',
                    'password_mismatch' => 'Le password non coincidono',
                    'password_required' => 'Password obbligatoria',
                    'password_too_short' => 'Password troppo corta. Minimo 8 caratteri',
                    'password_too_long' => 'Password troppo lunga',
                    'password_no_uppercase' => 'Password deve contenere una lettera MAIUSCOLA',
                    'password_no_lowercase' => 'Password deve contenere una lettera minuscola',
                    'password_no_number' => 'Password deve contenere un numero',
                    'password_no_special_char' => 'Password deve contenere un carattere speciale (!@#$%^&*)',
                    'missing_name' => 'Nome e cognome sono obbligatori',
                    'email_required' => 'Email obbligatoria',
                    'email_invalid' => 'Email non valida',
                    'email_too_long' => 'Email troppo lunga',
                ];

                if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($errorMessages[$error] ?? 'Errore durante la registrazione'); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="?url=register" class="form" id="registerForm">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label for="nome">Nome *</label>
                            <input type="text" id="nome" name="nome" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cognome">Cognome *</label>
                            <input type="text" id="cognome" name="cognome" required class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" required class="form-control" placeholder="Inserisci la password" style="padding-right: 40px;">
                            <button type="button" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="conferma_password">Conferma Password *</label>
                        <div style="position: relative;">
                            <input type="password" id="conferma_password" name="conferma_password" required class="form-control" placeholder="Conferma la password" style="padding-right: 40px;">
                            <button type="button" id="toggleConfirm" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Registrati</button>
                </form>

                <p style="text-align: center; margin-top: 20px;">
                    Hai già un account? <a href="/pokemon/lan_challenge-/public/?url=login">Accedi</a>
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
    const togglePass = document.getElementById('togglePassword');
    if (togglePass) {
        togglePass.addEventListener('click', function(e) {
            e.preventDefault();
            const input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    }

    const toggleConf = document.getElementById('toggleConfirm');
    if (toggleConf) {
        toggleConf.addEventListener('click', function(e) {
            e.preventDefault();
            const input = document.getElementById('conferma_password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    }

    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('conferma_password').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!email || !emailRegex.test(email)) {
            e.preventDefault();
            alert('Email non valida');
            document.getElementById('email').focus();
            return false;
        }

        if (password !== confirmPassword) {
            e.preventDefault();
            alert('Le password non coincidono');
            document.getElementById('conferma_password').focus();
            return false;
        }

        if (password.length < 3) {
            e.preventDefault();
            alert('Password troppo corta');
            document.getElementById('password').focus();
            return false;
        }
    });
    </script>
</body>
</html>
