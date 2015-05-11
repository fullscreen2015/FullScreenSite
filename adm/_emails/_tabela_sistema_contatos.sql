-- phpMyAdmin SQL Dump
-- version 3.0.1.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Dez 16, 2009 as 01:31 PM
-- Versão do Servidor: 5.0.27
-- Versão do PHP: 5.2.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `nunem_alarmes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabela_sistema_contatos`
--

CREATE TABLE IF NOT EXISTS `tabela_sistema_contatos` (
  `codigo_contato` int(11) NOT NULL,
  `nome_contato` varchar(255) collate latin1_general_cs NOT NULL,
  `email_contato` varchar(255) collate latin1_general_cs NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  PRIMARY KEY  (`codigo_contato`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;
