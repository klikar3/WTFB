                     
CREATE TABLE `mitgliederdisziplinen_neu` (
  `maId` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'a',
  `MitgliedId` int(10) NOT NULL,
  `DisziplinId` int(10) unsigned NOT NULL,
  `Von` date NOT NULL,
  `Bis` date NOT NULL,
  PRIMARY KEY (`maId`),
  KEY `MitgliedId` (`MitgliedId`,`DisziplinId`),
  KEY `DisziplinId` (`DisziplinId`),
  CONSTRAINT `mitglieder` FOREIGN KEY (`MitgliedId`) REFERENCES `mitglieder_neu` (`MitgliederId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mitgliederdisziplinen_ibfk_2` FOREIGN KEY (`DisziplinId`) REFERENCES `disziplinen` (`DispId`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1061 DEFAULT CHARSET=utf8;

CREATE TABLE `mitgliedergrade_neu` (
  `mgID` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'a',
  `MitgliedId` int(11) NOT NULL,
  `GradId` int(11) unsigned NOT NULL,
  `Datum` date NOT NULL,
  `PrueferId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`mgID`),
  UNIQUE KEY `MitgliedGrad_neu` (`MitgliedId`,`GradId`),
  KEY `MitgliedId` (`MitgliedId`),
  KEY `GradId` (`GradId`),
  KEY `PrueferId` (`PrueferId`),
  KEY `datum` (`Datum`)
) ENGINE=InnoDB AUTO_INCREMENT=2468 DEFAULT CHARSET=utf8 COMMENT='Verknüpfung Mitglieder und Grade';
  CONSTRAINT `mitgliedergrade_neu_ibfk_1` FOREIGN KEY (`MitgliedId`) REFERENCES `mitglieder_neu` (`MitgliederId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mitgliedergrade_neu_ibfk_4` FOREIGN KEY (`GradId`) REFERENCES `grade` (`gradId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mitgliedergrade_neu_ibfk_5` FOREIGN KEY (`PrueferId`) REFERENCES `pruefer` (`prueferId`) ON DELETE NO ACTION ON UPDATE NO ACTION

CREATE TABLE `mitgliederschulen_neu` (
  `msID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'a',
  `MitgliederId` int(11) NOT NULL,
  `SchulId` int(10) unsigned NOT NULL,
  `Von` date NOT NULL,
  `Bis` date DEFAULT NULL,
  `VertragId` int(10) unsigned DEFAULT NULL,
  `VDauerMonate` int(10) unsigned NOT NULL,
  `MonatsBeitrag` decimal(8,2) NOT NULL,
  `ZahlungsArt` varchar(20) NOT NULL,
  `Zahlungsweise` varchar(20) NOT NULL,
  `BeitragAussetzenVon` date DEFAULT NULL,
  `BeitragAussetzenBis` date DEFAULT NULL,
  `BeitragAussetzenGrund` varchar(45) DEFAULT NULL,
  `KuendigungAm` date DEFAULT NULL,
  PRIMARY KEY (`msID`),
  KEY `MitgliederId` (`MitgliederId`),
  KEY `SchulId` (`SchulId`),
  KEY `VertragId` (`VertragId`),
  CONSTRAINT `MitgliederId` FOREIGN KEY (`MitgliederId`) REFERENCES `mitglieder_neu` (`MitgliederId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SchulId` FOREIGN KEY (`SchulId`) REFERENCES `schulen` (`SchulId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `VertragId` FOREIGN KEY (`VertragId`) REFERENCES `vertrag` (`VertragId`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=999 DEFAULT CHARSET=utf8;

/* Disziplinen */ /* Disziplinen werden nicht mehr benötigt - Schulverträge haben Diziplinen
INSERT INTO `mitgliederdisziplinen`(`MitgliedId`, `DisziplinId`) 
SELECT `MitgliederId`, (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'Wing Tzun') 
FROM `mitglieder` m WHERE `Disziplin` LIKE '%Wing Tzun%' AND (GruppenArt = 'Erwachsenen-Gruppe' OR
GruppenArt = '')
AND NOT EXISTS ( SELECT 1 FROM `mitgliederdisziplinen` WHERE `MitgliedId`= m.`MitgliederId` 
AND `DisziplinId` =  (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'Wing Tzun'));

INSERT INTO `mitgliederdisziplinen`(`MitgliedId`, `DisziplinId`) 
SELECT `MitgliederId`, (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'Esckrima') 
FROM `mitglieder` m WHERE `Disziplin` LIKE '%Esckrima%' AND (GruppenArt = 'Erwachsenen-Gruppe' OR
GruppenArt = '')
AND NOT EXISTS ( SELECT 1 FROM `mitgliederdisziplinen` WHERE m.`MitgliederId`= `MitgliedId` 
AND `DisziplinId` =  (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'Esckrima'));

INSERT INTO `mitgliederdisziplinen`(`MitgliedId`, `DisziplinId`) 
SELECT `MitgliederId`, (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Kinder') 
FROM `mitglieder` m WHERE `Disziplin` LIKE '%Wing Tzun%' AND GruppenArt = 'Kinder-Gruppe'
AND NOT EXISTS ( SELECT 1 FROM `mitgliederdisziplinen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `DisziplinId` =  (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Kinder'));

INSERT INTO `mitgliederdisziplinen`(`MitgliedId`, `DisziplinId`) 
SELECT `MitgliederId`, (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Jugend') 
FROM `mitglieder` m WHERE `Disziplin` LIKE '%Wing Tzun%' AND GruppenArt = 'Jugend-Gruppe'
AND NOT EXISTS ( SELECT 1 FROM `mitgliederdisziplinen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `DisziplinId` =  (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Jugend'));

INSERT INTO `mitgliederdisziplinen`(`MitgliedId`, `DisziplinId`) 
SELECT `MitgliederId`, (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Intensiv') 
FROM `mitglieder` m WHERE `Disziplin` LIKE '%Wing Tzun%' AND GruppenArt = 'Intensiv-Gruppe'
AND NOT EXISTS ( SELECT 1 FROM `mitgliederdisziplinen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `DisziplinId` =  (SELECT `DispId` FROM `disziplinen` WHERE `DispName` = 'WT-Intensiv'));
*/

/* Schulverträge   */
-- Wing Tzun
INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
ZahlungsArt,Zahlungsweise,BeitragAussetzenVon,BeitragAussetzenBis,BeitragAussetzenGrund,KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, CASE m.VDauer WHEN '12 Monate' THEN 12
WHEN '6 Monate' THEN 6 WHEN '4 Monate' THEN 4 WHEN '3 Monate' THEN 3 ELSE 0 END, m.Monatsbeitrag, 
m.ZahlungsArt, m.Zahlungsweise,m.BeitragAussetzenVon, m.BeitragAussetzenBis,m.BeitragAussetzenGrund,m.KuendigungDatum  
FROM `mitglieder` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 1 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where (GruppenArt = 'Erwachsenen-Gruppe' OR
GruppenArt = '') AND m.Disziplin LIKE'%Tz%' 
AND NOT EXISTS ( SELECT 1 FROM `mitgliederschulen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `SchulId` =  s.`SchulId` AND s.Disziplin = 1);

-- WT-Kinder
INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
ZahlungsArt,Zahlungsweise,BeitragAussetzenVon,BeitragAussetzenBis,BeitragAussetzenGrund,KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, CASE m.VDauer WHEN '12 Monate' THEN 12
WHEN '6 Monate' THEN 6 WHEN '4 Monate' THEN 4 WHEN '3 Monate' THEN 3 ELSE 0 END, m.Monatsbeitrag, 
m.ZahlungsArt, m.Zahlungsweise,m.BeitragAussetzenVon, m.BeitragAussetzenBis,m.BeitragAussetzenGrund,m.KuendigungDatum  
FROM `mitglieder` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 3 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where m.GruppenArt = 'Kinder-Gruppe' AND m.Disziplin LIKE'%Tz%' 
AND NOT EXISTS ( SELECT 1 FROM `mitgliederschulen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `SchulId` =  s.`SchulId` AND s.Disziplin = 3);

-- WT-Jugend
INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
ZahlungsArt,Zahlungsweise,BeitragAussetzenVon,BeitragAussetzenBis,BeitragAussetzenGrund,KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, CASE m.VDauer WHEN '12 Monate' THEN 12
WHEN '6 Monate' THEN 6 WHEN '4 Monate' THEN 4 WHEN '3 Monate' THEN 3 ELSE 0 END, m.Monatsbeitrag, 
m.ZahlungsArt, m.Zahlungsweise,m.BeitragAussetzenVon, m.BeitragAussetzenBis,m.BeitragAussetzenGrund,m.KuendigungDatum  
FROM `mitglieder` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 5 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where m.GruppenArt = 'Jugend-Gruppe' AND m.Disziplin LIKE'%Tz%' 
AND NOT EXISTS ( SELECT 1 FROM `mitgliederschulen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `SchulId` =  s.`SchulId` AND s.Disziplin = 5);



/* Esckrima */
INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate, MonatsBeitrag, ZahlungsArt, Zahlungsweise, BeitragAussetzenVon, BeitragAussetzenBis, BeitragAussetzenGrund, KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, 12, m.Monatsbeitrag, m.Zahlungsart, m.Zahlungsweise, m.BeitragAussetzenVon, m.BeitragAussetzenBis, m.BeitragAussetzenGrund,m.KuendigungDatum 
FROM `mitglieder` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 2 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where /*m.GruppenArt = 'Kinder-Gruppe'
AND*/ m.Disziplin LIKE 'Esckrima' 
AND NOT EXISTS ( SELECT 1 FROM `mitgliederschulen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `SchulId` =  s.`SchulId` AND s.Disziplin = 2);
;

/* Kinder-Esckrima */
INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate, MonatsBeitrag, ZahlungsArt, Zahlungsweise, BeitragAussetzenVon, BeitragAussetzenBis, BeitragAussetzenGrund, KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, 12, m.DM2Schule, m.Zahlungsart, m.Zahlungsweise, m.BeitragAussetzenVon, m.BeitragAussetzenBis, m.BeitragAussetzenGrund,m.KuendigungDatum 
FROM `mitglieder_neu` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 2 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where /*m.GruppenArt = 'Kinder-Gruppe'
AND*/ m.Disziplin LIKE '%Tz%E%' ;


INSERT INTO `mitgliederschulen`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate, MonatsBeitrag, ZahlungsArt, Zahlungsweise, BeitragAussetzenVon, BeitragAussetzenBis, BeitragAussetzenGrund, KuendigungAm) 
select ms.`MitgliederId`, ms.`SchulId`, ms.Von, ms.Bis, ms.VDauerMonate, ms.MonatsBeitrag, ms.ZahlungsArt, 
ms.Zahlungsweise, ms.BeitragAussetzenVon, ms.BeitragAussetzenBis, ms.BeitragAussetzenGrund, ms.KuendigungAm 
from  `mitgliederschulen_neu` ms left outer join `mitgliederschulen` m
on ms.`MitgliederId` = m.`MitgliederId` AND ms.`SchulId` = m.`SchulId` and ms.von = m.von
where m.msid is null

/*---------- Grade ------------------------------------------
 --- wt */
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,1,`datumwt1sg`, 1 FROM `mitglieder` 
WHERE `datumwt1sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,1,`datumwt1sg`, 2 FROM `mitglieder` 
WHERE `datumwt1sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,2, `datumwt2sg` ,1 FROM `mitglieder` 
WHERE `datumwt2sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,2, `datumwt2sg` ,2 FROM `mitglieder` 
WHERE `datumwt2sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,3, `datumwt3sg` ,1 FROM `mitglieder` 
WHERE `datumwt3sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,3, `datumwt3sg` ,2 FROM `mitglieder` 
WHERE `datumwt3sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,4, `datumwt4sg` ,1 FROM `mitglieder` 
WHERE `datumwt4sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,4, `datumwt4sg` ,2 FROM `mitglieder` 
WHERE `datumwt4sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,5, `datumwt5sg` ,1 FROM `mitglieder` 
WHERE `datumwt5sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,5, `datumwt5sg` ,2 FROM `mitglieder` 
WHERE `datumwt5sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,6, `datumwt6sg` ,1 FROM `mitglieder` 
WHERE `datumwt6sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,6, `datumwt6sg` ,2 FROM `mitglieder` 
WHERE `datumwt6sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,7, `datumwt7sg` ,1 FROM `mitglieder` 
WHERE `datumwt7sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,7, `datumwt7sg` ,2 FROM `mitglieder` 
WHERE `datumwt7sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,8, `datumwt8sg` ,1 FROM `mitglieder` 
WHERE `datumwt8sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,8, `datumwt8sg` ,2 FROM `mitglieder` 
WHERE `datumwt8sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,9, `datumwt9sg` ,1 FROM `mitglieder` 
WHERE `datumwt9sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,9, `datumwt9sg` ,2 FROM `mitglieder` 
WHERE `datumwt9sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,10, `datumwt10sg` ,1 FROM `mitglieder` 
WHERE `datumwt10sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,10, `datumwt10sg` ,2 FROM `mitglieder` 
WHERE `datumwt10sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,11, `datumwt11sg` ,1 FROM `mitglieder` 
WHERE `datumwt11sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,11, `datumwt11sg` ,2 FROM `mitglieder` 
WHERE `datumwt11sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,12, `datumwt12sg` ,1 FROM `mitglieder` 
WHERE `datumwt12sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,12, `datumwt12sg` ,2 FROM `mitglieder` 
WHERE `datumwt12sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,13, `datumwt1tg` ,1 FROM `mitglieder` 
WHERE `datumwt1tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,13, `datumwt1tg` ,2 FROM `mitglieder` 
WHERE `datumwt1tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,14, `datumwt2tg` ,1 FROM `mitglieder` 
WHERE `datumwt2tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,14, `datumwt2tg` ,2 FROM `mitglieder` 
WHERE `datumwt2tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,15, `datumwt3tg` ,1 FROM `mitglieder` 
WHERE `datumwt3tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,15, `datumwt3tg` ,2 FROM `mitglieder` 
WHERE `datumwt3tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,16, `datumwt4tg` ,1 FROM `mitglieder` 
WHERE `datumwt4tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,16, `datumwt4tg` ,2 FROM `mitglieder` 
WHERE `datumwt4tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,21, `datumwt5pg` ,1 FROM `mitglieder` 
WHERE `datumwt5pg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,21, `datumwt5pg` ,2 FROM `mitglieder` 
WHERE `datumwt5pg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart';



/* --- esckrima   */
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume1sg` ,1 FROM `mitglieder`,grade  
WHERE `datume1sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND  `gradName` LIKE '1. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume1sg` ,2 FROM `mitglieder`,grade  
WHERE `datume1sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '1. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume2sg` ,1 FROM `mitglieder`,grade  
WHERE `datume2sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '2. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume2sg` ,2 FROM `mitglieder` ,grade 
WHERE `datume2sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '2. S%' 
AND `DispName` = 'Esckrima' ;

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume3sg` ,1 FROM `mitglieder` ,grade 
WHERE `datume3sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '3. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume3sg` ,2 FROM `mitglieder`,grade  
WHERE `datume3sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '3. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume4sg` ,1 FROM `mitglieder` ,grade 
WHERE `datume4sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '4. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume4sg` ,2 FROM `mitglieder`,grade  
WHERE `datume4sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '4. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume5sg` ,1 FROM `mitglieder` ,grade 
WHERE `datume5sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '5. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume5sg` ,2 FROM `mitglieder`,grade  
WHERE `datume5sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '5. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume6sg` ,1 FROM `mitglieder`,grade  
WHERE `datume6sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '6. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume6sg` ,2 FROM `mitglieder`,grade  
WHERE `datume6sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '6. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume7sg` ,1 FROM `mitglieder`,grade  
WHERE `datume7sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '7. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume7sg` ,2 FROM `mitglieder`,grade  
WHERE `datume7sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '7. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume8sg` ,1 FROM `mitglieder`,grade  
WHERE `datume8sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '8. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume8sg` ,2 FROM `mitglieder`,grade  
WHERE `datume8sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '8. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume9sg` ,1 FROM `mitglieder`,grade 
WHERE `datume9sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart'
AND `gradName` LIKE '9. S%' AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume9sg` ,2 FROM `mitglieder`,grade 
WHERE `datume9sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart'
AND `gradName` LIKE '9. S%' AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume10sg` ,1 FROM `mitglieder`,grade  
WHERE `datume10sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '10. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume10sg` ,2 FROM `mitglieder`,grade  
WHERE `datume10sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '10. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume11sg` ,1 FROM `mitglieder`,grade  
WHERE `datume11sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '11. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume11sg` ,2 FROM `mitglieder`,grade  
WHERE `datume11sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '11. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume12sg` ,1 FROM `mitglieder` ,grade 
WHERE `datume12sg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '12. S%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume12sg` ,2 FROM `mitglieder`,grade  
WHERE `datume12sg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '12. S%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume11tg` ,1 FROM `mitglieder`,grade  
WHERE `datume11tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '1. T%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume11tg` ,2 FROM `mitglieder`,grade  
WHERE `datume11tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '1. T%' 
AND `DispName` = 'Esckrima';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume12tg` ,1 FROM `mitglieder` ,grade 
WHERE `datume12tg` not in ( '' , '0000-00-00') AND `Schulort` = 'Stuttgart' AND `gradName` LIKE '2. T%' 
AND `DispName` = 'Esckrima';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datume12tg` ,2 FROM `mitglieder` ,grade 
WHERE `datume12tg` not in ( '' , '0000-00-00') AND `Schulort` <> 'Stuttgart' AND `gradName` LIKE '2. T%' 
AND `DispName` = 'Esckrima';
/*
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId``gradName` LIKE '3. T%' 
AND `DispName` = 'Esckrima'), `datume3tg` ,1 FROM `mitglieder` 
WHERE `datume3tg` > '' AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId``gradName` LIKE '3. T%' 
AND `DispName` = 'Esckrima'), `datume3tg` ,2 FROM `mitglieder` 
WHERE `datume3tg` > '' AND `Schulort` <> 'Stuttgart';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId``gradName` LIKE '4. T%' 
AND `DispName` = 'Esckrima'), `datume4tg` ,1 FROM `mitglieder` 
WHERE `datume4tg` > '' AND `Schulort` = 'Stuttgart';
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId``gradName` LIKE '4. T%' 
AND `DispName` = 'Esckrima'), `datume4tg` ,2 FROM `mitglieder` 
WHERE `datume4tg` > '' AND `Schulort` <> 'Stuttgart';
*/

/* ---- Ausbilder */
INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datumWtAusbilder1` ,1 FROM `mitglieder`,grade  
WHERE `datumWtAusbilder1` not in ( '' , '0000-00-00') AND `gradName` LIKE 'Ausbilder 1%' 
AND `DispName` = 'Wing Tzun';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datumWtAusbilder2` ,1 FROM `mitglieder`,grade  
WHERE `datumWtAusbilder2` not in ( '' , '0000-00-00') AND `gradName` LIKE 'Ausbilder 2%' 
AND `DispName` = 'Wing Tzun';

INSERT INTO `mitgliedergrade_neu`(`MitgliedId`, `GradId`, `Datum`, `PrueferId`) 
SELECT `MitgliederId`,`gradId`, `datumWtAusbilder3` ,1 FROM `mitglieder`,grade  
WHERE `datumWtAusbilder3` not in ( '' , '0000-00-00') AND `gradName` LIKE 'Ausbilder 3%' 
AND `DispName` = 'Wing Tzun';

INSERT mitgliedergrade (MitgliedId,GradId,Datum,PrueferId)
SELECT MitgliedId,GradId,Datum,PrueferId FROM mitgliedergrade_neu mn
where not exists (select 1 from mitgliedergrade where MitgliedId = mn.MitgliedId
and GradId = mn.GradId) and GradId <> 17;

-- ALTER TABLE `mitglieder` 
CHANGE COLUMN `ProbetrainingAm` `ProbetrainingAm` DATETIME NULL DEFAULT NULL COMMENT '' ;

ALTER TABLE `wt-data`.`mitgliederschulen` 
ADD COLUMN `WtoEmail` INT(1) NULL DEFAULT '0' COMMENT '' AFTER `Bemerkung`,
ADD COLUMN `Wto-Freis` INT(1) NULL DEFAULT '0' COMMENT '' AFTER `WtoEmail`;
