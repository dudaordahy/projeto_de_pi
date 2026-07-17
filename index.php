<?php 
    include "./includes/conexao.php";
    include "./includes/logado.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - Perguntas e Respostas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .pergunta-box { background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .comentario { margin-left: 20px; padding: 10px; border-left: 2px solid #ccc; background: #fafafa; }
        .resposta { margin-left: 40px; border-left: 2px solid #007BFF; background: #f0f7ff; }
        form { margin-top: 10px; }
    </style>
</head>
<body>

    <h1>Fórum de Discussão</h1>

    <?php
    // 1. Buscar todas as perguntas base
    $sql_perguntas = "SELECT * FROM perguntas ORDER BY id_pergunta DESC";
    $res_perguntas = $conexao->query($sql_perguntas);

    if ($res_perguntas->num_rows > 0) {
        while ($pergunta = $res_perguntas->fetch_assoc()) {
            echo "<div class='pergunta-box'>";
            echo "<h2>Pergunta: " . htmlspecialchars($pergunta['texto_pergunta']) . "</h2>";

            // 2. Buscar comentários principais desta pergunta (na tabela comentarios_perguntas)
            $id_p = $pergunta['id_pergunta'];
            $sql_comentarios = "SELECT cp.*, u.nome_user FROM comentarios_perguntas cp 
                                JOIN usuarios u ON cp.usuario = u.id_user 
                                WHERE cp.pergunta_pai = $id_p ORDER BY cp.data_criacao ASC";
            $res_comentarios = $conexao->query($sql_comentarios);

            if ($res_comentarios && $res_comentarios->num_rows > 0) {
                while ($comentario = $res_comentarios->fetch_assoc()) {
                    echo "<div class='comentario'>";
                    echo "<strong>@" . htmlspecialchars($comentario['nome_user']) . ":</strong> " . htmlspecialchars($comentario['texto']);
                    
                    // Botão/Formulário para responder a ESTE comentário específico
                    ?>
                    <form action="./actions/comentario.php" method="POST">
                        <input type="hidden" name="comentario_pai" value="<?php echo $comentario['id']; ?>">
                        <input type="text" name="texto" placeholder="Responder a este comentário..." required>
                        <button type="submit">Responder</button>
                    </form>
                    <?php

                    // 3. Buscar sub-respostas (respostas do comentário na tabela comentarios_usuarios)
                    $id_c = $comentario['id'];
                    $sql_respostas = "SELECT cu.*, u.nome_user FROM comentarios_usuarios cu 
                                      JOIN usuarios u ON cu.usuario = u.id_user 
                                      WHERE cu.comentario_pai = $id_c ORDER BY cu.data_criacao ASC";
                    $res_respostas = $conexao->query($sql_respostas);

                    if ($res_respostas && $res_respostas->num_rows > 0) {
                        while ($resposta = $res_respostas->fetch_assoc()) {
                            echo "<div class='comentario resposta'>";
                            echo "<strong>@" . htmlspecialchars($resposta['nome_user']) . " respondeu:</strong> " . htmlspecialchars($resposta['texto']);
                            echo "</div>";
                        }
                    }
                    echo "</div>"; // Fim do bloco de comentário
                }
            } else {
                echo "<p style='color: gray;'>Nenhuma resposta para esta pergunta ainda.</p>";
            }

            // Formulário para criar um comentário NOVO direto na pergunta base
            ?>
            <hr>
            <form action="./actions/comentario_pergunta.php" method="POST">
                <input type="hidden" name="pergunta_pai" value="<?php echo $pergunta['id_pergunta']; ?>">
                <textarea name="texto" placeholder="Responda a essa pergunta base..." required></textarea>
                <br>
                <button type="submit">Enviar Resposta Base</button>
            </form>
            <?php

            echo "</div>"; // Fim da pergunta-box
        }
    } else {
        echo "<p>Nenhuma pergunta cadastrada no fórum ainda.</p>";
    }
    ?>

</body>
</html>