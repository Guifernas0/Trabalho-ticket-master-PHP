<?php
include "conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM filmes WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);
$filme = mysqli_fetch_assoc($resultado);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $total = $quantidade * $filme["preco"];

    $sql_insert = "INSERT INTO tickets (nome_cliente, filme_id, quantidade, total)
                   VALUES ('$nome', $id, $quantidade, $total)";

    mysqli_query($conexao, $sql_insert);

    header("Location: meus_tickets.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comprar Ingresso</title>
</head>
<body>

<h1>Comprar Ingresso</h1>

<h2><?php echo $filme["nome"]; ?></h2>
<p>Preço: R$ <?php echo $filme["preco"]; ?></p>

<form method="POST">
    <label>Seu nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" required><br><br>

    <button type="submit">Finalizar compra</button>
</form>

<br>
<a href="filmes.php">Voltar</a>

</body>
</html>
