CREATE TABLE `trainings` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `schulId` INT(11) UNSIGNED NULL COMMENT '',
  `description` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `fk_training_schule_idx` (`schulId` ASC)  COMMENT '',
  CONSTRAINT `fk_training_schule`
    FOREIGN KEY (`schulId`)
    REFERENCES `wt-data`.`schulen` (`SchulId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
/*ALTER TABLE `trainings` 
ADD CONSTRAINT `fk_trainings_schulen`
  FOREIGN KEY (`schulId`)
  REFERENCES `wt-data`.`schulen` (`SchulId`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;    
*/
ALTER TABLE `trainings` 
CHANGE COLUMN `schulId` `schulId` INT(11) UNSIGNED NOT NULL COMMENT '' ,
CHANGE COLUMN `description` `description` VARCHAR(45) NOT NULL COMMENT '' ;    
    
CREATE TABLE `anwesenheit` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `trainingsId` INT NOT NULL COMMENT '',
  `datum` DATE NOT NULL COMMENT '',
  `anzahl` INT NOT NULL COMMENT '',
  PRIMARY KEY (`id`)  COMMENT '',
  UNIQUE INDEX `id_UNIQUE` (`id` ASC)  COMMENT '',
  INDEX `fk_anwesenheit_trainings_idx` (`trainingsId` ASC)  COMMENT '',
  CONSTRAINT `fk_anwesenheit_trainings`
    FOREIGN KEY (`trainingsId`)
    REFERENCES `wt-data`.`trainings` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
    
INSERT INTO `trainings` (schulId, description) 
VALUES (10,'Montag 18:30'),
(10,'Montag 20:30'),
(10,'Donnerstag 18:30'),
(10,'Donnerstag 20:15'),
(10,'Samstag');        
    
UPDATE `trainings` SET `schulId`='33' WHERE `id`='1';
UPDATE `trainings` SET `schulId`='33' WHERE `id`='2';
UPDATE `trainings` SET `schulId`='33' WHERE `id`='3';
UPDATE `trainings` SET `schulId`='33' WHERE `id`='4';
UPDATE `trainings` SET `schulId`='33' WHERE `id`='5';
  
  
-- ALTER TABLE `user` CHANGE `registration_ip` `registration_ip` VARCHAR(45) NULL DEFAULT NULL; 

 USE `wt-data`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `mitgliederzahl1` AS
    SELECT 
        `t`.`jahr` AS `jahr`,
        `t`.`monat` AS `monat`,
        (SELECT 
                COUNT(0)
            FROM
                `mitgliederschulen` `m1`
            WHERE
                ((YEAR(`m1`.`Von`) = `t`.`jahr`)
                    AND (MONTH(`m1`.`Von`) = `t`.`monat`)
                    AND (`m1`.`SchulId` = `m2`.`SchulId`))) AS `Eintritt`,
        (SELECT 
                COUNT(0)
            FROM
                `mitgliederschulen` `m1`
            WHERE
                ((YEAR(`m1`.`Bis`) = `t`.`jahr`)
                    AND (MONTH(`m1`.`Bis`) = `t`.`monat`)
                    AND (`m1`.`SchulId` = `m2`.`SchulId`))) AS `Austritt`,
        (SELECT 
                COUNT(0)
            FROM
                `mitgliederschulen` `m1`
            WHERE
                ((YEAR(`m1`.`KuendigungAm`) = `t`.`jahr`)
                    AND (MONTH(`m1`.`KuendigungAm`) = `t`.`monat`)
                    AND (`m1`.`SchulId` = `m2`.`SchulId`))) AS `Kuendigung`,
        (SELECT 
                COUNT(0)
            FROM
                `mitgliederschulen` `m1`
            WHERE
            (
                (
					(	(YEAR(`m1`.`Von`) = `t`.`jahr`)
						AND (MONTH(`m1`.`Von`) <= `t`.`monat`)
					)
					 OR (YEAR(`m1`.`Von`) < `t`.`jahr`)
				)
                AND 
                (
					(	(YEAR(`m1`.`Bis`) = `t`.`jahr`)
						AND (MONTH(`m1`.`Von`) >= `t`.`monat`)
					)
					 OR (YEAR(`m1`.`Bis`) > `t`.`jahr`)
                     OR (YEAR(`m1`.`Bis`) IS NULL)
                )
				AND (`m1`.`SchulId` = `m2`.`SchulId`)
            )        
		) AS `Anzahl`,
        `m2`.`SchulId` AS `SchulId`
    FROM
        (`tally` `t`
        JOIN `schulen` `m2`)
    GROUP BY `t`.`jahr` , `t`.`monat` , `m2`.`SchulId`
    ORDER BY `t`.`jahr` , `t`.`monat`;
   