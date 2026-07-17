<?php
    include "./includes/conexao.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <form action="./actions/cadastro_usuario.php" method="post">
        <h1>Cadastro</h1>
        <div class="input-box">
            <input name="user" type="text" placeholder="Usuário" required>
        </div>

        <div class="input-box">
            <input name="email" type="email" placeholder="Email" required>
        </div>

        <div class="input-box">
            <input name="senha" type="password" placeholder="Senha" required>
        </div>

        <button type="submit" class="btn">Cadastrar</button>
    
    </form>


    <form action="./actions/login.php" method="post">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" placeholder="Usuário" name="user" required>
                </div>

                <div class="input-box">
                    <input name="senha" type="password" placeholder="Senha" required>
                </div>

                <button type="submit" class="btn">Login</button>
            
            </form>

</body>
</html>