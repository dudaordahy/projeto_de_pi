<?php
    include "./includes/conexao.php";

    // login.php volta para cá com ?msg=semusuario quando usuário/senha estão errados
    $erro_login = (isset($_GET['msg']) && $_GET['msg'] === 'semusuario');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro e Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="cadastro.css">
</head>
<body class="pagina-auth">

    <div class="auth-card <?php echo $erro_login ? 'modo-login' : ''; ?>" id="auth-card">

        <!-- Painel vermelho que desliza -->
        <div class="auth-panel">
            <div class="msg msg-cadastro">
                <h2>Já tem conta?</h2>
                <p>Entre com seus dados para voltar ao fórum.</p>
                <button type="button" class="btn-contorno" data-modo="login">Entrar</button>
            </div>
            <div class="msg msg-login">
                <h2>Novo por aqui?</h2>
                <p>Crie sua conta para participar das discussões.</p>
                <button type="button" class="btn-contorno" data-modo="cadastro">Criar conta</button>
            </div>
        </div>

        <!-- Cadastro -->
        <form class="auth-form form-cadastro" action="./actions/cadastro_usuario.php" method="post">
            <h1>Criar conta</h1>

            <div class="input-box">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
                <input name="user" type="text" placeholder="Usuário" required>
            </div>

            <div class="input-box">
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                <input name="email" type="email" placeholder="Email" required>
            </div>

            <div class="input-box">
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>
                <input name="senha" type="password" placeholder="Senha" required>
            </div>

            <button type="submit" class="btn">Cadastrar</button>
        </form>

        <!-- Login -->
        <form class="auth-form form-login" action="./actions/login.php" method="post">
            <h1>Entrar</h1>

            <?php if ($erro_login) { ?>
                <p class="auth-erro">Usuário ou senha incorretos. Tente de novo.</p>
            <?php } ?>

            <div class="input-box">
                <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/></svg>
                <input name="user" type="text" placeholder="Usuário" required>
            </div>

            <div class="input-box">
                <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="11" width="14" height="10" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg>
                <input name="senha" type="password" placeholder="Senha" required>
            </div>

            <button type="submit" class="btn">Entrar</button>
        </form>

    </div>

    <script>
    const card = document.getElementById('auth-card');
    document.querySelectorAll('[data-modo]').forEach(botao => {
        botao.addEventListener('click', () => {
            card.classList.toggle('modo-login', botao.dataset.modo === 'login');
        });
    });
    </script>

</body>
</html>