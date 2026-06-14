<?php
include "conexao.php";

$sql = "SELECT * FROM filmes";
$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Filmes em Cartaz</title>
</head>
<body>

<h1>Filmes em Cartaz</h1>

<?php while ($filme = mysqli_fetch_assoc($resultado)) { ?>
    <div>
        <h2><?php echo $filme["nome"]; ?></h2>
        <p>Horário: <?php echo $filme["horario"]; ?></p>
        <p>Sala: <?php echo $filme["sala"]; ?></p>
        <p>Preço: R$ <?php echo $filme["preco"]; ?></p>

        <a href="comprar.php?id=<?php echo $filme["id"]; ?>">
            Comprar ingresso
        </a>
    </div>
    <hr>
<?php } ?>

<a href="meus_tickets.php">Ver tickets comprados</a>

</body>
</html>
