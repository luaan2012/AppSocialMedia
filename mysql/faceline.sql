-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Abr-2022 às 01:05
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `faceline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fl_codigo`
--

CREATE TABLE `fl_codigo` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuarios` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fl_login`
--

CREATE TABLE `fl_login` (
  `id_usuarios` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uf` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `localidade` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `idade` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fl_seguidores`
--

CREATE TABLE `fl_seguidores` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_usuario_seguindo` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fl_tweets`
--

CREATE TABLE `fl_tweets` (
  `id` int(11) NOT NULL,
  `id_usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tweet` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `data` datetime DEFAULT current_timestamp(),
  `nome` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `fl_codigo`
--
ALTER TABLE `fl_codigo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fl_login`
--
ALTER TABLE `fl_login`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- Índices para tabela `fl_seguidores`
--
ALTER TABLE `fl_seguidores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `fl_tweets`
--
ALTER TABLE `fl_tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fl_codigo`
--
ALTER TABLE `fl_codigo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de tabela `fl_seguidores`
--
ALTER TABLE `fl_seguidores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT de tabela `fl_tweets`
--
ALTER TABLE `fl_tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `fl_seguidores`
--
ALTER TABLE `fl_seguidores`
  ADD CONSTRAINT `fl_seguidores_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `fl_login` (`id_usuarios`);

--
-- Limitadores para a tabela `fl_tweets`
--
ALTER TABLE `fl_tweets`
  ADD CONSTRAINT `fl_tweets_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `fl_login` (`id_usuarios`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
