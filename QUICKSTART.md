# 🚀 Quick Start - Challenge App MVC

## Primi Passi (5 minuti)

### 1️⃣ Copia il file di configurazione
```bash
cp .env.example .env
```
Modifica i valori con le tue credenziali MySQL.

### 2️⃣ Crea il database
Apri phpMyAdmin e importa `database.sql`, oppure esegui:
```bash
mysql -u root < database.sql
```

### 3️⃣ Accedi all'app
```
http://localhost/pokemon/lan_challenge-/public/
```

## 🏗️ Struttura Rapidissima

```
📁 app/
  ├── Controllers/     ← La tua logica (es: UserController)
  ├── Models/         ← Accesso DB (es: User extends Model)
  └── Views/          ← HTML (cartelle per ogni sezione)

📁 core/             ← Framework (non modificare)
  ├── Database.php    ← Connessione DB
  ├── Router.php      ← Rotte HTTP
  ├── Controller.php  ← Base controller
  └── Model.php       ← Base model

📁 public/           ← Unica cartella pubblica
  ├── index.php       ← Front controller
  ├── .htaccess       ← URL rewriting
  └── assets/         ← CSS, JS, img
```

## 🎯 Creare una Nuova Feature (5 minuti)

### Scenario: Creare un Controller per "Progetti"

#### 1. Crea il Model
**File:** `app/Models/Project.php`
```php
<?php
namespace App\Models;

use App\Core\Model;

class Project extends Model
{
    protected string $table = 'projects';
}
```

#### 2. Crea il Controller
**File:** `app/Controllers/ProjectController.php`
```php
<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = (new Project())->all();
        $this->render('projects.index', ['projects' => $projects]);
    }

    public function show(string $id)
    {
        $project = (new Project())->find((int)$id);
        if (!$project) {
            $this->abort(404);
        }
        $this->render('projects.show', ['project' => $project]);
    }
}
```

#### 3. Aggiungi le Rotte
**File:** `public/index.php` (aggiungi prima di `$router->dispatch()`)
```php
$router->get('/projects', 'ProjectController@index');
$router->get('/project/{id}', 'ProjectController@show');
```

#### 4. Crea la View
**File:** `app/Views/projects/index.php`
```php
<?php $title = 'Projects'; require __DIR__ . '/../layouts/header.php'; ?>

<h2>Progetti</h2>
<ul>
    <?php foreach ($projects as $project): ?>
        <li>
            <a href="/pokemon/lan_challenge-/project/<?php echo $project['id']; ?>">
                <?php echo htmlspecialchars($project['name']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
```

#### 5. Aggiungi la Tabella al Database
```sql
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

## 📝 Metodi Disponibili

### Nel Model
```php
$model = new YourModel();

$all = $model->all();                           // SELECT *
$one = $model->find(1);                         // SELECT WHERE id=1
$id = $model->create(['name' => 'test']);       // INSERT
$model->update(1, ['name' => 'new']);           // UPDATE
$model->delete(1);                              // DELETE
$custom = $model->query("SELECT ...", [$param]); // Custom query
```

### Nel Controller
```php
$this->render('folder.view', $data);   // Mostra una view
$this->redirect('/path');              // Reindirizza
$this->json(['data' => 'value']);      // Ritorna JSON
$this->abort(404, 'Not Found');        // Errore HTTP
```

## 🔐 Security Quick Tips

```php
// ✅ SEMPRE usare prepared statements
$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);

// ✅ Escapare l'output HTML
<?php echo htmlspecialchars($user_name); ?>

// ✅ Hash delle password
$hashed = password_hash($password, PASSWORD_BCRYPT);
$valid = password_verify($input, $hashed);

// ❌ NON fare questo:
$query = "SELECT * FROM users WHERE email = '$email'";  // SQL Injection!
```

## 🐛 Debugging

### Attiva il debug mode
**File:** `.env`
```
APP_DEBUG=true
```

### Stampa dati
```php
// Nel controller
echo '<pre>';
var_dump($data);
echo '</pre>';
die();

// Oppure più elegante
$this->json(['debug' => $data], 200);
```

## 📚 Documentazione Completa

- 📖 **README.md** - Panoramica completa
- 🔧 **INSTALLATION.md** - Guida dettagliata di setup
- 🏗️ **ARCHITECTURE.md** - Architettura del framework
- 📋 **database.sql** - Schema del database

## 🆘 Troubleshooting

| Problema | Soluzione |
|----------|-----------|
| 404 Not Found | Verifica `.htaccess` e che mod_rewrite sia abilitato |
| Errore DB | Controlla credenziali in `.env` e che MySQL sia online |
| Class not found | Verifica il namespace e la cartella sia corretta |
| Sessioni persi | Aggiungi `session_start()` all'inizio di `public/index.php` |

## ⚡ Prossime Feature Facili da Aggiungere

1. **Validazione Form** - Crea una classe `Validator`
2. **Middleware** - Blocca rotte per utenti non autenticati
3. **API REST** - Ritorna JSON dal controller
4. **Upload File** - Gestisci form multipart
5. **Paginazione** - Dividi query su più pagine

---

🎉 **Buon sviluppo!** Se hai dubbi, leggi ARCHITECTURE.md per capire meglio il flow.
