<div class="card">

    <h2>Cadastro</h2>

    <?php if (!empty($mensagem)): ?>
        <p class="mensagem"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form method="POST" action="/register">

        <label>Nome</label>
        <input type="text" name="name" required>

        <label>E-mail</label>
        <input type="email" name="email" required>

        <label>Senha</label>
        <input type="password" name="password" required>

        <button type="submit">Cadastrar</button>

    </form>

    <p>
        Já possui conta?
        <a href="/login">Entrar</a>
    </p>

</div>
