-- -----------------------------------------------------
-- Schema mytest
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mytest` DEFAULT CHARACTER SET utf8 ;
USE `mytest` ;

-- -----------------------------------------------------
-- Table `mytest`.`usuario`
-- -----------------------------------------------------


CREATE TABLE IF NOT EXISTS `mytest`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(300) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `status` ENUM('A', 'B') NOT NULL,
  `password` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;