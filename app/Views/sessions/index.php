<section class="container">
    <h2>Sessões Disponíveis</h2>

    <?php if (empty($sessoes)): ?>
        <p class="empty-msg">Nenhuma sessão disponível no momento.</p>
    <?php else: ?>
        <div class="sessions-grid">
            <?php foreach ($sessoes as $s): ?>
                <div class="session-card">
                    <?php if (!empty($s['poster_url'])): ?>
                        <img src="<?= htmlspecialchars($s['poster_url']) ?>"
                             alt="<?= htmlspecialchars($s['movie_title']) ?>">
                    <?php endif; ?>
                    <div class="session-info">
                        <h4><?= htmlspecialchars($s['movie_title']) ?></h4>
                        <p><strong>Data/Hora:</strong> <?= date('d/m/Y H:i', strtotime($s['datetime'])) ?></p>
                        <p><strong>Sala:</strong> <?= htmlspecialchars($s['room']) ?></p>
                        <p><strong>Preço:</strong> R$ <?= number_format($s['price'], 2, ',', '.') ?></p>
                        <p><strong>Lugares:</strong> <?= $s['available_seats'] ?> disponíveis</p>
                        <div class="session-actions">
                            <a href="/sessions/<?= $s['id'] ?>" class="btn btn-outline btn-sm">Detalhes</a>
                            <?php if ($s['available_seats'] > 0): ?>
                                <a href="/tickets/buy/<?= $s['id'] ?>" class="btn btn-sm">Comprar</a>
                            <?php else: ?>
                                <span class="badge badge-danger">Esgotado</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
