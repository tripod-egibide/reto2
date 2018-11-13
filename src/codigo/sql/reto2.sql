SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


DROP TABLE IF EXISTS `reto2`.`etiqueta`;
DROP TABLE IF EXISTS `reto2`.`voto`;
DROP TABLE IF EXISTS `reto2`.`respuesta`;
DROP TABLE IF EXISTS `reto2`.`pregunta`;
DROP TABLE IF EXISTS `reto2`.`usuario`;

-- -----------------------------------------------------
-- Table `reto2`.`usuario`
-- -----------------------------------------------------
CREATE TABLE `reto2`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(12) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `contrasenna` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(1000) NULL,
  `url_avatar` VARCHAR(45) NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2`.`pregunta`
-- -----------------------------------------------------
CREATE TABLE `reto2`.`pregunta` (
  `idpregunta` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  PRIMARY KEY (`idpregunta`),
  INDEX `fk_pregunta_usuarios_idx` (`idusuario` ASC),
  CONSTRAINT `fk_pregunta_usuarios`
    FOREIGN KEY (`idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2`.`respuesta`
-- -----------------------------------------------------
CREATE TABLE `reto2`.`respuesta` (
  `idrespuesta` INT NOT NULL AUTO_INCREMENT,
  `idpregunta` INT NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `respuesta` VARCHAR(1000) NOT NULL,
  `resuelve` TINYINT NOT NULL DEFAULT 0,
  `puntos` INT NOT NULL DEFAULT 0,
  INDEX `fk_respuesta_pregunta1_idx` (`idpregunta` ASC),
  INDEX `fk_respuesta_usuario1_idx` (`usuario_idusuario` ASC),
  PRIMARY KEY (`idrespuesta`),
  CONSTRAINT `fk_respuesta_pregunta1`
    FOREIGN KEY (`idpregunta`)
    REFERENCES `reto2`.`pregunta` (`idpregunta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_respuesta_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2`.`etiqueta`
-- -----------------------------------------------------
CREATE TABLE `reto2`.`etiqueta` (
  `idetiqueta` INT NOT NULL,
  `etiqueta` VARCHAR(50) NOT NULL,
  `pregunta_idpregunta` INT NOT NULL,
  PRIMARY KEY (`idetiqueta`),
  UNIQUE INDEX `etiqueta_UNIQUE` (`etiqueta` ASC),
  INDEX `fk_etiqueta_pregunta1_idx` (`pregunta_idpregunta` ASC),
  CONSTRAINT `fk_etiqueta_pregunta1`
    FOREIGN KEY (`pregunta_idpregunta`)
    REFERENCES `reto2`.`pregunta` (`idpregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reto2`.`voto`
-- -----------------------------------------------------
CREATE TABLE `reto2`.`voto` (
  `usuario_idusuario` INT NOT NULL,
  `respuesta_idrespuesta` INT NOT NULL,
  INDEX `fk_voto_usuario1_idx` (`usuario_idusuario` ASC),
  INDEX `fk_voto_respuesta1_idx` (`respuesta_idrespuesta` ASC),
  PRIMARY KEY (`usuario_idusuario`, `respuesta_idrespuesta`),
  CONSTRAINT `fk_voto_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voto_respuesta1`
    FOREIGN KEY (`respuesta_idrespuesta`)
    REFERENCES `reto2`.`respuesta` (`idrespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
