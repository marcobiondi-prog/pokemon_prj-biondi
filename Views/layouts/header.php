<?php
$navUser = function_exists('getCurrentUser') ? getCurrentUser() : null;
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title ?? 'Challenge App'); ?></title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/assets/css/style.css?v=26">
</head>
<body>
    <div class="pokedex-frame">
    <div class="pokedex-body">
    <nav class="navbar">
        <div class="container">
            <?php if ($navUser): ?>
                <div class="user-menu">
                    <button type="button" class="user-menu-toggle">
                        <span class="user-avatar"><?php echo htmlspecialchars(strtoupper(substr($navUser['name'] ?? 'U', 0, 1))); ?></span>
                        <?php echo htmlspecialchars($navUser['name'] ?? 'Utente'); ?>
                        <svg class="caret" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div class="user-menu-dropdown">
                        <a href="/pokemon/lan_challenge-/public/" class="user-menu-item">
                            <span class="user-menu-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20a8 8 0 1 0-8-8"></path><path d="M12 12 8 10"></path><path d="M12 12V6"></path></svg>
                            </span>
                            Dashboard
                        </a>
                        <a href="/pokemon/lan_challenge-/public/?url=challenges/create" class="user-menu-item">
                            <span class="user-menu-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 8v8"></path><path d="M8 12h8"></path></svg>
                            </span>
                            Crea Challenge
                        </a>
                        <a href="/pokemon/lan_challenge-/public/?url=user/profile" class="user-menu-item">
                            <span class="user-menu-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </span>
                            Il Mio Profilo
                        </a>
                        <div class="user-menu-divider"></div>
                        <a href="/pokemon/lan_challenge-/public/?url=logout" class="user-menu-item logout">
                            <span class="user-menu-item-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                            </span>
                            Esci
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <ul class="nav-menu">
                    <li><a href="/pokemon/lan_challenge-/public/?url=login">Login</a></li>
                    <li><a href="/pokemon/lan_challenge-/public/?url=register">Register</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>

    <main class="container">
