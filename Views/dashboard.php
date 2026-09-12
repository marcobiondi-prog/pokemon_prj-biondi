<?php $title = 'Dashboard - Challenge App'; $hideNavUserMenu = true; require __DIR__ . '/layouts/header.php'; ?>
        <div class="dashboard">
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

            <div class="dex-topbar">
                <a href="/pokemon/lan_challenge-/public/?url=challenges/create" class="dex-icon-btn" title="Crea nuova challenge" aria-label="Crea nuova challenge">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"></path><path d="M5 12h14"></path></svg>
                </a>
                <div class="dex-tab dex-tab-user">
                    <?php include __DIR__ . '/layouts/account-tab.php'; ?>
                </div>
                <div class="dex-count"><?php echo count($challenges); ?></div>
            </div>

            <?php if (empty($challenges)): ?>
                <div class="alert alert-info">
                    <p>Non hai ancora creato nessuna challenge.</p>
                    <p><a href="/pokemon/lan_challenge-/public/?url=challenges/create">Creane una ora</a></p>
                </div>
            <?php else: ?>
                <div class="dex-list">
                    <?php foreach ($challenges as $challenge):
                        $isAccepted = ($challenge['status'] ?? 'pending') === 'accepted';
                        $progress = $isAccepted ? 100 : 50;
                        $statusLabel = $isAccepted ? 'Accettata' : 'In attesa';
                        $opponent = getOpponent($challenge, (int) $user['id']);
                        $initials = strtoupper(substr($opponent['name'] ?? '?', 0, 1) . substr($opponent['cognome'] ?? '', 0, 1));
                    ?>
                        <div class="dex-row">
                            <div class="dex-row-info">
                                <h4 class="dex-row-title"><?php echo htmlspecialchars($challenge['title']); ?></h4>
                                <div class="dex-row-sub"><?php echo htmlspecialchars($statusLabel); ?> · <?php echo htmlspecialchars(explode(' ', $challenge['created_at'])[0]); ?></div>
                                <div class="dex-progress">
                                    <div class="dex-progress-fill" style="width: <?php echo (int) $progress; ?>%"></div>
                                </div>
                                <div class="dex-row-actions">
                                    <a href="#" class="dex-action-btn">Visualizza</a>
                                    <form method="POST" action="?url=challenges/delete" onsubmit="return confirm('Eliminare questa challenge?');">
                                        <input type="hidden" name="challenge_id" value="<?php echo (int) $challenge['id']; ?>">
                                        <button type="submit" class="dex-action-btn dex-action-danger">Elimina</button>
                                    </form>
                                </div>
                            </div>
                            <div class="dex-row-visual">
                                <span class="dex-avatar"><?php echo htmlspecialchars($initials); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
<?php require __DIR__ . '/layouts/footer.php'; ?>
