<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

echo "<h1>🔍 Debug Login Completo</h1>";
echo "<pre>";

echo "=== INFORMAZIONI SESSIONE ===\n";
echo "Session ID: " . session_id() . "\n";
echo "Session Status: " . session_status() . "\n";
echo "Session Data: " . json_encode($_SESSION, JSON_PRETTY_PRINT) . "\n";

echo "\n=== INFORMAZIONI RICHIESTA ===\n";
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "URL: " . ($_GET['url'] ?? 'VUOTA') . "\n";
echo "Query String: " . ($_SERVER['QUERY_STRING'] ?? 'VUOTA') . "\n";

// Test credenziali
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n=== FORM RICEVUTO ===\n";
    echo "Email: " . ($_POST['email'] ?? 'MANCANTE') . "\n";
    echo "Password: " . (isset($_POST['password']) ? '***' : 'MANCANTE') . "\n";

    // Test verifica credenziali
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    echo "\n=== TEST CREDENZIALI ===\n";
    echo "Email pulita: '$email'\n";
    echo "Password vuota: " . (empty($password) ? 'SI' : 'NO') . "\n";

    $users = [
        'user@example.com' => '123456',
        'test@test.com' => 'test123'
    ];

    if (isset($users[$email])) {
        echo "Utente trovato: SI\n";
        if ($users[$email] === $password) {
            echo "Password: CORRETTA ✓\n";
            echo "\n✅ LOGIN DOVREBBE RIUSCIRE\n";
        } else {
            echo "Password: SBAGLIATA ✗\n";
            echo "Attesa: " . $users[$email] . "\n";
            echo "Ricevuta: $password\n";
        }
    } else {
        echo "Utente trovato: NO\n";
        echo "Email disponibili:\n";
        foreach (array_keys($users) as $e) {
            echo "  - $e\n";
        }
    }
}

echo "\n=== CREDENZIALI DI TEST ===\n";
echo "Email 1: user@example.com / Password: 123456\n";
echo "Email 2: test@test.com / Password: test123\n";

echo "</pre>";

// Form di test
?>

<h3>Form di Test Login</h3>
<form method="POST" style="background: #f0f0f0; padding: 20px; border-radius: 5px; max-width: 400px;">
    <div style="margin-bottom: 10px;">
        <label><strong>Email:</strong></label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? 'user@example.com'); ?>" required style="width: 100%; padding: 5px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label><strong>Password:</strong></label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '123456'); ?>" required style="width: 100%; padding: 5px;">
    </div>
    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; width: 100%;">
        Test Login
    </button>
</form>

<p style="margin-top: 20px; color: #666;">
    <strong>Istruzioni:</strong><br>
    Il form è precompilato con credenziali valide.<br>
    Clicca il bottone per testare il login.
</p>
