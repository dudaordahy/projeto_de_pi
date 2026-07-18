-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jul-2026 às 04:23
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

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
-- Estrutura da tabela `comentarios_perguntas`
--

CREATE TABLE `comentarios_perguntas` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `pergunta_pai` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `comentarios_perguntas`
--

INSERT INTO `comentarios_perguntas` (`id`, `usuario`, `texto`, `pergunta_pai`, `data_criacao`) VALUES
(9, 20, 'Olá', NULL, '2026-07-17 20:49:29'),
(14, 20, 'olá', NULL, '2026-07-17 23:22:36'),
(15, 20, 'tudo bem?', NULL, '2026-07-17 23:22:45');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_usuarios`
--

CREATE TABLE `comentarios_usuarios` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `texto` text NOT NULL,
  `comentario_pai` int(11) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id_pergunta` int(11) NOT NULL,
  `texto_pergunta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id_pergunta`, `texto_pergunta`) VALUES
(1, 'Qual é a sua linguagem de programação favorita e por quê?');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(11) NOT NULL,
  `nome_user` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `senha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `nome_user`, `email`, `senha`) VALUES
(20, 'dudaordahy', 'dudasciortino@gmail.com', 'Duda');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_pai` (`pergunta_pai`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices para tabela `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comentario_pai` (`comentario_pai`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices para tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id_pergunta`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id_pergunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios_perguntas`
--
ALTER TABLE `comentarios_perguntas`
  ADD CONSTRAINT `comentarios_perguntas_ibfk_1` FOREIGN KEY (`pergunta_pai`) REFERENCES `comentarios_perguntas` (`id`),
  ADD CONSTRAINT `comentarios_perguntas_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_user`);

--
-- Limitadores para a tabela `comentarios_usuarios`
--
ALTER TABLE `comentarios_usuarios`
  ADD CONSTRAINT `comentarios_usuarios_ibfk_1` FOREIGN KEY (`comentario_pai`) REFERENCES `comentarios_usuarios` (`id`),
  ADD CONSTRAINT `comentarios_usuarios_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
