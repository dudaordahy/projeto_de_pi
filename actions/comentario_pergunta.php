<?php
include "../includes/conexao.php";
include "../includes/logado.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Verifica se a sessão realmente existe antes de prosseguir
    if (!isset($_SESSION['id_user'])) {
        die("Erro: Você precisa estar logado para comentar.");
    }

    $id_usuario = $_SESSION['id_user']; 
    $texto = $_POST['texto'];
    $pergunta_pai = $_POST['pergunta_pai'];

    // ... restante do código original

    if (!empty($texto) && !empty($pergunta_pai)) {
        $sql = "INSERT INTO comentarios_perguntas (usuario, texto, pergunta_pai) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("isi", $id_usuario, $texto, $pergunta_pai);
        
        if ($stmt->execute()) {
            header("Location: ../index.php?sucesso=2");
            exit();
        } else {
            echo "Erro ao responder pergunta: " . $conexao->error;
        }
    }
}
?>