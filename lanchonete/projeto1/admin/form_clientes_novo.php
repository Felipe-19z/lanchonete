<?php
    // Página para criar um novo cliente
?>

<div class="container mt-3">
    <h2>Adicionar Novo Cliente</h2>
    
    <form action="?pg=insere_clientes" method="post" class="form-clientes">
        <div class="form-group">
            <label>Nome do Cliente:</label>
            <input type="text" name="cliente" required class="form-control">
        </div>
        
        <div class="form-group">
            <label>Cidade:</label>
            <input type="text" name="cidade" required class="form-control">
        </div>
        
        <div class="form-group">
            <label>Estado:</label>
            <input type="text" name="estado" maxlength="2" required class="form-control" placeholder="SP, RJ, MG...">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Cadastrar Cliente" class="btn btn-primary">
            <a href="?pg=admin_clientes" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<style>
    .form-clientes {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        max-width: 600px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .btn {
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-primary {
        background-color: #007bff;
        color: white;
    }
    
    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }
</style>
