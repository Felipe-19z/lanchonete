<?php
    require_once "config.inc.php";
    
    // Criar tabela
    $sql_tabela = "CREATE TABLE IF NOT EXISTS comidas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        descricao TEXT,
        preco DECIMAL(10, 2) NOT NULL
    )";
    
    if(mysqli_query($conexao, $sql_tabela)){
        echo "Tabela 'comidas' criada com sucesso!<br>";
    } else {
        echo "Erro ao criar tabela: " . mysqli_error($conexao) . "<br>";
    }
    
    // Inserir dados
    $sql_dados = "INSERT INTO comidas (nome, categoria, descricao, preco) VALUES
    ('Empada', 'Entrada', '', 3.00),
    ('Pão de alho', 'Entrada', '', 2.00),
    ('Batata Frita', 'Entrada', '', 5.00),
    ('Saladas Leves', 'Entrada', '', 4.00),
    ('Hamburguer Tradicional', 'Principal', 'Hamburguer, Alface, Tomate, Cebola', 6.00),
    ('Sertanejo', 'Principal', 'Carne de sol desfiado, Queijo coalho, Alface, cebola dourada', 10.00),
    ('X-calabresa', 'Principal', 'Calabresa fatiada, Hamburguer, Alface, tomate, cebola', 9.00),
    ('X-Frango', 'Principal', 'Frango desfiado, Hamburguer, Alface, tomate, cebola', 8.00),
    ('X-Picanha', 'Principal', 'Queijo cheddar derretido, Carne de hamburguer artesanal, Cebola dourada', 12.00),
    ('X-Tudo', 'Principal', 'Frango desfiado, Hamburguer artesanal, Calabresa fatiada, Alface, tomate, cebola dourada, queijo cheddar derretido', 30.00),
    ('Sorvete', 'Sobremesa', 'Chocolate, Morango, Leite Ninho, Nutella, Leite condensado, Napolitano, Coco, Manga, Choco Blue, Chocolate Escuro', 3.00),
    ('Brownie', 'Sobremesa', '', 5.00),
    ('Petit Gateau', 'Sobremesa', '', 7.00),
    ('Trufas', 'Sobremesa', 'Nutella, Chocolate ao leite, Oreo, Chocolate branco, amendoim, Leite ninho, Doce de leite, Coco, Hortelã', 0.00),
    ('Coca cola 350ml', 'Bebida', '', 5.00),
    ('Coca cola 500ml', 'Bebida', '', 7.50),
    ('Coca cola 1L', 'Bebida', '', 11.00),
    ('Coca cola 2L', 'Bebida', '', 15.00),
    ('Café pequeno', 'Bebida', '', 1.00),
    ('Café médio', 'Bebida', '', 3.00),
    ('Café Grande', 'Bebida', '', 5.00),
    ('Cappucino', 'Bebida', '', 6.00),
    ('Milkshake', 'Bebida', 'Nutella, Chocolate ao leite, Oreo, Chocolate branco, amendoim, Leite ninho, Doce de leite, Coco, Hortelã', 10.00),
    ('Suco de frutas 1L', 'Bebida', 'Acerola, abacaxi, Maracujá, Manga, Laranja, Uva, Goiaba', 6.00)";
    
    if(mysqli_query($conexao, $sql_dados)){
        echo "Dados inseridos com sucesso!<br>";
    } else {
        echo "Erro ao inserir dados: " . mysqli_error($conexao) . "<br>";
    }
    
    // Criar tabelas de pedidos (idempotente)
    $sql_pedidos = "CREATE TABLE IF NOT EXISTS pedidos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_nome VARCHAR(150) NOT NULL,
        status VARCHAR(50) NOT NULL DEFAULT 'Pendente',
        criado_em DATETIME NOT NULL,
        entregue_em DATETIME NULL,
        telefone VARCHAR(50) DEFAULT NULL,
        endereco TEXT DEFAULT NULL,
        observacoes TEXT DEFAULT NULL
    )";
    if(mysqli_query($conexao, $sql_pedidos)){
        echo "Tabela 'pedidos' pronta.<br>";
    } else {
        echo "Erro ao criar tabela pedidos: " . mysqli_error($conexao) . "<br>";
    }

    $sql_itens = "CREATE TABLE IF NOT EXISTS pedido_itens (
        id INT AUTO_INCREMENT PRIMARY KEY,
        pedido_id INT NOT NULL,
        comida_id INT NULL,
        nome VARCHAR(150) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        quantidade INT NOT NULL,
        FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE
    )";
    if(mysqli_query($conexao, $sql_itens)){
        echo "Tabela 'pedido_itens' pronta.<br>";
    } else {
        echo "Erro ao criar tabela pedido_itens: " . mysqli_error($conexao) . "<br>";
    }

    // Garantir colunas adicionais caso a tabela já exista (MySQL 8+ suporta IF NOT EXISTS)
    mysqli_query($conexao, "ALTER TABLE pedidos ADD COLUMN IF NOT EXISTS telefone VARCHAR(50) DEFAULT NULL");
    mysqli_query($conexao, "ALTER TABLE pedidos ADD COLUMN IF NOT EXISTS endereco TEXT DEFAULT NULL");
    mysqli_query($conexao, "ALTER TABLE pedidos ADD COLUMN IF NOT EXISTS observacoes TEXT DEFAULT NULL");

    echo "<a href='index.php?pg=admin_comidas'>Voltar para Cardápio</a>";
?>
