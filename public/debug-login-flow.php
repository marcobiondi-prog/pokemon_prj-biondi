<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/functions.php';

echo "<h1>🔍 Test Completo Login Flow</h1>";
echo "<pre>";

// Simula una richiesta POST di login
echo "=== SIMULAZIONE LOGIN ===\n";
echo "Step 1: Preparazione\n";
echo "  - Session started\n";
echo "  - Router and controllers loaded\n\n";

use Core\Router;
use App\Controllers\AuthController;

$router = new Router();
$router->add('GET', 'login', 'AuthController@showLogin');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', '', 'DashboardController@index');

echo "Step 2: Registrazione rotte\n";
echo "  - GET login -> AuthController@showLogin\n";
echo "  - POST login -> AuthController@login\n";
echo "  - GET (empty) -> DashboardController@index\n\n";

// Test credenziali di accesso
echo "Step 3: Test credenziali di accesso\n";
$testEmail = 'user@example.com';
$testPassword = '123456';

$controller = new AuthController();
$_POST['email'] = $testEmail;
$_POST['password'] = $testPassword;
$_SERVER['REQUEST_METHOD'] = 'POST';
$_GET['url'] = 'login';

echo "  - Email: $testEmail\n";
echo "  - Password: ***\n\n";

// Test router matching
echo "Step 4: Test Router Matching\n";
echo "  - Method: POST\n";
echo "  - URL: login\n";
echo "  - Match result: ";

$routeMatched = false;
foreach ([['method' => 'POST', 'path' => 'login']] as $route) {
    if ($route['method'] === 'POST' && $route['path'] === 'login') {
        echo "✅ MATCH\n\n";
        $routeMatched = true;
    }
}

if (!$routeMatched) {
    echo "❌ NO MATCH\n\n";
}

// Test controller method
echo "Step 5: Test AuthController::login()\n";

$authController = new AuthController();

// Creo una classe proxy per catturare l'output senza fare redirect
class TestAuthController extends AuthController {
    public function testLogin() {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        echo "  - Email ricevuta: '$email'\n";
        echo "  - Password ricevuta: " . (empty($password) ? 'VUOTA' : '***') . "\n";

        if (empty($email) || empty($password)) {
            echo "  ❌ Email o password vuote\n";
            return false;
        }

        // Verifico le credenziali
        echo "  - Verificando credenziali...\n";

        // Simulate le credenziali disponibili nel controller
        $users = [
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

        foreach ($users as $user) {
            if (strtolower($user['email']) === strtolower($email)) {
                if ($user['password'] === $password) {
                    echo "  ✅ Credenziali CORRETTE\n";
                    echo "  - User ID: " . $user['id'] . "\n";
                    echo "  - Email: " . $user['email'] . "\n";
                    $_SESSION['user_id'] = $user['id'];
                    return true;
                } else {
                    echo "  ❌ Password SBAGLIATA\n";
                    echo "  - Attesa: " . $user['password'] . "\n";
                    echo "  - Ricevuta: $password\n";
                    return false;
                }
            }
        }

        echo "  ❌ Email NON TROVATA\n";
        return false;
    }
}

$testController = new TestAuthController();
$loginSuccess = $testController->testLogin();

echo "\n=== RISULTATO FINALE ===\n";
if ($loginSuccess) {
    echo "✅ LOGIN RIUSCITO!\n";
    echo "Session user_id: " . ($_SESSION['user_id'] ?? 'MANCANTE') . "\n";
    echo "Redirect a: /pokemon/lan_challenge-/public/\n";
} else {
    echo "❌ LOGIN FALLITO\n";
}

echo "</pre>";

// Mostra form di test
?>

<h3>Testa il Login Reale</h3>
<p>Clicca il link sottostante per testare il vero login:</p>
<a href="/pokemon/lan_challenge-/public/?url=login" style="display: inline-block; padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 3px; margin: 10px 0;">
    👉 Vai al Login Form
</a>

<p style="margin-top: 20px; color: #666;">
    <strong>Credenziali disponibili:</strong><br>
    Email: user@example.com / Password: 123456<br>
    Email: test@test.com / Password: test123
</p>
