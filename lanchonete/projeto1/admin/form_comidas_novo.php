<!-- form_comidas_novo.php -->
<?php
    // Página para criar um novo item no cardápio
?>

<div class="container mt-3">
    <h2>Adicionar Novo Item ao Cardápio</h2>
    
    <form action="?pg=insere_comidas" method="post" class="form-comidas">
        <div class="form-group">
            <label>Nome do Item:</label>
            <input type="text" name="nome" required class="form-control">
        </div>
        
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria" required class="form-control">
                <option value="">-- Selecione uma categoria --</option>
                <option value="Entrada">Entrada</option>
                <option value="Principal">Principal</option>
                <option value="Sobremesa">Sobremesa</option>
                <option value="Bebida">Bebida</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label>Preço (R$):</label>
            <input type="number" name="preco" step="0.01" required class="form-control">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Cadastrar Item" class="btn btn-primary">
            <a href="?pg=admin_comidas" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<style>
    .form-comidas {
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
