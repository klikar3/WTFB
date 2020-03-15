ALTER TABLE `wt-data`.`schulen` 
ADD COLUMN `swmInteressentenListe` INT(8) NOT NULL DEFAULT 0 COMMENT '' AFTER `Disziplin`,
ADD COLUMN `swmInteressentenForm` INT(8) NOT NULL DEFAULT 0 COMMENT '' AFTER `swmInteressentenListe`,
ADD COLUMN `swmMitgliederListe` INT(8) NOT NULL DEFAULT 0 COMMENT '' AFTER `swmInteressentenForm`,
ADD COLUMN `swmMitgliederForm` INT(8) NOT NULL DEFAULT 0 COMMENT '' AFTER `swmMitgliederListe`;
