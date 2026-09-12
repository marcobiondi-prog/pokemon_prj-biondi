<?php

// Funzioni di utilità per autenticazione

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function getCurrentUser()
{
    return $_SESSION['user'] ?? null;
}

function login(string $email, string $password): bool
{
    // Dati di test (senza database)
    $users = [
        [
            'id' => 1,
            'email' => 'user@example.com',
            'password' => '123456', // In produzione: password_hash()
            'name' => 'Mario Rossi'
        ],
        [
            'id' => 2,
            'email' => 'test@test.com',
            'password' => 'test123',
            'name' => 'Test User'
        ]
    ];

    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email'],
                'name' => $user['name']
            ];
            return true;
        }
    }

    return false;
}

function logout(): void
{
    session_destroy();
}

function requireLogin(): void
{
    if (!isLoggedIn()) {
        header('Location: /pokemon/lan_challenge-/public/?url=login');
        exit;
    }
}

function redirectToDashboard(): void
{
    header('Location: /pokemon/lan_challenge-/public/');
    exit;
}

function redirectToLogin(): void
{
    header('Location: /pokemon/lan_challenge-/public/?url=login');
    exit;
}

// Funzioni di relazione User <-> Challenge (storage su file JSON)

function getAllUsersData(): array
{
    $users = [
        ['id' => 1, 'email' => 'user@example.com', 'password' => '123456', 'name' => 'Mario', 'cognome' => 'Rossi', 'telefono' => ''],
        ['id' => 2, 'email' => 'test@test.com', 'password' => 'test123', 'name' => 'Test', 'cognome' => 'User', 'telefono' => ''],
    ];

    $usersFile = __DIR__ . '/../users.json';
    if (file_exists($usersFile)) {
        $data = json_decode(file_get_contents($usersFile), true);
        if (is_array($data)) {
            $users = array_merge($users, $data);
        }
    }

    return $users;
}

function findUserById(int $id): ?array
{
    foreach (getAllUsersData() as $user) {
        if ((int) $user['id'] === $id) {
            return $user;
        }
    }

    return null;
}

function updateUserInStorage(int $userId, array $changes): bool
{
    $usersFile = __DIR__ . '/../users.json';
    $customUsers = [];

    if (file_exists($usersFile)) {
        $data = json_decode(file_get_contents($usersFile), true);
        if (is_array($data)) {
            $customUsers = $data;
        }
    }

    $updated = false;
    foreach ($customUsers as &$user) {
        if ((int) $user['id'] === $userId) {
            $user = array_merge($user, $changes);
            $updated = true;
            break;
        }
    }
    unset($user);

    if ($updated) {
        file_put_contents($usersFile, json_encode($customUsers, JSON_PRETTY_PRINT));
    }

    return $updated;
}

function getOtherUsers(int $excludeUserId): array
{
    return array_values(array_filter(
        getAllUsersData(),
        fn($user) => (int) $user['id'] !== $excludeUserId
    ));
}

function getChallengesFilePath(): string
{
    return __DIR__ . '/../challenges.json';
}

function getAllChallenges(): array
{
    $file = getChallengesFilePath();
    if (!file_exists($file)) {
        return [];
    }

    $data = json_decode(file_get_contents($file), true);

    return is_array($data) ? $data : [];
}

function saveChallenge(array $challenge): int
{
    $challenges = getAllChallenges();
    $challenge['id'] = count($challenges) > 0 ? max(array_column($challenges, 'id')) + 1 : 1;
    $challenges[] = $challenge;

    file_put_contents(getChallengesFilePath(), json_encode($challenges, JSON_PRETTY_PRINT));

    return $challenge['id'];
}

function updateChallenge(int $challengeId, array $changes): bool
{
    $challenges = getAllChallenges();

    foreach ($challenges as &$challenge) {
        if ((int) $challenge['id'] === $challengeId) {
            $challenge = array_merge($challenge, $changes);
            file_put_contents(getChallengesFilePath(), json_encode($challenges, JSON_PRETTY_PRINT));
            return true;
        }
    }

    return false;
}

function deleteChallenge(int $challengeId): bool
{
    $challenges = getAllChallenges();
    $remaining = array_values(array_filter(
        $challenges,
        fn($challenge) => (int) $challenge['id'] !== $challengeId
    ));

    if (count($remaining) === count($challenges)) {
        return false;
    }

    file_put_contents(getChallengesFilePath(), json_encode($remaining, JSON_PRETTY_PRINT));

    return true;
}

function findChallengeById(int $challengeId): ?array
{
    foreach (getAllChallenges() as $challenge) {
        if ((int) $challenge['id'] === $challengeId) {
            return $challenge;
        }
    }

    return null;
}

// Relazione: le challenge in cui l'utente è coinvolto, come sfidante o sfidato
function getChallengesByUser(int $userId): array
{
    return array_values(array_filter(
        getAllChallenges(),
        fn($challenge) => (int) $challenge['challenger_id'] === $userId || (int) $challenge['challenged_id'] === $userId
    ));
}

// Relazione: la challenge appartiene (belongsTo) all'utente che l'ha creata
function getChallengerUser(array $challenge): ?array
{
    return findUserById((int) $challenge['challenger_id']);
}

// Relazione: la challenge appartiene (belongsTo) all'utente sfidato
function getChallengedUser(array $challenge): ?array
{
    return findUserById((int) $challenge['challenged_id']);
}

// Relazione: dato un utente coinvolto in una challenge, trova l'avversario
function getOpponent(array $challenge, int $currentUserId): ?array
{
    if ((int) $challenge['challenger_id'] === $currentUserId) {
        return getChallengedUser($challenge);
    }

    return getChallengerUser($challenge);
}
