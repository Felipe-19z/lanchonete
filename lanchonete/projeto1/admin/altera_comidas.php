<!-- altera_comidas.php -->
<?php
    require_once "config.inc.php";
    
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    $sql = "UPDATE comidas SET nome='$nome', categoria='$categoria', 
            descricao='$descricao', preco='$preco' WHERE id=$id";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Item atualizado com sucesso!'); window.location='?pg=admin_comidas';</script>";
    } else {
        echo "Erro ao atualizar item: " . mysqli_error($conexao);
    }
?>
