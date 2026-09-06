<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    public function findByEmail(string $email): array|false
    {
        return $this->queryOne("SELECT * FROM {$this->table} WHERE email = ?", [$email]);
    }

    public function findByEmailAndPassword(string $email, string $password): array|false
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}
