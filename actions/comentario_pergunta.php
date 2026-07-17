<?php
include "../includes/conexao.php";
include "../includes/logado.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_usuario = isset($_SESSION['id_user']) ? intval($_SESSION['id_user']) : 0; 
    $texto = $_POST['texto'];
    
    // Se vier vazio do formulário, definimos como NULL puro
    $pergunta_pai = !empty($_POST['pergunta_pai']) ? intval($_POST['pergunta_pai']) : null;

    if ($id_usuario <= 0) {
        die("Erro: Sessão inválida ou usuário não encontrado. Faça login novamente.");
    }

    if (!empty($texto)) {
        $sql = "INSERT INTO comentarios_perguntas (usuario, texto, pergunta_pai) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        
        // Se pergunta_pai for nulo, precisamos passar a variável por referência corretamente
        // ou mudar o tipo no bind se necessário. Para colunas int aceitando NULL:
        if ($pergunta_pai === null) {
            $stmt->bind_param("iss", $id_usuario, $texto, $pergunta_pai); // 's' aceita null perfeitamente no mysqli
        } else {
            $stmt->bind_param("isi", $id_usuario, $texto, $pergunta_pai);
        }
        
        if ($stmt->execute()) {
            header("Location: ../index.php?sucesso=2");
            exit();
        } else {
            echo "Erro ao responder: " . $conexao->error;
        }
    }
}
?>