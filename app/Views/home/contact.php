<section class="container page-content">
    <div class="card" style="max-width:520px; margin:0 auto;">
        <h2>Fale Conosco</h2>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

        <form method="POST" action="/contact">
            <?= $csrf_field ?>

            <label>Nome</label>
            <input type="text" name="name" required>

            <label>E-mail</label>
            <input type="email" name="email" required>

            <label>Assunto</label>
            <input type="text" name="subject" required>

            <label>Mensagem</label>
            <textarea name="message" rows="5" required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
</section>
