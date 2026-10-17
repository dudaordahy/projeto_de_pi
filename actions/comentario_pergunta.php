
<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);

include "../includes/conexao.php";
include "../includes/logado.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuario = isset($_SESSION['id_user'])
        ? intval($_SESSION['id_user'])
        : 0;

    $texto = isset($_POST['texto'])
        ? trim($_POST['texto'])
        : '';

    $id_pergunta = isset($_POST['pergunta_pai'])
        ? intval($_POST['pergunta_pai'])
        : 0;

    if ($id_usuario <= 0) {
        echo json_encode([
            'sucesso' => false,
            'erro' => 'Sessão inválida. Faça login novamente.'
        ]);
        exit();
    }

    if (empty($texto)) {
        echo json_encode([
            'sucesso' => false,
            'erro' => 'A resposta não pode estar vazia.'
        ]);
        exit();
    }

    if ($id_pergunta <= 0) {
        echo json_encode([
            'sucesso' => false,
            'erro' => 'Pergunta inválida.'
        ]);
        exit();
    }

    try {
        $sql = "INSERT INTO comentarios_perguntas
                (usuario, texto, pergunta_pai)
                VALUES (?, ?, ?)";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(
            "isi",
            $id_usuario,
            $texto,
            $id_pergunta
        );

        if ($stmt->execute()) {
            $nome_usuario = $_SESSION['nome_user'] ?? 'Usuário';

            echo json_encode([
                'sucesso' => true,
                'usuario' => htmlspecialchars(
                    $nome_usuario,
                    ENT_QUOTES,
                    'UTF-8'
                ),
                'texto' => htmlspecialchars(
                    $texto,
                    ENT_QUOTES,
                    'UTF-8'
                )
            ]);
        } else {
            echo json_encode([
                'sucesso' => false,
                'erro' => 'Não foi possível salvar a resposta.'
            ]);
        }

        $stmt->close();

    } catch (Throwable $e) {
        echo json_encode([
            'sucesso' => false,
            'erro' => 'Erro ao salvar. Verifique o banco de dados e o ID da pergunta.'
        ]);
    }
}
?>
