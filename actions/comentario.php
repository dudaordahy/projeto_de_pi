<?php

require "..includes/conexao.php";

$texto = $_POST['texto'];
$comentario_pai = $_POST['comentario_pai'];

$sql = "INSERT INTO comentarios (usuario_id, texto, comentario_pai)
VALUES (:usuario_id, :texto, :comentario_pai)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':usuario_id' => $_SESSION['Usuario'],
    ':texto' => $_POST['texto'],
    ':comentario_pai' => $_POST['comentario_pai'] ?: null
]);

$stmt->execute();

echo "Resposta enviada!";