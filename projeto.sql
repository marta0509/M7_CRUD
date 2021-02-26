-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Fev-2021 às 13:21
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulaconducao`
--

CREATE TABLE `aulaconducao` (
  `id` int(11) NOT NULL,
  `id_escola` int(11) NOT NULL,
  `data` date NOT NULL,
  `instrutor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aulaconducao`
--

INSERT INTO `aulaconducao` (`id`, `id_escola`, `data`, `instrutor`) VALUES
(7, 14, '2020-12-02', 'Maria'),
(9, 7, '2021-03-15', 'Antonio'),
(10, 13, '2020-06-26', 'Manuel'),
(11, 15, '2021-04-05', 'Rita'),
(12, 16, '2021-05-11', 'Francisco'),
(13, 17, '2021-08-30', 'Roberto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolaconducao`
--

CREATE TABLE `escolaconducao` (
  `id_escola` int(11) NOT NULL,
  `escola` varchar(50) NOT NULL,
  `descricao` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `escolaconducao`
--

INSERT INTO `escolaconducao` (`id_escola`, `escola`, `descricao`) VALUES
(7, 'Rio Vizela', 'Escola de condução situada em Vizela'),
(13, 'Avilense', 'Escola de condu??o situada em vila das aves'),
(14, 'Eficiência', 'Escola de condu??o situada em s.tom? de negrelos'),
(15, 'Condução Máxima', 'Escola de condução situada na Trofa'),
(16, 'O volante', 'Escola de condu??o situada em Santo Tirso'),
(17, 'A desportiva', 'Escola de condu??o situada em Santo Tirso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id_utilizador` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id_utilizador`, `user_name`, `nome`, `email`, `data_nascimento`, `password`) VALUES
(6, 'marta', 'Marta', 'a14177@aedah.pt', '2003-09-05', '$2y$10$5MKMOPU4vk9KaeX4mdQ0ne5VaW9pDeTl.x.KDRupkve'),
(7, 'jose_', 'JosÃ© Alves', 'jose@gmail.com', '1999-02-19', '$2y$10$/jUu9xRbVDTx4Hw.fr9IRupdNCdLZs66Bam4I6iuK1H'),
(9, 'Rita_Ferr', 'Rita', 'ritaaa44@gmail.com', '2000-04-25', '$2y$10$nFnZPxxyO1QemjvZORapkeNI9QGmR/LfBfQmGmNBT15'),
(10, 'aaanselmo', 'Anselmo', 'anselmoop@gmail.com', '1994-09-13', '$2y$10$Xttl6XTywtJ8tYWHJdYQeOC/grdKuQP7LHG/MhVYyEb'),
(11, 'vaniaar', 'Vania', 'vaniaar@gmail.com', '2000-06-17', '$2y$10$2l9x/Uxa8iYyPTdxQFOHSOIlBmPyZe4GVFJId0P0xwL'),
(12, 'Dinnis', 'Dinis', 'dinniss_13@gmail.com', '2002-06-13', '$2y$10$IM37LF4cUagprlBizMLPpet5YFYhRdOialVxVSlORCu');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aulaconducao`
--
ALTER TABLE `aulaconducao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_escola` (`id_escola`);

--
-- Índices para tabela `escolaconducao`
--
ALTER TABLE `escolaconducao`
  ADD PRIMARY KEY (`id_escola`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id_utilizador`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulaconducao`
--
ALTER TABLE `aulaconducao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `escolaconducao`
--
ALTER TABLE `escolaconducao`
  MODIFY `id_escola` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aulaconducao`
--
ALTER TABLE `aulaconducao`
  ADD CONSTRAINT `aulaconducao_ibfk_1` FOREIGN KEY (`id_escola`) REFERENCES `escolaconducao` (`id_escola`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
