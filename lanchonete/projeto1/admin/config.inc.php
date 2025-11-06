<?php
    
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "lanchonete";
    
    
    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
    
    
    if (!$conexao) {
        die("Erro ao conectar com o banco: " . mysqli_connect_error());
    }
    
    
    mysqli_set_charset($conexao, "utf8");
?>
