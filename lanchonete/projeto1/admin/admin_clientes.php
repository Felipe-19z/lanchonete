<?php
    require_once "config.inc.php";
    $sql = "SELECT * FROM clientes";
    $resultado = mysqli_query($conexao, $sql);
?>

<div class="container mt-3">
    <h2>👥 Clientes</h2>
    <p>Lista de clientes cadastrados no sistema</p>
    
    <a href="?pg=form_clientes_novo" class="btn btn-primary mb-3">+ Adicionar Novo Cliente</a>
    
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($cliente = mysqli_fetch_array($resultado)){
            ?>
            <tr>
                <td><?=$cliente['id']?></td>
                <td><?=$cliente['cliente']?></td>
                <td><?=$cliente['cidade']?></td>
                <td><?=$cliente['estado']?></td>
                <td>
                    <a href="?pg=form_clientes_alterar&id=<?=$cliente['id']?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="?pg=deleta_clientes&id=<?=$cliente['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza?')">Deletar</a>
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
        border: none;
        cursor: pointer;
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


    