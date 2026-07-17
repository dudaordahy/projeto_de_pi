<?php 
include "../includes/conexao.php";

$user = $_POST['user'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE nome_user = '{$user}' AND Senha = '{$senha}'";
$resultado = mysqli_query($conexao, $sql);

// validacao do acesso
if($resultado->num_rows > 0){
    // validacao do usuario - cria a sessao
    $_SESSION['Usuario'] =  mysqli_fetch_assoc($resultado);
    header('Location: ../index.php');
    print_r($_SESSION);
    exit('Usuario cadastrado');
}else{
    header('Location: ../cadastro.php?msg=semusuario');
}
exit();
?>