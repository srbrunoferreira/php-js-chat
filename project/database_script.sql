-- MySQL Script generated by MySQL Workbench
-- Tue Feb 16 22:55:20 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='';

-- -----------------------------------------------------
-- Schema justtype
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema justtype
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `justtype` DEFAULT CHARACTER SET utf8 ;
USE `justtype` ;

-- -----------------------------------------------------
-- Table `justtype`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `justtype`.`_message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `msg` TEXT(1000) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `_user_id` CHAR(9) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `user_nickname` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
