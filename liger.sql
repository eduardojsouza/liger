-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31-Ago-2015 às 14:57
-- Versão do servidor: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `liger`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_group`
--

CREATE TABLE IF NOT EXISTS `system_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_group`
--

INSERT INTO `system_group` (`id`, `name`) VALUES
(1, 'ADMIN');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_group_program`
--

CREATE TABLE IF NOT EXISTS `system_group_program` (
  `id` int(11) NOT NULL,
  `system_group_id` int(11) DEFAULT NULL,
  `system_program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_group_program`
--

INSERT INTO `system_group_program` (`id`, `system_group_id`, `system_program_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_program`
--

CREATE TABLE IF NOT EXISTS `system_program` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_program`
--

INSERT INTO `system_program` (`id`, `name`, `controller`) VALUES
(1, 'System Group Form', 'SystemGroupForm'),
(2, 'System Group List', 'SystemGroupList'),
(3, 'System Program Form', 'SystemProgramForm'),
(4, 'System Program List', 'SystemProgramList'),
(5, 'System User Form', 'SystemUserForm'),
(6, 'System User List', 'SystemUserList'),
(7, 'Common Page', 'CommonPage'),
(8, 'BairroForm', 'BairroForm'),
(9, 'BairroList', 'BairroList'),
(10, 'CidadeForm', 'CidadeForm'),
(11, 'CidadeList', 'CidadeList'),
(12, 'LogradouroForm', 'LogradouroForm'),
(13, 'LogradouroList', 'LogradouroList'),
(14, 'ContribuinteForm', 'ContribuinteForm'),
(15, 'ContribuinteList', 'ContribuinteList'),
(16, 'ImovelList', 'ImovelList'),
(17, 'ImovelForm', 'ImovelForm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user`
--

CREATE TABLE IF NOT EXISTS `system_user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `frontpage_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_user`
--

INSERT INTO `system_user` (`id`, `name`, `login`, `password`, `email`, `frontpage_id`) VALUES
(1, 'Administrator', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.net', 6),
(2, 'User', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@user.net', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user_group`
--

CREATE TABLE IF NOT EXISTS `system_user_group` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) DEFAULT NULL,
  `system_group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_user_group`
--

INSERT INTO `system_user_group` (`id`, `system_user_id`, `system_group_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `system_user_program`
--

CREATE TABLE IF NOT EXISTS `system_user_program` (
  `id` int(11) NOT NULL,
  `system_user_id` int(11) DEFAULT NULL,
  `system_program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `system_user_program`
--

INSERT INTO `system_user_program` (`id`, `system_user_id`, `system_program_id`) VALUES
(1, 2, 7),
(2, 1, 8),
(3, 1, 9),
(4, 1, 10),
(5, 1, 11),
(6, 1, 12),
(7, 1, 13),
(8, 1, 14),
(9, 1, 15),
(10, 1, 16),
(11, 1, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_bairros`
--

CREATE TABLE IF NOT EXISTS `tb_bairros` (
  `bairros_id` int(11) NOT NULL,
  `bairros_nome` varchar(255) NOT NULL,
  `tb_cidades_cid_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_bairros`
--

INSERT INTO `tb_bairros` (`bairros_id`, `bairros_nome`, `tb_cidades_cid_id`) VALUES
(1, 'Central', 2),
(2, 'Curumin', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cidades`
--

CREATE TABLE IF NOT EXISTS `tb_cidades` (
  `cid_id` int(11) NOT NULL,
  `cid_nome` varchar(255) NOT NULL,
  `tb_estados_uf_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_cidades`
--

INSERT INTO `tb_cidades` (`cid_id`, `cid_nome`, `tb_estados_uf_id`) VALUES
(1, 'Ceres', 9),
(2, 'Rubiataba', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_contribuinte`
--

CREATE TABLE IF NOT EXISTS `tb_contribuinte` (
  `contribuinte_id` int(11) NOT NULL,
  `contribuinte_nome` varchar(200) NOT NULL,
  `contribuinte_tipo` varchar(200) NOT NULL,
  `contribuinte_endereco` varchar(200) NOT NULL,
  `contribuinte_bairro` varchar(200) NOT NULL,
  `contribuinte_cidade` varchar(200) NOT NULL,
  `contribuinte_estado` varchar(200) NOT NULL,
  `contribuinte_cep` int(8) NOT NULL,
  `contribuinte_telefone` varchar(50) NOT NULL,
  `contribuinte_cpf` int(11) DEFAULT NULL,
  `contribuinte_dtnascimento` date DEFAULT NULL,
  `contribuinte_rg` int(30) DEFAULT NULL,
  `contribuinte_cnpj` int(50) DEFAULT NULL,
  `contribuinte_inscricaoestadual` int(50) DEFAULT NULL,
  `contribuinte_inscricaomunicipal` int(50) DEFAULT NULL,
  `contribuinte_regjuceg` int(50) DEFAULT NULL,
  `contribuinte_ramo` varchar(200) DEFAULT NULL,
  `contribuinte_codatividade` int(50) DEFAULT NULL,
  `contribuinte_numempregados` int(50) DEFAULT NULL,
  `contribuinte_inicioatividades` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_contribuinte`
--

INSERT INTO `tb_contribuinte` (`contribuinte_id`, `contribuinte_nome`, `contribuinte_tipo`, `contribuinte_endereco`, `contribuinte_bairro`, `contribuinte_cidade`, `contribuinte_estado`, `contribuinte_cep`, `contribuinte_telefone`, `contribuinte_cpf`, `contribuinte_dtnascimento`, `contribuinte_rg`, `contribuinte_cnpj`, `contribuinte_inscricaoestadual`, `contribuinte_inscricaomunicipal`, `contribuinte_regjuceg`, `contribuinte_ramo`, `contribuinte_codatividade`, `contribuinte_numempregados`, `contribuinte_inicioatividades`) VALUES
(1, 'Eduardo Souza', '1', 'Rua 36', 'Central', 'Ceres', '', 76300, '6284795790', 2147483647, '1990-03-06', 5375151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Teste', '2', 'Rua teste', 'teste', 'Ceres', '', 76300000, '999999999', NULL, '2010-02-02', NULL, 0, NULL, NULL, NULL, 'teste', 121222, 11, '2015-08-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estados`
--

CREATE TABLE IF NOT EXISTS `tb_estados` (
  `uf_id` int(11) NOT NULL,
  `uf_nome` varchar(255) NOT NULL,
  `uf_sigla` varchar(255) NOT NULL,
  `uf_cod_ibge` varchar(255) NOT NULL,
  `uf_dtm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_estados`
--

INSERT INTO `tb_estados` (`uf_id`, `uf_nome`, `uf_sigla`, `uf_cod_ibge`, `uf_dtm`) VALUES
(1, 'Acre', 'AC', '12', '2015-07-16 21:22:54'),
(2, 'Alagoas', 'AL', '27', '2015-07-16 21:22:54'),
(3, 'Amazonas', 'AM', '13', '2015-07-16 21:22:54'),
(4, 'Amapá', 'AP', '16', '2015-07-16 21:22:54'),
(5, 'Bahia', 'BA', '29', '2015-07-16 21:22:54'),
(6, 'Ceará', 'CE', '23', '2015-07-16 21:22:54'),
(7, 'Distrito Federal', 'DF', '53', '2015-07-16 21:22:54'),
(8, 'Espírito Santo', 'ES', '32', '2015-07-16 21:22:54'),
(9, 'Goiás', 'GO', '52', '2015-07-16 21:22:54'),
(10, 'Maranhão', 'MA', '21', '2015-07-16 21:22:54'),
(11, 'Minas Gerais', 'MG', '31', '2015-07-16 21:22:54'),
(12, 'Mato Grosso do Sul', 'MS', '50', '2015-07-16 21:22:54'),
(13, 'Mato Grosso', 'MT', '51', '2015-07-16 21:22:54'),
(14, 'Pará', 'PA', '15', '2015-07-16 21:22:54'),
(15, 'Paraíba', 'PB', '25', '2015-07-16 21:22:54'),
(16, 'Pernambuco', 'PE', '26', '2015-07-16 21:22:54'),
(17, 'Piauí', 'PI', '22', '2015-07-16 21:22:54'),
(18, 'Paraná', 'PR', '41', '2015-07-16 21:22:54'),
(19, 'Rio de Janeiro', 'RJ', '33', '2015-07-16 21:22:54'),
(20, 'Rio Grande do Norte', 'RN', '24', '2015-07-16 21:22:54'),
(21, 'Rondônia', 'RO', '11', '2015-07-16 21:22:54'),
(22, 'Roraima', 'RR', '14', '2015-07-16 21:22:54'),
(23, 'Rio Grande do Sul', 'RS', '43', '2015-07-16 21:22:55'),
(24, 'Santa Catarina', 'SC', '42', '2015-07-16 21:22:55'),
(25, 'Sergipe', 'SE', '28', '2015-07-16 21:22:55'),
(26, 'São Paulo', 'SP', '35', '2015-07-16 21:22:55'),
(27, 'Tocantins', 'TO', '17', '2015-07-16 21:22:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imovel`
--

CREATE TABLE IF NOT EXISTS `tb_imovel` (
  `imovel_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `quadra` int(11) NOT NULL,
  `lote` int(11) NOT NULL,
  `proprietarios` varchar(100) NOT NULL,
  `inflogradouro` varchar(100) NOT NULL,
  `tipopropriedade` int(11) NOT NULL,
  `situacaojuridica` int(11) NOT NULL,
  `localizacao` int(11) NOT NULL,
  `caracteristica` int(11) NOT NULL,
  `ocupacao` int(11) NOT NULL,
  `numfrentes` int(11) NOT NULL,
  `utilizacao` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `douso` int(11) NOT NULL,
  `agua` int(11) NOT NULL,
  `esgoto` int(11) NOT NULL,
  `piso` int(11) NOT NULL,
  `estrutura` int(11) NOT NULL,
  `janelas` int(11) NOT NULL,
  `revestimentointerno` int(11) NOT NULL,
  `revestimentoexterno` int(11) NOT NULL,
  `forro` int(11) NOT NULL,
  `instalacaoeletrica` int(11) NOT NULL,
  `instalacaosanitaria` int(11) NOT NULL,
  `cobertura` int(11) NOT NULL,
  `conservacao` int(11) NOT NULL,
  `areaterreno` double NOT NULL,
  `testada` double NOT NULL,
  `areaedificada` double NOT NULL,
  `areatotaledificada` double NOT NULL,
  `imgimovel` int(100) NOT NULL,
  `logradouro` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_imovelproprietarios`
--

CREATE TABLE IF NOT EXISTS `tb_imovelproprietarios` (
  `id_imovel_proprietarios` int(20) NOT NULL,
  `tb_imovel_imovel_id` int(20) NOT NULL,
  `tb_contribuinte_contribuinte_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_logradouros`
--

CREATE TABLE IF NOT EXISTS `tb_logradouros` (
  `logra_id` int(11) NOT NULL,
  `logra_nome` varchar(255) NOT NULL,
  `logra_cep` varchar(255) NOT NULL,
  `tb_bairros_bairros_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_logradouros`
--

INSERT INTO `tb_logradouros` (`logra_id`, `logra_nome`, `logra_cep`, `tb_bairros_bairros_id`) VALUES
(1, 'Rua 57', '', 0),
(2, 'Rua 31', '', 0),
(3, 'Rua 30', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_logradouros_tb_bairros`
--

CREATE TABLE IF NOT EXISTS `tb_logradouros_tb_bairros` (
  `id_logra_bairro` int(15) NOT NULL,
  `tb_logradouros_logra_id` int(15) NOT NULL,
  `tb_bairros_bairros_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tb_logradouros_tb_bairros`
--

INSERT INTO `tb_logradouros_tb_bairros` (`id_logra_bairro`, `tb_logradouros_logra_id`, `tb_bairros_bairros_id`) VALUES
(1, 1, 1),
(2, 0, 0),
(3, 0, 2),
(4, 0, 1),
(5, 0, 2),
(6, 3, 1),
(7, 3, 1),
(8, 3, 2),
(9, 3, 1),
(10, 3, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `system_group`
--
ALTER TABLE `system_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_group_program`
--
ALTER TABLE `system_group_program`
  ADD PRIMARY KEY (`id`), ADD KEY `system_group_id` (`system_group_id`), ADD KEY `system_program_id` (`system_program_id`);

--
-- Indexes for table `system_program`
--
ALTER TABLE `system_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_user`
--
ALTER TABLE `system_user`
  ADD PRIMARY KEY (`id`), ADD KEY `frontpage_id` (`frontpage_id`);

--
-- Indexes for table `system_user_group`
--
ALTER TABLE `system_user_group`
  ADD PRIMARY KEY (`id`), ADD KEY `system_user_id` (`system_user_id`), ADD KEY `system_group_id` (`system_group_id`);

--
-- Indexes for table `system_user_program`
--
ALTER TABLE `system_user_program`
  ADD PRIMARY KEY (`id`), ADD KEY `system_user_id` (`system_user_id`), ADD KEY `system_program_id` (`system_program_id`);

--
-- Indexes for table `tb_bairros`
--
ALTER TABLE `tb_bairros`
  ADD PRIMARY KEY (`bairros_id`,`tb_cidades_cid_id`), ADD KEY `fk_tb_bairros_tb_cidades1_idx` (`tb_cidades_cid_id`);

--
-- Indexes for table `tb_cidades`
--
ALTER TABLE `tb_cidades`
  ADD PRIMARY KEY (`cid_id`,`tb_estados_uf_id`), ADD KEY `fk_tb_cidades_tb_estados1_idx` (`tb_estados_uf_id`);

--
-- Indexes for table `tb_contribuinte`
--
ALTER TABLE `tb_contribuinte`
  ADD PRIMARY KEY (`contribuinte_id`);

--
-- Indexes for table `tb_estados`
--
ALTER TABLE `tb_estados`
  ADD PRIMARY KEY (`uf_id`);

--
-- Indexes for table `tb_imovel`
--
ALTER TABLE `tb_imovel`
  ADD PRIMARY KEY (`imovel_id`);

--
-- Indexes for table `tb_imovelproprietarios`
--
ALTER TABLE `tb_imovelproprietarios`
  ADD PRIMARY KEY (`id_imovel_proprietarios`);

--
-- Indexes for table `tb_logradouros`
--
ALTER TABLE `tb_logradouros`
  ADD PRIMARY KEY (`logra_id`,`tb_bairros_bairros_id`), ADD KEY `fk_tb_logradouros_tb_bairros1_idx` (`tb_bairros_bairros_id`);

--
-- Indexes for table `tb_logradouros_tb_bairros`
--
ALTER TABLE `tb_logradouros_tb_bairros`
  ADD PRIMARY KEY (`id_logra_bairro`), ADD KEY `id_logra_bairro` (`id_logra_bairro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bairros`
--
ALTER TABLE `tb_bairros`
  MODIFY `bairros_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_cidades`
--
ALTER TABLE `tb_cidades`
  MODIFY `cid_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_contribuinte`
--
ALTER TABLE `tb_contribuinte`
  MODIFY `contribuinte_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_estados`
--
ALTER TABLE `tb_estados`
  MODIFY `uf_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tb_imovelproprietarios`
--
ALTER TABLE `tb_imovelproprietarios`
  MODIFY `id_imovel_proprietarios` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_logradouros`
--
ALTER TABLE `tb_logradouros`
  MODIFY `logra_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `system_group_program`
--
ALTER TABLE `system_group_program`
ADD CONSTRAINT `system_group_program_ibfk_1` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`),
ADD CONSTRAINT `system_group_program_ibfk_2` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`);

--
-- Limitadores para a tabela `system_user`
--
ALTER TABLE `system_user`
ADD CONSTRAINT `system_user_ibfk_1` FOREIGN KEY (`frontpage_id`) REFERENCES `system_program` (`id`);

--
-- Limitadores para a tabela `system_user_group`
--
ALTER TABLE `system_user_group`
ADD CONSTRAINT `system_user_group_ibfk_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_user` (`id`),
ADD CONSTRAINT `system_user_group_ibfk_2` FOREIGN KEY (`system_group_id`) REFERENCES `system_group` (`id`);

--
-- Limitadores para a tabela `system_user_program`
--
ALTER TABLE `system_user_program`
ADD CONSTRAINT `system_user_program_ibfk_1` FOREIGN KEY (`system_user_id`) REFERENCES `system_user` (`id`),
ADD CONSTRAINT `system_user_program_ibfk_2` FOREIGN KEY (`system_program_id`) REFERENCES `system_program` (`id`);

--
-- Limitadores para a tabela `tb_bairros`
--
ALTER TABLE `tb_bairros`
ADD CONSTRAINT `fk_tb_bairros_tb_cidades1` FOREIGN KEY (`tb_cidades_cid_id`) REFERENCES `tb_cidades` (`cid_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_cidades`
--
ALTER TABLE `tb_cidades`
ADD CONSTRAINT `fk_tb_cidades_tb_estados1` FOREIGN KEY (`tb_estados_uf_id`) REFERENCES `tb_estados` (`uf_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
