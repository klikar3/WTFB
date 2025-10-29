ALTER TABLE `wt-data`.`mitglieder` 
ADD COLUMN `foto` MEDIUMBLOB NULL DEFAULT NULL COMMENT '' AFTER `wiederVorlageAm`;

USE `wt-data`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `mitgliederliste` AS
    SELECT 
        `m`.`MitgliederId` AS `MitgliederId`,
        `m`.`MitgliedsNr` AS `MitgliedsNr`,
        `m`.`Vorname` AS `Vorname`,
        `m`.`Name` AS `Nachname`,
        `m`.`Funktion` AS `Funktion`,
        `m`.`PruefungZum` AS `PruefungZum`,
        CONCAT(`m`.`Name`, ', ', `m`.`Vorname`) AS `Name`,
        COALESCE(`s`.`Schulname`, `m`.`Schulort`) AS `Schulname`,
        `sl`.`LeiterName` AS `LeiterName`,
        COALESCE(GROUP_CONCAT(DISTINCT `scd`.`DispKurz`
                    SEPARATOR ', '),
                `m`.`Disziplin`) AS `DispName`,
        IFNULL(GROUP_CONCAT(DISTINCT CONCAT(`sc`.`Schulname`, ' ', `scd`.`DispKurz`)
                    SEPARATOR ', '),
                '.') AS `Vertrag`,
        GROUP_CONCAT(DISTINCT CONCAT(`g`.`gKurz`, ' ', `dd`.`DispKurz`)
            SEPARATOR ', ') AS `Grad`,
        `m`.`LetzteAenderung` AS `LetzteAenderung`,
        `m`.`LetztAendSifu` AS `LetztAendSifu`,
        `m`.`GeburtsDatum` AS `GeburtsDatum`,
        `m`.`Email` AS `Email`,
        `m`.`RecDeleted` AS `RecDeleted`,
        `s`.`SchulId` AS `SchulId`,
        `mgg`.`printed` AS `printed`,
        `mgg`.`mgID` AS `mgID`,
        m.foto AS Foto
    FROM
        (((((((((((`mitglieder` `m`
        LEFT JOIN `mitgliederschulen` `ms` ON ((`ms`.`MitgliederId` = `m`.`MitgliederId`)))
        LEFT JOIN `schulen` `s` ON (((`s`.`SchulId` = `ms`.`SchulId`)
            AND (`s`.`Schulname` <> 'WTFB'))))
        LEFT JOIN `schulleiterschulen` `ss` ON ((`ss`.`SchulId` = `s`.`SchulId`)))
        LEFT JOIN `schulleiter` `sl` ON ((`sl`.`LeiterId` = `ss`.`LeiterId`)))
        LEFT JOIN `mitgliederschulen` `msc` ON ((`msc`.`MitgliederId` = `m`.`MitgliederId`)))
        LEFT JOIN `schulen` `sc` ON ((`sc`.`SchulId` = `msc`.`SchulId`)))
        LEFT JOIN `disziplinen` `scd` ON ((`scd`.`DispId` = `sc`.`Disziplin`)))
        LEFT JOIN `maxgrad` `mg` ON ((`mg`.`MitgliedId` = `m`.`MitgliederId`)))
        LEFT JOIN `grade` `g` ON ((`g`.`gradId` = `mg`.`Grad`)))
        LEFT JOIN `disziplinen` `dd` ON ((`dd`.`DispName` = `g`.`DispName`)))
        LEFT JOIN `mitgliedergrade` `mgg` ON (((`mgg`.`GradId` = `mg`.`Grad`)
            AND (`mgg`.`MitgliedId` = `m`.`MitgliederId`))))
    WHERE
        (1 = 1)
    GROUP BY `m`.`MitgliederId`;

