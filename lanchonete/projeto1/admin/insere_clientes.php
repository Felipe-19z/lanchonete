<?php
    require_once "config.inc.php";
    
    $nome = $_POST['cliente'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    
    $sql = "INSERT INTO clientes (cliente, cidade, estado) 
            VALUES ('$nome', '$cidade', '$estado')";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Cliente adicionado com sucesso!'); window.location='?pg=admin_clientes';</script>";
    } else {
        echo "Erro ao adicionar cliente: " . mysqli_error($conexao);
    }
?>
