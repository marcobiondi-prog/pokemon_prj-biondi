<?php

session_start();

// Simula il login manualmente
echo "<h1>🔍 Test Salvataggio Sessione</h1>";
echo "<pre>";

echo "=== PRIMO CARICAMENTO ===\n";
echo "Session ID: " . session_id() . "\n";
echo "Session Data PRIMA: " . json_encode($_SESSION, JSON_PRETTY_PRINT) . "\n\n";

// Simula il login
echo "=== SIMULAZIONE LOGIN ===\n";
$_SESSION['user_id'] = 1;
$_SESSION['user'] = [
    'id' => 1,
    'name' => 'Mario',
    'cognome' => 'Rossi',
    'email' => 'user@example.com',
    'telefono' => ''
];

echo "Session Data DOPO login: " . json_encode($_SESSION, JSON_PRETTY_PRINT) . "\n";
echo "User ID salvato: " . $_SESSION['user_id'] . "\n";
echo "User name salvato: " . $_SESSION['user']['name'] . "\n\n";

echo "=== CONTROLLO SESSIONE ===\n";
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}

echo "isLoggedIn() ritorna: " . (isLoggedIn() ? 'TRUE' : 'FALSE') . "\n\n";

echo "=== SIMULAZIONE DOPO REDIRECT ===\n";
echo "Nel file successivo, quando la sessione persiste:\n";
echo "Session ID sarebbe: " . session_id() . "\n";
echo "Session user_id sarebbe: " . ($_SESSION['user_id'] ?? 'MANCANTE') . "\n";

echo "</pre>";

// Mostra cookie di sessione
?>

<p style="margin-top: 20px; background: #f0f0f0; padding: 10px; border-radius: 5px;">
    <strong>Informazioni Cookie di Sessione:</strong><br>
    Session Cookie Name: PHPSESSID<br>
    Session Path: /pokemon/lan_challenge-/public/<br>
    <br>
    Per verificare che la sessione persista dopo il login, dovresti controllare:<br>
    1. Il browser mantiene il cookie PHPSESSID<br>
    2. Il server legge il cookie e ricarica la sessione<br>
    3. La variabile $_SESSION contiene i dati salvati
</p>
