SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `sacta` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sacta` ;

-- -----------------------------------------------------
-- Table `sacta`.`palestra`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`palestra` (
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
-- Table `sacta`.`tipo_usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`tipo_usuario` (
  `id_tipo_usuario` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(30) NULL ,
  `alias` VARCHAR(30) NULL ,
  PRIMARY KEY (`id_tipo_usuario`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sacta`.`usuario`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NULL ,
  `email` VARCHAR(50) NULL ,
  `login` VARCHAR(45) NULL ,
  `senha` VARCHAR(45) NULL ,
  `id_tipo_usuario` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_usuario_tipo_usuario1` (`id_tipo_usuario` ASC) ,
  CONSTRAINT `fk_usuario_tipo_usuario1`
    FOREIGN KEY (`id_tipo_usuario` )
    REFERENCES `sacta`.`tipo_usuario` (`id_tipo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sacta`.`ouvinte`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`ouvinte` (
  `id_ouvinte` INT NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(100) NULL ,
  `rg` VARCHAR(15) NULL ,
  `email` VARCHAR(50) NULL ,
  `curso` VARCHAR(50) NULL ,
  `instituicao` VARCHAR(50) NULL ,
  `pagamento` VARCHAR(10) NULL DEFAULT 'naopago' ,
  `impresso` TINYINT(1)  NULL DEFAULT 0 ,
  `codigo_barras` CHAR(6)  NOT NULL ,
  PRIMARY KEY (`id_ouvinte`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sacta`.`sessao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`sessao` (
  `id_sessao` INT NOT NULL AUTO_INCREMENT ,
  `id_ouvinte` INT NOT NULL ,
  `id_palestra` INT NOT NULL ,
  `hora_entrada` DATETIME NULL ,
  `hora_saida` DATETIME NULL ,
  PRIMARY KEY (`id_sessao`) ,
  INDEX `fk_sessao_ouvinte2` (`id_ouvinte` ASC) ,
  INDEX `fk_sessao_palestra2` (`id_palestra` ASC) ,
  CONSTRAINT `fk_sessao_ouvinte2`
    FOREIGN KEY (`id_ouvinte` )
    REFERENCES `sacta`.`ouvinte` (`id_ouvinte` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sessao_palestra2`
    FOREIGN KEY (`id_palestra` )
    REFERENCES `sacta`.`palestra` (`id_palestra` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sacta`.`permissao`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `sacta`.`permissao` (
  `id_permissao` INT NOT NULL AUTO_INCREMENT ,
  `id_usuario` INT NOT NULL ,
  `id_palestra` INT NOT NULL ,
  PRIMARY KEY (`id_permissao`) ,
  INDEX `fk_usuario_palestra_usuario1` (`id_usuario` ASC) ,
  INDEX `fk_usuario_palestra_palestra1` (`id_palestra` ASC) ,
  CONSTRAINT `fk_usuario_palestra_usuario1`
    FOREIGN KEY (`id_usuario` )
    REFERENCES `sacta`.`usuario` (`id_usuario` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_palestra_palestra1`
    FOREIGN KEY (`id_palestra` )
    REFERENCES `sacta`.`palestra` (`id_palestra` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
