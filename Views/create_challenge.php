<?php $title = 'Crea Challenge - Challenge App'; $hideNavUserMenu = true; require __DIR__ . '/layouts/header.php'; ?>
        <div class="challenge-form">
            <div class="dex-topbar">
                <div class="dex-tab dex-tab-user">
                    <?php include __DIR__ . '/layouts/account-tab.php'; ?>
                </div>
            </div>

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

                <div class="form-group">
                    <label for="challenged_id">Chi vuoi sfidare?</label>
                    <select id="challenged_id" name="challenged_id" required class="form-control">
                        <option value="">Seleziona un avversario</option>
                        <?php foreach ($opponents as $opponent): ?>
                            <option value="<?php echo (int) $opponent['id']; ?>">
                                <?php echo htmlspecialchars($opponent['name'] . ' ' . $opponent['cognome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Crea Challenge</button>
                    <a href="/pokemon/lan_challenge-/public/" class="btn btn-secondary">Annulla</a>
                </div>
            </form>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
