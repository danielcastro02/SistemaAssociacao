-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Maio-2019 às 21:42
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

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
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id_usuario` int(11) NOT NULL,
  `id_responsavel` int(11) DEFAULT NULL,
  `id_curso` int(11) NOT NULL,
  `saldo` decimal(15,2) DEFAULT '0.00',
  `data_inicio` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `previsao_conclusao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `concluido` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id_usuario`, `id_responsavel`, `id_curso`, `saldo`, `data_inicio`, `previsao_conclusao`, `concluido`) VALUES
(1, NULL, 1, '0.00', '01/01/2017', '30/12/2019', 'false');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE `contato` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motivo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descricao` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `turno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `turno`, `nivel`) VALUES
(1, 'Analise e Desenvolvimento de Sistemas', 'Tarde', 'Superior');

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretoria`
--

CREATE TABLE `diretoria` (
  `id_usuario` int(11) NOT NULL,
  `cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_nasc` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data_associacao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fotoPerfil` varchar(150) COLLATE utf8_unicode_ci DEFAULT '../Img/Src/user_icon.png',
  `pode_logar` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'false',
  `administrador` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `usuario`, `senha`, `cidade`, `bairro`, `rua`, `numero`, `cep`, `cpf`, `rg`, `data_nasc`, `telefone`, `email`, `data_associacao`, `fotoPerfil`, `pode_logar`, `administrador`) VALUES
(1, 'Daniel Zanini de Castro', 'dcastro', 'f903d5d4141b05ae28192bc3d75e0491', 'Jaguari', 'Centro', 'Av. dr. severiano de almeida', '280', '97760-000', '039.855.650-40', '5123700463', '10/03/2000', '(55) 55995-9841', 'zanini.castro@hotmail.com', '01/01/2019', '../Img/Perfil/c4ca4238a0b923820dcc509a6f75849b.png', 'true', 'true');

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
  ADD KEY `id_responsavel` (`id_responsavel`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `rg` (`rg`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_responsavel`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`);

--
-- Limitadores para a tabela `diretoria`
--
ALTER TABLE `diretoria`
  ADD CONSTRAINT `diretoria_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
