<div class="auth-wrapper">
<div class="card">

    <h2>Login</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= url('/login') ?>">

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>

    </form>

    <p>
        Não possui conta?
        <a href="<?= url('/register') ?>">Cadastre-se</a>
    </p>

    <p>
        <a href="<?= url('/reset-password') ?>">Esqueci minha senha</a>
    </p>

</div>
</div>
