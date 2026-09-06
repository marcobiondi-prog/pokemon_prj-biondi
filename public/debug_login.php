<?php

session_start();

// Test 1: Verifica che session_start() funziona
echo "<h2>🔍 Debug Login</h2>";
echo "<pre>";

echo "Session ID: " . session_id() . "\n";
echo "Session Status: " . session_status() . "\n";
echo "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n";

// Test 2: Verifica credenziali
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n=== FORM INVIATO ===\n";
    echo "Email ricevuta: " . ($_POST['email'] ?? 'MANCANTE') . "\n";
    echo "Password ricevuta: " . (isset($_POST['password']) ? '***' : 'MANCANTE') . "\n";

    // Test login diretto
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    echo "\nEmail pulita: '$email'\n";
    echo "Password vuota: " . (empty($password) ? 'SI' : 'NO') . "\n";

    // Test password_verify
    $hashes = [
        'user@example.com' => '$2y$10$slYQmyNdGzSqKWARNpJZPeLCvLgNXvWKLRCjBg.TBDqJJfxpRvFpa',
        'test@test.com' => '$2y$10$R9h7cIPz0gi.URNNX3kh2OPST9/PgBkqquzi.Ss7KIUgO2t0jKMUm'
    ];

    if (isset($hashes[$email])) {
        echo "\nUtente trovato: SI\n";
        echo "Password match: " . (password_verify($password, $hashes[$email]) ? 'SI ✓' : 'NO ✗') . "\n";

        if (password_verify($password, $hashes[$email])) {
            echo "\n✅ LOGIN RIUSCITO!\n";
            $_SESSION['user_id'] = 1;
            $_SESSION['user'] = ['email' => $email, 'name' => 'Test'];
            echo "Session user_id: " . $_SESSION['user_id'] . "\n";
            echo "Reindirizzamento a: /pokemon/lan_challenge-/public/\n";
            // header('Location: /pokemon/lan_challenge-/public/');
            // exit;
        } else {
            echo "\n❌ PASSWORD SBAGLIATA\n";
        }
    } else {
        echo "\nUtente trovato: NO\n";
        echo "Email non riconosciuta: $email\n";
    }
}

echo "\n=== CREDENZIALI DI TEST ===\n";
echo "Email 1: user@example.com\n";
echo "Password 1: 123456\n";
echo "Email 2: test@test.com\n";
echo "Password 2: test123\n";

echo "</pre>";

// Form di test
echo "<h3>Form di Test Login</h3>";
echo "<form method='POST' style='background: #f0f0f0; padding: 20px; border-radius: 5px;'>";
echo "<div style='margin-bottom: 10px;'>";
echo "<label>Email:</label>";
echo "<input type='email' name='email' value='" . ($_POST['email'] ?? '') . "' required>";
echo "</div>";
echo "<div style='margin-bottom: 10px;'>";
echo "<label>Password:</label>";
echo "<input type='password' name='password' required>";
echo "</div>";
echo "<button type='submit' style='padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer;'>Test Login</button>";
echo "</form>";
?>
