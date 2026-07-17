<?php 
include "../includes/conexao.php";

$user = $_POST['user'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios (nome_user, email, senha) VALUES ('{$user}','{$email}','{$senha}')";
mysqli_query($conexao, $sql);

header("Location: ../cadastro.php");
exit;
?>