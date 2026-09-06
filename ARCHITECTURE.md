# Architettura del Framework MVC

## Panoramica

Challenge App MVC è un framework leggero basato sull'architettura Model-View-Controller. Seguendo il principio della separazione delle responsabilità, il codice è organizzato in componenti distinti:

- **Model**: Gestisce la logica dei dati e l'accesso al database
- **View**: Presenta i dati all'utente
- **Controller**: Gestisce la logica dell'applicazione e coordina Model e View

## Core Framework

### Database (Singleton Pattern)

```php
// core/Database.php
```

**Responsabilità:**
- Gestire una singola connessione PDO al database
- Implementare il pattern Singleton per evitare connessioni multiple
- Fornire una interfaccia semplice per accedere alla connessione

**Utilizzo:**
```php
use App\Core\Database;

$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$result = $stmt->fetch();
```

### Router

```php
// core/Router.php
```

**Responsabilità:**
- Mappare le rotte HTTP ai controller e ai metodi corrispondenti
- Supportare parametri dinamici nelle rotte (es. `/challenge/{id}`)
- Gestire i diversi metodi HTTP (GET, POST, PUT, DELETE)
- Eseguire il dispatch della richiesta

**Utilizzo:**
```php
$router->get('/rotta', 'ControllerName@methodName');
$router->post('/rotta', 'ControllerName@methodName');
$router->get('/rotta/{id}', 'ControllerName@methodName');

$router->dispatch();
```

### Controller Base

```php
// core/Controller.php
```

**Responsabilità:**
- Fornire metodi helper per il rendering di view
- Gestire il reindirizzamento
- Gestire le risposte JSON
- Gestire gli errori HTTP

**Metodi Disponibili:**
```php
// Renderizza una view con dati
$this->render('view.name', ['key' => 'value']);

// Reindirizza a un percorso
$this->redirect('/dashboard');

// Ritorna JSON
$this->json(['status' => 'ok'], 200);

// Ritorna un errore
$this->abort(404, 'Not found');
```

### Model Base

```php
// core/Model.php
```

**Responsabilità:**
- Fornire metodi CRUD (Create, Read, Update, Delete)
- Semplificare l'accesso al database
- Implementare pattern repository

**Metodi Disponibili:**
```php
$model->all();                    // Tutti i record
$model->find($id);                // Record per ID
$model->create($data);            // Crea nuovo record
$model->update($id, $data);       // Aggiorna record
$model->delete($id);              // Elimina record
$model->query($sql, $params);     // Query personalizzata
$model->queryOne($sql, $params);  // Query singolo risultato
```

## Application Layer

### Controller

**Posizione:** `app/Controllers/`

**Struttura:**
```php
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\SomeModel;

class YourController extends Controller
{
    public function action()
    {
        // Logica dell'applicazione
        $model = new SomeModel();
        $data = $model->all();
        
        // Renderizza view
        $this->render('folder.view', ['data' => $data]);
    }
}
```

**Responsabilità:**
- Ricevere le richieste HTTP
- Validare l'input
- Coordinare Model e View
- Gestire l'autenticazione e l'autorizzazione

### Model

**Posizione:** `app/Models/`

**Struttura:**
```php
<?php
namespace App\Models;

use App\Core\Model;

class YourModel extends Model
{
    protected string $table = 'your_table';
    
    public function customMethod()
    {
        return $this->query(
            "SELECT * FROM {$this->table} WHERE condition = ?",
            [$param]
        );
    }
}
```

**Responsabilità:**
- Definire la tabella del database
- Implementare query personalizzate
- Fornire metodi di accesso ai dati
- Implementare la logica di business

### View

**Posizione:** `app/Views/`

**Struttura:**
```php
<?php $title = 'Page Title'; require __DIR__ . '/../layouts/header.php'; ?>

<!-- Contenuto della view -->

<?php require __DIR__ . '/../layouts/footer.php'; ?>
```

**Responsabilità:**
- Presentare i dati all'utente
- Implementare la logica di presentazione
- Utilizzare HTML e CSS per il layout

## Flusso di una Richiesta

```
1. Richiesta HTTP → public/index.php (Front Controller)
                      ↓
2. Router analizza la rotta
                      ↓
3. Controller corrispondente viene istanziato
                      ↓
4. Metodo del Controller viene eseguito
                      ↓
5. Controller utilizza Model per accedere ai dati
                      ↓
6. Model esegue query al database
                      ↓
7. View viene renderizzata con i dati
                      ↓
8. Risposta HTML viene inviata al browser
```

## Best Practice

### Naming Convention

- **Controllers:** `NameController.php` (es. `UserController.php`)
- **Models:** `Name.php` (es. `User.php`)
- **Views:** `folder/name.php` (es. `user/profile.php`)
- **Metodi Controller:** camelCase (es. `getUserProfile()`)
- **Proprietà:** snake_case (es. `$user_id`)

### Code Organization

```
Controllers
├── Autenticazione
├── Gestione Utenti
└── Gestione Risorse

Models
├── User
├── Challenge
└── Altro

Views
├── Layouts (header, footer)
├── Auth (login, register)
├── Dashboard
└── Admin
```

### Security

1. **Input Validation**
   - Valida sempre l'input dell'utente
   - Usa `filter_var()` per validare
   - Usa `htmlspecialchars()` per escapare l'output

2. **SQL Injection Protection**
   - Usa prepared statements
   - Non concatenare mai variabili SQL
   - Usa placeholder `?` nelle query

3. **Password Security**
   - Usa `password_hash()` per salvare le password
   - Usa `password_verify()` per verificare le password
   - Non salvare mai password in plaintext

4. **CSRF Protection**
   - Implementa token CSRF per i form
   - Valida il token prima di processare i dati

### Performance

1. **Database**
   - Usa indici sulle colonne frequentemente ricercate
   - Evita query N+1
   - Usa query ottimizzate

2. **Caching**
   - Cache i risultati di query frequenti
   - Cache le view compilate

3. **Lazy Loading**
   - Carica i dati solo quando necessario
   - Usa pagination per grandi dataset

## Estensione del Framework

### Aggiungere Middleware

```php
// Crea un middleware
class AuthMiddleware
{
    public function handle($request)
    {
        if (!isset($_SESSION['user_id'])) {
            redirect('/login');
        }
    }
}
```

### Aggiungere Helper Functions

```php
// config/helpers.php
function redirect($path)
{
    header("Location: $path");
    exit;
}

function view($name, $data = [])
{
    extract($data);
    require __DIR__ . "/../app/Views/$name.php";
}
```

### Aggiungere Validazione

```php
class Validator
{
    public static function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            // Implementa la validazione
        }
        return $errors;
    }
}
```

## Documentazione Aggiuntiva

- **README.md** - Panoramica generale del progetto
- **INSTALLATION.md** - Guida di installazione
- **database.sql** - Script di creazione del database

## Supporto e Contributi

Per domande o contributi, contatta il maintainer del progetto.

---

**Versione:** 1.0  
**Ultimo Aggiornamento:** 2026-09-06
