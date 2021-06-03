SET GLOBAL lc_time_names=pt_BR;
SET GLOBAL lc_messages=pt_BR;

DROP DATABASE IF EXISTS immune_system;
CREATE DATABASE IF NOT EXISTS immune_system
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `perfil` varchar(15), #Usuário, Administrador
  `status` smallint not null default '5', # os dados estão ativos (não foram excluídos logicamente) [1: Inativo, 5: Ativo]
  dt_in TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  dt_up TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`cpf`)
);

CREATE TABLE IF NOT EXISTS `agendamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL, #[1:Vacina, 2:Medicamento]
  `dt_entrega` timestamp NULL DEFAULT NULL,
  `dt_contaminacao` timestamp NULL DEFAULT NULL,
  `dt_retorno_movimentos` timestamp NULL DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `status` smallint NOT NULL DEFAULT '5', # [1: Cancelado, 5: Ativo, 10: Entregue]
  `dt_in` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_up` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_usuario`) REFERENCES usuario(id)
);