<?php

namespace App\Models;

use App\Core\Model;

class Ticket extends Model
{
    protected string $table = 'tickets';

    public function buy(int $userId, int $sessionId, string $seatNumber): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO tickets (user_id, cinema_session_id, seat_number)
             VALUES (:uid, :sid, :seat)"
        );
        return $stmt->execute([
            ':uid'  => $userId,
            ':sid'  => $sessionId,
            ':seat' => $seatNumber,
        ]);
    }

    public function findByUser(int $userId): array
    {
        $stmt = $this->db->prepare(
            "SELECT t.*, cs.datetime, cs.room, cs.price,
                    m.title AS movie_title, m.poster_url
             FROM tickets t
             INNER JOIN cinema_sessions cs ON cs.id = t.cinema_session_id
             INNER JOIN movies m ON m.id = cs.movie_id
             WHERE t.user_id = :uid
             ORDER BY t.purchased_at DESC"
        );
        $stmt->execute([':uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function belongsToUser(int $id, int $userId): bool
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM tickets WHERE id = :id AND user_id = :uid"
        );
        $stmt->execute([':id' => $id, ':uid' => $userId]);
        return (bool) $stmt->fetch();
    }

    public function findWithSession(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT t.*, t.cinema_session_id
             FROM tickets t
             WHERE t.id = :id"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}
