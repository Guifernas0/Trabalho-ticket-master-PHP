<section class="container">
    <a href="<?= url('/movies') ?>" class="back-link">← Voltar para Filmes</a>

    <div class="movie-detail">
        <?php if (!empty($filme['poster_url'])): ?>
            <img src="<?= htmlspecialchars($filme['poster_url']) ?>"
                 alt="<?= htmlspecialchars($filme['title']) ?>"
                 class="movie-poster">
        <?php endif; ?>

        <div class="movie-detail-info">
            <h2><?= htmlspecialchars($filme['title']) ?></h2>
            <p><strong>Gênero:</strong> <?= htmlspecialchars($filme['genre'] ?? '') ?></p>
            <p><strong>Duração:</strong> <?= (int)($filme['duration_min'] ?? 0) ?> minutos</p>
            <p><strong>Avaliação média:</strong>
                <?= $media !== null ? number_format($media, 1, ',', '.') . ' / 5' : 'Sem avaliações' ?>
            </p>
            <p><?= nl2br(htmlspecialchars($filme['description'] ?? '')) ?></p>

            <?php if (!empty($sessoes)): ?>
                <h3>Sessões Disponíveis</h3>
                <ul class="sessions-list">
                    <?php foreach ($sessoes as $s): ?>
                        <li>
                            <?= date('d/m/Y H:i', strtotime($s['datetime'])) ?>
                            — Sala <?= htmlspecialchars($s['room']) ?>
                            — R$ <?= number_format($s['price'], 2, ',', '.') ?>
                            — <?= $s['available_seats'] ?> lugar(es)
                            <a href="<?= url('/tickets/buy/' . $s['id']) ?>" class="btn btn-sm">Comprar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="empty-msg">Sem sessões disponíveis no momento.</p>
            <?php endif; ?>

            <a href="<?= url('/reviews/form/' . $filme['id']) ?>" class="btn" style="margin-top:16px;">
                Avaliar este filme
            </a>
        </div>
    </div>

    <hr class="divider">

    <h3>Avaliações</h3>

    <?php if (empty($avaliacoes)): ?>
        <p class="empty-msg">Nenhuma avaliação ainda. Seja o primeiro!</p>
    <?php else: ?>
        <div class="reviews-list">
            <?php foreach ($avaliacoes as $av): ?>
                <div class="review-card">
                    <div class="review-header">
                        <strong><?= htmlspecialchars($av['nome_usuario']) ?></strong>
                        <span class="stars"><?= str_repeat('★', (int)$av['rating']) ?><?= str_repeat('☆', 5 - (int)$av['rating']) ?></span>
                    </div>
                    <p><?= nl2br(htmlspecialchars($av['comment'])) ?></p>
                    <?php if (\App\Core\Session::get('user_id') == $av['user_id']): ?>
                        <form method="POST" action="<?= url('/reviews/delete/' . $av['id']) ?>"
                              onsubmit="return confirm('Remover avaliação?')">
                            <?= $csrf_field ?>
                            <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
