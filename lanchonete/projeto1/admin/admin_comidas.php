<!-- admin_comidas.php -->
<?php
    require_once "config.inc.php"; 
    $sql = "SELECT * FROM comidas";
    $resultado = mysqli_query($conexao, $sql);
?>

<div class="container mt-3">
    <h2>Cardápio - Gerenciar Comidas</h2>
    <p>Controle todos os itens do cardápio da lanchonete</p>
    
    <a href="?pg=form_comidas_novo" class="btn btn-primary mb-3">+ Adicionar Novo Item</a>
    
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($comida = mysqli_fetch_array($resultado)){
            ?>
            <tr>
                <td><?=$comida['id']?></td>
                <td><?=$comida['nome']?></td>
                <td><?=$comida['categoria']?></td>
                <td><?=$comida['descricao']?></td>
                <td>R$ <?=number_format($comida['preco'], 2, ',', '.')?></td>
                <td>
                    <a href="?pg=form_comidas_alterar&id=<?=$comida['id']?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="?pg=deleta_comidas&id=<?=$comida['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Deletar</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<style>
    .container {
        padding: 20px;
    }
    
    .btn {
        padding: 5px 10px;
        margin: 2px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
    }
    
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    
    .btn-warning {
        background-color: #ffc107;
        color: black;
    }
    
    .btn-danger {
        background-color: #dc3545;
        color: white;
    }
    
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .table th, .table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    
    .table th {
        background-color: #343a40;
        color: white;
    }
    
    .table tr:hover {
        background-color: #495057;
    }
</style>
