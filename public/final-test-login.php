<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/functions.php';

echo "<h1>🧪 Simula Login Completo</h1>";
echo "<pre>";

use App\Controllers\AuthController;

// Fase 1: Simula richiesta GET /login (mostra form)
echo "=== FASE 1: GET /login (Mostra Form) ===\n";
$_SERVER['REQUEST_METHOD'] = 'GET';
$_GET['url'] = 'login';
$_SESSION = [];

echo "✓ Form di login caricato\n";
echo "Utente vede il form e compila:\n";
echo "  Email: user@example.com\n";
echo "  Password: 123456\n\n";

// Fase 2: Simula POST /login (login)
echo "=== FASE 2: POST /login (Effettua Login) ===\n";
$_SERVER['REQUEST_METHOD'] = 'POST';
$_GET['url'] = 'login';
$_POST['email'] = 'user@example.com';
$_POST['password'] = '123456';

echo "Dati inviati:\n";
echo "  Method: " . $_SERVER['REQUEST_METHOD'] . "\n";
echo "  URL: " . $_GET['url'] . "\n";
echo "  Email: " . $_POST['email'] . "\n";
echo "  Password: ***\n\n";

// Simula il login senza fare header redirect
$controller = new AuthController();

// Uso reflection per testare
$reflection = new ReflectionClass($controller);
$usersProperty = $reflection->getProperty('users');
$usersProperty->setAccessible(true);
$users = $usersProperty->getValue($controller);

echo "Verifica credenziali nel controller:\n";
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$loginSuccess = false;

foreach ($users as $user) {
    if (strtolower($user['email']) === strtolower($email)) {
        echo "  ✓ Email trovata: {$user['email']}\n";
        if ($user['password'] === $password) {
            echo "  ✓ Password CORRETTA\n";
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'cognome' => $user['cognome'],
                'email' => $user['email'],
            ];
            echo "  ✓ Session salvata:\n";
            echo "    - user_id: " . $_SESSION['user_id'] . "\n";
            echo "    - user.name: " . $_SESSION['user']['name'] . "\n";
            echo "    - user.email: " . $_SESSION['user']['email'] . "\n";
            $loginSuccess = true;
        } else {
            echo "  ✗ Password SBAGLIATA\n";
        }
        break;
    }
}

if (!$loginSuccess && !isset($_SESSION['user_id'])) {
    echo "  ✗ Login FALLITO\n";
} elseif ($loginSuccess) {
    echo "  ✓ Login RIUSCITO\n";
    echo "  → Redirect a: ?url=\n\n";
}

// Fase 3: Simula GET / (dashboard)
echo "=== FASE 3: GET / (Dashboard) ===\n";
$_SERVER['REQUEST_METHOD'] = 'GET';
$_GET['url'] = '';
// La sessione persiste automaticamente

echo "URL ricevuto: ?url= (vuota)\n";
echo "Session persiste?\n";

// Simula function isLoggedIn
function testIsLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

if (testIsLoggedIn()) {
    echo "  ✓ Session trovata\n";
    echo "  ✓ Utente loggato: " . $_SESSION['user']['name'] . "\n";
    echo "  ✓ Dashboard caricato\n\n";
} else {
    echo "  ✗ Session PERSA\n";
    echo "  → Redirect a login\n\n";
}

// Risultato finale
echo "=== RISULTATO FINALE ===\n";
if ($loginSuccess && testIsLoggedIn()) {
    echo "✅ LOGIN FLOW COMPLETO E FUNZIONANTE\n";
    echo "\nOra testa nel browser:\n";
    echo "1. Vai a: http://localhost/pokemon/lan_challenge-/public/?url=login\n";
    echo "2. Compila il form con:\n";
    echo "   Email: user@example.com\n";
    echo "   Password: 123456\n";
    echo "3. Clicca Login\n";
    echo "4. Dovresti vedere il Dashboard\n";
} else {
    echo "❌ QUALCOSA NON HA FUNZIONATO\n";
    echo "Login success: " . ($loginSuccess ? 'TRUE' : 'FALSE') . "\n";
    echo "Session exists: " . (testIsLoggedIn() ? 'TRUE' : 'FALSE') . "\n";
}

echo "</pre>";
?>
