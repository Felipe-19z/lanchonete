<!-- insere_comidas.php -->
<?php
    require_once "config.inc.php";
    
    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    
    $sql = "INSERT INTO comidas (nome, categoria, descricao, preco) 
            VALUES ('$nome', '$categoria', '$descricao', '$preco')";
    
    if(mysqli_query($conexao, $sql)){
        echo "<script>alert('Item adicionado com sucesso!'); window.location='?pg=admin_comidas';</script>";
    } else {
        echo "Erro ao adicionar item: " . mysqli_error($conexao);
    }
?>
