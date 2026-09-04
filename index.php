<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Challenge LAN</title>

    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <header class="navbar">
        <div class="container nav-content">

            <div class="logo">
                🏆 Challenge LAN
            </div>

            <nav>
                <a href="index.php">Home</a>
                <a href="login.php">Accedi</a>
                <a href="register.php" class="nav-button">
                    Registrati
                </a>
            </nav>

        </div>
    </header>


    <main>

        <!-- HERO -->

        <section class="hero">

            <div class="container hero-content">

                <span class="badge">
                    🌐 Piattaforma LAN
                </span>

                <h1>
                    Benvenuto in<br>
                    <span>Challenge LAN</span>
                </h1>

                <p class="hero-description">
                    Una piattaforma dove puoi creare, condividere
                    e affrontare sfide con i tuoi compagni di classe.
                </p>

                <div class="hero-buttons">

                    <a href="register.php" class="btn btn-primary">
                        🚀 Crea il tuo account
                    </a>

                    <a href="login.php" class="btn btn-secondary">
                        🔐 Accedi
                    </a>

                </div>

            </div>

        </section>


        <!-- COME FUNZIONA -->

        <section class="how-section">

            <div class="container">

                <div class="section-title">

                    <span class="section-label">
                        COME FUNZIONA
                    </span>

                    <h2>
                        Tutto parte da qui
                    </h2>

                    <p>
                        Registrati, accedi alla piattaforma e preparati
                        a creare le tue prime sfide.
                    </p>

                </div>


                <div class="cards">

                    <div class="card">

                        <div class="card-icon">
                            👤
                        </div>

                        <h3>
                            1. Registrati
                        </h3>

                        <p>
                            Crea il tuo account utilizzando username,
                            email e password.
                        </p>

                        <a href="register.php">
                            Crea account →
                        </a>

                    </div>


                    <div class="card">

                        <div class="card-icon">
                            🔐
                        </div>

                        <h3>
                            2. Accedi
                        </h3>

                        <p>
                            Effettua il login per entrare nella tua
                            area personale.
                        </p>

                        <a href="login.php">
                            Vai al login →
                        </a>

                    </div>


                    <div class="card">

                        <div class="card-icon">
                            🏆
                        </div>

                        <h3>
                            3. Crea una sfida
                        </h3>

                        <p>
                            Presto potrai creare sfide e condividerle
                            con tutti gli utenti della rete.
                        </p>

                        <span class="coming-soon">
                            IN ARRIVO
                        </span>

                    </div>

                </div>

            </div>

        </section>


        <!-- LAN -->

        <section class="lan-section">

            <div class="container">

                <div class="lan-box">

                    <div>

                        <span class="section-label">
                            RETE LOCALE
                        </span>

                        <h2>
                            Un server, tanti computer.
                        </h2>

                        <p>
                            Il progetto funziona all'interno della rete LAN
                            della classe. Tutti gli studenti accedono allo
                            stesso server tramite il browser.
                        </p>

                    </div>

                    <div class="network">

                        <div class="network-item">
                            💻
                            <span>PC Studente</span>
                        </div>

                        <div class="arrow">
                            →
                        </div>

                        <div class="network-item server">
                            🖥️
                            <span>SERVER</span>
                        </div>

                        <div class="arrow">
                            →
                        </div>

                        <div class="network-item">
                            💻
                            <span>PC Studente</span>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- CALL TO ACTION -->

        <section class="cta">

            <div class="container">

                <h2>
                    Sei pronto a iniziare?
                </h2>

                <p>
                    Crea il tuo account e preparati alle prossime sfide.
                </p>

                <a href="register.php" class="btn btn-primary">
                    Registrati gratuitamente →
                </a>

            </div>

        </section>

    </main>


    <footer>

        <div class="container footer-content">

            <div>
                🏆 <strong>Challenge LAN</strong>
            </div>

            <div>
                Progetto didattico PHP • LAN
            </div>

        </div>

    </footer>

</body>
</html>
```
