<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['votar'])) {
    $candidato_id = $_POST['votar'];

    $sql = "UPDATE candidato SET votos = votos + 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $candidato_id);
    
    if ($stmt->execute()) {
        header('Location: candidato.php');
        exit;
    } else {
        echo "Erro ao votar.";
    }
} else {
    echo "Ação inválida.";
}
?>
