<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Challenge App</title>
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
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo htmlspecialchars($_SESSION['success']);
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div class="dashboard">
            <h2>Benvenuto, <?php echo htmlspecialchars($user['name'] ?? 'Utente'); ?>!</h2>

            <div class="dashboard-actions">
                <a href="/pokemon/lan_challenge-/public/?url=challenges/create" class="btn btn-primary">
                    + Crea Nuova Challenge
                </a>
            </div>

            <h3>Le Tue Challenge</h3>

            <?php if (empty($challenges)): ?>
                <div class="alert alert-info">
                    <p>Non hai ancora creato nessuna challenge.</p>
                    <p><a href="/pokemon/lan_challenge-/public/?url=challenges/create">Creane una ora</a></p>
                </div>
            <?php else: ?>
                <div class="challenges-grid">
                    <?php foreach ($challenges as $challenge): ?>
                        <div class="challenge-card">
                            <h4><?php echo htmlspecialchars($challenge['title']); ?></h4>
                            <p><?php echo htmlspecialchars($challenge['description']); ?></p>
                            <p class="challenge-date">Creato il: <?php echo htmlspecialchars($challenge['created_at']); ?></p>
                            <a href="#" class="btn btn-secondary">Visualizza</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2026 Challenge App. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
