<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

include "../includes/conexao.php";
include "../includes/logado.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id_usuario = isset($_SESSION['id_user']) ? intval($_SESSION['id_user']) : 0; 
    $texto = isset($_POST['texto']) ? trim($_POST['texto']) : '';
    
    // COMO SUA MODELAGEM ESPERA QUE pergunta_pai SEJA OUTRO COMENTÁRIO:
    // Forçamos NULL no primeiro nível para não quebrar a Foreign Key do banco
    $pergunta_pai = null; 

    if ($id_usuario <= 0) {
        echo json_encode(['sucesso' => false, 'erro' => 'Sessão inválida. Por favor, faça login novamente.']);
        exit();
    }

    if (empty($texto)) {
        echo json_encode(['sucesso' => false, 'erro' => 'O texto do comentário não pode estar vazio.']);
        exit();
    }

    try {
        $sql = "INSERT INTO comentarios_perguntas (usuario, texto, pergunta_pai) VALUES (?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        
        // Passando explicitamente o tipo 'i' (ou 's' para aceitar null de forma limpa)
        $stmt->bind_param("iss", $id_usuario, $texto, $pergunta_pai);
        
        if ($stmt->execute()) {
            $nome_usuario = isset($_SESSION['nome_user']) ? $_SESSION['nome_user'] : 'Usuário';

            echo json_encode([
                'sucesso' => true,
                'usuario' => htmlspecialchars($nome_usuario),
                'texto' => htmlspecialchars($texto)
            ]);
            exit();
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro na execução: ' . $stmt->error]);
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(['sucesso' => false, 'erro' => 'Erro no banco de dados: ' . $e->getMessage()]);
        exit();
    }
}
?>