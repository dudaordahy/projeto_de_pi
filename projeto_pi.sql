-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/07/2026 às 17:08
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
-- Banco de dados: `projeto_pi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios_perguntas`
--

CREATE TABLE `comentarios_perguntas` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `pergunta_pai` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios_usuarios`
--

CREATE TABLE `comentarios_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `comentario_pai` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `comentarios_usuarios`
--

INSERT INTO `comentarios_usuarios` (`id`, `usuario`, `texto`, `comentario_pai`, `data_criacao`) VALUES
(5, 16, 'ola', 5, '2026-07-17 11:59:52');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id_pergunta` int(11) NOT NULL,
  `texto_pergunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome_user` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome_user`, `email`, `senha`) VALUES
(16, 'ananagel', 'dudasciortino@gmail.com', 'duda'),
(17, 'ananagel', 'dudasciortino@gmail.com', 'Duda'),
(18, 'ananagel', 'dudasciortino@gmail.com', 'Duda'),
(19, 'lulusilva', 'acfsciortino@gmail.com', 'Duda');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_pai` (`pergunta_pai`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_pai` (`comentario_pai`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id_pergunta`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id_pergunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  ADD CONSTRAINT `comentarios_perguntas_ibfk_1` FOREIGN KEY (`pergunta_pai`) REFERENCES `comentarios_perguntas` (`id`),
  ADD CONSTRAINT `comentarios_perguntas_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_user`);

--
-- Restrições para tabelas `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  ADD CONSTRAINT `comentarios_usuarios_ibfk_1` FOREIGN KEY (`comentario_pai`) REFERENCES `comentarios_usuarios` (`id`),
  ADD CONSTRAINT `comentarios_usuarios_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
