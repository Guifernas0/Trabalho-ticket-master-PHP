<?php
include "conexao.php";

$sql = "SELECT tickets.id, tickets.nome_cliente, filmes.nome, tickets.quantidade, tickets.total
        FROM tickets
        INNER JOIN filmes ON tickets.filme_id = filmes.id";

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meus Tickets</title>
</head>
<body>

<h1>Tickets Comprados</h1>

<table border="1">
    <tr>
        <th>Cliente</th>
        <th>Filme</th>
        <th>Quantidade</th>
        <th>Total</th>
        <th>Ação</th>
    </tr>

    <?php while ($ticket = mysqli_fetch_assoc($resultado)) { ?>
        <tr>
            <td><?php echo $ticket["nome_cliente"]; ?></td>
            <td><?php echo $ticket["nome"]; ?></td>
            <td><?php echo $ticket["quantidade"]; ?></td>
            <td>R$ <?php echo $ticket["total"]; ?></td>
            <td>
                <a href="cancelar_ticket.php?id=<?php echo $ticket["id"]; ?>">
                    Cancelar
                </a>
            </td>
        </tr>
    <?php } ?>
</table>

<br>
<a href="filmes.php">Voltar para filmes</a>

</body>
</html>
