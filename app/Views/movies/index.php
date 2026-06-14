<section class="container">
    <h2>Filmes em Cartaz</h2>

    <form class="search-form" method="GET" action="/movies">
        <input type="text" name="busca" placeholder="Buscar por título ou gênero..."
               value="<?= htmlspecialchars($busca) ?>">
        <button type="submit" class="btn">Buscar</button>
        <?php if ($busca): ?>
            <a href="/movies" class="btn btn-outline">Limpar</a>
        <?php endif; ?>
    </form>

    <?php if (empty($filmes)): ?>
        <p class="empty-msg">Nenhum filme encontrado.</p>
    <?php else: ?>
        <div class="movies-grid">
            <?php foreach ($filmes as $f): ?>
                <div class="movie-card">
                    <?php if (!empty($f['poster_url'])): ?>
                        <img src="<?= htmlspecialchars($f['poster_url']) ?>" alt="<?= htmlspecialchars($f['title']) ?>">
                    <?php else: ?>
                        <div class="no-poster">Sem imagem</div>
                    <?php endif; ?>
                    <div class="movie-info">
                        <h4><?= htmlspecialchars($f['title']) ?></h4>
                        <span class="badge"><?= htmlspecialchars($f['genre'] ?? '') ?></span>
                        <p><?= (int)($f['duration_min'] ?? 0) ?> min</p>
                        <a href="/movies/<?= $f['id'] ?>" class="btn btn-sm">Ver Detalhes</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
