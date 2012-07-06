-- -----------------------------------------------------
-- Data for table `sacta`.`tipo_usuario`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `sacta`;
INSERT INTO `sacta`.`tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES ('1', 'Organizador', 'organizador');
INSERT INTO `sacta`.`tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES ('2', 'Colaborador', 'colaborador');
INSERT INTO `sacta`.`tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES ('3', 'Administrador', 'administrador');

COMMIT;

-- -----------------------------------------------------
-- Data for table `sacta`.`usuario`
-- -----------------------------------------------------
SET AUTOCOMMIT=0;
USE `sacta`;
INSERT INTO `sacta`.`usuario` (`id_usuario`, `nome`, `email`, `login`, `senha`, `id_tipo_usuario`) VALUES ('1', 'Administrador', '', 'admin', 'admin', '3');

COMMIT;
