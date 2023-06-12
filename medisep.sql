-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jun-2023 às 12:46
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `medisep`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id` int(9) NOT NULL,
  `id_medico` int(9) NOT NULL,
  `id_paciente` int(9) NOT NULL,
  `data_agendamento` date NOT NULL,
  `hora_agendamento` time NOT NULL,
  `descricao` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id`, `id_medico`, `id_paciente`, `data_agendamento`, `hora_agendamento`, `descricao`) VALUES
(1, 6, 8, '2023-06-22', '17:44:00', 'Consulta de rotina.'),
(3, 2, 3, '0000-00-00', '20:30:00', 'consulta'),
(5, 6, 8, '2023-06-15', '17:44:00', 'consulta da coluna');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico_paciente`
--

CREATE TABLE `medico_paciente` (
  `id_medico` int(9) NOT NULL,
  `id_paciente` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `medico_paciente`
--

INSERT INTO `medico_paciente` (`id_medico`, `id_paciente`) VALUES
(6, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(9) NOT NULL,
  `id_medico` int(9) NOT NULL,
  `id_paciente` int(9) NOT NULL,
  `medicamento` varchar(250) NOT NULL,
  `ref_receita` int(9) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `data_emissao` date NOT NULL,
  `data_validade` date NOT NULL,
  `quantidade` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`id`, `id_medico`, `id_paciente`, `medicamento`, `ref_receita`, `descricao`, `data_emissao`, `data_validade`, `quantidade`) VALUES
(1, 6, 8, 'nada', 23123, 'nada', '2023-06-01', '2023-06-22', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(9) NOT NULL,
  `email` varchar(250) NOT NULL,
  `nome` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `type` varchar(10) NOT NULL,
  `morada` varchar(250) NOT NULL,
  `data_nascimento` date NOT NULL,
  `nr_telemovel` int(9) NOT NULL,
  `especialidade` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `nome`, `password`, `type`, `morada`, `data_nascimento`, `nr_telemovel`, `especialidade`) VALUES
(2, 'admin@gmail.com', 'admin', 'admin', 'admin', '', '0000-00-00', 0, ''),
(6, 'medico@gmail.com', 'medico', 'medico', 'medico', '', '0000-00-00', 0, ''),
(8, 'paciente@gmail.com', 'paciente', 'paciente', 'paciente', '', '0000-00-00', 0, ''),
(28, 'paciente1@gmail.com', '', '459156722', 'paciente', '', '0000-00-00', 0, ''),
(31, 'medico1@gmail.com', 'medico1', '807772988', 'medico', 'rua do medico', '1954-02-04', 913754283, 'Cardiologia');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
