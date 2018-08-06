-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06-Ago-2018 às 10:52
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plataforma`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistencia_tecnica`
--

CREATE TABLE `assistencia_tecnica` (
  `idAssistencia_Tecnica` int(11) NOT NULL,
  `Descricao_Avaria` varchar(150) NOT NULL,
  `Data_Pedido` date NOT NULL,
  `Data_Prevista_Entrega` date NOT NULL,
  `Historico_Servico` varchar(150) DEFAULT NULL,
  `Observacao_Assistencia` varchar(250) DEFAULT NULL,
  `Requerente_idRequerente` int(11) NOT NULL,
  `Requerente_Tipo_Requerente_idTipo_Requerente` int(11) NOT NULL,
  `Tipo_Assistencia_idTipo_Assistencia` int(11) NOT NULL,
  `Tecnico_idTecnico` int(11) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `Imprimir_Relatorio` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamento`
--

CREATE TABLE `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `Nome_Departamento` varchar(45) NOT NULL,
  `Contacto_Departamento` varchar(30) NOT NULL,
  `Observacao_Departamento` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `idEquipamentos` int(11) NOT NULL,
  `Nome_Equipamento` varchar(45) NOT NULL,
  `Numero_Serie` varchar(20) NOT NULL,
  `Marca` varchar(20) NOT NULL,
  `Modelo` varchar(20) NOT NULL,
  `Numero_Inventario` int(11) NOT NULL,
  `Local_Instalacao` varchar(80) NOT NULL,
  `Contacto` varchar(45) NOT NULL,
  `Estado_Material` varchar(50) NOT NULL,
  `User_Acesso_Internet` varchar(45) DEFAULT NULL,
  `Password_Acesso_Internet` varchar(45) DEFAULT NULL,
  `Username_Equipamento` varchar(45) DEFAULT NULL,
  `Password_Equipamento` varchar(45) DEFAULT NULL,
  `Contacto_Suporte` varchar(80) DEFAULT NULL,
  `Observacao_Equipamento` varchar(250) DEFAULT NULL,
  `Copia_Fatura` varchar(220) DEFAULT NULL,
  `Ficheiro_Configuracao` varchar(500) DEFAULT NULL,
  `Tipo_Equipamento_idTipo_Equipamento` int(11) NOT NULL,
  `Registo_Postos_Trabalho_idRegisto_Postos_Trabalho` int(11) NOT NULL,
  `Registo_Postos_Trabalho_Requerente_idRequerente` int(11) NOT NULL,
  `Registo_Postos_Trabalho_idTipo_Requerente` int(11) NOT NULL,
  `Registo_Postos_Trabalho_Departamento_idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `Nome_Estado_Assistencia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`idEstado`, `Nome_Estado_Assistencia`) VALUES
(1, 'Aberto'),
(2, 'Processo'),
(3, 'Fechado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `instalacao_computadores`
--

CREATE TABLE `instalacao_computadores` (
  `idInstalacao_Computadores` int(11) NOT NULL,
  `Nome_Instalacao` varchar(50) NOT NULL,
  `Nome_Rede` varchar(50) NOT NULL,
  `Antivirus` tinyint(4) NOT NULL,
  `Observacao_Instalacao_Computadores` varchar(250) DEFAULT NULL,
  `Data_Instalacao_Computadores` date DEFAULT NULL,
  `Sistema_Operativo_idSistema_Operativo` int(11) NOT NULL,
  `Office_idOffice` int(11) NOT NULL,
  `Estado_idEstado` int(11) NOT NULL,
  `Aplicativo` varchar(255) DEFAULT NULL,
  `Impressora` tinyint(4) NOT NULL,
  `AIRC` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `office`
--

CREATE TABLE `office` (
  `idOffice` int(11) NOT NULL,
  `Versao_Office` varchar(50) NOT NULL,
  `Nome_Office` varchar(50) NOT NULL,
  `Descricao_Office` varchar(50) DEFAULT NULL,
  `Observacao_Office` varchar(250) DEFAULT NULL,
  `foto` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `registo_postos_trabalho`
--

CREATE TABLE `registo_postos_trabalho` (
  `idRegisto_Postos_Trabalho` int(11) NOT NULL,
  `Cargo` varchar(45) NOT NULL,
  `Observacao_Registo_Postos_Trabalho` varchar(250) DEFAULT NULL,
  `Anexo` varchar(220) DEFAULT NULL,
  `Departamento_idDepartamento` int(11) NOT NULL,
  `Requerente_idRequerente` int(11) NOT NULL,
  `Requerente_Tipo_Requerente_idTipo_Requerente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requerente`
--

CREATE TABLE `requerente` (
  `idRequerente` int(11) NOT NULL,
  `Nome_Requerente` varchar(45) NOT NULL,
  `Numero_Funcionario` int(11) DEFAULT NULL,
  `Morada_Requerente` varchar(80) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contacto_Requerente` varchar(30) NOT NULL,
  `NIF` int(11) NOT NULL,
  `Codigo_Postal` varchar(10) NOT NULL,
  `Localidade` varchar(100) NOT NULL,
  `Tipo_Requerente_idTipo_Requerente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requerimento`
--

CREATE TABLE `requerimento` (
  `idRequerimento` int(11) NOT NULL,
  `Festa` varchar(100) NOT NULL,
  `Data_Requerimento` date NOT NULL,
  `Data_Festividade` date NOT NULL,
  `Observacao_Requerimento` varchar(250) DEFAULT NULL,
  `Elaboracao_Cartazes_Alusivos` tinyint(4) NOT NULL,
  `Impressao_Cartazes` tinyint(4) NOT NULL,
  `Tamanho_A4` int(11) NOT NULL,
  `Tamanho_A3` int(11) NOT NULL,
  `Site_Municipio` tinyint(4) NOT NULL,
  `Mupis_Publicidade` tinyint(4) NOT NULL,
  `Agenda_Boletim` tinyint(4) NOT NULL,
  `Outros_Apoios_1` varchar(80) DEFAULT NULL,
  `Outros_Apoios_2` varchar(80) DEFAULT NULL,
  `Outros_Apoios_3` varchar(80) DEFAULT NULL,
  `Outros_Apoios_4` varchar(80) DEFAULT NULL,
  `Outros_Apoios_5` varchar(80) DEFAULT NULL,
  `Outros_Apoios_6` varchar(80) DEFAULT NULL,
  `Requerente_idRequerente` int(11) NOT NULL,
  `Requerente_Tipo_Requerente_idTipo_Requerente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao_material`
--

CREATE TABLE `requisicao_material` (
  `idRequisicao_Material` int(11) NOT NULL,
  `Data_Requisicao` date NOT NULL,
  `Data_Prevista_Devolucao` date NOT NULL,
  `Seccao` varchar(45) NOT NULL,
  `Observacao_Requisicao_Material` varchar(250) DEFAULT NULL,
  `Data_Devolucao` date DEFAULT NULL,
  `Estado_Material_Devolvido` varchar(45) DEFAULT NULL,
  `Estado_Requisicao` tinyint(4) NOT NULL,
  `Requerente_idRequerente` int(11) NOT NULL,
  `Requerente_Tipo_Requerente_idTipo_Requerente` int(11) NOT NULL,
  `Equipamentos_idEquipamentos` int(11) NOT NULL,
  `Equipamentos_Tipo_Equipamento_idTipo_Equipamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema_operativo`
--

CREATE TABLE `sistema_operativo` (
  `idSistema_Operativo` int(11) NOT NULL,
  `Nome_Sistema_Operativo` varchar(45) NOT NULL,
  `Observacao_Sistema_Operativo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `software`
--

CREATE TABLE `software` (
  `idSoftware` int(11) NOT NULL,
  `Nome_Software` varchar(80) NOT NULL,
  `Data_Registo` date NOT NULL,
  `Data_Inicio_Contrato` date NOT NULL,
  `Data_Renovacao_Contrato` date NOT NULL,
  `Versao` varchar(45) NOT NULL,
  `Copia_Fatura` blob,
  `Contrato_Protocolo` blob,
  `Observacao_Software` varchar(250) DEFAULT NULL,
  `Registo_Postos_Trabalho_idRegisto_Postos_Trabalho` int(11) NOT NULL,
  `Registo_Postos_Trabalho_Requerente_idRequerente` int(11) NOT NULL,
  `Registo_Postos_Trabalho_idTipo_Requerente` int(11) NOT NULL,
  `Registo_Postos_Trabalho_Departamento_idDepartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnico`
--

CREATE TABLE `tecnico` (
  `idTecnico` int(11) NOT NULL,
  `Nome` varchar(45) NOT NULL,
  `Apelido` varchar(45) NOT NULL,
  `Numero_Funcionario` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Contacto` varchar(30) NOT NULL,
  `Funcao` varchar(45) NOT NULL,
  `User` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  `Observacao_Tecnico` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tecnico`
--

INSERT INTO `tecnico` (`idTecnico`, `Nome`, `Apelido`, `Numero_Funcionario`, `Email`, `Contacto`, `Funcao`, `User`, `Password`, `Observacao_Tecnico`) VALUES
(1, 'Admin', 'Admin', 0, 'admin@admin.com', '0', 'Administardor', 'admin', 'admin', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_assistencia`
--

CREATE TABLE `tipo_assistencia` (
  `idTipo_Assistencia` int(11) NOT NULL,
  `Nome_Tipo_Assistencia` varchar(80) NOT NULL,
  `Observacao_Tipo_Assistencia` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_assistencia`
--

INSERT INTO `tipo_assistencia` (`idTipo_Assistencia`, `Nome_Tipo_Assistencia`, `Observacao_Tipo_Assistencia`) VALUES
(1, 'Ao Nível do Apoio Técnico (Hardware e Software)', ''),
(2, 'Ao Nível da Web', ''),
(3, 'Arte e Design', ''),
(4, 'Outras Atividades', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_equipamento`
--

CREATE TABLE `tipo_equipamento` (
  `idTipo_Equipamento` int(11) NOT NULL,
  `Nome_Tipo_Equipamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_requerente`
--

CREATE TABLE `tipo_requerente` (
  `idTipo_Requerente` int(11) NOT NULL,
  `Nome_Tipo_Requerente` varchar(45) NOT NULL,
  `Tipo_Entidade` tinyint(4) NOT NULL,
  `Observacao_Tipo_Requerente` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assistencia_tecnica`
--
ALTER TABLE `assistencia_tecnica`
  ADD PRIMARY KEY (`idAssistencia_Tecnica`,`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`,`Tipo_Assistencia_idTipo_Assistencia`,`Tecnico_idTecnico`,`Estado_idEstado`),
  ADD KEY `fk_Assistencia_Tecnica_Requerente1_idx` (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`),
  ADD KEY `fk_Assistencia_Tecnica_Tipo_Assistencia1_idx` (`Tipo_Assistencia_idTipo_Assistencia`),
  ADD KEY `fk_Assistencia_Tecnica_Tecnico1_idx` (`Tecnico_idTecnico`),
  ADD KEY `fk_Assistencia_Tecnica_Estado1_idx` (`Estado_idEstado`);

--
-- Indexes for table `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indexes for table `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`idEquipamentos`,`Tipo_Equipamento_idTipo_Equipamento`,`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`,`Registo_Postos_Trabalho_Requerente_idRequerente`,`Registo_Postos_Trabalho_idTipo_Requerente`,`Registo_Postos_Trabalho_Departamento_idDepartamento`),
  ADD KEY `fk_Equipamentos_Tipo_Equipamento1_idx` (`Tipo_Equipamento_idTipo_Equipamento`),
  ADD KEY `fk_Equipamentos_Registo_Postos_Trabalho1_idx` (`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`,`Registo_Postos_Trabalho_Requerente_idRequerente`,`Registo_Postos_Trabalho_idTipo_Requerente`,`Registo_Postos_Trabalho_Departamento_idDepartamento`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indexes for table `instalacao_computadores`
--
ALTER TABLE `instalacao_computadores`
  ADD PRIMARY KEY (`idInstalacao_Computadores`,`Sistema_Operativo_idSistema_Operativo`,`Office_idOffice`,`Estado_idEstado`),
  ADD KEY `fk_Instalacao_Computadores_Sistema_Operativo1_idx` (`Sistema_Operativo_idSistema_Operativo`),
  ADD KEY `fk_Instalacao_Computadores_Office1_idx` (`Office_idOffice`),
  ADD KEY `fk_Instalacao_Computadores_Estado1_idx` (`Estado_idEstado`);

--
-- Indexes for table `office`
--
ALTER TABLE `office`
  ADD PRIMARY KEY (`idOffice`);

--
-- Indexes for table `registo_postos_trabalho`
--
ALTER TABLE `registo_postos_trabalho`
  ADD PRIMARY KEY (`idRegisto_Postos_Trabalho`,`Departamento_idDepartamento`,`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`),
  ADD KEY `fk_Registo_Postos_Trabalho_Departamento1_idx` (`Departamento_idDepartamento`),
  ADD KEY `fk_Registo_Postos_Trabalho_Requerente1_idx` (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`);

--
-- Indexes for table `requerente`
--
ALTER TABLE `requerente`
  ADD PRIMARY KEY (`idRequerente`,`Tipo_Requerente_idTipo_Requerente`),
  ADD KEY `fk_Requerente_Tipo_Requerente_idx` (`Tipo_Requerente_idTipo_Requerente`);

--
-- Indexes for table `requerimento`
--
ALTER TABLE `requerimento`
  ADD PRIMARY KEY (`idRequerimento`,`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`),
  ADD KEY `fk_Requerimento_Requerente1_idx` (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`);

--
-- Indexes for table `requisicao_material`
--
ALTER TABLE `requisicao_material`
  ADD PRIMARY KEY (`idRequisicao_Material`,`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`,`Equipamentos_idEquipamentos`,`Equipamentos_Tipo_Equipamento_idTipo_Equipamento`),
  ADD KEY `fk_Requisicao_Material_Requerente1_idx` (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`),
  ADD KEY `fk_Requisicao_Material_Equipamentos1_idx` (`Equipamentos_idEquipamentos`,`Equipamentos_Tipo_Equipamento_idTipo_Equipamento`);

--
-- Indexes for table `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  ADD PRIMARY KEY (`idSistema_Operativo`);

--
-- Indexes for table `software`
--
ALTER TABLE `software`
  ADD PRIMARY KEY (`idSoftware`,`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`,`Registo_Postos_Trabalho_Requerente_idRequerente`,`Registo_Postos_Trabalho_idTipo_Requerente`,`Registo_Postos_Trabalho_Departamento_idDepartamento`),
  ADD KEY `fk_Software_Registo_Postos_Trabalho1_idx` (`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`,`Registo_Postos_Trabalho_Requerente_idRequerente`,`Registo_Postos_Trabalho_idTipo_Requerente`,`Registo_Postos_Trabalho_Departamento_idDepartamento`);

--
-- Indexes for table `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`idTecnico`);

--
-- Indexes for table `tipo_assistencia`
--
ALTER TABLE `tipo_assistencia`
  ADD PRIMARY KEY (`idTipo_Assistencia`);

--
-- Indexes for table `tipo_equipamento`
--
ALTER TABLE `tipo_equipamento`
  ADD PRIMARY KEY (`idTipo_Equipamento`);

--
-- Indexes for table `tipo_requerente`
--
ALTER TABLE `tipo_requerente`
  ADD PRIMARY KEY (`idTipo_Requerente`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assistencia_tecnica`
--
ALTER TABLE `assistencia_tecnica`
  MODIFY `idAssistencia_Tecnica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipamentos`
--
ALTER TABLE `equipamentos`
  MODIFY `idEquipamentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instalacao_computadores`
--
ALTER TABLE `instalacao_computadores`
  MODIFY `idInstalacao_Computadores` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `office`
--
ALTER TABLE `office`
  MODIFY `idOffice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `registo_postos_trabalho`
--
ALTER TABLE `registo_postos_trabalho`
  MODIFY `idRegisto_Postos_Trabalho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requerente`
--
ALTER TABLE `requerente`
  MODIFY `idRequerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requerimento`
--
ALTER TABLE `requerimento`
  MODIFY `idRequerimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requisicao_material`
--
ALTER TABLE `requisicao_material`
  MODIFY `idRequisicao_Material` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sistema_operativo`
--
ALTER TABLE `sistema_operativo`
  MODIFY `idSistema_Operativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `software`
--
ALTER TABLE `software`
  MODIFY `idSoftware` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tecnico`
--
ALTER TABLE `tecnico`
  MODIFY `idTecnico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipo_assistencia`
--
ALTER TABLE `tipo_assistencia`
  MODIFY `idTipo_Assistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipo_equipamento`
--
ALTER TABLE `tipo_equipamento`
  MODIFY `idTipo_Equipamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_requerente`
--
ALTER TABLE `tipo_requerente`
  MODIFY `idTipo_Requerente` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `assistencia_tecnica`
--
ALTER TABLE `assistencia_tecnica`
  ADD CONSTRAINT `fk_Assistencia_Tecnica_Estado1` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assistencia_Tecnica_Requerente1` FOREIGN KEY (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`) REFERENCES `requerente` (`idRequerente`, `Tipo_Requerente_idTipo_Requerente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assistencia_Tecnica_Tecnico1` FOREIGN KEY (`Tecnico_idTecnico`) REFERENCES `tecnico` (`idTecnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Assistencia_Tecnica_Tipo_Assistencia1` FOREIGN KEY (`Tipo_Assistencia_idTipo_Assistencia`) REFERENCES `tipo_assistencia` (`idTipo_Assistencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD CONSTRAINT `fk_Equipamentos_Registo_Postos_Trabalho1` FOREIGN KEY (`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`) REFERENCES `registo_postos_trabalho` (`idRegisto_Postos_Trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Equipamentos_Tipo_Equipamento1` FOREIGN KEY (`Tipo_Equipamento_idTipo_Equipamento`) REFERENCES `tipo_equipamento` (`idTipo_Equipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `instalacao_computadores`
--
ALTER TABLE `instalacao_computadores`
  ADD CONSTRAINT `fk_Instalacao_Computadores_Estado1` FOREIGN KEY (`Estado_idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Instalacao_Computadores_Office1` FOREIGN KEY (`Office_idOffice`) REFERENCES `office` (`idOffice`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Instalacao_Computadores_Sistema_Operativo1` FOREIGN KEY (`Sistema_Operativo_idSistema_Operativo`) REFERENCES `sistema_operativo` (`idSistema_Operativo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `registo_postos_trabalho`
--
ALTER TABLE `registo_postos_trabalho`
  ADD CONSTRAINT `fk_Registo_Postos_Trabalho_Departamento1` FOREIGN KEY (`Departamento_idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Registo_Postos_Trabalho_Requerente1` FOREIGN KEY (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`) REFERENCES `requerente` (`idRequerente`, `Tipo_Requerente_idTipo_Requerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `requerente`
--
ALTER TABLE `requerente`
  ADD CONSTRAINT `fk_Requerente_Tipo_Requerente` FOREIGN KEY (`Tipo_Requerente_idTipo_Requerente`) REFERENCES `tipo_requerente` (`idTipo_Requerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `requerimento`
--
ALTER TABLE `requerimento`
  ADD CONSTRAINT `fk_Requerimento_Requerente1` FOREIGN KEY (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`) REFERENCES `requerente` (`idRequerente`, `Tipo_Requerente_idTipo_Requerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `requisicao_material`
--
ALTER TABLE `requisicao_material`
  ADD CONSTRAINT `fk_Requisicao_Material_Equipamentos1` FOREIGN KEY (`Equipamentos_idEquipamentos`,`Equipamentos_Tipo_Equipamento_idTipo_Equipamento`) REFERENCES `equipamentos` (`idEquipamentos`, `Tipo_Equipamento_idTipo_Equipamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Requisicao_Material_Requerente1` FOREIGN KEY (`Requerente_idRequerente`,`Requerente_Tipo_Requerente_idTipo_Requerente`) REFERENCES `requerente` (`idRequerente`, `Tipo_Requerente_idTipo_Requerente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `software`
--
ALTER TABLE `software`
  ADD CONSTRAINT `fk_Software_Registo_Postos_Trabalho1` FOREIGN KEY (`Registo_Postos_Trabalho_idRegisto_Postos_Trabalho`) REFERENCES `registo_postos_trabalho` (`idRegisto_Postos_Trabalho`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
