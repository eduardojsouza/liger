-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 21/09/2015 às 15:59
-- Versão do servidor: 5.5.44-0ubuntu0.14.10.1
-- Versão do PHP: 5.5.12-2ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `liger`
--

--
-- Estrutura para tabela `tb_anobase`
--

CREATE TABLE IF NOT EXISTS `tb_anobase` (
`anobase_id` int(12) NOT NULL,
  `anobase_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_imovelproprietarios`
--

CREATE TABLE IF NOT EXISTS `tb_imovelproprietarios` (
`id_imovel_proprietarios` int(20) NOT NULL,
  `tb_imovel_imovel_id` int(20) NOT NULL,
  `tb_contribuinte_contribuinte_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;





-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_plantavalores`
--

CREATE TABLE IF NOT EXISTS `tb_plantavalores` (
`plantavalores_id` int(12) NOT NULL,
  `plantavalores_valorm2territorial` int(12) NOT NULL,
  `plantavalores_valorm2predial` int(12) NOT NULL,
  `plantavalores_aliquotaterritorial1` int(12) NOT NULL,
  `plantavalores_aliquotaterritorial2` int(12) NOT NULL,
  `plantavalores_aliquotaresidencial1` int(12) NOT NULL,
  `plantavalores_aliquotaresidencial2` int(12) NOT NULL,
  `plantavalores_aliquotanresidencial1` int(12) NOT NULL,
  `plantavalores_aliquotanresidencial2` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_zonafiscal`
--

CREATE TABLE IF NOT EXISTS `tb_zonafiscal` (
`zona_id` int(12) NOT NULL,
  `zona_tipo` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Índices de tabelas apagadas
--

