#!/bin/bash
# Setup Script per Challenge App MVC

echo "================================"
echo "Challenge App MVC - Setup Script"
echo "================================"
echo ""

# Coppia il file .env
if [ ! -f .env ]; then
    echo "📋 Creazione file .env..."
    cp .env.example .env
    echo "✅ File .env creato. Modifica le credenziali del database."
else
    echo "✅ File .env già presente"
fi

# Verifica directory vendor
if [ ! -d vendor ]; then
    echo "📦 Creazione directory vendor..."
    mkdir -p vendor
fi

# Verifica file autoload
if [ ! -f vendor/autoload.php ]; then
    echo "⚙️  Creazione autoloader..."
    mkdir -p vendor
    cat > vendor/autoload.php << 'EOF'
<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    if (strpos($class, $prefix) === 0) {
        $relative_class = substr($class, strlen($prefix));
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

        if (file_exists($file)) {
            require $file;
        }
    }
});
EOF
    echo "✅ Autoloader creato"
fi

# Crea directory temporanea
if [ ! -d tmp ]; then
    echo "📁 Creazione directory tmp..."
    mkdir -p tmp
    chmod 777 tmp
fi

echo ""
echo "================================"
echo "✨ Setup completato!"
echo "================================"
echo ""
echo "Prossimi step:"
echo "1. Modifica .env con le tue credenziali DB"
echo "2. Importa database.sql nel tuo database"
echo "3. Accedi a http://localhost/pokemon/lan_challenge-/public/"
echo ""
echo "📖 Leggi INSTALLATION.md per ulteriori dettagli"
echo ""
