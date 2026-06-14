<?php

namespace App\Models;

use App\Core\Model;

class Review extends Model
{
    protected string $table = 'reviews';

    public function findByMovie(int $movieId): array
    {
        $stmt = $this->db->prepare(
            "SELECT reviews.*, users.name AS nome_usuario
             FROM reviews
             INNER JOIN users ON users.id = reviews.user_id
             WHERE reviews.movie_id = :mid
             ORDER BY reviews.id DESC"
        );
        $stmt->execute([':mid' => $movieId]);
        return $stmt->fetchAll();
    }

    public function averageByMovie(int $movieId): ?float
    {
        $stmt = $this->db->prepare(
            "SELECT AVG(rating) AS media FROM reviews WHERE movie_id = :mid"
        );
        $stmt->execute([':mid' => $movieId]);
        $row = $stmt->fetch();
        return $row['media'] !== null ? (float) $row['media'] : null;
    }

    public function store(int $userId, int $movieId, int $rating, string $comment): bool
    {
        $rating = max(1, min(5, $rating));
        $stmt = $this->db->prepare(
            "INSERT INTO reviews (user_id, movie_id, rating, comment)
             VALUES (:uid, :mid, :rating, :comment)"
        );
        return $stmt->execute([
            ':uid'     => $userId,
            ':mid'     => $movieId,
            ':rating'  => $rating,
            ':comment' => $comment,
        ]);
    }

    public function belongsToUser(int $id, int $userId): bool
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM reviews WHERE id = :id AND user_id = :uid"
        );
        $stmt->execute([':id' => $id, ':uid' => $userId]);
        return (bool) $stmt->fetch();
    }
}
