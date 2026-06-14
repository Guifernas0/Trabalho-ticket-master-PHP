<div class="auth-wrapper">
<div class="card">

    <h2>Recuperar Senha</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= url('/reset-password') ?>">

        <label>E-mail</label>
        <input type="email" name="email" required>

        <button type="submit">Enviar Recuperação</button>

    </form>

    <p>
        <a href="<?= url('/login') ?>">Voltar para Login</a>
    </p>

</div>
</div>
