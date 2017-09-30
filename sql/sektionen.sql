CREATE TABLE `sektionen` (
  `sekt_id` INT NOT NULL COMMENT '',
  `kurz` VARCHAR(20) NOT NULL COMMENT '',
  `name` VARCHAR(75) NULL COMMENT '',
  PRIMARY KEY (`sekt_id`)  COMMENT '');
  
ALTER TABLE `sektionen` 
CHANGE COLUMN `sekt_id` `sekt_id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '' ;


CREATE TABLE `mitgliedersektionen` (
  `msekt_id` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `mitglied_id` INT NOT NULL COMMENT '',
  `sektion_id` INT NOT NULL COMMENT '',
  `datum` DATETIME NULL COMMENT '',
  `pruefer_id` INT(10) UNSIGNED NOT NULL COMMENT '',
  PRIMARY KEY (`msekt_id`)  COMMENT '',
  UNIQUE INDEX `msekt_id_UNIQUE` (`msekt_id` ASC)  COMMENT '',
  INDEX `fk_mitglied_idx` (`mitglied_id` ASC)  COMMENT '',
  INDEX `fk_sekt_idx` (`sektion_id` ASC)  COMMENT '',
  INDEX `fk_pruef_idx` (`pruefer_id` ASC)  COMMENT '',
  CONSTRAINT `fk_mitglied`
    FOREIGN KEY (`mitglied_id`)
    REFERENCES `wt-data`.`mitglieder` (`MitgliederId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sekt`
    FOREIGN KEY (`sektion_id`)
    REFERENCES `wt-data`.`sektionen` (`sekt_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pruef`
    FOREIGN KEY (`pruefer_id`)
    REFERENCES `wt-data`.`pruefer` (`prueferId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

ALTER TABLE `mitgliedersektionen` 
ADD INDEX `ix_datum` (`datum` ASC)  COMMENT '';



INSERT INTO `sektionen` (kurz, name)
SELECT 'SNT','Siu Nim Tao' UNION ALL
SELECT 'CK','Cham Kiu' UNION ALL
SELECT '1 CS','1. Sektion Chi Sao' UNION ALL
SELECT '2 CS','2. Sektion Chi Sao' UNION ALL
SELECT '3 CS','3. Sektion Chi Sao' UNION ALL
SELECT '4 CS','4. Sektion Chi Sao' UNION ALL
SELECT '5 CS','5. Sektion Chi Sao' UNION ALL
SELECT '6 CS','6. Sektion Chi Sao' UNION ALL
SELECT '7 CS','1. Sektion Chi Sao' UNION ALL
SELECT 'BT','Biu Tze' UNION ALL
SELECT '1 BT-CS','1. Sektion Biu Tze - Chi Sao' UNION ALL
SELECT '2 BT-CS','2. Sektion Biu Tze - Chi Sao' UNION ALL
SELECT '3 BT-CS','3. Sektion Biu Tze - Chi Sao' UNION ALL
SELECT '4 BT-CS','4. Sektion Biu Tze - Chi Sao' UNION ALL
SELECT 'MYC','Holzpuppenform Muk Yan Chong' UNION ALL
SELECT '1 MYC-CS','1. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '2 MYC-CS','2. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '3 MYC-CS','3. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '4 MYC-CS','4. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '5 MYC-CS','5. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '6 MYC-CS','6. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '7 MYC-CS','7. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '8 MYC-CS','8. Sektion Muk Yan Chong - Chi Sao' UNION ALL
SELECT '1 CG','1. Teil Chi Gerk - Tripodalform' UNION ALL
SELECT '2 CG','2. Sektion Chi Gerk' UNION ALL
SELECT '3 CG','3. Sektion Chi Gerk' UNION ALL
SELECT '1 LDBK','1. Teil Luk Dim Boon Kwun - Kraftübungen' UNION ALL
SELECT '2 LDBK','2. Teil Luk Dim Boon Kwun - Vorübungen' UNION ALL
SELECT '3 LDBK','3. Teil Luk Dim Boon Kwun - Form' UNION ALL
SELECT '4 LDBK','4. Teil Luk Dim Boon Kwun - Chi Kwan' UNION ALL
SELECT '5 LDBK','5. Teil Luk Dim Boon Kwun - Lat Kwan - Anwendungen' UNION ALL
SELECT '1 BCD','1. Teil Bart Cham Dao - Vorübungen' UNION ALL
SELECT '2 BCD','2. Teil Bart Cham Dao - Form 1. Teil' UNION ALL
SELECT '3 BCD','3. Teil Bart Cham Dao - Form 2. Teil' UNION ALL
SELECT '4 BCD','4. Teil Bart Cham Dao - Anwendung'


ALTER TABLE `mitgliedersektionen` 
DROP FOREIGN KEY `fk_pruef`;
ALTER TABLE `mitgliedersektionen` 
CHANGE COLUMN `datum` `pdatum` DATETIME NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `pruefer_id` `pruefer_id` INT(10) UNSIGNED NULL COMMENT '' ,
ADD COLUMN `vdatum` DATETIME NULL COMMENT '' AFTER `pruefer_id`,
ADD COLUMN `vermittler_id` INT(10) UNSIGNED NULL COMMENT '' AFTER `vdatum`,
ADD INDEX `fk_sifu_idx` (`vermittler_id` ASC)  COMMENT '';
ALTER TABLE `mitgliedersektionen` 
ADD CONSTRAINT `fk_pruef`
  FOREIGN KEY (`pruefer_id`)
  REFERENCES `pruefer` (`prueferId`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_sifu`
  FOREIGN KEY (`vermittler_id`)
  REFERENCES `sifu` (`sId`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
ALTER TABLE `mitgliedersektionen` 
CHANGE COLUMN `pdatum` `pdatum` DATE NULL DEFAULT NULL COMMENT '' ,
CHANGE COLUMN `vdatum` `vdatum` DATE NULL DEFAULT NULL COMMENT '' ;
  
 
 
ALTER TABLE `user` 
ADD INDEX `ix_prueferid` (`PrueferId` ASC)  COMMENT '';
ALTER TABLE `tbl_dynagrid_dtl` 
ADD INDEX `ix_dynagrid_id` (`dynagrid_id` ASC)  COMMENT '';

