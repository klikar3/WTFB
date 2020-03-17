CREATE TABLE `wt-data`.`woocustomer` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(100) NULL COMMENT '',
  `anrede` VARCHAR(100) NULL COMMENT '',
  `vorname` VARCHAR(100) NULL COMMENT '',
  `nachname` VARCHAR(100) NULL COMMENT '',
  `geburtstag` VARCHAR(45) NULL COMMENT '',
  `geschlecht` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `ix_email` (`email` ASC)  COMMENT '');
  
 CREATE TABLE `wt-data`.`swmreceiver` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `email` VARCHAR(100) NULL COMMENT '',
  `anrede` VARCHAR(100) NULL COMMENT '',
  `vorname` VARCHAR(100) NULL COMMENT '',
  `nachname` VARCHAR(100) NULL COMMENT '',
  `geburtstag` VARCHAR(45) NULL COMMENT '',
  `geschlecht` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `ix_email` (`email` ASC)  COMMENT '');
  
   