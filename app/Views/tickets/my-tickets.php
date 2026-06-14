<section class="container">
    <h2>Meus Ingressos</h2>

    <?php if (empty($ingressos)): ?>
        <p class="empty-msg">Você ainda não comprou nenhum ingresso.</p>
        <a href="/sessions" class="btn">Ver Sessões</a>
    <?php else: ?>
        <div class="tickets-list">
            <?php foreach ($ingressos as $t): ?>
                <div class="ticket-card">
                    <?php if (!empty($t['poster_url'])): ?>
                        <img src="<?= htmlspecialchars($t['poster_url']) ?>"
                             alt="<?= htmlspecialchars($t['movie_title']) ?>">
                    <?php endif; ?>
                    <div class="ticket-info">
                        <h4><?= htmlspecialchars($t['movie_title']) ?></h4>
                        <p><strong>Data/Hora:</strong> <?= date('d/m/Y H:i', strtotime($t['datetime'])) ?></p>
                        <p><strong>Sala:</strong> <?= htmlspecialchars($t['room']) ?></p>
                        <p><strong>Assento:</strong> <?= htmlspecialchars($t['seat_number']) ?></p>
                        <p><strong>Preço pago:</strong> R$ <?= number_format($t['price'], 2, ',', '.') ?></p>
                        <p><strong>Comprado em:</strong> <?= date('d/m/Y H:i', strtotime($t['purchased_at'])) ?></p>

                        <form method="POST" action="/tickets/cancel/<?= $t['id'] ?>"
                              onsubmit="return confirm('Cancelar este ingresso?')">
                            <?= \App\Core\Csrf::field() ?>
                            <button type="submit" class="btn btn-danger btn-sm">Cancelar Ingresso</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
