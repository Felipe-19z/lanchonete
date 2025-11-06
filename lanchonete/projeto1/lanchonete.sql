-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2025 às 18:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lanchonete`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `cliente`, `cidade`, `estado`) VALUES
(6, 'Denise', 'João Pessoa', 'PB'),
(7, 'Felipe Pai', 'Rio de janeiro', 'RJ'),
(8, 'Michele', 'João Pessoa', 'PB'),
(9, 'Gustavo', 'Rio de janeiro', 'RJ'),
(10, 'Lucas Nascimento', 'Campina Grande', 'PB'),
(11, 'Vinicius', 'João Pessoa', 'PB');

-- --------------------------------------------------------

--
-- Estrutura para tabela `comidas`
--

CREATE TABLE `comidas` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `comidas`
--

INSERT INTO `comidas` (`id`, `nome`, `categoria`, `descricao`, `preco`) VALUES
(1, 'Empada', 'Entrada', '', 3.00),
(2, 'Pão de alho', 'Entrada', '', 2.00),
(3, 'Batata Frita', 'Entrada', '', 5.00),
(4, 'Saladas Leves', 'Entrada', '', 4.00),
(5, 'Hamburguer Tradicional', 'Principal', 'Hamburguer, Alface, Tomate, Cebola', 6.00),
(6, 'Sertanejo', 'Principal', 'Carne de sol desfiado, Queijo coalho, Alface, cebola dourada', 10.00),
(7, 'X-calabresa', 'Principal', 'Calabresa fatiada, Hamburguer, Alface, tomate, cebola', 9.00),
(8, 'X-Frango', 'Principal', 'Frango desfiado, Hamburguer, Alface, tomate, cebola', 8.00),
(9, 'X-Picanha', 'Principal', 'Queijo cheddar derretido, Carne de hamburguer artesanal, Cebola dourada', 12.00),
(10, 'X-Tudo', 'Principal', 'Frango desfiado, Hamburguer artesanal, Calabresa fatiada, Alface, tomate, cebola dourada, queijo cheddar derretido', 30.00),
(11, 'Sorvete', 'Sobremesa', 'Chocolate, Morango, Leite Ninho, Nutella, Leite condensado, Napolitano, Coco, Manga, Choco Blue, Chocolate Escuro', 3.00),
(12, 'Brownie', 'Sobremesa', '', 5.00),
(13, 'Petit Gateau', 'Sobremesa', '', 7.00),
(14, 'Trufas', 'Sobremesa', 'Nutella, Chocolate ao leite, Oreo, Chocolate branco, amendoim, Leite ninho, Doce de leite, Coco, Hortelã', 2.00),
(15, 'Coca cola 350ml', 'Bebida', '', 5.00),
(16, 'Coca cola 500ml', 'Bebida', '', 7.50),
(17, 'Coca cola 1L', 'Bebida', '', 11.00),
(18, 'Coca cola 2L', 'Bebida', '', 15.00),
(19, 'Café pequeno', 'Bebida', '', 1.00),
(20, 'Café médio', 'Bebida', '', 3.00),
(21, 'Café Grande', 'Bebida', '', 5.00),
(22, 'Milkshake', 'Bebida', '', 10.00),
(23, 'Suco de frutas 1L', 'Bebida', 'Acerola, abacaxi, Maracujá, Manga, Laranja, Uva, Goiaba', 6.00),
(52, 'Capuccino', 'Bebida', '', 6.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_nome` varchar(150) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pendente',
  `criado_em` datetime NOT NULL,
  `entregue_em` datetime DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `observacoes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `comida_id` int(11) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comidas`
--
ALTER TABLE `comidas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_comidas_nome` (`nome`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `comidas`
--
ALTER TABLE `comidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
