SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `sbrettsc_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sbrettsc_db` ;

-- -----------------------------------------------------
-- Table `sbrettsc_db`.`menu_top`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`menu_top` (
  `label` VARCHAR(18) NOT NULL,
  `link` VARCHAR(100) NOT NULL,
  `sort` INT NULL,
  `icon` VARCHAR(45) NULL,
  PRIMARY KEY (`label`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`category` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(18) NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  `parent_label` VARCHAR(18) NOT NULL,
  `description` TEXT NULL,
  `thumbnail` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Catagory_Menu_top1_idx` (`parent_label` ASC),
  CONSTRAINT `fk_Catagory_Menu_top1`
    FOREIGN KEY (`parent_label`)
    REFERENCES `sbrettsc_db`.`menu_top` (`label`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`product` (
  `id` INT UNSIGNED NOT NULL,
  `price` INT NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `fullname` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `defaultimage` VARCHAR(45) NOT NULL,
  `category_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Product_Catagory1_idx` (`category_id` ASC),
  CONSTRAINT `fk_Product_Catagory1`
    FOREIGN KEY (`category_id`)
    REFERENCES `sbrettsc_db`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`image`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`image` (
  `id` INT UNSIGNED NOT NULL,
  `product_id` INT UNSIGNED NOT NULL,
  `url` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`, `product_id`),
  INDEX `fk_Image_Product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_Image_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `sbrettsc_db`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`sale` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` DATETIME NOT NULL,
  `end` DATETIME NOT NULL,
  `modifier` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`product_sale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`product_sale` (
  `product_id` INT UNSIGNED NOT NULL,
  `sale_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`product_id`, `sale_id`),
  INDEX `fk_Product_has_Sale_Sale1_idx` (`sale_id` ASC),
  INDEX `fk_Product_has_Sale_Product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_Product_has_Sale_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `sbrettsc_db`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_Sale_Sale1`
    FOREIGN KEY (`sale_id`)
    REFERENCES `sbrettsc_db`.`sale` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`specification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`specification` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `spec` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sbrettsc_db`.`product_specification`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sbrettsc_db`.`product_specification` (
  `product_id` INT UNSIGNED NOT NULL,
  `spec_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`product_id`, `spec_id`),
  INDEX `fk_Product_has_table1_table11_idx` (`spec_id` ASC),
  INDEX `fk_Product_has_table1_Product1_idx` (`product_id` ASC),
  CONSTRAINT `fk_Product_has_table1_Product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `sbrettsc_db`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Product_has_table1_table11`
    FOREIGN KEY (`spec_id`)
    REFERENCES `sbrettsc_db`.`specification` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
