<?php

namespace App\Models;

use App\Core\Model;

class CinemaSession extends Model
{
    protected string $table = 'cinema_sessions';

    public function findAllWithMovie(): array
    {
        $stmt = $this->db->query(
            "SELECT cs.*, m.title AS movie_title, m.poster_url
             FROM cinema_sessions cs
             INNER JOIN movies m ON m.id = cs.movie_id
             ORDER BY cs.datetime ASC"
        );
        return $stmt->fetchAll();
    }

    public function findByIdWithMovie(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT cs.*, m.title AS movie_title, m.genre, m.duration_min, m.poster_url, m.description
             FROM cinema_sessions cs
             INNER JOIN movies m ON m.id = cs.movie_id
             WHERE cs.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function findByMovie(int $movieId): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM cinema_sessions
             WHERE movie_id = :mid AND available_seats > 0
             ORDER BY datetime ASC"
        );
        $stmt->execute([':mid' => $movieId]);
        return $stmt->fetchAll();
    }

    public function decrementSeat(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE cinema_sessions
             SET available_seats = available_seats - 1
             WHERE id = :id AND available_seats > 0"
        );
        return $stmt->execute([':id' => $id]) && $stmt->rowCount() > 0;
    }

    public function incrementSeat(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE cinema_sessions
             SET available_seats = available_seats + 1
             WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
