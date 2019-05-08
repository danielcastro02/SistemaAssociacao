-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Maio-2019 às 02:06
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
-- Database: `livro caixa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id_aluno` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id_aluno`, `nome`) VALUES
(1, 'ALUNO 1'),
(2, 'ALUNO 2'),
(3, 'ALUNO3'),
(4, 'ALUNO 4'),
(5, 'ALUNO 5'),
(6, 'ALUNO 6'),
(7, 'ALUNO 7'),
(8, 'ALUNO 8'),
(9, 'ALUNO 9'),
(10, 'ALUNO 10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `id_conta` int(1) NOT NULL,
  `conta` varchar(10) NOT NULL,
  `saldo_anterior` double(10,2) NOT NULL,
  `total_entrada` double(10,2) NOT NULL,
  `total_saida` double(10,2) NOT NULL,
  `saldo_atual` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id_conta`, `conta`, `saldo_anterior`, `total_entrada`, `total_saida`, `saldo_atual`) VALUES
(1, 'DIURNO', 0.00, 0.00, 0.00, 0.00),
(2, 'NOTURNO', 0.00, 0.00, 0.00, 0.00),
(3, 'ASSOCIAÇÃO', 0.00, 0.00, 0.00, 0.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_lancamento`
--

CREATE TABLE `historico_lancamento` (
  `ID_lancamento` int(3) NOT NULL,
  `historico` varchar(50) NOT NULL,
  `tipo_lancamento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `historico_lancamento`
--

INSERT INTO `historico_lancamento` (`ID_lancamento`, `historico`, `tipo_lancamento`) VALUES
(1, 'SALDO ANTERIOR', 3),
(2, 'RECEBIMENTO DE MENSALIDADE', 1),
(3, 'PAGAMENTO EMPRESA DE ONIBUS', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro_caixa`
--

CREATE TABLE `livro_caixa` (
  `id_registro` int(11) NOT NULL,
  `dt_lancamento` date NOT NULL,
  `id_hist_lancamento` int(3) NOT NULL,
  `id_referencia` int(11) DEFAULT NULL,
  `id_tipo_lancamento` int(1) NOT NULL,
  `id_conta` int(1) NOT NULL,
  `valor` double(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro_caixa`
--

INSERT INTO `livro_caixa` (`id_registro`, `dt_lancamento`, `id_hist_lancamento`, `id_referencia`, `id_tipo_lancamento`, `id_conta`, `valor`) VALUES
(3, '2019-04-24', 2, 10, 2, 1, 100.00),
(6, '2019-04-23', 1, NULL, 1, 1, 125.00),
(7, '2019-04-24', 3, 6, 3, 1, 50.00),
(8, '2019-04-24', 2, 2, 2, 1, 38.00),
(9, '2019-04-29', 2, 4, 2, 2, 125.35),
(10, '2019-04-29', 2, 8, 2, 1, 55.55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `referencia`
--

CREATE TABLE `referencia` (
  `id_referencia` int(11) NOT NULL,
  `tipo_referencia` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `referencia`
--

INSERT INTO `referencia` (`id_referencia`, `tipo_referencia`) VALUES
(1, 'SALDO À TRANSPORTAR');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_lancamento`
--

CREATE TABLE `tipo_lancamento` (
  `id_tipo_lancamento` int(1) NOT NULL,
  `hist_tipo_lancamento` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_lancamento`
--

INSERT INTO `tipo_lancamento` (`id_tipo_lancamento`, `hist_tipo_lancamento`) VALUES
(1, 'SALDO'),
(2, 'ENTRADA'),
(3, 'SAIDA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id_aluno`);

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id_conta`);

--
-- Indexes for table `historico_lancamento`
--
ALTER TABLE `historico_lancamento`
  ADD PRIMARY KEY (`ID_lancamento`),
  ADD KEY `tipo_lancamento` (`tipo_lancamento`);

--
-- Indexes for table `livro_caixa`
--
ALTER TABLE `livro_caixa`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `dt_lancamento` (`dt_lancamento`) USING BTREE,
  ADD KEY `id_conta` (`id_conta`),
  ADD KEY `id_lancamento` (`id_hist_lancamento`),
  ADD KEY `id_tipo_lancamento` (`id_tipo_lancamento`),
  ADD KEY `id_aluno` (`id_referencia`);

--
-- Indexes for table `referencia`
--
ALTER TABLE `referencia`
  ADD PRIMARY KEY (`id_referencia`);

--
-- Indexes for table `tipo_lancamento`
--
ALTER TABLE `tipo_lancamento`
  ADD PRIMARY KEY (`id_tipo_lancamento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id_aluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `id_conta` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `historico_lancamento`
--
ALTER TABLE `historico_lancamento`
  MODIFY `ID_lancamento` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `livro_caixa`
--
ALTER TABLE `livro_caixa`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipo_lancamento`
--
ALTER TABLE `tipo_lancamento`
  MODIFY `id_tipo_lancamento` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `historico_lancamento`
--
ALTER TABLE `historico_lancamento`
  ADD CONSTRAINT `historico_lancamento_ibfk_1` FOREIGN KEY (`tipo_lancamento`) REFERENCES `tipo_lancamento` (`id_tipo_lancamento`);

--
-- Limitadores para a tabela `livro_caixa`
--
ALTER TABLE `livro_caixa`
  ADD CONSTRAINT `livro_caixa_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  ADD CONSTRAINT `livro_caixa_ibfk_2` FOREIGN KEY (`id_hist_lancamento`) REFERENCES `historico_lancamento` (`ID_lancamento`),
  ADD CONSTRAINT `livro_caixa_ibfk_3` FOREIGN KEY (`id_tipo_lancamento`) REFERENCES `tipo_lancamento` (`id_tipo_lancamento`),
  ADD CONSTRAINT `livro_caixa_ibfk_4` FOREIGN KEY (`id_referencia`) REFERENCES `alunos` (`id_aluno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
