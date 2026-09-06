<?php

session_start();

// Verifica prima di tutto che il POST riceva i dati
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Mostra il form di test
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Login - Analisi Completa</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; }
        form { background: #f0f0f0; padding: 20px; border-radius: 5px; }
        input { width: 100%; padding: 8px; margin: 5px 0 15px; box-sizing: border-box; }
        button { background: #007bff; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; }
        .info { background: #d1ecf1; padding: 10px; margin: 10px 0; border-radius: 5px; }
        code { background: #f5f5f5; padding: 2px 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🧪 Test Login - Analisi Completa</h1>

        <div class="info">
            <strong>Questo test verificherà ogni fase del login:</strong>
            <ol>
                <li>Ricevi il POST</li>
                <li>Valida email e password</li>
                <li>Verifica le credenziali</li>
                <li>Salva la sessione</li>
                <li>Tenta il redirect</li>
            </ol>
        </div>

        <form method="POST">
            <label><strong>Email:</strong></label>
            <input type="text" name="email" value="user@example.com" required>

            <label><strong>Password:</strong></label>
            <input type="text" name="password" value="123456" required>

            <button type="submit">Testa Login</button>
        </form>

        <div class="info">
            <strong>Credenziali disponibili:</strong>
            <ul>
                <li><code>user@example.com</code> / <code>123456</code></li>
                <li><code>test@test.com</code> / <code>test123</code></li>
            </ul>
        </div>
    </div>
</body>
</html>
    <?php
    exit;
}

// POST ricevuto - analiza
echo "<h1>✅ POST Ricevuto</h1>";
echo "<pre>";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

echo "Email: '$email' (length: " . strlen($email) . ")\n";
echo "Password: '$password' (length: " . strlen($password) . ")\n\n";

// Fase 2: Valida
echo "=== FASE 2: VALIDAZIONE ===\n";

if (empty($email)) {
    echo "❌ Email vuota\n";
    exit;
}
if (empty($password)) {
    echo "❌ Password vuota\n";
    exit;
}

echo "✓ Email e password non vuote\n";

$emailValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
echo "Email valida? " . ($emailValid ? "✓ SI" : "❌ NO") . "\n";

if (!$emailValid) {
    echo "La mail non passa la validazione filter_var()\n";
    exit;
}

// Fase 3: Verifica credenziali
echo "\n=== FASE 3: VERIFICA CREDENZIALI ===\n";

$users = [
    ['id' => 1, 'email' => 'user@example.com', 'password' => '123456', 'name' => 'Mario', 'cognome' => 'Rossi'],
    ['id' => 2, 'email' => 'test@test.com', 'password' => 'test123', 'name' => 'Test', 'cognome' => 'User']
];

$found = false;
foreach ($users as $user) {
    $emailMatch = strtolower($user['email']) === strtolower($email);
    echo "Checking: {$user['email']} vs $email => " . ($emailMatch ? "MATCH" : "no") . "\n";

    if ($emailMatch) {
        $found = true;
        echo "\n✓ Email trovata!\n";
        echo "Password nel DB: '{$user['password']}'\n";
        echo "Password ricevuta: '$password'\n";

        if ($user['password'] === $password) {
            echo "✓ Password CORRETTA\n";

            // Fase 4: Salva sessione
            echo "\n=== FASE 4: SALVA SESSIONE ===\n";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'cognome' => $user['cognome'],
                'email' => $user['email']
            ];

            echo "✓ Session salvata\n";
            echo "  user_id: " . $_SESSION['user_id'] . "\n";
            echo "  user.name: " . $_SESSION['user']['name'] . "\n";

            // Fase 5: Redirect
            echo "\n=== FASE 5: REDIRECT ===\n";
            echo "✓ Tentativo redirect a: ?url=\n";
            echo "\n✅ LOGIN SUCCESSO!\n";

            // Redirect effettivo
            header('Location: ?url=');
            exit;
        } else {
            echo "❌ Password SBAGLIATA\n";
            exit;
        }
    }
}

if (!$found) {
    echo "\n❌ Email NON trovata\n";
    echo "Email disponibili:\n";
    foreach ($users as $u) {
        echo "  - {$u['email']}\n";
    }
}

echo "</pre>";
?>
