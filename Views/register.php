<?php $title = 'Registrazione - Challenge App'; require __DIR__ . '/layouts/header.php'; ?>
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

                <?php if (!empty($_SESSION['info'])): ?>
                    <div class="alert alert-info">
                        <?php echo htmlspecialchars($_SESSION['info']); unset($_SESSION['info']); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="?url=register" class="form" id="registerForm">
                    <div class="form-row-2">
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

                <div class="social-divider">oppure</div>

                <div class="social-login">
                    <a href="/pokemon/lan_challenge-/public/?url=auth/google" class="btn-social google">
                        <svg viewBox="0 0 24 24"><path fill="#4285F4" d="M23.52 12.27c0-.85-.08-1.67-.22-2.45H12v4.63h6.46c-.28 1.5-1.13 2.78-2.4 3.63v3.02h3.88c2.27-2.09 3.58-5.17 3.58-8.83z"/><path fill="#34A853" d="M12 24c3.24 0 5.96-1.07 7.94-2.9l-3.88-3.02c-1.08.72-2.45 1.15-4.06 1.15-3.12 0-5.77-2.11-6.71-4.94H1.28v3.11C3.25 21.3 7.31 24 12 24z"/><path fill="#FBBC05" d="M5.29 14.29A7.2 7.2 0 0 1 4.9 12c0-.8.14-1.57.39-2.29V6.6H1.28A11.98 11.98 0 0 0 0 12c0 1.93.46 3.76 1.28 5.4z"/><path fill="#EA4335" d="M12 4.77c1.77 0 3.35.61 4.6 1.8l3.44-3.44C17.95 1.19 15.24 0 12 0 7.31 0 3.25 2.7 1.28 6.6l4.01 3.11C6.23 6.88 8.88 4.77 12 4.77z"/></svg>
                        Continua con Google
                    </a>
                    <a href="/pokemon/lan_challenge-/public/?url=auth/github" class="btn-social github">
                        <svg viewBox="0 0 16 16" fill="#ffffff"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z"/></svg>
                        Continua con GitHub
                    </a>
                    <a href="/pokemon/lan_challenge-/public/?url=auth/facebook" class="btn-social facebook">
                        <svg viewBox="0 0 24 24" fill="#ffffff"><path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.99 3.66 9.13 8.44 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56V12h2.78l-.44 2.89h-2.34v6.99C18.34 21.13 22 16.99 22 12z"/></svg>
                        Continua con Facebook
                    </a>
                </div>

                <p style="text-align: center; margin-top: 20px;">
                    Hai già un account? <a href="/pokemon/lan_challenge-/public/?url=login">Accedi</a>
                </p>
            </div>
        </div>
<?php
$pageScript = <<<'HTML'
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
HTML;
require __DIR__ . '/layouts/footer.php';
?>
