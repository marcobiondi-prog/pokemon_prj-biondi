<?php

// Simula il redirect del login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Credenziali di test
    $validUsers = [
        'user@example.com' => '123456',
        'test@test.com' => 'test123'
    ];

    if (isset($validUsers[$email]) && $validUsers[$email] === $password) {
        // Login riuscito
        session_start();
        $_SESSION['user_id'] = 1;
        $_SESSION['user'] = ['email' => $email, 'name' => 'Test User'];

        echo "<h1>✅ LOGIN RIUSCITO!</h1>";
        echo "<p>Email: $email</p>";
        echo "<p>Session user_id: " . $_SESSION['user_id'] . "</p>";
        echo "<p>Reindirizzamento al dashboard in 2 secondi...</p>";
        echo "<meta http-equiv='refresh' content='2;url=?url='>";
        exit;
    } else {
        $error = 'Email o password non corretti';
    }
}

$error = $error ?? '';
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Test Semplificato</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; padding: 20px; }
        .container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; font-size: 16px; }
        button:hover { background: #0056b3; }
        .error { background: #f8d7da; color: #721c24; padding: 12px; border-radius: 3px; margin-bottom: 15px; }
        .info { background: #d1ecf1; color: #0c5460; padding: 12px; border-radius: 3px; margin-bottom: 15px; }
        .debug { background: #f0f0f0; padding: 10px; border-radius: 3px; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login - Test Semplificato</h1>

        <?php if (!empty($error)): ?>
            <div class="error">
                ⚠️ <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="info">
            <strong>Credenziali di Test:</strong><br>
            Email: user@example.com<br>
            Password: 123456
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required value="user@example.com">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required value="123456">
            </div>

            <button type="submit">Accedi</button>
        </form>

        <div class="debug">
            <p><strong>Debug Info:</strong></p>
            <p>Questo è un form di test semplificato SENZA validazione JavaScript.</p>
            <p>Se questo funziona ma il login vero no, il problema è nel controller o nel router.</p>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                <p><strong>POST ricevuto:</strong></p>
                <p>Email: <?php echo htmlspecialchars($_POST['email'] ?? ''); ?></p>
                <p>Password: <?php echo htmlspecialchars($_POST['password'] ?? ''); ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
