<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Core\Csrf;
use App\Models\Ticket;
use App\Models\CinemaSession;

class TicketController extends Controller
{
    public function buyForm(string $sessionId): void
    {
        $this->requireAuth();

        $sessionModel = new CinemaSession();
        $sessao       = $sessionModel->findByIdWithMovie((int) $sessionId);

        if (!$sessao || $sessao['available_seats'] <= 0) {
            $this->redirect('/sessions');
        }

        $csrf_field = Csrf::field();
        $this->render('tickets.buy', compact('sessao', 'csrf_field'));
    }

    public function buy(): void
    {
        $this->requireAuth();
        Csrf::check();

        $userId    = Session::get('user_id');
        $sessionId = (int) ($_POST['session_id'] ?? 0);
        $seat      = trim($_POST['seat_number'] ?? '');

        if ($sessionId <= 0 || $seat === '') {
            $this->redirect('/sessions');
        }

        $sessionModel = new CinemaSession();
        $ticketModel  = new Ticket();

        $ok = $sessionModel->decrementSeat($sessionId);

        if ($ok) {
            $ticketModel->buy($userId, $sessionId, $seat);
            $this->redirect('/tickets');
        } else {
            $this->redirect("/tickets/buy/{$sessionId}");
        }
    }

    public function myTickets(): void
    {
        $this->requireAuth();

        $userId      = Session::get('user_id');
        $ticketModel = new Ticket();
        $ingressos   = $ticketModel->findByUser($userId);

        $this->render('tickets.my-tickets', compact('ingressos'));
    }

    public function cancel(string $id): void
    {
        $this->requireAuth();
        Csrf::check();

        $userId      = Session::get('user_id');
        $ticketModel = new Ticket();
        $ticket      = $ticketModel->findWithSession((int) $id);

        if ($ticket && $ticketModel->belongsToUser((int) $id, $userId)) {
            $sessionModel = new CinemaSession();
            $sessionModel->incrementSeat($ticket['cinema_session_id']);
            $ticketModel->delete((int) $id);
        }

        $this->redirect('/tickets');
    }
}
