<?php

include "../includes/conexao.php";
include "../includes/logado.php";

session_start();
session_destroy();
header("Location: ../cadastro.php");
exit();