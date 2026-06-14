<div class="card">

    <h2>Login</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="/login">

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>

    </form>

    <p>
        Não possui conta?
        <a href="/register">Cadastre-se</a>
    </p>

    <p>
        <a href="/reset-password">Esqueci minha senha</a>
    </p>

</div>
