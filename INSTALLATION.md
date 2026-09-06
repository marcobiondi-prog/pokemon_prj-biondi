# Guida di Installazione - Challenge App MVC

## Step 1: Copia il file di configurazione dell'ambiente

```bash
cp .env.example .env
```

## Step 2: Modifica le credenziali del database

Apri `.env` e modifica le credenziali:

```
DB_HOST=localhost
DB_NAME=challenge_app_mvc
DB_USER=root
DB_PASS=tuapassword
```

## Step 3: Crea il database e le tabelle

Apri phpMyAdmin (http://localhost/phpmyadmin) o usa il terminale MySQL:

```sql
CREATE DATABASE challenge_app_mvc DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE challenge_app_mvc;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE challenges (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT,
    user_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Step 4: Configura Apache

### Opzione A: File di configurazione virtuale
Crea un nuovo virtual host in `conf/extra/httpd-vhosts.conf`:

```apache
<VirtualHost *:80>
    ServerName challenge-app.local
    DocumentRoot "c:/xampp/htdocs/pokemon/lan_challenge-/public"
    
    <Directory "c:/xampp/htdocs/pokemon/lan_challenge-/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Aggiungi a `hosts` (C:\Windows\System32\drivers\etc\hosts):
```
127.0.0.1   challenge-app.local
```

### Opzione B: URL diretto (già configurato)
Se usi il setup attuale, accedi tramite:
```
http://localhost/pokemon/lan_challenge-/public/
```

## Step 5: Verifica mod_rewrite
Assicurati che Apache abbia mod_rewrite abilitato. In XAMPP:

1. Apri `apache/conf/httpd.conf`
2. Cerca: `LoadModule rewrite_module modules/mod_rewrite.so`
3. Se ha `#` davanti, rimuovilo
4. Riavvia Apache

## Step 6: Accedi all'applicazione

```
http://challenge-app.local  (se usato l'opzione A)
oppure
http://localhost/pokemon/lan_challenge-/public/  (opzione B)
```

## Primo Login

L'applicazione reindirizza al login. Registrati con:
- Email: test@example.com
- Password: password123

## Troubleshooting

### Errore 404
- Verifica che `.htaccess` sia in `public/` e contenga le regole di rewrite
- Verifica che mod_rewrite sia abilitato in Apache
- Controlla che `AllowOverride All` sia impostato nel virtual host

### Errore di connessione al database
- Verifica le credenziali in `config/database.php` o `.env`
- Verifica che MySQL sia in esecuzione
- Verifica che il database `challenge_app_mvc` esista

### Errore "Class not found"
- Verifica che i file siano nella directory corretta secondo la struttura
- Verifica lo spelling del namespace nei file

### Sessioni non funzionano
- Verifica che `session_start()` sia al primo riga in `public/index.php`
- Verifica i permessi delle directory temporanee di PHP

## Struttura Directory da Verificare

```
public/
├── index.php          ← Front controller
├── .htaccess          ← Configurazione rewrite
└── assets/
    └── css/
        └── style.css

app/
├── Controllers/       ← I tuoi controller
├── Models/           ← I tuoi model
└── Views/            ← Le tue view
    ├── layouts/
    ├── auth/
    ├── dashboard/
    └── challenges/

core/                 ← Framework MVC (non modificare)
├── Database.php
├── Router.php
├── Controller.php
└── Model.php

config/
└── database.php      ← Configurazione DB
```

## Next Steps

1. Aggiungi nuove rotte in `public/index.php`
2. Crea nuovi controller estendendo `App\Core\Controller`
3. Crea nuovi model estendendo `App\Core\Model`
4. Crea view in `app/Views/`

Buon lavoro! 🚀
