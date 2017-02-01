
DROP TABLE `mitglieder_neu`;
DROP TABLE `mitgliederschulen_neu`;
DROP TABLE `mitgliederdisziplinen_neu`;
DROP TABLE `mitgliederdisziplinen_neu`;

CREATE TABLE `mitglieder_neu` (
  `MitgliederId` int(4) NOT NULL DEFAULT '0',
  `MitgliedsNr` varchar(6) NOT NULL,
  `Vorname` varchar(30) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Geschlecht` varchar(9) DEFAULT NULL,
  `Anrede` varchar(11) DEFAULT NULL,
  `GeburtsDatum` DATETIME DEFAULT NULL,
  `PLZ` varchar(13) DEFAULT NULL,
  `Wohnort` varchar(50) DEFAULT NULL,
  `Strasse` varchar(50) DEFAULT NULL,
  `Telefon1` varchar(30) DEFAULT NULL,
  `Telefon2` varchar(30) DEFAULT NULL,
  `HandyNr` varchar(30) DEFAULT NULL,
  `Fax` varchar(30) DEFAULT NULL,
  `LetzteAenderung` DATETIME DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Beruf` varchar(50) DEFAULT NULL,
  `Nationalitaet` varchar(22) DEFAULT NULL,
  `BLZ` varchar(90) DEFAULT NULL,
  `Bank` varchar(45) DEFAULT NULL,
  `KontoNr` varchar(100) DEFAULT NULL,
  `Status` varchar(17) DEFAULT NULL,
  `AktivPassiv` varchar(10) DEFAULT NULL,
  `Kontoinhaber` varchar(31) DEFAULT NULL,
  `Schulort` varchar(30) DEFAULT NULL,
  `Disziplin` varchar(20) DEFAULT NULL,
  `Funktion` varchar(30) DEFAULT NULL,
  `Sifu` varchar(30) DEFAULT NULL,
  `Woher` varchar(30) DEFAULT NULL,
  `Graduierung` varchar(16) DEFAULT NULL,
  `VDauer` varchar(13) DEFAULT NULL,
  `Monatsbeitrag` varchar(10) DEFAULT NULL,
  `BeitrittDatum` DATETIME DEFAULT NULL,
  `KuendigungDatum` DATETIME DEFAULT NULL,
  `AustrittDatum` DATETIME DEFAULT NULL,
  `AustrittGrund` varchar(30) DEFAULT NULL,
  `Geburtsort` varchar(30) DEFAULT NULL,
  `GruppenArt` varchar(18) DEFAULT NULL,
  `Zahlungsart` varchar(12) DEFAULT NULL,
  `Zahlungsweise` varchar(16) DEFAULT NULL,
  `EinzugZum` varchar(15) DEFAULT NULL,
  `BeitragAussetzenVon` DATETIME DEFAULT NULL,
  `BeitragAussetzenBis` DATETIME DEFAULT NULL,
  `BeitragAussetzenGrund` varchar(37) DEFAULT NULL,
  `AufnahmegebuehrBezahlt` varchar(14) DEFAULT NULL,
  `EWTONr` varchar(10) DEFAULT NULL,
  `EWTOAustritt` varchar(10) DEFAULT NULL,
  `BeitragOffenAb` varchar(20) DEFAULT NULL,
  `BeitragOffenEuro` varchar(10) DEFAULT NULL,
  `BeitragOffenBis` varchar(20) DEFAULT NULL,
  `Mahngebuehren` varchar(9) DEFAULT NULL,
  `GesamtOffen` varchar(10) DEFAULT NULL,
  `Mahnung1Am` DATETIME DEFAULT NULL,
  `Mahnung2Am` DATETIME DEFAULT NULL,
  `Mahnung3Am` DATETIME DEFAULT NULL,
  `BarZahlungAm` DATETIME DEFAULT NULL,
  `InkassoAm` DATETIME DEFAULT NULL,
  `Zahlungsfrist` varchar(19) DEFAULT NULL,
  `Bemerkungen` varchar(294) DEFAULT NULL,
  `Betreff` varchar(30) DEFAULT NULL,
  `Text` varchar(512) DEFAULT NULL,
  `KontaktAm` DATETIME DEFAULT NULL,
  `KontaktArt` varchar(5) DEFAULT NULL,
  `Bemerkung1` varchar(250) DEFAULT NULL,
  `EinladungIAzum` DATETIME DEFAULT NULL,
  `warZumIAda` varchar(6) DEFAULT NULL,
  `zumIAnichtDa` varchar(6) DEFAULT NULL,
  `ProbetrainingAm` DATETIME DEFAULT NULL,
  `PTwarDa` varchar(6) DEFAULT NULL,
  `zumPTnichtDa` varchar(6) DEFAULT NULL,
  `VertragAbgeschlossen` varchar(10) DEFAULT NULL,
  `VertragMit` int(1) DEFAULT NULL,
  `Abschlussgespraech` varchar(10) DEFAULT NULL,
  `Bemerkung2` varchar(10) DEFAULT NULL,
  `WTPruefungZum` varchar(14) DEFAULT NULL,
  `WTPruefungAm` DATETIME DEFAULT NULL,
  `KPruefungZum` varchar(12) DEFAULT NULL,
  `KPruefungAm` DATETIME DEFAULT NULL,
  `EPruefungZum` varchar(12) DEFAULT NULL,
  `EPruefungAm` DATETIME DEFAULT NULL,
  `GutscheinVon` varchar(10) DEFAULT NULL,
  `Name2Schule` varchar(19) DEFAULT NULL,
  `DM2Schule` varchar(5) DEFAULT NULL,
  `NeuerBeitrag` varchar(10) DEFAULT NULL,
  `Vereinbarung` varchar(9) DEFAULT NULL,
  `RechnungsNr` varchar(1) DEFAULT NULL,
  `VErgaenzungAb` varchar(9) DEFAULT NULL,
  `Land` varchar(10) DEFAULT NULL,
  `AussetzenDauer` varchar(100) DEFAULT NULL,
  `Betrag` varchar(10) DEFAULT NULL,
  `BezahltAm` DATETIME DEFAULT NULL,
  `ZahlungsweiseBetrag` varchar(10) DEFAULT NULL,
  `datumwt1sg` DATETIME DEFAULT NULL,
  `datumwt2sg` DATETIME DEFAULT NULL,
  `datumwt3sg` DATETIME DEFAULT NULL,
  `datumwt4sg` DATETIME DEFAULT NULL,
  `datumwt5sg` DATETIME DEFAULT NULL,
  `datumwt6sg` DATETIME DEFAULT NULL,
  `datumwt7sg` DATETIME DEFAULT NULL,
  `datumwt8sg` DATETIME DEFAULT NULL,
  `datumwt9sg` DATETIME DEFAULT NULL,
  `datumwt10sg` DATETIME DEFAULT NULL,
  `datumwt11sg` DATETIME DEFAULT NULL,
  `datumwt12sg` DATETIME DEFAULT NULL,
  `datumwt1tg` DATETIME DEFAULT NULL,
  `datumwt2tg` DATETIME DEFAULT NULL,
  `datumwt3tg` DATETIME DEFAULT NULL,
  `datumwt4tg` DATETIME DEFAULT NULL,
  `datumwt5pg` DATETIME DEFAULT NULL,
  `AufnahmegebuehrBezahltAm` DATETIME DEFAULT NULL,
  `datumWtPraktikum` DATETIME DEFAULT NULL,
  `datumWtAusbilder1` DATETIME DEFAULT NULL,
  `datumWtAusbilder2` DATETIME DEFAULT NULL,
  `datumWtAusbilder3` DATETIME DEFAULT NULL,
  `datumWtSchulleiter` DATETIME DEFAULT NULL,
  `AufnGebuehrBetrag` varchar(9) DEFAULT NULL,
  `SFirm` int(1) DEFAULT NULL,
  `datumwt1sgk` DATETIME DEFAULT NULL,
  `datumwt2sgk` DATETIME DEFAULT NULL,
  `datumwt3sgk` DATETIME DEFAULT NULL,
  `datumwt4sgk` DATETIME DEFAULT NULL,
  `datumwt5sgk` DATETIME DEFAULT NULL,
  `datumwt6sgk` DATETIME DEFAULT NULL,
  `datumwt7sgk` DATETIME DEFAULT NULL,
  `datumwt8sgk` DATETIME DEFAULT NULL,
  `datumwt9sgk` DATETIME DEFAULT NULL,
  `datumwt10sgk` DATETIME DEFAULT NULL,
  `datumwt11sgk` DATETIME DEFAULT NULL,
  `datumwt12sgk` DATETIME DEFAULT NULL,
  `datume1sg` DATETIME DEFAULT NULL,
  `datume2sg` DATETIME DEFAULT NULL,
  `datume3sg` DATETIME DEFAULT NULL,
  `datume4sg` DATETIME DEFAULT NULL,
  `datume5sg` DATETIME DEFAULT NULL,
  `datume6sg` DATETIME DEFAULT NULL,
  `datume7sg` DATETIME DEFAULT NULL,
  `datume8sg` DATETIME DEFAULT NULL,
  `datume9sg` DATETIME DEFAULT NULL,
  `datume10sg` DATETIME DEFAULT NULL,
  `datume11sg` DATETIME DEFAULT NULL,
  `datume12sg` DATETIME DEFAULT NULL,
  `BListe` int(1) DEFAULT NULL,
  `DVDgesendetAm` DATETIME DEFAULT NULL,
  `datume11tg` DATETIME DEFAULT NULL,
  `datume12tg` DATETIME DEFAULT NULL,
  `datume21tg` DATETIME DEFAULT NULL,
  `datume22tg` DATETIME DEFAULT NULL,
  `datume31tg` DATETIME DEFAULT NULL,
  `datume32tg` DATETIME DEFAULT NULL,
  `datume41tg` DATETIME DEFAULT NULL,
  `datume42tg` DATETIME DEFAULT NULL,
  `EsckrimaGraduierung` varchar(9) DEFAULT NULL,
  `BeginnEsckrima` DATETIME DEFAULT NULL,
  `EndeEsckrima` DATETIME DEFAULT NULL,
  PRIMARY KEY (`MitgliederId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOAD DATA INFILE '../Mitglieder_08_04_15.csv'
INTO TABLE mitglieder_neu
CHARACTER SET cp1250
FIELDS TERMINATED BY ';' ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS
(MitgliederId,MitgliedsNr,Vorname,`Name`,Geschlecht,Anrede,@GeburtsDatum,PLZ,Wohnort,Strasse,Telefon1,
Telefon2,HandyNr,Fax,@LetzteAenderung,Email,Beruf,Nationalitaet,BLZ,Bank,KontoNr,`Status`,AktivPassiv,
Kontoinhaber,Schulort,Disziplin,Funktion,Sifu,Woher,Graduierung,VDauer,Monatsbeitrag,@BeitrittDatum,
@KuendigungDatum,@AustrittDatum,AustrittGrund,Geburtsort,GruppenArt,Zahlungsart,Zahlungsweise,@EinzugZum,
@BeitragAussetzenVon,@BeitragAussetzenBis,BeitragAussetzenGrund,AufnahmegebuehrBezahlt,EWTONr,EWTOAustritt,
@BeitragOffenAb,BeitragOffenEuro,@BeitragOffenBis,Mahngebuehren,GesamtOffen,@1MahnungAm,@2MahnungAm,
@3MahnungAm,@BarZahlungAm,@InkassoAm,Zahlungsfrist,Bemerkungen,Betreff,`Text`,@KontaktAm,KontaktArt,
Bemerkung1,@EinladungIAzum,warZumIAda,zumIAnichtDa,@ProbetrainingAm,PTwarDa,zumPTnichtDa,
`VertragAbgeschlossen`,VertragMit,Abschlussgespraech,Bemerkung2,WTPruefungZum,@WTPruefungAm,KPruefungZum,
@KPruefungAm,EPruefungZum,@EPruefungAm,GutscheinVon,Name2Schule,DM2Schule,NeuerBeitrag,Vereinbarung,
RechnungsNr,@VErgaenzungAb,Land,AussetzenDauer,Betrag,@BezahltAm,ZahlungsweiseBetrag,@datumwt1sg,@datumwt2sg,
@datumwt3sg,@datumwt4sg,@datumwt5sg,@datumwt6sg,@datumwt7sg,@datumwt8sg,@datumwt9sg,@datumwt10sg,@datumwt11sg,
@datumwt12sg,@datumwt1tg,@datumwt2tg,@datumwt3tg,@datumwt4tg,@datumwt5pg,@AufnahmegebuehrBezahltAm,
@datumWtPraktikum,@datumWtAusbilder1,@datumWtAusbilder2,@datumWtAusbilder3,@datumWtSchulleiter,
AufnGebuehrBetrag,SFirm,@datumwt1sgk,@datumwt2sgk,@datumwt3sgk,@datumwt4sgk,@datumwt5sgk,@datumwt6sgk,
@datumwt7sgk,@datumwt8sgk,@datumwt9sgk,@datumwt10sgk,@datumwt11sgk,@datumwt12sgk,@datume1sg,@datume2sg,
@datume3sg,@datume4sg,@datume5sg,@datume6sg,@datume7sg,@datume8sg,@datume9sg,@datume10sg,@datume11sg,
@datume12sg,BListe,@DVDgesendetAm,@datume11tg,@datume12tg,@datume21tg,@datume22tg,@datume31tg,@datume32tg,
@datume41tg,@datume42tg,EsckrimaGraduierung,@BeginnEsckrima,@EndeEsckrima)
SET GeburtsDatum = STR_TO_DATE(@GeburtsDatum, '%e.%c.%Y %H:%i:%s')
, LetzteAenderung = STR_TO_DATE(@LetzteAenderung, '%e.%c.%Y %H:%i:%s')
, BeitrittDatum = STR_TO_DATE(@BeitrittDatum, '%e.%c.%Y %H:%i:%s')
, KuendigungDatum = STR_TO_DATE(@KuendigungDatum, '%e.%c.%Y %H:%i:%s')
, AustrittDatum = STR_TO_DATE(@AustrittDatum, '%e.%c.%Y %H:%i:%s')
, BeitragAussetzenVon = STR_TO_DATE(@BeitragAussetzenVon, '%e.%c.%Y %H:%i:%s')
, BeitragAussetzenBis = STR_TO_DATE(@BeitragAussetzenBis, '%e.%c.%Y %H:%i:%s')
/*, BeitragOffenAb = STR_TO_DATE(@BeitragOffenAb, '%e.%c.%Y %H:%i:%s')
, BeitragOffenBis = STR_TO_DATE(@BeitragOffenBis, '%e.%c.%Y %H:%i:%s')
*/, Mahnung1Am = STR_TO_DATE(@Mahnung1Am, '%e.%c.%Y %H:%i:%s')
, Mahnung2Am = STR_TO_DATE(@Mahnung2Am, '%e.%c.%Y %H:%i:%s')
, Mahnung3Am = STR_TO_DATE(@Mahnung3Am, '%e.%c.%Y %H:%i:%s')
, BarZahlungAm = STR_TO_DATE(@BarZahlungAm, '%e.%c.%Y %H:%i:%s')
, InkassoAm = STR_TO_DATE(@InkassoAm, '%e.%c.%Y %H:%i:%s')
, KontaktAm = STR_TO_DATE(@KontaktAm, '%e.%c.%Y %H:%i:%s')
, EinladungIAzum = STR_TO_DATE(@EinladungIAzum, '%e.%c.%Y %H:%i:%s')
, ProbetrainingAm = STR_TO_DATE(@ProbetrainingAm, '%e.%c.%Y %H:%i:%s')
, WTPruefungAm = STR_TO_DATE(@WTPruefungAm, '%e.%c.%Y %H:%i:%s')
, KPruefungAm = STR_TO_DATE(@KPruefungAm, '%e.%c.%Y %H:%i:%s')
, EPruefungAm = STR_TO_DATE(@EPruefungAm, '%e.%c.%Y %H:%i:%s')
, BezahltAm = STR_TO_DATE(@BezahltAm, '%e.%c.%Y %H:%i:%s')
, datumwt1sg = STR_TO_DATE(@datumwt1sg, '%e.%c.%Y %H:%i:%s')
, datumwt2sg = STR_TO_DATE(@datumwt2sg, '%e.%c.%Y %H:%i:%s')
, datumwt3sg = STR_TO_DATE(@datumwt3sg, '%e.%c.%Y %H:%i:%s')
, datumwt4sg = STR_TO_DATE(@datumwt4sg, '%e.%c.%Y %H:%i:%s')
, datumwt5sg = STR_TO_DATE(@datumwt5sg, '%e.%c.%Y %H:%i:%s')
, datumwt6sg = STR_TO_DATE(@datumwt6sg, '%e.%c.%Y %H:%i:%s')
, datumwt7sg = STR_TO_DATE(@datumwt7sg, '%e.%c.%Y %H:%i:%s')
, datumwt8sg = STR_TO_DATE(@datumwt8sg, '%e.%c.%Y %H:%i:%s')
, datumwt9sg = STR_TO_DATE(@datumwt9sg, '%e.%c.%Y %H:%i:%s')
, datumwt10sg = STR_TO_DATE(@datumwt10sg, '%e.%c.%Y %H:%i:%s')
, datumwt11sg = STR_TO_DATE(@datumwt11sg, '%e.%c.%Y %H:%i:%s')
, datumwt12sg = STR_TO_DATE(@datumwt12sg, '%e.%c.%Y %H:%i:%s')
, datumwt1tg = STR_TO_DATE(@datumwt1tg, '%e.%c.%Y %H:%i:%s')
, datumwt2tg = STR_TO_DATE(@datumwt2tg, '%e.%c.%Y %H:%i:%s')
, datumwt3tg = STR_TO_DATE(@datumwt3tg, '%e.%c.%Y %H:%i:%s')
, datumwt4tg = STR_TO_DATE(@datumwt4tg, '%e.%c.%Y %H:%i:%s')
, datumwt5pg = STR_TO_DATE(@datumwt5pg, '%e.%c.%Y %H:%i:%s')
, AufnahmegebuehrBezahltAm = STR_TO_DATE(@AufnahmegebuehrBezahltAm, '%e.%c.%Y %H:%i:%s')
, datumWtPraktikum = STR_TO_DATE(@datumWtPraktikum, '%e.%c.%Y %H:%i:%s')
, datumWtAusbilder1 = STR_TO_DATE(@datumWtAusbilder1, '%e.%c.%Y %H:%i:%s')
, datumWtAusbilder2 = STR_TO_DATE(@datumWtAusbilder2, '%e.%c.%Y %H:%i:%s')
, datumWtAusbilder3 = STR_TO_DATE(@datumWtAusbilder3, '%e.%c.%Y %H:%i:%s')
, datumWtSchulleiter = STR_TO_DATE(@datumWtSchulleiter, '%e.%c.%Y %H:%i:%s')
, datumwt1sgk = STR_TO_DATE(@datumwt1sgk, '%e.%c.%Y %H:%i:%s')
, datumwt2sgk = STR_TO_DATE(@datumwt2sgk, '%e.%c.%Y %H:%i:%s')
, datumwt3sgk = STR_TO_DATE(@datumwt3sgk, '%e.%c.%Y %H:%i:%s')
, datumwt4sgk = STR_TO_DATE(@datumwt4sgk, '%e.%c.%Y %H:%i:%s')
, datumwt5sgk = STR_TO_DATE(@datumwt5sgk, '%e.%c.%Y %H:%i:%s')
, datumwt6sgk = STR_TO_DATE(@datumwt6sgk, '%e.%c.%Y %H:%i:%s')
, datumwt7sgk = STR_TO_DATE(@datumwt7sgk, '%e.%c.%Y %H:%i:%s')
, datumwt8sgk = STR_TO_DATE(@datumwt8sgk, '%e.%c.%Y %H:%i:%s')
, datumwt9sgk = STR_TO_DATE(@datumwt9sgk, '%e.%c.%Y %H:%i:%s')
, datumwt10sgk = STR_TO_DATE(@datumwt10sgk, '%e.%c.%Y %H:%i:%s')
, datumwt11sgk = STR_TO_DATE(@datumwt11sgk, '%e.%c.%Y %H:%i:%s')
, datumwt12sgk = STR_TO_DATE(@datumwt12sgk, '%e.%c.%Y %H:%i:%s')
, datume1sg = STR_TO_DATE(@datume1sg, '%e.%c.%Y %H:%i:%s')
, datume2sg = STR_TO_DATE(@datume2sg, '%e.%c.%Y %H:%i:%s')
, datume3sg = STR_TO_DATE(@datume3sg, '%e.%c.%Y %H:%i:%s')
, datume4sg = STR_TO_DATE(@datume4sg, '%e.%c.%Y %H:%i:%s')
, datume5sg = STR_TO_DATE(@datume5sg, '%e.%c.%Y %H:%i:%s')
, datume6sg = STR_TO_DATE(@datume6sg, '%e.%c.%Y %H:%i:%s')
, datume7sg = STR_TO_DATE(@datume7sg, '%e.%c.%Y %H:%i:%s')
, datume8sg = STR_TO_DATE(@datume8sg, '%e.%c.%Y %H:%i:%s')
, datume9sg = STR_TO_DATE(@datume9sg, '%e.%c.%Y %H:%i:%s')
, datume10sg = STR_TO_DATE(@datume10sg, '%e.%c.%Y %H:%i:%s')
, datume11sg = STR_TO_DATE(@datume11sg, '%e.%c.%Y %H:%i:%s')
, datume12sg = STR_TO_DATE(@datume12sg, '%e.%c.%Y %H:%i:%s')
, DVDgesendetAm = STR_TO_DATE(@DVDgesendetAm, '%e.%c.%Y %H:%i:%s')
, datume11tg = STR_TO_DATE(@datume11tg, '%e.%c.%Y %H:%i:%s')
, datume12tg = STR_TO_DATE(@datume12tg, '%e.%c.%Y %H:%i:%s')
, datume21tg = STR_TO_DATE(@datume21tg, '%e.%c.%Y %H:%i:%s')
, datume22tg = STR_TO_DATE(@datume22tg, '%e.%c.%Y %H:%i:%s')
, datume31tg = STR_TO_DATE(@datume31tg, '%e.%c.%Y %H:%i:%s')
, datume32tg = STR_TO_DATE(@datume32tg, '%e.%c.%Y %H:%i:%s')
, datume41tg = STR_TO_DATE(@datume41tg, '%e.%c.%Y %H:%i:%s')
, datume42tg = STR_TO_DATE(@datume42tg, '%e.%c.%Y %H:%i:%s')
, BeginnEsckrima = STR_TO_DATE(@BeginnEsckrima, '%e.%c.%Y %H:%i:%s')
, EndeEsckrima = STR_TO_DATE(@EndeEsckrima, '%e.%c.%Y %H:%i:%s');

