-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema appBus
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `appBus` DEFAULT CHARACTER SET utf8 ;
USE `appBus` ;

-- -----------------------------------------------------
-- Table `appBus`.`onibus`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appBus`.`onibus` (
  `onibus_id` INT NOT NULL AUTO_INCREMENT,
  `passagem` FLOAT NULL,
  `linha` VARCHAR(45) NOT NULL,
  `origem` VARCHAR(45) NULL,
  `destino` VARCHAR(45) NULL,
  PRIMARY KEY (`onibus_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appBus`.`horario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appBus`.`horario` (
  `horario_id` INT NOT NULL AUTO_INCREMENT,
  `hora` TINYINT(1) NOT NULL,
  `minuto` TINYINT(1) NOT NULL,
  `onibus_onibus_id` INT NOT NULL,
  PRIMARY KEY (`horario_id`, `onibus_onibus_id`),
  INDEX `fk_horario_onibus_idx` (`onibus_onibus_id` ASC),
  CONSTRAINT `fk_horario_onibus`
    FOREIGN KEY (`onibus_onibus_id`)
    REFERENCES `appBus`.`onibus` (`onibus_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appBus`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appBus`.`usuario` (
  `usuario_id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `data_cadastro` DATE NOT NULL,
  PRIMARY KEY (`usuario_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `appBus`.`favorito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `appBus`.`favorito` (
  `onibus_onibus_id` INT NOT NULL,
  `usuario_usuario_id` INT NOT NULL,
  PRIMARY KEY (`onibus_onibus_id`, `usuario_usuario_id`),
  INDEX `fk_onibus_has_usuario_usuario1_idx` (`usuario_usuario_id` ASC),
  INDEX `fk_onibus_has_usuario_onibus1_idx` (`onibus_onibus_id` ASC),
  CONSTRAINT `fk_onibus_has_usuario_onibus1`
    FOREIGN KEY (`onibus_onibus_id`)
    REFERENCES `appBus`.`onibus` (`onibus_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_onibus_has_usuario_usuario1`
    FOREIGN KEY (`usuario_usuario_id`)
    REFERENCES `appBus`.`usuario` (`usuario_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
