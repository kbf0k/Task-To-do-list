-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Maio-2025 às 17:34
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_task_sync`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id_tarefa` int(11) NOT NULL,
  `descricao_tarefa` varchar(250) NOT NULL,
  `prioridade_tarefa` enum('Baixa','Média','Alta') NOT NULL,
  `setor_empresa_tarefa` varchar(255) NOT NULL,
  `data_cadastro_tarefa` date NOT NULL,
  `status_tarefa` enum('A fazer','Fazendo','Finalizado') NOT NULL,
  `fk_usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tarefas`
--

INSERT INTO `tarefas` (`id_tarefa`, `descricao_tarefa`, `prioridade_tarefa`, `setor_empresa_tarefa`, `data_cadastro_tarefa`, `status_tarefa`, `fk_usuario_id`) VALUES
(3, 'Isso é uma descição da tarefa', 'Baixa', 'CARGA', '2025-05-22', 'A fazer', 1),
(4, 'asdasdasdasdadada tarefa de descrição', 'Alta', 'ADMSS', '2025-05-20', 'Fazendo', 1),
(5, 'Isso é outra descrição da tarefa', 'Média', 'RH', '2025-05-17', 'Finalizado', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`) VALUES
(1, 'Kaique', 'kaique1245br@gmail.com', '$2y$10$0mUQ0NOSET0Xk/l4K/Ro8el4oSiUZljx7wpuDkTx.jI1mCTPUDN/G');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id_tarefa`),
  ADD KEY `fk_usuario_id` (`fk_usuario_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id_tarefa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`fk_usuario_id`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
