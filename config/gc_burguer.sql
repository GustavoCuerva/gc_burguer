-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2022 às 15:28
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gc_burguer`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_avaliacao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `nome_categoria` varchar(100) NOT NULL,
  `img` varchar(200) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`, `nome_categoria`, `img`, `data_cadastro`) VALUES
(1, 'Combos', 'combos', 'img/categoria/combos.jpg', '2022-10-23'),
(2, 'Lanches', 'lanches', 'img/categoria/lanches.png', '2022-10-23'),
(3, 'Bebidas', 'bebidas', 'img/categoria/bebidas.jpg', '2022-10-23'),
(4, 'Sobremesa', 'sobremesa', 'img/categoria/sobremesa.png', '2022-10-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes_hamburgueiria`
--

CREATE TABLE `informacoes_hamburgueiria` (
  `id` int(11) NOT NULL,
  `horario_inicio` time NOT NULL,
  `horario_fim` time NOT NULL,
  `endereco` text NOT NULL,
  `capacidade` int(11) NOT NULL,
  `mesas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `informacoes_hamburgueiria`
--

INSERT INTO `informacoes_hamburgueiria` (`id`, `horario_inicio`, `horario_fim`, `endereco`, `capacidade`, `mesas`) VALUES
(1, '18:00:00', '00:00:00', 'Avenida Paulista 2222', 50, 12);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_produto` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `valor` varchar(10) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categoria`, `categoria`, `nome`, `nome_produto`, `descricao`, `imagem`, `valor`, `data_cadastro`) VALUES
(1, 1, 'Combos', 'Combo Bacon', 'combobacon', 'Hamburguer de Bacon\r\nBatata frita\r\nRefrigerante', 'img/produtos/combobacon.jpg', '32,50', '2022-10-23'),
(2, 1, 'Combos', 'Duplo Bacon', 'duplobacon', '1 Hamburguer duplo de bacon\r\n1 Batata \r\n1 Refrigerante', 'img/produtos/duplobacon.jpg', '36,00', '2022-10-23'),
(3, 1, 'Combos', 'Compre 1 Leve 2', 'compre1leve2', '2 Hamburgues médios\r\n1 Batata', 'img/produtos/compre1leve2.jpg', '40,00', '2022-10-23'),
(4, 1, 'Combos', 'Combo Picanha', 'combopicanha', 'Hamburguer picanha\r\nBatata\r\nRefrigerante', 'img/produtos/combopicanha.jpg', '32,50', '2022-10-23'),
(5, 1, 'Combos', 'Combo simples', 'combosimples', 'Hamburguer médio\r\nBatata', 'img/produtos/combosimples.jpg', '29,99', '2022-10-23'),
(6, 2, 'Lanches', 'Hamburguer picanha', 'hamburguerpicanha', 'Hamburguer picanha\r\nSalada\r\nCheedar', 'img/produtos/hamburguerpicanha.jpg', '29,50', '2022-10-23'),
(7, 2, 'Lanches', 'Duplo Cheddar', 'duplocheddar', '2 carnes\r\ncheedar', 'img/produtos/duplocheddar.png', '26,00', '2022-10-23'),
(8, 4, 'Sobremesa', 'Copo de chocolate', 'copodechocolate', 'Copo de chocolate com amendoim', 'img/produtos/copodechocolate.png', '10,00', '2022-10-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_reserva` date NOT NULL,
  `horario` time NOT NULL,
  `quantidade` int(11) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'Aguardando confirmacao',
  `status` int(11) NOT NULL DEFAULT 1,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`id`, `id_usuario`, `data_reserva`, `horario`, `quantidade`, `mesa`, `status`, `data_cadastro`) VALUES
(1, 1, '2022-10-23', '19:30:00', 2, 'Reserva vencida', 2, '2022-10-23'),
(2, 1, '2022-10-27', '20:30:00', 4, '1', 0, '2022-10-23'),
(3, 1, '2022-10-26', '19:30:00', 1, 'Reserva cancelada', 3, '2022-10-23'),
(4, 1, '2022-10-23', '18:01:00', 6, 'Reserva vencida', 2, '2022-10-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salvos`
--

CREATE TABLE `salvos` (
  `id_salvo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `salvos`
--

INSERT INTO `salvos` (`id_salvo`, `id_usuario`, `id_produto`, `data`) VALUES
(1, 1, 2, '2022-10-23'),
(2, 1, 4, '2022-10-23'),
(3, 1, 3, '2022-10-23'),
(4, 1, 5, '2022-10-23'),
(5, 1, 6, '2022-10-23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `permissao` int(11) NOT NULL DEFAULT 0,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `permissao`, `data_cadastro`) VALUES
(1, 'admin', 'gustavoccuerva@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '(11)967009012', 1, '2022-10-23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `informacoes_hamburgueiria`
--
ALTER TABLE `informacoes_hamburgueiria`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `salvos`
--
ALTER TABLE `salvos`
  ADD PRIMARY KEY (`id_salvo`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `informacoes_hamburgueiria`
--
ALTER TABLE `informacoes_hamburgueiria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `salvos`
--
ALTER TABLE `salvos`
  MODIFY `id_salvo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
