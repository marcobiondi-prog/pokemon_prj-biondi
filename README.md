# Challenge App MVC

Una semplice applicazione MVC per la gestione di challenge con autenticazione utente.

## Struttura del Progetto

```
challenge-app-mvc/
├── config/              # Configurazione dell'applicazione
│   └── database.php     # Parametri di connessione al database
├── core/                # Classi core del framework MVC
│   ├── Database.php     # Singleton per la connessione al database
│   ├── Router.php       # Router personalizzato per le rotte
│   ├── Controller.php   # Classe base per i controller
│   └── Model.php        # Classe base per i model
├── app/                 # Codice dell'applicazione
│   ├── Controllers/     # Controller dell'applicazione
│   ├── Models/          # Model dell'applicazione
│   └── Views/           # Template HTML
├── public/              # Unica directory pubblica
│   ├── index.php        # Front controller
│   ├── .htaccess        # Configurazione Apache
│   └── assets/          # CSS, JS, immagini
├── vendor/              # Dipendenze Composer
├── composer.json        # File di configurazione Composer
├── .gitignore           # Configurazione Git
└── README.md            # Questo file
```

## Installazione

### Requisiti
- PHP 8.0+
- MySQL/MariaDB
- Apache con mod_rewrite abilitato

### Setup

1. **Clona il repository**
```bash
git clone <repository-url>
cd challenge-app-mvc
```

2. **Installa le dipendenze**
```bash
composer install
```

3. **Configura il database**

Modifica `config/database.php` con le tue credenziali:
```php
return [
    'host'     => 'localhost',
    'dbname'   => 'challenge_app_mvc',
    'user'     => 'root',
    'password' => '',
];
```

4. **Crea il database**

```sql
CREATE DATABASE challenge_app_mvc DEFAULT CHARACTER SET utf8mb4;

USE challenge_app_mvc;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE challenges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

5. **Configura Apache**

Assicurati che `mod_rewrite` sia abilitato e che la `DocumentRoot` punti a `public/`:

```apache
<VirtualHost *:80>
    ServerName challenge-app.local
    DocumentRoot /path/to/challenge-app-mvc/public
    
    <Directory /path/to/challenge-app-mvc/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

## Utilizzo

### Rotte Disponibili

#### Autenticazione
- `GET /login` - Mostra il form di login
- `POST /login` - Processa il login
- `GET /register` - Mostra il form di registrazione
- `POST /register` - Processa la registrazione
- `GET /logout` - Effettua il logout

#### Dashboard
- `GET /dashboard` - Dashboard principale

#### Challenge
- `GET /challenge/create` - Mostra il form per creare una challenge
- `POST /challenge/create` - Crea una nuova challenge
- `GET /challenge/{id}` - Visualizza una challenge

### Definizione di Nuove Rotte

In `public/index.php`:

```php
$router->get('/rotta', 'ControllerName@methodName');
$router->post('/rotta', 'ControllerName@methodName');
$router->put('/rotta/{id}', 'ControllerName@methodName');
$router->delete('/rotta/{id}', 'ControllerName@methodName');
```

### Creazione di un Controller

Crea un nuovo file in `app/Controllers/YourController.php`:

```php
<?php
namespace App\Controllers;

use App\Core\Controller;

class YourController extends Controller
{
    public function index()
    {
        $data = ['title' => 'Test'];
        $this->render('view.name', $data);
    }
    
    public function redirect()
    {
        $this->redirect('/dashboard');
    }
    
    public function api()
    {
        $this->json(['status' => 'ok']);
    }
}
```

### Creazione di un Model

Crea un nuovo file in `app/Models/YourModel.php`:

```php
<?php
namespace App\Models;

use App\Core\Model;

class YourModel extends Model
{
    protected string $table = 'your_table';
    
    public function customQuery()
    {
        return $this->query("SELECT * FROM {$this->table} WHERE ...", []);
    }
}
```

## Funzionalità

### Database (Singleton)
```php
use App\Core\Database;

$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$result = $stmt->fetch();
```

### Model Base
- `all()` - Recupera tutti i record
- `find($id)` - Recupera un record per ID
- `create($data)` - Crea un nuovo record
- `update($id, $data)` - Aggiorna un record
- `delete($id)` - Elimina un record
- `query($sql, $params)` - Query personalizzata
- `queryOne($sql, $params)` - Query che ritorna un singolo record

### Controller Base
- `render($view, $data)` - Renderizza una view
- `redirect($path)` - Reindirizza a un percorso
- `json($data, $statusCode)` - Ritorna JSON
- `abort($statusCode, $message)` - Ritorna un errore

## Security

- Usa `htmlspecialchars()` per escapare l'output HTML
- Usa prepared statements per le query SQL
- Valida sempre l'input dell'utente
- Usa `password_hash()` per salvare le password

## Licenza

MIT

## Autore

Emanuele Demos
