<section class="container">
    <a href="/sessions" class="back-link">← Voltar para Sessões</a>

    <div class="movie-detail">
        <?php if (!empty($sessao['poster_url'])): ?>
            <img src="<?= htmlspecialchars($sessao['poster_url']) ?>"
                 alt="<?= htmlspecialchars($sessao['movie_title']) ?>"
                 class="movie-poster">
        <?php endif; ?>

        <div class="movie-detail-info">
            <h2><?= htmlspecialchars($sessao['movie_title']) ?></h2>
            <p><strong>Gênero:</strong> <?= htmlspecialchars($sessao['genre'] ?? '') ?></p>
            <p><strong>Duração:</strong> <?= (int)($sessao['duration_min'] ?? 0) ?> minutos</p>
            <p><?= nl2br(htmlspecialchars($sessao['description'] ?? '')) ?></p>

            <hr class="divider">

            <h3>Informações da Sessão</h3>
            <p><strong>Data/Hora:</strong> <?= date('d/m/Y H:i', strtotime($sessao['datetime'])) ?></p>
            <p><strong>Sala:</strong> <?= htmlspecialchars($sessao['room']) ?></p>
            <p><strong>Preço:</strong> R$ <?= number_format($sessao['price'], 2, ',', '.') ?></p>
            <p><strong>Lugares disponíveis:</strong> <?= $sessao['available_seats'] ?> / <?= $sessao['total_seats'] ?></p>

            <?php if ($sessao['available_seats'] > 0): ?>
                <a href="/tickets/buy/<?= $sessao['id'] ?>" class="btn" style="margin-top:16px;">
                    Comprar Ingresso
                </a>
            <?php else: ?>
                <p class="badge badge-danger" style="margin-top:16px;">Sessão esgotada</p>
            <?php endif; ?>
        </div>
    </div>
</section>
