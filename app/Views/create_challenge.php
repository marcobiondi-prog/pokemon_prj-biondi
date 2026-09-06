<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crea Challenge - Challenge App</title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/public/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="navbar-brand">Challenge App</h1>
            <ul class="nav-menu">
                <li><a href="/pokemon/lan_challenge-/public/">Dashboard</a></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=challenges/create">Crea Challenge</a></li>
                <li><strong><?php echo htmlspecialchars($user['name'] ?? 'Utente'); ?></strong></li>
                <li><a href="/pokemon/lan_challenge-/public/?url=logout">Logout</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <div class="challenge-form">
            <h2>Crea una Nuova Challenge</h2>

            <form method="POST" action="?url=challenges/store" class="form">
                <div class="form-group">
                    <label for="title">Titolo</label>
                    <input type="text" id="title" name="title" required class="form-control" placeholder="Es. Chi è il più veloce?">
                </div>

                <div class="form-group">
                    <label for="description">Descrizione</label>
                    <textarea id="description" name="description" required class="form-control" rows="6" placeholder="Descrivi la tua challenge..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Crea Challenge</button>
                    <a href="/pokemon/lan_challenge-/public/" class="btn btn-secondary">Annulla</a>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
