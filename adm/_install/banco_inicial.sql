CREATE TABLE `tabela_adm_acesso_tipos` 
(
  `codigo_tipo` tinyint(4) NOT NULL,
  `descricao_tipo` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo_tipo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tabela_adm_acesso_tipos` VALUES(1, 'Leitura');
INSERT INTO `tabela_adm_acesso_tipos` VALUES(3, 'Grava��o');
INSERT INTO `tabela_adm_acesso_tipos` VALUES(5, 'Altera��o');
INSERT INTO `tabela_adm_acesso_tipos` VALUES(7, 'Exclusão');




CREATE TABLE `tabela_adm_ass_usuario_relatorio` (
  `codigo_associativo` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_relatorio` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_associativo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tabela_adm_ass_usuario_grafico` (
  `codigo_associativo` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_grafico` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_associativo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tabela_adm_ass_usuario_painel` (
  `codigo_associativo` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_painel` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_associativo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;






CREATE TABLE `tabela_adm_log` (
  `codigo_log` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_log` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `acao_log` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `sistema_log` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `data_log` varchar(30) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`codigo_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;




CREATE TABLE `tabela_adm_relatorios` 
(
  `codigo_relatorio` tinyint(4) NOT NULL,
  `descricao_relatorio` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `texto_relatorio` text COLLATE latin1_general_ci NOT NULL,
  `arquivo_relatorio` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sql_relatorio` text COLLATE latin1_general_ci NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_relatorio`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tabela_adm_graficos` 
(
  `codigo_grafico` tinyint(4) NOT NULL,
  `descricao_grafico` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `texto_grafico` text COLLATE latin1_general_ci NOT NULL,
  `arquivo_grafico` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_grafico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tabela_adm_paineis` 
(
  `codigo_painel` tinyint(4) NOT NULL,
  `descricao_painel` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `texto_painel` text COLLATE latin1_general_ci NOT NULL,
  `arquivo_painel` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_painel`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


CREATE TABLE `tabela_adm_sistemas` (
  `codigo_sistema` tinyint(4) NOT NULL,
  `descricao_sistema` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `texto_sistema` text COLLATE latin1_general_ci NOT NULL,
  `tabela_sistema` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `campo_principal_sistema` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `sistema_exclusao` tinyint(4) NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_sistema`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


INSERT INTO `tabela_adm_sistemas` VALUES(1, 'ADM - Alterar Senha', 'M�dulo de altera��o de senha', 'tabela_adm_relatorios','',0,1);
INSERT INTO `tabela_adm_sistemas` VALUES(2, 'ADM - usuários', 'M�dulo de controle de acesso aos usuários', 'tabela_adm_usuarios','',0,1);
INSERT INTO `tabela_adm_sistemas` VALUES(3, 'ADM - M�dulos', 'M�dulo de controle de M�dulos', 'tabela_adm_sistemas','',0,1);
INSERT INTO `tabela_adm_sistemas` VALUES(4, 'ADM - Gr�ficos', 'M�dulo de controle de Gr�ficos', 'tabela_adm_graficos','',0,1);
INSERT INTO `tabela_adm_sistemas` VALUES(5, 'ADM - Relat�rios', 'M�dulo de controle de Relat�rios', 'tabela_adm_relatorios','',0,1);
INSERT INTO `tabela_adm_sistemas` VALUES(6, 'ADM - Pain�is', 'M�dulo de controle de Pain�is', 'tabela_adm_paineis','',1,1);


CREATE TABLE `tabela_adm_usuarios` (
  `codigo_usuario` int(11) NOT NULL,
  `nome_usuario` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `email_usuario` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `senha_usuario` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `administrador_sistema` tinyint(4) NOT NULL,
  `publicar` tinyint(4) NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tabela_adm_usuarios`
--

INSERT INTO `tabela_adm_usuarios`  VALUES(1, 'Programador Friweb', 'testes@friwebdesign.com.br', '8f2724c84c07eb3713a80295d03c125c', 1,1,1);





CREATE TABLE `tabela_adm_ass_usuario_sistema_acesso` (
  `codigo_associativo` int(11) NOT NULL,
  `codigo_usuario` int(11) NOT NULL,
  `codigo_sistema` tinyint(4) NOT NULL,
  `codigo_tipo` tinyint(4) NOT NULL,
  PRIMARY KEY (`codigo_associativo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Extraindo dados da tabela `tabela_adm_ass_usuario_sistema_acesso`
--


INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(1, 1, 1, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(2, 1, 1, 5);

INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(3, 1, 2, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(4, 1, 2, 3);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(5, 1, 2, 5);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(6, 1, 2, 7);

INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(7, 1, 3, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(8, 1, 3, 3);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(9, 1, 3, 5);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(10, 1, 3, 7);

INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(11, 1, 4, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(12, 1, 4, 3);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(13, 1, 4, 5);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(14, 1, 4, 7);

INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(15, 1, 5, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(16, 1, 5, 3);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(17, 1, 5, 5);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(18, 1, 5, 7);

INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(19, 1, 6, 1);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(20, 1, 6, 3);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(21, 1, 6, 5);
INSERT INTO `tabela_adm_ass_usuario_sistema_acesso` VALUES(22, 1, 6, 7);
