<section class="hero">
    <div class="hero-content">
        <h2>Bem-vindo ao TicketMaster 🎬</h2>
        <p>Compre seus ingressos de cinema com facilidade e rapidez.</p>
        <a href="/movies" class="btn">Ver Filmes</a>
        <a href="/sessions" class="btn btn-outline">Ver Sessões</a>
    </div>
</section>

<section class="container">
    <h3 class="section-title">Filmes em Cartaz</h3>

    <?php if (empty($destaques)): ?>
        <p class="empty-msg">Nenhum filme cadastrado ainda.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($destaques as $filme): ?>
                <div class="movie-card">
                    <?php if (!empty($filme['poster_url'])): ?>
                        <img src="<?= htmlspecialchars($filme['poster_url']) ?>" alt="<?= htmlspecialchars($filme['title']) ?>">
                    <?php else: ?>
                        <div class="no-poster">Sem imagem</div>
                    <?php endif; ?>
                    <div class="movie-info">
                        <h4><?= htmlspecialchars($filme['title']) ?></h4>
                        <p><?= htmlspecialchars($filme['genre'] ?? '') ?></p>
                        <a href="/movies/<?= $filme['id'] ?>" class="btn btn-sm">Ver Detalhes</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
