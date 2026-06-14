<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected string $table = 'users';

    public function criarUsuario(string $nome, string $email, string $senha): bool
    {
        $sql = "INSERT INTO users (name, email, password_hash) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome'  => $nome,
            ':email' => $email,
            ':senha' => password_hash($senha, PASSWORD_DEFAULT),
        ]);
    }

    public function buscarPorEmail(string $email): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
}
