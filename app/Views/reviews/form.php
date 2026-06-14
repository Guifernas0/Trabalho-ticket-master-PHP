<section class="container page-content">
    <div class="card" style="max-width:520px; margin:0 auto;">
        <a href="/movies/<?= $filme['id'] ?>" class="back-link">← Voltar para o Filme</a>

        <h2>Avaliar: <?= htmlspecialchars($filme['title']) ?></h2>

        <form method="POST" action="/reviews">
            <?= $csrf_field ?>
            <input type="hidden" name="movie_id" value="<?= $filme['id'] ?>">

            <label>Nota</label>
            <select name="rating">
                <option value="5">★★★★★ — Excelente</option>
                <option value="4">★★★★☆ — Muito Bom</option>
                <option value="3" selected>★★★☆☆ — Regular</option>
                <option value="2">★★☆☆☆ — Ruim</option>
                <option value="1">★☆☆☆☆ — Péssimo</option>
            </select>

            <label>Comentário</label>
            <textarea name="comment" rows="5" placeholder="O que você achou do filme?"></textarea>

            <button type="submit">Enviar Avaliação</button>
        </form>
    </div>
</section>
