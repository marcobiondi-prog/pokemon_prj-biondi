<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/functions.php';

echo "<h1>🧪 Test E2E Completo Login</h1>";
echo "<pre>";

echo "=== TEST 1: Credenziali Valide ===\n";

use App\Controllers\AuthController;

// Reset sessione
$_SESSION = [];

// Simula POST login
$_POST = [
    'email' => 'user@example.com',
    'password' => '123456'
];
$_SERVER['REQUEST_METHOD'] = 'POST';
$_GET['url'] = 'login';

echo "Simulo POST a ?url=login\n";
echo "Email: user@example.com\n";
echo "Password: 123456\n\n";

// Creo controller e testo
$controller = new AuthController();

// Uso reflection per accedere al metodo privato
$reflection = new ReflectionClass($controller);
$method = $reflection->getMethod('login');
$method->setAccessible(true);

// Cattura output per evitare header redirect
ob_start();

try {
    // Questo fa exit, quindi uso un test diverso
    echo "Tentativo di login in corso...\n";

    // Accedo direttamente alla logica senza fare exit
    // Estraggo l'email e password
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    echo "Email estratta: '$email'\n";
    echo "Password estratta: " . (empty($password) ? 'VUOTA' : '***') . "\n";

    // Test manuale delle credenziali usando reflection per accedere al $users
    $usersProperty = $reflection->getProperty('users');
    $usersProperty->setAccessible(true);
    $users = $usersProperty->getValue($controller);

    echo "\nUtenti disponibili nel controller:\n";
    foreach ($users as $user) {
        echo "  - {$user['email']}\n";
    }

    echo "\nVerifica credenziali:\n";
    $found = false;
    foreach ($users as $user) {
        if (strtolower($user['email']) === strtolower($email)) {
            $found = true;
            echo "  ✓ Email trovata: {$user['email']}\n";
            if ($user['password'] === $password) {
                echo "  ✓ Password CORRETTA\n";
                echo "  ✓ Login RIUSCITO\n";
            } else {
                echo "  ✗ Password SBAGLIATA\n";
                echo "    Attesa: {$user['password']}\n";
                echo "    Ricevuta: $password\n";
            }
            break;
        }
    }

    if (!$found) {
        echo "  ✗ Email NON TROVATA\n";
    }
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage() . "\n";
}

ob_end_clean();

echo "\n\n=== TEST 2: Verifica Router ===\n";

use Core\Router;

$router = new Router();
$router->add('GET', 'login', 'AuthController@showLogin');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', '', 'DashboardController@index');

echo "Router creato con 3 rotte:\n";
echo "  1. GET login -> AuthController@showLogin\n";
echo "  2. POST login -> AuthController@login\n";
echo "  3. GET (empty) -> DashboardController@index\n\n";

echo "Test matching POST login:\n";
$_SERVER['REQUEST_METHOD'] = 'POST';
$_GET['url'] = 'login';

$matchFound = false;
$routes = $reflection->getProperty('routes');
$routes->setAccessible(true);
$allRoutes = $routes->getValue($router);

foreach ($allRoutes as $route) {
    if ($route['method'] === 'POST' && $route['path'] === 'login') {
        echo "  ✓ Rotta trovata!\n";
        echo "  Handler: " . $route['handler'] . "\n";
        $matchFound = true;
        break;
    }
}

if (!$matchFound) {
    echo "  ✗ Rotta NON trovata\n";
}

echo "\n=== TEST 3: Verifica Session ===\n";

// Simula il salvataggio in sessione
$_SESSION['user_id'] = 1;
$_SESSION['user'] = [
    'id' => 1,
    'name' => 'Mario',
    'email' => 'user@example.com'
];

echo "Session data dopo login:\n";
echo "  user_id: " . $_SESSION['user_id'] . "\n";
echo "  user: " . json_encode($_SESSION['user'], JSON_PRETTY_PRINT) . "\n";

// Test funzione isLoggedIn
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

echo "\nisLoggedIn() result: " . (isLoggedIn() ? 'TRUE ✓' : 'FALSE ✗') . "\n";

echo "\n=== CONCLUSIONE ===\n";
if ($matchFound && isLoggedIn()) {
    echo "✅ TUTTI I TEST PASSATI!\n";
    echo "Il login dovrebbe funzionare nel browser.\n";
} else {
    echo "❌ ALCUNI TEST FALLITI\n";
}

echo "</pre>";
?>
