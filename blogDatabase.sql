-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema blogDatabase
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema blogDatabase
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `blogDatabase` DEFAULT CHARACTER SET utf8 ;
USE `blogDatabase` ;

-- -----------------------------------------------------
-- Table `blogDatabase`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blogDatabase`.`user` (
  `idUser` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(16) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(50) NOT NULL,
  `isAdmin` TINYINT NOT NULL,
  `createdAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` DATETIME NOT NULL,
  PRIMARY KEY (`idUser`));


-- -----------------------------------------------------
-- Table `blogDatabase`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blogDatabase`.`category` (
  `idCategory` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idCategory`));


-- -----------------------------------------------------
-- Table `blogDatabase`.`article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blogDatabase`.`article` (
  `idArticle` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` VARCHAR(45) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `chapo` MEDIUMTEXT NOT NULL,
  `urlImage` VARCHAR(100) NULL,
  `content` LONGTEXT NOT NULL,
  `readTime` TINYINT(3) NOT NULL,
  `createdAt` DATE NOT NULL,
  `updatedAt` DATE NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  `idCategory` INT NOT NULL,
  PRIMARY KEY (`idArticle`),
  INDEX `fk_article_user1_idx` (`idUser` ASC),
  INDEX `fk_article_category1_idx` (`idCategory` ASC),
  CONSTRAINT `fk_article_user1`
    FOREIGN KEY (`idUser`)
    REFERENCES `blogDatabase`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_article_category1`
    FOREIGN KEY (`idCategory`)
    REFERENCES `blogDatabase`.`category` (`idCategory`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `blogDatabase`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `blogDatabase`.`comment` (
  `idComment` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` MEDIUMTEXT NOT NULL,
  `createdAt` DATE NOT NULL,
  `updatedAt` DATE NOT NULL,
  `idArticle` INT UNSIGNED NOT NULL,
  `idUser` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`idComment`),
  INDEX `fk_comment_article_idx` (`idArticle` ASC),
  INDEX `fk_comment_user1_idx` (`idUser` ASC),
  CONSTRAINT `fk_comment_article`
    FOREIGN KEY (`idArticle`)
    REFERENCES `blogDatabase`.`article` (`idArticle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`idUser`)
    REFERENCES `blogDatabase`.`user` (`idUser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
