<?php
    require_once "config.inc.php";
    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM clientes WHERE id=$id";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Cliente deletado com sucesso!'); window.location='?pg=admin_clientes';</script>";
    } else {
        echo "Erro ao deletar cliente: " . mysqli_error($conexao);
    }
?>
