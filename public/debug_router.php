<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

echo "<h1>🔍 Debug Router e Login</h1>";
echo "<pre>";

// Test 1: Verifica che le classi siano caricate
use Core\Router;

echo "✓ Router caricato\n";

// Test 2: Mostra informazioni richiesta
echo "\n=== INFORMAZIONI RICHIESTA ===\n";
echo "Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "URL da GET: " . ($_GET['url'] ?? 'VUOTA') . "\n";
echo "Query String: " . ($_SERVER['QUERY_STRING'] ?? 'VUOTA') . "\n";

// Test 3: Crea router e registra rotte
echo "\n=== REGISTRAZIONE ROTTE ===\n";
$router = new Router();

$router->add('GET', 'login', 'AuthController@showLogin');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', 'register', 'AuthController@showRegister');
$router->add('POST', 'register', 'AuthController@register');

echo "4 rotte registrate\n";

// Test 4: Verifica matching
echo "\n=== TEST MATCHING ===\n";
$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

echo "Cercando: $method $url\n";
echo "Rotte disponibili:\n";
echo "  POST login\n";
echo "  GET login\n";
echo "  GET register\n";
echo "  POST register\n";

// Test 5: Se POST, mostra dati form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "\n=== DATI FORM ===\n";
    echo "Email: " . ($_POST['email'] ?? 'MANCANTE') . "\n";
    echo "Password: " . (isset($_POST['password']) ? '***' : 'MANCANTE') . "\n";

    if ($url === 'login' && !empty($_POST['email']) && !empty($_POST['password'])) {
        echo "\n✅ PRONTO PER LOGIN\n";
        echo "Verifica credenziali:\n";

        $users = [
            'user@example.com' => '123456',
            'test@test.com' => 'test123'
        ];

        $email = trim($_POST['email']);
        if (isset($users[$email])) {
            if ($users[$email] === $_POST['password']) {
                echo "  ✅ Credenziali CORRETTE\n";
                echo "  Dovrebbe reindirizzare al dashboard\n";
            } else {
                echo "  ❌ Password SBAGLIATA\n";
            }
        } else {
            echo "  ❌ Email NON TROVATA\n";
        }
    }
}

echo "\n=== FORM DI TEST ===\n";
echo "</pre>";
?>

<form method="POST" style="background: #f0f0f0; padding: 20px; border-radius: 5px; max-width: 400px;">
    <div style="margin-bottom: 10px;">
        <label><strong>Email:</strong></label>
        <input type="email" name="email" value="user@example.com" required style="width: 100%; padding: 5px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label><strong>Password:</strong></label>
        <input type="password" name="password" value="123456" required style="width: 100%; padding: 5px;">
    </div>
    <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 3px; cursor: pointer; width: 100%;">
        Test Login Completo
    </button>
</form>

<p style="margin-top: 20px; color: #666;">
    <strong>Istruzioni:</strong>
    <br>1. Compila il form sopra (è precompilato)
    <br>2. Clicca "Test Login Completo"
    <br>3. Verificherai se il router funziona correttamente
</p>
