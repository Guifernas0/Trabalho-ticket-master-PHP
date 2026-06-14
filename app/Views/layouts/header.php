<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketMaster</title>
    <link rel="stylesheet" href="<?= url('/assets/style.css') ?>">
</head>
<body>

<header>
    <div class="header-inner">
        <a href="<?= url('/') ?>" class="logo">🎟️ TicketMaster</a>
        <nav>
            <a href="<?= url('/') ?>">Início</a>
            <a href="<?= url('/movies') ?>">Filmes</a>
            <a href="<?= url('/sessions') ?>">Sessões</a>
            <a href="<?= url('/about') ?>">Sobre</a>
            <a href="<?= url('/contact') ?>">Contato</a>
            <?php if (\App\Core\Session::has('user_id')): ?>
                <a href="<?= url('/tickets') ?>">Meus Ingressos</a>
                <a href="<?= url('/logout') ?>" class="btn-nav">Sair</a>
            <?php else: ?>
                <a href="<?= url('/login') ?>" class="btn-nav">Entrar</a>
                <a href="<?= url('/register') ?>" class="btn-nav btn-nav-outline">Cadastrar</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main>
