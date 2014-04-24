SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `TextAdventure` ;
CREATE SCHEMA IF NOT EXISTS `TextAdventure` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `TextAdventure` ;

-- -----------------------------------------------------
-- Table `TextAdventure`.`Befehle`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `TextAdventure`.`Befehle` (
  `IdBefehle` INT NOT NULL AUTO_INCREMENT ,
  `Befehle` VARCHAR(45) NULL ,
  PRIMARY KEY (`IdBefehle`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TextAdventure`.`Texte`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `TextAdventure`.`Texte` (
  `IdTexte` INT NOT NULL AUTO_INCREMENT ,
  `Texte` VARCHAR(500) NULL ,
  PRIMARY KEY (`IdTexte`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TextAdventure`.`Storybefehle`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `TextAdventure`.`Storybefehle` (
  `IdBefehle` INT NOT NULL ,
  `IdTexte` INT NOT NULL ,
  `IdTexte1` INT NOT NULL ,
  PRIMARY KEY (`IdBefehle`, `IdTexte`, `IdTexte1`) ,
  INDEX `fk_Befehle_has_Texte_Texte1_idx` (`IdTexte` ASC) ,
  INDEX `fk_Befehle_has_Texte_Befehle1_idx` (`IdBefehle` ASC) ,
  INDEX `fk_Befehle_has_Texte_Texte2_idx` (`IdTexte1` ASC) ,
  CONSTRAINT `fk_Befehle_has_Texte_Befehle1`
    FOREIGN KEY (`IdBefehle` )
    REFERENCES `TextAdventure`.`Befehle` (`IdBefehle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Befehle_has_Texte_Texte1`
    FOREIGN KEY (`IdTexte` )
    REFERENCES `TextAdventure`.`Texte` (`IdTexte` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Befehle_has_Texte_Texte2`
    FOREIGN KEY (`IdTexte1` )
    REFERENCES `TextAdventure`.`Texte` (`IdTexte` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TextAdventure`.`Storybefehle`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `TextAdventure`.`Storybefehle` (
  `IdBefehle` INT NOT NULL ,
  `IdTexte` INT NOT NULL ,
  `IdTexte1` INT NOT NULL ,
  PRIMARY KEY (`IdBefehle`, `IdTexte`, `IdTexte1`) ,
  INDEX `fk_Befehle_has_Texte_Texte1_idx` (`IdTexte` ASC) ,
  INDEX `fk_Befehle_has_Texte_Befehle1_idx` (`IdBefehle` ASC) ,
  INDEX `fk_Befehle_has_Texte_Texte2_idx` (`IdTexte1` ASC) ,
  CONSTRAINT `fk_Befehle_has_Texte_Befehle1`
    FOREIGN KEY (`IdBefehle` )
    REFERENCES `TextAdventure`.`Befehle` (`IdBefehle` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Befehle_has_Texte_Texte1`
    FOREIGN KEY (`IdTexte` )
    REFERENCES `TextAdventure`.`Texte` (`IdTexte` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Befehle_has_Texte_Texte2`
    FOREIGN KEY (`IdTexte1` )
    REFERENCES `TextAdventure`.`Texte` (`IdTexte` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `TextAdventure` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
