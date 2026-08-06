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
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            color: #222;
        }
        .pergunta-box { 
            background: #ffffff; 
            padding: 20px; 
            margin-bottom: 25px; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .pergunta-box h2 {
            margin-top: 0;
            color: #007BFF;
        }
        .lista-comentarios {
            margin-top: 15px;
        }
        .comentario { 
            margin-left: 10px; 
            margin-top: 10px;
            padding: 12px; 
            border-left: 3px solid #ccc; 
            background: #fdfdfd; 
            border-radius: 0 4px 4px 0;
        }
        .form-comentario-ajax { 
            margin-top: 15px; 
        }
        .form-comentario-ajax textarea {
            width: 100%;
            height: 70px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .form-comentario-ajax button {
            margin-top: 8px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .form-comentario-ajax button:hover {
            background: #0056b3;
        }
        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 20px 0 10px 0;
        }
    </style>
</head>
<body>

    <h1>Fórum de Discussão</h1>

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
                    $sql_comentarios = "SELECT cp.*, u.nome_user FROM comentarios_perguntas cp 
                    JOIN usuarios u ON cp.usuario = u.id_user 
                    WHERE cp.pergunta_pai IS NULL ORDER BY cp.data_criacao ASC"; 
                    // Nota: Como 'pergunta_pai' na sua modelagem aceita NULL para os primeiros comentários, 
                    // filtramos por IS NULL ou associamos diretamente conforme sua regra de negócios.
                    
                    $res_comentarios = $conexao->query($sql_comentarios);

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
        echo "<p>Nenhuma pergunta cadastrada no fórum ainda.</p>";
    }
    ?>

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