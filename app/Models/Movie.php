<?php

namespace App\Models;

use App\Core\Model;

class Movie extends Model
{
    protected string $table = 'movies';

    public function search(string $busca): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM movies
             WHERE title LIKE :b OR genre LIKE :b
             ORDER BY id DESC"
        );
        $stmt->execute([':b' => "%{$busca}%"]);
        return $stmt->fetchAll();
    }

    public function findAllOrdered(): array
    {
        $stmt = $this->db->query("SELECT * FROM movies ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function create(string $title, ?string $description, ?string $genre, ?int $duration, ?string $poster): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO movies (title, description, genre, duration_min, poster_url)
             VALUES (:title, :description, :genre, :duration, :poster)"
        );
        return $stmt->execute([
            ':title'       => $title,
            ':description' => $description,
            ':genre'       => $genre,
            ':duration'    => $duration,
            ':poster'      => $poster,
        ]);
    }
}
