<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário realmente realizou o login
if (!isset($_SESSION['Usuario'])) { // <--- Ajuste essa chave se necessário!
    header("Location: ../cadastro.php");
    exit();
}
?>