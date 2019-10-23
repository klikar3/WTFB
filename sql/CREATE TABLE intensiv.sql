- Alter
- Graduierung
- Ausbilderqualifikation
- Unterrichtest Du
- Eigene Schule
- Dein(e) Lehrer
- Organisation
- Erfahrung and. Stile
- Dein Ziel
- Wieviel Zeit
- Trainingspartner
- Erst-Termin (Datumsfeld)


CREATE TABLE `wt-data`.`intensiv` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `mitgliederId` INT NOT NULL COMMENT '',
  `eigeneLehrer` VARCHAR(45) NULL COMMENT '',
  `alter` INT NULL COMMENT '',
  `graduierung` VARCHAR(45) NULL COMMENT '',
  `ausbQuali` VARCHAR(45) NULL COMMENT '',
  `unterrichtet` VARCHAR(45) NULL COMMENT '',
  `eigeneSchule` VARCHAR(45) NULL COMMENT '',
  `organisation` TINYTEXT NULL COMMENT '',
  `erfAndereStile` TINYTEXT NULL COMMENT '',
  `ziel` INT NULL COMMENT '',
  `wievielZeit` INT NULL COMMENT '',
  `trainingsPartner` VARCHAR(45) NULL COMMENT '',
  `erstTermin` DATE NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  UNIQUE INDEX `mitgliederId_UNIQUE` (`mitgliederId` ASC)  COMMENT '',
  CONSTRAINT `FK_intensiv_Mitglieder`
    FOREIGN KEY (`mitgliederId`)
    REFERENCES `wt-data`.`mitglieder` (`MitgliederId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);


ALTER TABLE `wt-data`.`intensiv` 
CHANGE COLUMN `eigeneLehrer` `eigeneLehrer` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `graduierung` `graduierung` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `ausbQuali` `ausbQuali` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `unterrichtet` `unterrichtet` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `eigeneSchule` `eigeneSchule` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `organisation` `organisation` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `erfAndereStile` `erfAndereStile` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `ziel` `ziel` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `wievielZeit` `wievielZeit` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `trainingsPartner` `trainingsPartner` VARCHAR(2000) NULL DEFAULT NULL COMMENT '' ;


ALTER TABLE `wt-data`.`intensiv` 
CHANGE COLUMN `eigeneLehrer` `eigeneLehrer` VARCHAR(200) NULL DEFAULT NULL COMMENT '' AFTER `eigeneSchule`,
CHANGE COLUMN `graduierung` `graduierung` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `ausbQuali` `ausbQuali` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `unterrichtet` `unterrichtet` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `eigeneSchule` `eigeneSchule` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `organisation` `organisation` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `erfAndereStile` `erfAndereStile` VARCHAR(500) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `ziel` `ziel` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `wievielZeit` `wievielZeit` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `trainingsPartner` `trainingsPartner` VARCHAR(200) NULL DEFAULT NULL COMMENT '' ,
ADD COLUMN `kontaktNachricht` MEDIUMTEXT NULL COMMENT '' AFTER `mitgliederId`,
ADD COLUMN `wieLangeWt` VARCHAR(200) NULL COMMENT '' AFTER `graduierung`,
ADD COLUMN `bemerkung` MEDIUMTEXT NULL COMMENT '' AFTER `erstTermin`;

