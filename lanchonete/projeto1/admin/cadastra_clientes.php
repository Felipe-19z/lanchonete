<?php

    require_once "config.inc.php";

    $sql = "INSERT INTO  clientes (cliente, cidade, estado)VALUES (
            '$_POST[nome]','$_POST[cidade]','$_POST[estado]')";

    $execute = mysqli_query($conexao, $sql);

    if ($execute) {
        echo "<br><h2>Cliente cadastrado com sucesso!</h2><br>";
        echo "<a href='?pg=admin_clientes'>Voltar</a>";
    }else{
        echo "<h2>Houve um erro ao cadastrar o cliente!</h2><br>";
    }