<?php 
// 1. INICIAR A SESSÃO (Obrigatório para funcionar!)
session_start();

include "../includes/conexao.php";

$user = $_POST['user'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE nome_user = '{$user}' AND senha = '{$senha}'";
$resultado = mysqli_query($conexao, $sql);

// validacao do acesso
if($resultado && $resultado->num_rows > 0){
    // Busca a linha do usuário como array
    $dados_usuario = mysqli_fetch_assoc($resultado);
    
    // 2. SALVAR APENAS O ID (O número inteiro) na sessão!
    $_SESSION['id_user'] = $dados_usuario['id_user'];
    
    // Se quiser guardar o nome também para exibir na tela depois, use outra chave:
    $_SESSION['nome_user'] = $dados_usuario['nome_user'];
    
    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../cadastro.php?msg=semusuario');
    exit();
}
?>