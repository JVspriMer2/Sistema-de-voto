<?php
require 'conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $conn->real_escape_string($_POST['usuario']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $nome = $conn->real_escape_string($_POST['nome']);

    $diretorio = "uploads/";
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    $arquivo = $diretorio . basename($_FILES['foto']['name']);
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $arquivo)) {
    } else {
        $mensagem = "Desculpe, houve um erro ao enviar sua foto.";
    }

    if (empty($mensagem)) {
        $query = "INSERT INTO usuario (login, senha, foto) VALUES ('$login', '$senha', '$arquivo')";
        if ($conn->query($query) === TRUE) {
            $usuario_id = $conn->insert_id;
            $query_candidato = "INSERT INTO candidato (usuario_id, nome, votos) VALUES ('$usuario_id', '$nome', 0)";
            if ($conn->query($query_candidato) === TRUE) {
                $mensagem = "Novo candidato cadastrado com sucesso!";
            } else {
                $mensagem = "Erro: " . $query_candidato . "<br>" . $conn->error;
            }
        } else {
            $mensagem = "Erro: " . $query . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Candidato</title>
    <link rel="stylesheet" type="text/css" href="votacao.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Candidato</h1>
        <?php if ($mensagem): ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>
        <form action="cadastro.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="text" name="usuario" placeholder="Usuário" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input type="file" name="foto" required>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
