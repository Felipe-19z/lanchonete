<?php
    require_once "config.inc.php";
    
    $id = $_POST['id'];
    $nome = $_POST['cliente'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    
    $sql = "UPDATE clientes SET cliente='$nome', cidade='$cidade', 
            estado='$estado' WHERE id=$id";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Cliente atualizado com sucesso!'); window.location='?pg=admin_clientes';</script>";
    } else {
        echo "Erro ao atualizar cliente: " . mysqli_error($conexao);
    }
?>
