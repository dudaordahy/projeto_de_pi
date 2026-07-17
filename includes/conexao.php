<?php
session_start();

// configuracoes de acesso
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projeto_pi";

$conexao = mysqli_connect($servername, $username, $password, $dbname);
?>