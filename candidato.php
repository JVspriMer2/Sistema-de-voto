<?php
require 'conexao.php';

$candidatos = $conn->query("SELECT * FROM candidato");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Votação de Candidatos</title>
    <link rel="stylesheet" type="text/css" href="votacao.css">
</head>
<body>
    <div class="container">
        <h1>Votação de Candidatos</h1>
        <?php while ($candidato = $candidatos->fetch_assoc()): ?>
            <div class="candidato">
                <img src="" alt="Foto do Candidato">
                <p><?php echo $usuario['foto']; ?></p>
                <form action="votar.php" method="post" onsubmit="playAudio(event)">
                    <input type="hidden" name="votar" value="<?php echo $candidato['id']; ?>">
                    <input type="submit" value="Votar em <?php echo $candidato['nome']; ?>">
                </form>
            </div>
        <?php endwhile; ?>
    </div>
    <script type="text/javascript">
        const audio = new Audio("urna.mp3");

        function playAudio(event) {
            event.preventDefault(); 
            audio.play();
            console.log("Áudio reproduzido!"); 
        }
    </script>
</body>
</html>
