<?php

session_start();

echo "<h1>🔍 Verifica POST e Router</h1>";
echo "<pre>";

// Simula il POST al login
$_SERVER['REQUEST_METHOD'] = 'POST';
$_GET['url'] = 'login';
$_POST['email'] = 'user@example.com';
$_POST['password'] = '123456';

echo "=== SIMULO POST A /login ===\n";
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "URL: " . $_GET['url'] . "\n";
echo "Email: " . $_POST['email'] . "\n";
echo "Password: ***\n\n";

// Carica autoloader
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Carica il controller manualmente
use App\Controllers\AuthController;

echo "=== TEST CONTROLLER DIRETTAMENTE ===\n";

$controller = new AuthController();

// Usa reflection per accedere al metodo
$reflection = new ReflectionClass($controller);
$usersProperty = $reflection->getProperty('users');
$usersProperty->setAccessible(true);
$users = $usersProperty->getValue($controller);

echo "Utenti nel controller:\n";
foreach ($users as $user) {
    echo "  - {$user['email']} / {$user['password']}\n";
}

echo "\n=== SIMULO LOGIN MANUALMENTE ===\n";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

echo "Email ricevuta: '$email'\n";
echo "Password ricevuta: '$password'\n";

// Test validazione email
echo "\nValidazione email:\n";
$isValid = filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
echo "  filter_var result: " . ($isValid ? 'VALIDA' : 'INVALIDA') . "\n";

// Test credenziali
echo "\nVerifica credenziali:\n";
foreach ($users as $user) {
    echo "  Checking: '{$user['email']}' vs '$email'\n";
    if (strtolower($user['email']) === strtolower($email)) {
        echo "    ✓ Email trovata\n";
        echo "    Password nel DB: '{$user['password']}'\n";
        echo "    Password ricevuta: '$password'\n";
        echo "    Match: " . ($user['password'] === $password ? 'SI ✓' : 'NO ✗') . "\n";

        if ($user['password'] !== $password) {
            echo "\n    Lunghezze:\n";
            echo "    DB length: " . strlen($user['password']) . "\n";
            echo "    Ricevuta length: " . strlen($password) . "\n";

            echo "\n    Bytes DB: ";
            for ($i = 0; $i < strlen($user['password']); $i++) {
                echo ord($user['password'][$i]) . " ";
            }
            echo "\n";

            echo "    Bytes Ricevuta: ";
            for ($i = 0; $i < strlen($password); $i++) {
                echo ord($password[$i]) . " ";
            }
            echo "\n";
        }
    }
}

echo "\n=== RISULTATO ===\n";
echo "Se vedi 'Email trovata' e 'Match: SI', allora il login DOVREBBE funzionare.\n";
echo "Se vedi 'Match: NO', c'è un problema di encoding della password.\n";

echo "</pre>";
?>
