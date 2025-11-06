<!-- deleta_comidas.php -->
<?php
    require_once "config.inc.php";
    
    $id = $_GET['id'];
    
    $sql = "DELETE FROM comidas WHERE id=$id";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Item deletado com sucesso!'); window.location='?pg=admin_comidas';</script>";
    } else {
        echo "Erro ao deletar item: " . mysqli_error($conexao);
    }
?>
