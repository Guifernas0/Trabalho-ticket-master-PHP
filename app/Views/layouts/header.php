<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketMaster</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>

<header>
    <div class="header-inner">
        <a href="/" class="logo">🎟️ TicketMaster</a>
        <nav>
            <a href="/">Início</a>
            <a href="/movies">Filmes</a>
            <a href="/sessions">Sessões</a>
            <a href="/about">Sobre</a>
            <a href="/contact">Contato</a>
            <?php if (\App\Core\Session::has('user_id')): ?>
                <a href="/tickets">Meus Ingressos</a>
                <a href="/logout" class="btn-nav">Sair</a>
            <?php else: ?>
                <a href="/login" class="btn-nav">Entrar</a>
                <a href="/register" class="btn-nav btn-nav-outline">Cadastrar</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<main>
