CREATE SCHEMA IF NOT EXISTS `reto2` DEFAULT CHARACTER SET utf8 ;
USE `reto2` ;

DROP TABLE IF EXISTS `reto2`.`categoria`;
DROP TABLE IF EXISTS `reto2`.`voto`;
DROP TABLE IF EXISTS `reto2`.`respuesta`;
DROP TABLE IF EXISTS `reto2`.`etiqueta`;
DROP TABLE IF EXISTS `reto2`.`pregunta`;
DROP TABLE IF EXISTS `reto2`.`usuario`;

-- -----------------------------------------------------
-- Table `reto2`.`etiqueta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`etiqueta` (
  `idetiqueta` INT(11) NOT NULL,
  `etiqueta` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idetiqueta`),
  UNIQUE INDEX `etiqueta_UNIQUE` (`etiqueta` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` VARCHAR(12) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `contrasenna` VARCHAR(255) NOT NULL,
  `descripcion` VARCHAR(1000) NULL DEFAULT NULL,
  `url_avatar` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`pregunta` (
  `idpregunta` INT(11) NOT NULL AUTO_INCREMENT,
  `idusuario` INT(11) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `texto` VARCHAR(1000) NOT NULL,
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpregunta`),
  INDEX `fk_pregunta_usuario1` (`idusuario` ASC),
  CONSTRAINT `fk_pregunta_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`categoria` (
  `idetiqueta` INT(11) NOT NULL,
  `idpregunta` INT(11) NOT NULL,
  PRIMARY KEY (`idetiqueta`, `idpregunta`),
  INDEX `fk_etiqueta_has_pregunta_pregunta1_idx` (`idpregunta` ASC),
  INDEX `fk_etiqueta_has_pregunta_etiqueta1_idx` (`idetiqueta` ASC),
  CONSTRAINT `fk_etiqueta_has_pregunta_etiqueta1`
    FOREIGN KEY (`idetiqueta`)
    REFERENCES `reto2`.`etiqueta` (`idetiqueta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_etiqueta_has_pregunta_pregunta1`
    FOREIGN KEY (`idpregunta`)
    REFERENCES `reto2`.`pregunta` (`idpregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`respuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`respuesta` (
  `idrespuesta` INT(11) NOT NULL AUTO_INCREMENT,
  `idpregunta` INT(11) NOT NULL,
  `idusuario` INT(11) NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `texto` VARCHAR(1000) NOT NULL,
  `resuelve` TINYINT(4) NOT NULL DEFAULT '0',
  `fecha_creacion` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idrespuesta`),
  INDEX `fk_respuesta_pregunta1_idx` (`idpregunta` ASC),
  INDEX `fk_respuesta_usuario1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_respuesta_pregunta1`
    FOREIGN KEY (`idpregunta`)
    REFERENCES `reto2`.`pregunta` (`idpregunta`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_respuesta_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`voto_respuesta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`voto_respuesta` (
  `idusuario` INT(11) NOT NULL,
  `idrespuesta` INT(11) NOT NULL,
  `positivo` TINYINT(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`, `idrespuesta`),
  INDEX `fk_voto_usuario1_idx` (`idusuario` ASC),
  INDEX `fk_voto_respuesta1_idx` (`idrespuesta` ASC),
  CONSTRAINT `fk_voto_respuesta1`
    FOREIGN KEY (`idrespuesta`)
    REFERENCES `reto2`.`respuesta` (`idrespuesta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_voto_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `reto2`.`voto_pregunta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reto2`.`voto_pregunta` (
  `idusuario` INT(11) NOT NULL,
  `idpregunta` INT(11) NOT NULL,
  `positivo` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`, `idpregunta`),
  INDEX `fk_usuario_has_pregunta_pregunta1_idx` (`idpregunta` ASC),
  INDEX `fk_usuario_has_pregunta_usuario1_idx` (`idusuario` ASC),
  CONSTRAINT `fk_usuario_has_pregunta_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `reto2`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_has_pregunta_pregunta1`
    FOREIGN KEY (`idpregunta`)
    REFERENCES `reto2`.`pregunta` (`idpregunta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
