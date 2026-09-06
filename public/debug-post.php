<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

echo "<h1>🔍 Debug POST Login</h1>";
echo "<pre>";

echo "=== DATI RICEVUTI ===\n";
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "URL: " . ($_GET['url'] ?? 'VUOTA') . "\n";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n=== FORM DATA ===\n";
    echo "Email raw: " . var_export($_POST['email'] ?? null, true) . "\n";
    echo "Password raw: " . var_export($_POST['password'] ?? null, true) . "\n";

    echo "\nEmail trimmed: '" . trim($_POST['email'] ?? '') . "'\n";
    echo "Password: '" . ($_POST['password'] ?? '') . "'\n";

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    echo "\n=== ANALISI ===\n";
    echo "Email vuota? " . (empty($email) ? 'SI' : 'NO') . "\n";
    echo "Password vuota? " . (empty($password) ? 'SI' : 'NO') . "\n";
    echo "Email length: " . strlen($email) . "\n";
    echo "Password length: " . strlen($password) . "\n";

    // Test validateEmail
    echo "\n=== TEST VALIDATE EMAIL ===\n";
    $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    echo "filter_var result: " . ($isValidEmail ? 'VALIDA' : 'INVALIDA') . "\n";

    // Test credenziali
    echo "\n=== TEST CREDENZIALI ===\n";
    $testUsers = [
        [
            'id' => 1,
            'email' => 'user@example.com',
            'password' => '123456',
        ],
        [
            'id' => 2,
            'email' => 'test@test.com',
            'password' => 'test123',
        ]
    ];

    $found = false;
    foreach ($testUsers as $user) {
        $match = strtolower($user['email']) === strtolower($email);
        echo "Checking: '{$user['email']}' vs '$email' = " . ($match ? 'MATCH' : 'NO') . "\n";

        if ($match) {
            $found = true;
            echo "Email trovata!\n";
            echo "Password nel DB: '{$user['password']}'\n";
            echo "Password ricevuta: '$password'\n";
            echo "Match esatto? " . ($user['password'] === $password ? 'SI ✓' : 'NO ✗') . "\n";

            // Test character by character
            if ($user['password'] !== $password) {
                echo "\nAnalisi character-by-character:\n";
                echo "DB: ";
                for ($i = 0; $i < strlen($user['password']); $i++) {
                    echo ord($user['password'][$i]) . " ";
                }
                echo "\nRicevuta: ";
                for ($i = 0; $i < strlen($password); $i++) {
                    echo ord($password[$i]) . " ";
                }
                echo "\n";
            }
            break;
        }
    }

    if (!$found) {
        echo "Email NON trovata!\n";
        echo "Email disponibili:\n";
        foreach ($testUsers as $user) {
            echo "  - {$user['email']}\n";
        }
    }
} else {
    echo "\nNessun POST ricevuto. Mostra il form:\n";
}

echo "</pre>";

// Mostra form di test
?>

<h2>Form di Test Login</h2>
<form method="POST" style="background: #f0f0f0; padding: 20px; border-radius: 5px; max-width: 400px;">
    <div style="margin-bottom: 10px;">
        <label><strong>Email:</strong></label>
        <input type="text" name="email" value="user@example.com" style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    <div style="margin-bottom: 10px;">
        <label><strong>Password:</strong></label>
        <input type="text" name="password" value="123456" style="width: 100%; padding: 8px; box-sizing: border-box;">
    </div>
    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; width: 100%;">
        Testa Login Debug
    </button>
</form>

<p style="margin-top: 20px;">
    <strong>Nota:</strong> Questo script mostra esattamente cosa riceve il form POST. Se vedi qui che funziona, ma nel login vero non funziona, il problema è nel controller.
</p>
