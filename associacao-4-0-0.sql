-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Maio-2019 às 02:53
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remodelado`
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
  `id_pessoa` int(11) NOT NULL,
  `id_responsavel` int(11) DEFAULT NULL,
  `id_curso_ref` int(11) NOT NULL,
  `id_caixa_ref` int(11) NOT NULL,
  `saldo` decimal(15,2) DEFAULT '0.00',
  `data_inicio` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `previsao_conclusao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `concluido` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixa`
--

CREATE TABLE `caixa` (
  `id_caixa` int(11) NOT NULL,
  `nome_caixa` varchar(50) NOT NULL,
  `data_abertura` date NOT NULL,
  `data_fechamento` date DEFAULT NULL,
  `saldo_inicial` decimal(15,2) NOT NULL,
  `saldo_final` decimal(15,2) DEFAULT NULL,
  `saldo_atual` decimal(15,2) DEFAULT NULL,
  `aberto` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_curso` int(11) NOT NULL,
  `nome_curso` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `turno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nivel` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `diretoria`
--

CREATE TABLE `diretoria` (
  `id_pessoa` int(11) NOT NULL,
  `cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimento`
--

CREATE TABLE `movimento` (
  `id_movimento` int(11) NOT NULL,
  `id_caixa_ref` int(11) NOT NULL,
  `id_tipo_ref` int(11) NOT NULL,
  `id_pessoa_ref` int(11) NOT NULL,
  `data_movimento` date NOT NULL,
  `valor_movimento` decimal(15,2) NOT NULL,
  `saldo_movimento` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf_cnpj` varchar(19) NOT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipomovimento`
--

CREATE TABLE `tipomovimento` (
  `id_tipo_movimento` int(11) NOT NULL,
  `nome_tipo_movimento` varchar(50) NOT NULL,
  `tipo` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_pessoa` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'Não Registrado',
  `data_nasc` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `data_associacao` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fotoPerfil` varchar(150) COLLATE utf8_unicode_ci DEFAULT '../Img/Src/user_icon.png',
  `pode_logar` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'false',
  `administrador` varchar(30) COLLATE utf8_unicode_ci DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  ADD PRIMARY KEY (`id_pessoa`),
  ADD KEY `id_responsavel` (`id_responsavel`),
  ADD KEY `id_curso_ref` (`id_curso_ref`);

--
-- Indexes for table `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id_caixa`);

--
-- Indexes for table `contato`
--
ALTER TABLE `contato`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `diretoria`
--
ALTER TABLE `diretoria`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Indexes for table `movimento`
--
ALTER TABLE `movimento`
  ADD PRIMARY KEY (`id_movimento`),
  ADD KEY `id_caixa_ref` (`id_caixa_ref`),
  ADD KEY `id_tipo_ref` (`id_tipo_ref`),
  ADD KEY `id_pessoa_ref` (`id_pessoa_ref`);

--
-- Indexes for table `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD UNIQUE KEY `cpf_cnpj` (`cpf_cnpj`);

--
-- Indexes for table `tipomovimento`
--
ALTER TABLE `tipomovimento`
  ADD PRIMARY KEY (`id_tipo_movimento`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acesso_negado`
--
ALTER TABLE `acesso_negado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id_caixa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contato`
--
ALTER TABLE `contato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `curso`
--
ALTER TABLE `curso`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movimento`
--
ALTER TABLE `movimento`
  MODIFY `id_movimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipomovimento`
--
ALTER TABLE `tipomovimento`
  MODIFY `id_tipo_movimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `aluno_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `usuario` (`id_pessoa`),
  ADD CONSTRAINT `aluno_ibfk_2` FOREIGN KEY (`id_responsavel`) REFERENCES `pessoa` (`id_pessoa`),
  ADD CONSTRAINT `aluno_ibfk_3` FOREIGN KEY (`id_curso_ref`) REFERENCES `curso` (`id_curso`);

--
-- Limitadores para a tabela `diretoria`
--
ALTER TABLE `diretoria`
  ADD CONSTRAINT `diretoria_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `usuario` (`id_pessoa`);

--
-- Limitadores para a tabela `movimento`
--
ALTER TABLE `movimento`
  ADD CONSTRAINT `movimento_ibfk_1` FOREIGN KEY (`id_caixa_ref`) REFERENCES `caixa` (`id_caixa`),
  ADD CONSTRAINT `movimento_ibfk_2` FOREIGN KEY (`id_tipo_ref`) REFERENCES `tipomovimento` (`id_tipo_movimento`),
  ADD CONSTRAINT `movimento_ibfk_3` FOREIGN KEY (`id_pessoa_ref`) REFERENCES `pessoa` (`id_pessoa`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id_pessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
