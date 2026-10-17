<?php 
    include "./includes/conexao.php";
    include "./includes/logado.php"; // Garante que a sessão está iniciada e o usuário está logado
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fórum - Perguntas e Respostas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="forum.css">
</head>
<body>

    <header class="topo">
        <h1>Fórum de Discussão</h1>
        <div class="usuario">
            <span>@<?php echo htmlspecialchars($_SESSION['nome_user'] ?? ''); ?></span>
            <a class="sair" href="./actions/logoff.php">Sair</a>
        </div>
    </header>

    <main>

    <?php
    // 1. Buscar todas as perguntas base cadastradas na tabela 'perguntas'
    $sql_perguntas = "SELECT * FROM perguntas ORDER BY id_pergunta DESC";
    $res_perguntas = $conexao->query($sql_perguntas);

    if ($res_perguntas && $res_perguntas->num_rows > 0) {
        while ($pergunta = $res_perguntas->fetch_assoc()) {
            $id_p = $pergunta['id_pergunta'];
            ?>
            
            <div class="pergunta-box">
                <h2>Pergunta: <?php echo htmlspecialchars($pergunta['texto_pergunta']); ?></h2>

                <div id="comentarios-da-pergunta-<?php echo $id_p; ?>" class="lista-comentarios">
                    <?php
                    // 2. Buscar comentários principais desta pergunta (na tabela comentarios_perguntas)
                    
                    $sql_comentarios = "SELECT cp.*, u.nome_user
                    FROM comentarios_perguntas cp
                    JOIN usuarios u ON cp.usuario = u.id_user
                    WHERE cp.pergunta_pai = ?
                    ORDER BY cp.data_criacao ASC";

                    $stmt_comentarios = $conexao->prepare($sql_comentarios);
                    $stmt_comentarios->bind_param("i", $id_p);
                    $stmt_comentarios->execute();
                    $res_comentarios = $stmt_comentarios->get_result();

                    if ($res_comentarios && $res_comentarios->num_rows > 0) {
                        while ($comentario = $res_comentarios->fetch_assoc()) {
                            echo "<div class='comentario'>";
                            echo "<strong>@" . htmlspecialchars($comentario['nome_user']) . ":</strong> " . htmlspecialchars($comentario['texto']);
                            echo "</div>";
                        }
                    }
                    ?>
                </div>

                <hr>
                
                <form class="form-comentario-ajax" method="POST">
                    <input type="hidden" name="pergunta_pai" value="<?php echo $id_p; ?>">
                    <textarea name="texto" placeholder="Responda a essa pergunta base..." required></textarea>
                    <br>
                    <button type="submit">Enviar Resposta</button>
                </form>
            </div>

            <?php
        }
    } else {
        echo "<p class='vazio'>Nenhuma pergunta cadastrada no fórum ainda.</p>";
    }
    ?>
    </main>

    <script>
    document.querySelectorAll('.form-comentario-ajax').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Impede o recarregamento da página

            const formData = new FormData(this);
            const idPergunta = formData.get('pergunta_pai');
            const campoTexto = this.querySelector('textarea');

            // Faz a requisição em segundo plano para a Action
            fetch('./actions/comentario_pergunta.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Converte a resposta do PHP em JSON
            .then(data => {
                if (data.sucesso) {
                    // Seleciona o container de comentários da pergunta atual
                    const container = document.getElementById(`comentarios-da-pergunta-${idPergunta}`);
                    
                    // Cria o elemento HTML do novo comentário na hora
                    const novoComentario = document.createElement('div');
                    novoComentario.className = 'comentario';
                    novoComentario.innerHTML = `<strong>@${data.usuario}:</strong> ${data.texto}`;
                    
                    // Insere o novo comentário no fim da lista daquela pergunta
                    container.appendChild(novoComentario);
                    
                    // Limpa a caixinha de texto do usuário
                    campoTexto.value = '';
                } else {
                    alert('Erro ao enviar: ' + data.erro);
                }
            })
            .catch(error => {
                console.error('Erro na requisição:', error);
                alert('Não foi possível enviar o comentário. Verifique se o arquivo da Action está correto.');
            });
        });
    });
    </script>

</body>
</html>