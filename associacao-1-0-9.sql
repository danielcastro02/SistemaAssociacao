-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25-Abr-2019 às 02:56
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

drop database associacao;
create database associacao;
use associcao;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `associacao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_negado`
--

CREATE TABLE `acesso_negado` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_usuario` int(11) NOT NULL,
  `id_responsavel` int(11) DEFAULT NULL,
  `curso` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `previsao_conclusao` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_usuario`, `id_responsavel`, `curso`, `saldo`, `previsao_conclusao`) VALUES
(17, NULL, 'ADS', '0.00', '20/12/2019'),
(18, 20, 'a', '0.00', '30/04/2019'),
(21, NULL, 'c', '0.00', '15/04/2021'),
(23, NULL, 'ads', '0.00', '18/04/2019');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motivo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretoria`
--

CREATE TABLE `diretoria` (
  `id_usuario` int(11) NOT NULL,
  `cargo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `diretoria`
--

INSERT INTO `diretoria` (`id_usuario`, `cargo`) VALUES
(1, 'Presidente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rua` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nasc` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fotoPerfil` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pode_logar` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `administrador` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `cidade`, `bairro`, `rua`, `numero`, `cep`, `cpf`, `rg`, `data_nasc`, `telefone`, `email`, `fotoPerfil`, `pode_logar`, `administrador`) VALUES
(1, 'Paulo Glanzel', 'pglanzel', '202cb962ac59075b964b07152d234b70', 'Cacequi', 'Vila Candido', 'Marechal Hermes da Fonseca', '337', '97450-00', '', '', '00/00/0000', '55 98431-2589', 'pauloglanzel@hotmail.com', '../Img/user_icon.png', 'true', 'true'),
(9, 'Daniel Zanini de Castro', 'dcastro', '202cb962ac59075b964b07152d234b70', 'Jaguari', 'Centro', 'Dr. Severiano de Almeida', '280', '97760-000', '039.855.650-40', '5123700465', '10/03/2000', '55 99959-8414', 'zanini.castro@hotmail.com', '../Img/45c48cce2e2d7fbdea1afc51c7c6ad26.jpg', 'true', 'true'),
(17, 'Konrado Lorenzon de Souza', 'konradols', '5b2cc5cd7b54390a9525d24fba623bc9', 'Cacequi', 'Centro', 'Bento GonÃ§alves', '307', '97450000', '029.477.090-98', '4116813546', '19/01/1999', '55991192589', 'konradols@hotmail.com', '../Img/user_icon.png', 'true', 'false'),
(18, 'a', 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', 'a', 'a', 'a', '039.855.650-40', '999999999', '16/04/2014', 'a', 'a', '../Img/user_icon.png', 'true', 'false'),
(20, 'b', 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', 'b', 'b', 'b', 'q', 'd', '08/04/1999', 'b', 'b', '../Img/user_icon.png', 'true', 'false'),
(21, 'c', 'c', '4a8a08f09d37b73795649038408b5f33', 'c', 'c', 'c', 'c', 'c', '039.855.650-40', 'a', '16/04/2014', 'c', 'c', '../Img/user_icon.png', 'true', 'false'),
(23, 'Lucas de Lima Silva', 'l', '2db95e8e1a9267b7a1188556b2013b33', 'SVS', 'Rural', 'PaÃ§o do FranÃ§a', '233', '9', '99999999', '56489894', '21/02/1991', '9', 'aaa@email.com', '../Img/user_icon.png', 'true', 'false');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acesso_negado`
--
ALTER TABLE `acesso_negado`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_responsavel` (`id_responsavel`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diretoria`
--
ALTER TABLE `diretoria`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acesso_negado`
--
ALTER TABLE `acesso_negado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_responsavel`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `diretoria`
--
ALTER TABLE `diretoria`
  ADD CONSTRAINT `diretoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
