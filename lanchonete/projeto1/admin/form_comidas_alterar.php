<!-- form_comidas_alterar.php -->
<?php
    require_once "config.inc.php";
    $id = $_REQUEST['id'];
    $sql = "SELECT * FROM comidas WHERE id = $id";
    $resultado = mysqli_query($conexao, $sql);

    while ($comida = mysqli_fetch_array($resultado)){
        $id = $comida['id'];
        $nome = $comida['nome'];
        $categoria = $comida['categoria'];
        $descricao = $comida['descricao'];
        $preco = $comida['preco'];
    }
?>

<div class="container mt-3">
    <h2>Editar Item do Cardápio</h2>
    
    <form action="?pg=altera_comidas" method="post" class="form-comidas">
        <input type="hidden" name="id" value="<?=$id?>">
        
        <div class="form-group">
            <label>Nome do Item:</label>
            <input type="text" name="nome" value="<?=$nome?>" required class="form-control">
        </div>
        
        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria" required class="form-control">
                <option value="Entrada" <?=($categoria == 'Entrada') ? 'selected' : ''?>>Entrada</option>
                <option value="Principal" <?=($categoria == 'Principal') ? 'selected' : ''?>>Principal</option>
                <option value="Sobremesa" <?=($categoria == 'Sobremesa') ? 'selected' : ''?>>Sobremesa</option>
                <option value="Bebida" <?=($categoria == 'Bebida') ? 'selected' : ''?>>Bebida</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>Descrição:</label>
            <textarea name="descricao" class="form-control" rows="3"><?=$descricao?></textarea>
        </div>
        
        <div class="form-group">
            <label>Preço (R$):</label>
            <input type="number" name="preco" step="0.01" value="<?=$preco?>" required class="form-control">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Atualizar Item" class="btn btn-primary">
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
