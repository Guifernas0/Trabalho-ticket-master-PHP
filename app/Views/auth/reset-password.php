<div class="card">

    <h2>Recuperar Senha</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="/reset-password">

        <label>E-mail</label>
        <input type="email" name="email" required>

        <button type="submit">Enviar Recuperação</button>

    </form>

    <p>
        <a href="/login">Voltar para Login</a>
    </p>

</div>
