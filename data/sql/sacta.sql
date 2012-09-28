SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `palestra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `palestra` (
  `id_palestra` INT NOT NULL AUTO_INCREMENT ,
  `nome_palestra` VARCHAR(150) NULL ,
  `nome_palestrante` VARCHAR(100) NULL ,
  `instituicao` VARCHAR(100) NULL ,
  `hora_inicio_prevista` DATETIME NULL ,
  `hora_fim_prevista` DATETIME NULL ,
  `hora_inicio` DATETIME NULL ,
  `hora_fim` DATETIME NULL ,
  `sala` VARCHAR(30) NULL ,
  PRIMARY KEY (`id_palestra`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tipo_usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `tipo_usuario` (
  `id_tipo_usuario` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(30) NULL ,
  `alias` VARCHAR(30) NULL ,
  PRIMARY KEY (`id_tipo_usuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NULL ,
  `email` VARCHAR(50) NULL ,
  `login` VARCHAR(45) NULL ,
  `senha` VARCHAR(45) NULL ,
  `id_tipo_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_usuario_tipo_usuario1_idx` (`id_tipo_usuario` ASC) ,
  CONSTRAINT `fk_usuario_tipo_usuario1`
    FOREIGN KEY (`id_tipo_usuario` )
    REFERENCES `tipo_usuario` (`id_tipo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ouvinte`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ouvinte` (
  `id_ouvinte` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NULL ,
  `rg` VARCHAR(15) NULL ,
  `email` VARCHAR(50) NULL ,
  `curso` VARCHAR(50) NULL ,
  `instituicao` VARCHAR(50) NULL ,
  `pagamento` VARCHAR(10) NULL DEFAULT 'naopago' ,
  `impresso` TINYINT(1) NULL DEFAULT 0 ,
  `codigo_barras` CHAR(6) NOT NULL ,
  PRIMARY KEY (`id_ouvinte`) ,
  UNIQUE INDEX `un_cod_barras` (`codigo_barras` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sessao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sessao` (
  `id_sessao` INT NOT NULL AUTO_INCREMENT ,
  `id_ouvinte` INT NOT NULL ,
  `id_palestra` INT NOT NULL ,
  `hora_entrada` DATETIME NULL ,
  `hora_saida` DATETIME NULL ,
  PRIMARY KEY (`id_sessao`) ,
  INDEX `fk_sessao_ouvinte2_idx` (`id_ouvinte` ASC) ,
  INDEX `fk_sessao_palestra2_idx` (`id_palestra` ASC) ,
  CONSTRAINT `fk_sessao_ouvinte2`
    FOREIGN KEY (`id_ouvinte` )
    REFERENCES `ouvinte` (`id_ouvinte` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sessao_palestra2`
    FOREIGN KEY (`id_palestra` )
    REFERENCES `palestra` (`id_palestra` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `permissao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `permissao` (
  `id_permissao` INT NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT NOT NULL ,
  `id_palestra` INT NOT NULL ,
  PRIMARY KEY (`id_permissao`) ,
  INDEX `fk_usuario_palestra_usuario1_idx` (`id_usuario` ASC) ,
  INDEX `fk_usuario_palestra_palestra1_idx` (`id_palestra` ASC) ,
  CONSTRAINT `fk_usuario_palestra_usuario1`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `usuario` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_palestra_palestra1`
    FOREIGN KEY (`id_palestra` )
    REFERENCES `palestra` (`id_palestra` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `email_pendente`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `email_pendente` (
  `idemail_pendente` INT NOT NULL AUTO_INCREMENT ,
  `id_ouvinte` INT NOT NULL ,
  `data` DATETIME NOT NULL ,
  PRIMARY KEY (`idemail_pendente`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Token`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Token` (
  `token` VARCHAR(100) NOT NULL ,
  `data_criacao` DATETIME NULL ,
  `usuario_id_usuario` INT NOT NULL ,
  UNIQUE INDEX `token_UNIQUE` (`token` ASC) ,
  PRIMARY KEY (`token`) ,
  INDEX `fk_Token_usuario1_idx` (`usuario_id_usuario` ASC) ,
  CONSTRAINT `fk_Token_usuario1`
    FOREIGN KEY (`usuario_id_usuario` )
    REFERENCES `usuario` (`id_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `tipo_usuario`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES (1, 'Organizador', 'organizador');
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES (2, 'Colaborador', 'colaborador');
INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `nome`, `alias`) VALUES (3, 'Administrador', 'administrador');

COMMIT;

-- -----------------------------------------------------
-- Data for table `usuario`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `login`, `senha`, `id_tipo_usuario`) VALUES (1, 'Administrador', '', 'admin', 'admin', 3);

COMMIT;