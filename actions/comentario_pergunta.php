<?php
include "../includes/conexao.php";
include "../includes/logado.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // trata os dados do usuario logado
    $usuario = $_SESSION['Usuario']; 
    // pega o id do usuario que esta na sessao
    $id_usuario = $usuario['id_user'];
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