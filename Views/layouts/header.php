<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Challenge App'; ?></title>
    <link rel="stylesheet" href="/pokemon/lan_challenge-/public/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <h1 class="navbar-brand">Challenge App</h1>
            <ul class="nav-menu">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/pokemon/lan_challenge-/dashboard">Dashboard</a></li>
                    <li><a href="/pokemon/lan_challenge-/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/pokemon/lan_challenge-/login">Login</a></li>
                    <li><a href="/pokemon/lan_challenge-/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main class="container">
