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

ALTER TABLE `intensiv` 
ADD COLUMN `KontaktAm` date DEFAULT NULL COMMENT '' AFTER `mitgliederId`;

ALTER TABLE `intensiv` 
ADD COLUMN   `KontaktArt` varchar(50) DEFAULT NULL COMMENT '' AFTER `KontaktAm`;

ALTER TABLE `intensiv` 
ADD COLUMN   `Woher` varchar(27) DEFAULT NULL COMMENT '' AFTER `KontaktArt`;

ALTER TABLE `intensiv` 
ADD COLUMN `telefonatAm` DATE NULL COMMENT '' AFTER `kontaktNachricht`;

ALTER TABLE `intensiv` 
ADD COLUMN   `einstufung` varchar(20) DEFAULT NULL COMMENT '' AFTER `erstTermin`;

ALTER TABLE `wt-data`.`mitglieder` 
DROP COLUMN `datume42tg`,
DROP COLUMN `datume41tg`,
DROP COLUMN `datume32tg`,
DROP COLUMN `datume31tg`,
DROP COLUMN `datume22tg`,
DROP COLUMN `datume21tg`,
DROP COLUMN `datume12tg`,
DROP COLUMN `datume11tg`,
DROP COLUMN `datume12sg`,
DROP COLUMN `datume11sg`,
DROP COLUMN `datume10sg`,
DROP COLUMN `datume9sg`,
DROP COLUMN `datume8sg`,
DROP COLUMN `datume7sg`,
DROP COLUMN `datume6sg`,
DROP COLUMN `datume5sg`,
DROP COLUMN `datume4sg`,
DROP COLUMN `datume3sg`,
DROP COLUMN `datume2sg`,
DROP COLUMN `datume1sg`,
DROP COLUMN `datumwt12sgk`,
DROP COLUMN `datumwt11sgk`,
DROP COLUMN `datumwt10sgk`,
DROP COLUMN `datumwt9sgk`,
DROP COLUMN `datumwt8sgk`,
DROP COLUMN `datumwt7sgk`,
DROP COLUMN `datumwt6sgk`,
DROP COLUMN `datumwt5sgk`,
DROP COLUMN `datumwt4sgk`,
DROP COLUMN `datumwt3sgk`,
DROP COLUMN `datumwt2sgk`,
DROP COLUMN `datumwt1sgk`;

ALTER TABLE `wt-data`.`mitglieder` 
DROP COLUMN `datumwt5pg`,
DROP COLUMN `datumwt4tg`,
DROP COLUMN `datumwt3tg`,
DROP COLUMN `datumwt2tg`,
DROP COLUMN `datumwt1tg`,
DROP COLUMN `datumwt12sg`,
DROP COLUMN `datumwt11sg`,
DROP COLUMN `datumwt10sg`,
DROP COLUMN `datumwt9sg`,
DROP COLUMN `datumwt8sg`,
DROP COLUMN `datumwt7sg`,
DROP COLUMN `datumwt6sg`,
DROP COLUMN `datumwt5sg`,
DROP COLUMN `datumwt4sg`,
DROP COLUMN `datumwt3sg`,
DROP COLUMN `datumwt2sg`,
DROP COLUMN `datumwt1sg`;
