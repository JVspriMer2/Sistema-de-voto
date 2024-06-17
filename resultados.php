<?php
require 'conexao.php';

$resultados = $conn->query("SELECT nome, votos FROM candidato ORDER BY votos DESC");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="votacao.css">
    <title>Resultados da Votação</title>
</head>
<body>
    <div class="container">
        <h1>Resultados da Votação</h1>
        <?php while ($resultado = $resultados->fetch_assoc()): ?>
            <p><?php echo $resultado['nome']; ?> - Votos: <?php echo $resultado['votos']; ?></p>
        <?php endwhile; ?>
    </div>
</body>
</html>
