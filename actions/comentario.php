<?php
include "../includes/conexao.php";
include "../includes/logado.php"; // Garante que a sessão está iniciada

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando o ID do usuário logado na sessão (ajuste o nome da chave se necessário)
    $id_usuario = $_SESSION['id_user']; 
    $texto = $_POST['texto'];
    $comentario_pai = !empty($_POST['comentario_pai']) ? $_POST['comentario_pai'] : null;

    if (!empty($texto)) {
        // Inserindo na tabela de comentários de usuários
        $sql = "INSERT INTO comentarios_usuarios (usuario, texto, comentario_pai) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("isi", $id_usuario, $texto, $comentario_pai);
        
        if ($stmt->execute()) {
            header("Location: ../index.php?sucesso=1");
            exit();
        } else {
            echo "Erro ao enviar comentário: " . $conexao->error;
        }
    }
}
?>