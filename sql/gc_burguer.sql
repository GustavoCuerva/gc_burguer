-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Out-2022 às 22:34
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

--
-- Extraindo dados da tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `id_usuario`, `nota`, `comentario`, `data_avaliacao`) VALUES
(1, 3, 5, 'Ótimas instalações, funcionários muito educados e simpáticos\r\nExcelente ambiente familiar!', '2022-10-28'),
(2, 4, 3, 'Lanches de excelente qualidade, ambiente agradável só que com poucas variedades. Mas é uma excelente opção para um passeio.', '2022-10-28'),
(3, 5, 4, 'Muito bom, excelentes profissionais e lanches muito bons.\r\nEstá sempre bem cheio então é necessário chegar lá com sua reserva já efetuada\r\n', '2022-10-28');

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
(8, 4, 'Sobremesa', 'Copo de chocolate', 'copodechocolate', 'Copo de chocolate com amendoim', 'img/produtos/copodechocolate.png', '10,00', '2022-10-23'),
(12, 3, 'Bebidas', 'Suco de maracujá', 'sucodemaracuja', 'Suco natural de maracujá 300ml', 'img/produtos/sucodemaracuja.jpg', '10,00', '2022-10-28'),
(13, 3, 'Bebidas', 'Coca Cola', 'cocacola', 'Coca Cola 500ml', 'img/produtos/cocacola.jpg', '12,00', '2022-10-28'),
(14, 3, 'Bebidas', 'Cerveja', 'cerveja', 'Copo 600ml', 'img/produtos/cerveja.jpg', '13,00', '2022-10-28'),
(15, 3, 'Bebidas', 'Suco de limão', 'sucodelimao', '300ml de suco de limão natural', 'img/produtos/sucodelimao.jpg', '7,00', '2022-10-28'),
(16, 3, 'Bebidas', 'Jarra suco de limão', 'jarrasucodelimao', 'Jarra de 1l de suco natural', 'img/produtos/jarrasucodelimao.jpg', '15,00', '2022-10-28'),
(17, 3, 'Bebidas', 'Suco de abacaxi', 'sucodeabacaxi', 'Suco natural\r\n350ml', 'img/produtos/sucodeabacaxi.jpg', '12,00', '2022-10-28'),
(18, 3, 'Bebidas', 'Suco de abacaxi com hortelã', 'sucodeabacaxicomhortela', 'Suco natural\r\n500ml', 'img/produtos/sucodeabacaxicomhortela.jpg', '20,00', '2022-10-28'),
(19, 4, 'Sobremesa', 'Torta de maça', 'tortademaca', 'Torta de maça\r\nServe até 6 pessoas', 'img/produtos/tortademaca.jpg', '20,00', '2022-10-28'),
(20, 4, 'Sobremesa', 'Mousse de chocolate', 'moussedechocolate', 'Porção individual', 'img/produtos/moussedechocolate.jpg', '10,00', '2022-10-28'),
(21, 4, 'Sobremesa', 'Sorvete de morango', 'sorvetedemorango', 'Na taça de 300ml', 'img/produtos/sorvetedemorango.jpg', '15,00', '2022-10-28'),
(22, 2, 'Lanches', 'Costela', 'costela', 'Lanche de costela de boi', 'img/produtos/costela.jpg', '30,00', '2022-10-28'),
(23, 2, 'Lanches', 'Bacon com chedar', 'baconcomchedar', 'Lanche de bacon com chedar', 'img/produtos/baconcomchedar.png', '33,45', '2022-10-28');

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
(7, 3, '2022-11-02', '20:25:00', 3, '1', 0, '2022-10-28'),
(8, 3, '2022-11-05', '20:25:00', 6, 'Aguardando confirmacao', 1, '2022-10-28'),
(9, 3, '2022-11-10', '18:30:00', 4, 'Aguardando confirmacao', 1, '2022-10-28'),
(10, 4, '2022-10-29', '20:30:00', 1, '1', 0, '2022-10-28'),
(11, 4, '2022-11-05', '20:30:00', 4, 'Aguardando confirmacao', 1, '2022-10-28'),
(12, 5, '2022-11-02', '18:30:00', 3, 'Aguardando confirmacao', 1, '2022-10-28'),
(13, 5, '2022-11-04', '20:31:00', 4, 'Aguardando confirmacao', 1, '2022-10-28');

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
(5, 1, 6, '2022-10-23'),
(11, 3, 2, '2022-10-28'),
(12, 3, 12, '2022-10-28'),
(13, 3, 15, '2022-10-28'),
(14, 3, 16, '2022-10-28'),
(15, 3, 18, '2022-10-28'),
(16, 3, 7, '2022-10-28'),
(17, 3, 23, '2022-10-28'),
(18, 3, 20, '2022-10-28'),
(19, 3, 21, '2022-10-28'),
(20, 4, 7, '2022-10-28'),
(21, 4, 22, '2022-10-28'),
(22, 4, 6, '2022-10-28'),
(23, 4, 14, '2022-10-28'),
(24, 4, 18, '2022-10-28'),
(25, 5, 13, '2022-10-28'),
(26, 5, 6, '2022-10-28'),
(27, 5, 22, '2022-10-28'),
(28, 5, 23, '2022-10-28'),
(29, 5, 4, '2022-10-28'),
(30, 5, 3, '2022-10-28'),
(31, 5, 5, '2022-10-28');

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
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '(11)967009012', 1, '2022-10-23'),
(3, 'usuario1', 'usuario1@gmail.com', '122b738600a0f74f7c331c0ef59bc34c', '119645215', 0, '2022-10-28'),
(4, 'usuario2', 'usuario2@gmail.com', '2fb6c8d2f3842a5ceaa9bf320e649ff0', '119999999', 0, '2022-10-28'),
(5, 'usuario3', 'usuario3@gmail.com', '5a54c609c08a0ab3f7f8eef1365bfda6', '222222222', 0, '2022-10-28');

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
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `salvos`
--
ALTER TABLE `salvos`
  MODIFY `id_salvo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
