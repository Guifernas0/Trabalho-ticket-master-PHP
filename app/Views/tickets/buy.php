<section class="container page-content">
    <div class="card" style="max-width:520px; margin:0 auto;">
        <h2>Comprar Ingresso</h2>

        <div style="margin-bottom:20px;">
            <h3><?= htmlspecialchars($sessao['movie_title']) ?></h3>
            <p><strong>Data/Hora:</strong> <?= date('d/m/Y H:i', strtotime($sessao['datetime'])) ?></p>
            <p><strong>Sala:</strong> <?= htmlspecialchars($sessao['room']) ?></p>
            <p><strong>Preço:</strong> R$ <?= number_format($sessao['price'], 2, ',', '.') ?></p>
            <p><strong>Lugares disponíveis:</strong> <?= $sessao['available_seats'] ?></p>
        </div>

        <form method="POST" action="<?= url('/tickets/buy') ?>">
            <?= $csrf_field ?>
            <input type="hidden" name="session_id" value="<?= $sessao['id'] ?>">

            <label>Número do Assento</label>
            <input type="text" name="seat_number" placeholder="Ex: A1, B3..." maxlength="10" required>

            <button type="submit" class="btn" style="margin-top:16px;">Confirmar Compra</button>
        </form>

        <p style="margin-top:12px;"><a href="<?= url('/sessions/' . $sessao['id']) ?>">Cancelar</a></p>
    </div>
</section>
