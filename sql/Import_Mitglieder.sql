use `wt-data`;
alter TABLE mitglieder
CHANGE LetzteAenderung LetzteAenderung DATETIME NULL DEFAULT NULL,
CHANGE BeitrittDatum BeitrittDatum DATE NULL DEFAULT NULL,
CHANGE KuendigungDatum KuendigungDatum DATE NULL DEFAULT NULL,
CHANGE AustrittDatum AustrittDatum DATETIME NULL DEFAULT NULL,
CHANGE BeitragAussetzenVon BeitragAussetzenVon DATE NULL DEFAULT NULL,
CHANGE BeitragAussetzenBis BeitragAussetzenBis DATE NULL DEFAULT NULL,
CHANGE Mahnung1Am Mahnung1Am DATE NULL DEFAULT NULL,
CHANGE Mahnung2Am Mahnung2Am DATE NULL DEFAULT NULL,
CHANGE Mahnung3Am Mahnung3Am DATE NULL DEFAULT NULL,
CHANGE BarZahlungAm BarZahlungAm DATE NULL DEFAULT NULL,
CHANGE InkassoAm InkassoAm DATE NULL DEFAULT NULL,
CHANGE KontaktAm KontaktAm DATE NULL DEFAULT NULL,
CHANGE EinladungIAzum EinladungIAzum DATE NULL DEFAULT NULL,
CHANGE ProbetrainingAm ProbetrainingAm DATE NULL DEFAULT NULL,
CHANGE WTPruefungAm WTPruefungAm DATE NULL DEFAULT NULL,
CHANGE KPruefungAm KPruefungAm DATE NULL DEFAULT NULL,
CHANGE EPruefungAm EPruefungAm DATE NULL DEFAULT NULL,
CHANGE datumwt1sg datumwt1sg DATE NULL DEFAULT NULL,
CHANGE datumwt2sg datumwt2sg DATE NULL DEFAULT NULL,
CHANGE datumwt3sg datumwt3sg DATE NULL DEFAULT NULL,
CHANGE datumwt4sg datumwt4sg DATE NULL DEFAULT NULL,
CHANGE datumwt5sg datumwt5sg DATE NULL DEFAULT NULL,
CHANGE datumwt6sg datumwt6sg DATE NULL DEFAULT NULL,
CHANGE datumwt7sg datumwt7sg DATE NULL DEFAULT NULL,
CHANGE datumwt8sg datumwt8sg DATE NULL DEFAULT NULL,
CHANGE datumwt9sg datumwt9sg DATE NULL DEFAULT NULL,
CHANGE datumwt10sg datumwt10sg DATE NULL DEFAULT NULL,
CHANGE datumwt11sg datumwt11sg DATE NULL DEFAULT NULL,
CHANGE datumwt12sg datumwt12sg DATE NULL DEFAULT NULL,
CHANGE datumwt1tg datumwt1tg DATE NULL DEFAULT NULL,
CHANGE datumwt2tg datumwt2tg DATE NULL DEFAULT NULL,
CHANGE datumwt3tg datumwt3tg DATE NULL DEFAULT NULL,
CHANGE datumwt4tg datumwt4tg DATE NULL DEFAULT NULL,
CHANGE datumwt5pg datumwt5pg DATE NULL DEFAULT NULL,
CHANGE AufnahmegebuehrBezahltAm AufnahmegebuehrBezahltAm DATE NULL DEFAULT NULL,
CHANGE datumWtPraktikum datumWtPraktikum DATE NULL DEFAULT NULL,
CHANGE datumWtAusbilder1 datumWtAusbilder1 DATE NULL DEFAULT NULL,
CHANGE datumWtAusbilder2 datumWtAusbilder2 DATE NULL DEFAULT NULL,
CHANGE datumWtAusbilder3 datumWtAusbilder3 DATE NULL DEFAULT NULL,
CHANGE datumWtSchulleiter datumWtSchulleiter DATE NULL DEFAULT NULL,
CHANGE datumwt1sgk datumwt1sgk DATE NULL DEFAULT NULL,
CHANGE datumwt2sgk datumwt2sgk DATE NULL DEFAULT NULL,
CHANGE datumwt3sgk datumwt3sgk DATE NULL DEFAULT NULL,
CHANGE datumwt4sgk datumwt4sgk DATE NULL DEFAULT NULL,
CHANGE datumwt5sgk datumwt5sgk DATE NULL DEFAULT NULL,
CHANGE datumwt6sgk datumwt6sgk DATE NULL DEFAULT NULL,
CHANGE datumwt7sgk datumwt7sgk DATE NULL DEFAULT NULL,
CHANGE datumwt8sgk datumwt8sgk DATE NULL DEFAULT NULL,
CHANGE datumwt9sgk datumwt9sgk DATE NULL DEFAULT NULL,
CHANGE datumwt10sgk datumwt10sgk DATE NULL DEFAULT NULL,
CHANGE datumwt11sgk datumwt11sgk DATE NULL DEFAULT NULL,
CHANGE datumwt12sgk datumwt12sgk DATE NULL DEFAULT NULL,
CHANGE datume1sg datume1sg DATE NULL DEFAULT NULL,
CHANGE datume2sg datume2sg DATE NULL DEFAULT NULL,
CHANGE datume3sg datume3sg DATE NULL DEFAULT NULL,
CHANGE datume4sg datume4sg DATE NULL DEFAULT NULL,
CHANGE datume5sg datume5sg DATE NULL DEFAULT NULL,
CHANGE datume6sg datume6sg DATE NULL DEFAULT NULL,
CHANGE datume7sg datume7sg DATE NULL DEFAULT NULL,
CHANGE datume8sg datume8sg DATE NULL DEFAULT NULL,
CHANGE datume9sg datume9sg DATE NULL DEFAULT NULL,
CHANGE datume10sg datume10sg DATE NULL DEFAULT NULL,
CHANGE datume11sg datume11sg DATE NULL DEFAULT NULL,
CHANGE datume12sg datume12sg DATE NULL DEFAULT NULL,
CHANGE DVDgesendetAm DVDgesendetAm DATE NULL DEFAULT NULL,
CHANGE datume11tg datume11tg DATE NULL DEFAULT NULL,
CHANGE datume12tg datume12tg DATE NULL DEFAULT NULL,
CHANGE datume21tg datume21tg DATE NULL DEFAULT NULL,
CHANGE datume22tg datume22tg DATE NULL DEFAULT NULL,
CHANGE datume31tg datume31tg DATE NULL DEFAULT NULL,
CHANGE datume32tg datume32tg DATE NULL DEFAULT NULL,
CHANGE datume41tg datume41tg DATE NULL DEFAULT NULL,
CHANGE datume42tg datume42tg DATE NULL DEFAULT NULL,
CHANGE BeginnEsckrima BeginnEsckrima DATE NULL DEFAULT NULL,
CHANGE Text Text varchar(512) NULL DEFAULT NULL,
CHANGE EndeEsckrima EndeEsckrima DATE NULL DEFAULT NULL
;


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


insert mitglieder 
(`MitgliederId`,
`MitgliedsNr`,
`Vorname`,
`Name`,
`Geschlecht`,
`Anrede`,
`GeburtsDatum`,
`PLZ`,
`Wohnort`,
`Strasse`,
`Telefon1`,
`Telefon2`,
`HandyNr`,
`Fax`,
`LetzteAenderung`,
`Email`,
`Beruf`,
`Nationalitaet`,
`BLZ`,
`Bank`,
`IBAN`,
`KontoNr`,
`Status`,
`AktivPassiv`,
`Kontoinhaber`,
`Schulort`,
`Disziplin`,
`Funktion`,
`Sifu`,
`Woher`,
`Graduierung`,
`VDauer`,
`Monatsbeitrag`,
`BeitrittDatum`,
`KuendigungDatum`,
`AustrittDatum`,
`Geburtsort`,
`GruppenArt`,
`Zahlungsart`,
`Zahlungsweise`,
`EinzugZum`,
`BeitragAussetzenVon`,
`BeitragAussetzenBis`,
`BeitragAussetzenGrund`,
`AufnahmegebuehrBezahlt`,
`EWTONr`,
`EWTOAustritt`,
`BeitragOffenAb`,
`BeitragOffenEuro`,
`BeitragOffenBis`,
`Mahngebuehren`,
`GesamtOffen`,
`Mahnung1Am`,
`Mahnung2Am`,
`Mahnung3Am`,
`BarZahlungAm`,
`InkassoAm`,
`Zahlungsfrist`,
`Bemerkungen`,
`Betreff`,
`Text`,
`KontaktAm`,
`KontaktArt`,
`Bemerkung1`,
`EinladungIAzum`,
`WarZumIAda`,
`zumIAnichtDa`,
`ProbetrainingAm`,
`PTwarDa`,
`zumPTnichtDa`,
`VertragAbgeschlossen`,
`VertragMit`,
`Abschlussgespraech`,
`Bemerkung2`,
`WTPruefungZum`,
`WTPruefungAm`,
`KPruefungZum`,
`KPruefungAm`,
`EPruefungZum`,
`EPruefungAm`,
`GutscheinVon`,
`Name2Schule`,
`DM2Schule`,
`NeuerBeitrag`,
`Vereinbarung`,
`RechnungsNr`,
`VErgaenzungAb`,
`Land`,
`AussetzenDauer`,
`Betrag`,
`BezahltAm`,
`ZahlungsweiseBetrag`,
`datumwt1sg`,
`datumwt2sg`,
`datumwt3sg`,
`datumwt4sg`,
`datumwt5sg`,
`datumwt6sg`,
`datumwt7sg`,
`datumwt8sg`,
`datumwt9sg`,
`datumwt10sg`,
`datumwt11sg`,
`datumwt12sg`,
`datumwt1tg`,
`datumwt2tg`,
`datumwt3tg`,
`datumwt4tg`,
`datumwt5pg`,
`AufnahmegebuehrBezahltAm`,
`datumWtPraktikum`,
`datumWtAusbilder1`,
`datumWtAusbilder2`,
`datumWtAusbilder3`,
`datumWtSchulleiter`,
`AufnGebuehrBetrag`,
`SFirm`,
`datumwt1sgk`,
`datumwt2sgk`,
`datumwt3sgk`,
`datumwt4sgk`,
`datumwt5sgk`,
`datumwt6sgk`,
`datumwt7sgk`,
`datumwt8sgk`,
`datumwt9sgk`,
`datumwt10sgk`,
`datumwt11sgk`,
`datumwt12sgk`,
`datume1sg`,
`datume2sg`,
`datume3sg`,
`datume4sg`,
`datume5sg`,
`datume6sg`,
`datume7sg`,
`datume8sg`,
`datume9sg`,
`datume10sg`,
`datume11sg`,
`datume12sg`,
`BListe`,
`DVDgesendetAm`,
`datume11tg`,
`datume12tg`,
`datume21tg`,
`datume22tg`,
`datume31tg`,
`datume32tg`,
`datume41tg`,
`datume42tg`,
`EsckrimaGraduierung`,
`BeginnEsckrima`,
`EndeEsckrima`)
select * from mitglieder_neu as n where not EXISTS
(select 1 from mitglieder where MitgliederId = n.MitgliederId);

UPDATE `wt-data`.`mitglieder` as m, mitglieder_neu as n
SET m.`MitgliedsNr` = CASE n.MitgliedsNr WHEN '' THEN 0 ELSE n.MitgliedsNr END,
m.`Vorname` = n.Vorname,
m.`Name` = n.Name,
m.`Geschlecht` = n.Geschlecht,
m.`Anrede` = n.Anrede,
m.`GeburtsDatum` = CASE n.GeburtsDatum WHEN '0000-00-00 00:00:00' THEN null ELSE n.GeburtsDatum END,
m.`PLZ` = n.PLZ,
m.`Wohnort` = n.Wohnort,
m.`Strasse` = n.Strasse,
m.`Telefon1` = n.Telefon1,
m.`Telefon2` = n.Telefon2,
m.`HandyNr` = n.HandyNr,
m.`Fax` = n.Fax,
m.`LetzteAenderung` = CASE n.LetzteAenderung WHEN '0000-00-00 00:00:00' THEN null ELSE n.LetzteAenderung END,
m.`Email` = n.Email,
m.`Beruf` = n.Beruf,
m.`Nationalitaet` = n.Nationalitaet,
m.`BLZ` = n.BLZ,
m.`Bank` = n.Bank,
/*m.`IBAN` = n.IBAN,*/
m.`KontoNr` = n.KontoNr,
m.`Status` = n.Status,
m.`AktivPassiv` = n.AktivPassiv,
m.`Kontoinhaber` = n.Kontoinhaber,
m.`Schulort` = n.Schulort,
m.`Disziplin` = n.Disziplin,
m.`Funktion` = n.Funktion,
m.`Sifu` = n.Sifu,
m.`Woher` = n.Woher,
m.`Graduierung` = n.Graduierung,
m.`VDauer` = n.VDauer,
m.`Monatsbeitrag` = CASE n.Monatsbeitrag WHEN '0000-00-00 00:00:00' THEN null ELSE n.Monatsbeitrag END,
m.`BeitrittDatum` = CASE n.BeitrittDatum WHEN '0000-00-00 00:00:00' THEN null ELSE n.BeitrittDatum END,
m.`KuendigungDatum` = CASE n.KuendigungDatum WHEN '0000-00-00 00:00:00' THEN null ELSE n.KuendigungDatum END,
m.`AustrittDatum` = CASE n.AustrittDatum WHEN '0000-00-00 00:00:00' THEN null ELSE n.AustrittDatum END,
m.`Geburtsort` = n.Geburtsort,
m.`GruppenArt` = n.GruppenArt,
m.`Zahlungsart` = n.Zahlungsart,
m.`Zahlungsweise` = n.Zahlungsweise,
m.`EinzugZum` = n.EinzugZum,
m.`BeitragAussetzenVon` = CASE n.BeitragAussetzenVon WHEN '0000-00-00 00:00:00' THEN null ELSE n.BeitragAussetzenVon END,
m.`BeitragAussetzenBis` = CASE n.BeitragAussetzenBis WHEN '0000-00-00 00:00:00' THEN null ELSE n.BeitragAussetzenBis END,
m.`BeitragAussetzenGrund` = n.BeitragAussetzenGrund,
m.`AufnahmegebuehrBezahlt` = n.AufnahmegebuehrBezahlt,
m.`EWTONr` = n.EWTONr,
m.`EWTOAustritt` = n.EWTOAustritt,
m.`BeitragOffenAb` = CASE n.BeitragOffenAb WHEN '0000-00-00 00:00:00' THEN null ELSE n.BeitragOffenAb END,
m.`BeitragOffenEuro` = n.BeitragOffenEuro,
m.`BeitragOffenBis` = CASE n.BeitragOffenBis WHEN '0000-00-00 00:00:00' THEN null ELSE n.BeitragOffenBis END,
m.`Mahngebuehren` = n.Mahngebuehren,
m.`GesamtOffen` = n.GesamtOffen,
m.`Mahnung1Am` = CASE n.Mahnung1Am WHEN '0000-00-00 00:00:00' THEN null ELSE n.Mahnung1Am END,
m.`Mahnung2Am` = CASE n.Mahnung2Am WHEN '0000-00-00 00:00:00' THEN null ELSE n.Mahnung2Am END,
m.`Mahnung3Am` = CASE n.Mahnung3Am WHEN '0000-00-00 00:00:00' THEN null ELSE n.Mahnung3Am END,
m.`BarZahlungAm` = CASE n.BarZahlungAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.BarZahlungAm END,
m.`InkassoAm` = n.InkassoAm,
m.`Zahlungsfrist` = n.Zahlungsfrist,
m.`Bemerkungen` = n.Bemerkungen,
m.`Betreff` = n.Betreff,
m.`Text` = n.Text,
m.`KontaktAm` = CASE n.KontaktAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.KontaktAm END,
m.`KontaktArt` = n.KontaktArt,
m.`Bemerkung1` = n.Bemerkung1,
m.`EinladungIAzum` = CASE n.EinladungIAzum WHEN '0000-00-00 00:00:00' THEN null ELSE n.EinladungIAzum END,
m.`WarZumIAda` = CASE n.WarZumIAda WHEN 'WAHR' THEN 1 ELSE 0 END,
m.`zumIAnichtDa` = n.zumIAnichtDa,
m.`ProbetrainingAm` = CASE n.ProbetrainingAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.ProbetrainingAm END,
m.`PTwarDa` = CASE n.PTwarDa WHEN 'WAHR' THEN 1 ELSE 0 END,
m.`zumPTnichtDa` = n.zumPTnichtDa,
m.`VertragAbgeschlossen` = CASE n.VertragAbgeschlossen WHEN 'WAHR' THEN 1 ELSE 0 END,
m.`VertragMit` = n.VertragMit,
m.`Abschlussgespraech` = n.Abschlussgespraech,
m.`Bemerkung2` = n.Bemerkung2,
m.`WTPruefungZum` = n.WTPruefungZum,
m.`WTPruefungAm` = CASE n.WTPruefungAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.WTPruefungAm END,
m.`KPruefungZum` = n.KPruefungZum,
m.`KPruefungAm` = CASE n.KPruefungAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.KPruefungAm END,
m.`EPruefungZum` = n.EPruefungZum,
m.`EPruefungAm` = CASE n.EPruefungAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.EPruefungAm END,
m.`GutscheinVon` = n.GutscheinVon,
m.`Name2Schule` = n.Name2Schule,
m.`DM2Schule` = n.DM2Schule,
m.`NeuerBeitrag` = n.NeuerBeitrag,
m.`Vereinbarung` = n.Vereinbarung,
m.`RechnungsNr` = n.RechnungsNr,
m.`VErgaenzungAb` = CASE n.VErgaenzungAb WHEN '0000-00-00 00:00:00' THEN null ELSE n.VErgaenzungAb END,
m.`Land` = n.Land,
m.`AussetzenDauer` = n.AussetzenDauer,
m.`Betrag` = n.Betrag,
m.`BezahltAm` = CASE n.BezahltAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.BezahltAm END,
m.`ZahlungsweiseBetrag` = n.ZahlungsweiseBetrag,
m.`datumwt1sg` = CASE n.datumwt1sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt1sg END,
m.`datumwt2sg` = CASE n.datumwt2sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt2sg END,
m.`datumwt3sg` = CASE n.datumwt3sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt3sg END,
m.`datumwt4sg` = CASE n.datumwt4sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt4sg END,
m.`datumwt5sg` = CASE n.datumwt5sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt5sg END,
m.`datumwt6sg` = CASE n.datumwt6sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt6sg END,
m.`datumwt7sg` = CASE n.datumwt7sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt7sg END,
m.`datumwt8sg` = CASE n.datumwt8sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt8sg END,
m.`datumwt9sg` = CASE n.datumwt9sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt9sg END,
m.`datumwt10sg` = CASE n.datumwt10sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt10sg END,
m.`datumwt11sg` = CASE n.datumwt11sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt11sg END,
m.`datumwt12sg` = CASE n.datumwt12sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt12sg END,
m.`datumwt1tg` = CASE n.datumwt1tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt1tg END,
m.`datumwt2tg` = CASE n.datumwt2tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt2tg END,
m.`datumwt3tg` = CASE n.datumwt3tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt3tg END,
m.`datumwt4tg` = CASE n.datumwt4tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt4tg END,
m.`datumwt5pg` = CASE n.datumwt5pg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt5pg END,
m.`AufnahmegebuehrBezahltAm` = CASE n.AufnahmegebuehrBezahltAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.AufnahmegebuehrBezahltAm END,
m.`datumWtPraktikum` = CASE n.datumWtPraktikum WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumWtPraktikum END,
m.`datumWtAusbilder1` = CASE n.datumWtAusbilder1 WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumWtAusbilder1 END,
m.`datumWtAusbilder2` = CASE n.datumWtAusbilder2 WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumWtAusbilder2 END,
m.`datumWtAusbilder3` = CASE n.datumWtAusbilder3 WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumWtAusbilder3 END,
m.`datumWtSchulleiter` = CASE n.datumWtSchulleiter WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumWtSchulleiter END,
m.`AufnGebuehrBetrag` = n.AufnGebuehrBetrag,
m.`SFirm` = n.SFirm,
m.`datumwt1sgk` = CASE n.datumwt1sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt1sgk END,
m.`datumwt2sgk` = CASE n.datumwt2sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt2sgk END,
m.`datumwt3sgk` = CASE n.datumwt3sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt3sgk END,
m.`datumwt4sgk` = CASE n.datumwt4sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt4sgk END,
m.`datumwt5sgk` = CASE n.datumwt5sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt5sgk END,
m.`datumwt6sgk` = CASE n.datumwt6sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt6sgk END,
m.`datumwt7sgk` = CASE n.datumwt7sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt7sgk END,
m.`datumwt8sgk` = CASE n.datumwt8sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt8sgk END,
m.`datumwt9sgk` = CASE n.datumwt9sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt9sgk END,
m.`datumwt10sgk` = CASE n.datumwt10sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt10sgk END,
m.`datumwt11sgk` = CASE n.datumwt11sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt11sgk END,
m.`datumwt12sgk` = CASE n.datumwt12sgk WHEN '0000-00-00 00:00:00' THEN null ELSE n.datumwt12sgk END,
m.`datume1sg` = CASE n.datume1sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume1sg END,
m.`datume2sg` = CASE n.datume2sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume2sg END,
m.`datume3sg` = CASE n.datume3sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume3sg END,
m.`datume4sg` = CASE n.datume4sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume4sg END,
m.`datume5sg` = CASE n.datume5sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume5sg END,
m.`datume6sg` = CASE n.datume6sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume6sg END,
m.`datume7sg` = CASE n.datume7sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume7sg END,
m.`datume8sg` = CASE n.datume8sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume8sg END,
m.`datume9sg` = CASE n.datume9sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume9sg END,
m.`datume10sg` = CASE n.datume10sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume10sg END,
m.`datume11sg` = CASE n.datume11sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume11sg END,
m.`datume12sg` = CASE n.datume12sg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume12sg END,
m.`BListe` = n.BListe,
m.`DVDgesendetAm` = CASE n.DVDgesendetAm WHEN '0000-00-00 00:00:00' THEN null ELSE n.DVDgesendetAm END,
m.`datume11tg` = CASE n.datume11tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume11tg END,
m.`datume12tg` = CASE n.datume12tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume12tg END,
m.`datume21tg` = CASE n.datume21tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume21tg END,
m.`datume22tg` = CASE n.datume22tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume22tg END,
m.`datume31tg` = CASE n.datume31tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume31tg END,
m.`datume32tg` = CASE n.datume32tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume32tg END,
m.`datume41tg` = CASE n.datume41tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume41tg END,
m.`datume42tg` = CASE n.datume42tg WHEN '0000-00-00 00:00:00' THEN null ELSE n.datume42tg END,
m.`EsckrimaGraduierung` = n.EsckrimaGraduierung,
m.`BeginnEsckrima` = n.BeginnEsckrima,
m.`EndeEsckrima` = n.EndeEsckrima
/*`PruefungZum` = n.PruefungZum,
`GD` = n.GD,
`BIC` = n.BIC,
`mig_int` = n.mig_int*/

WHERE m.`MitgliederId` = n.`MitgliederId` 
;


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

/* Disziplinen */
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


/* Schulverträge   */
INSERT INTO `mitgliederschulen`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
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

INSERT INTO `mitgliederschulen`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
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

INSERT INTO `mitgliederschulen`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate,MonatsBeitrag,
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



/* esckrima */
INSERT INTO `mitgliederschulen`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate, MonatsBeitrag, ZahlungsArt, Zahlungsweise, BeitragAussetzenVon, BeitragAussetzenBis, BeitragAussetzenGrund, KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, 12, m.Monatsbeitrag, m.Zahlungsart, m.Zahlungsweise, m.BeitragAussetzenVon, m.BeitragAussetzenBis, m.BeitragAussetzenGrund,m.KuendigungDatum 
FROM `mitglieder` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 2 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where /*m.GruppenArt = 'Kinder-Gruppe'
AND*/ m.Disziplin LIKE 'Esckrima' 
AND NOT EXISTS ( SELECT 1 FROM `mitgliederschulen` WHERE m.`MitgliederId`= `MitgliederId` 
AND `SchulId` =  s.`SchulId` AND s.Disziplin = 5);
;

INSERT INTO `mitgliederschulen_neu`(`MitgliederId`, `SchulId`, Von, Bis, VDauerMonate, MonatsBeitrag, ZahlungsArt, Zahlungsweise, BeitragAussetzenVon, BeitragAussetzenBis, BeitragAussetzenGrund, KuendigungAm) 
SELECT m.`MitgliederId`, s.`SchulId`, m.BeitrittDatum, m.AustrittDatum, 12, m.DM2Schule, m.Zahlungsart, m.Zahlungsweise, m.BeitragAussetzenVon, m.BeitragAussetzenBis, m.BeitragAussetzenGrund,m.KuendigungDatum 
FROM `mitglieder_neu` m INNER JOIN `schulen` s 
ON s.`SchulName` = m.`Schulort` AND s.Disziplin = 2 
INNER JOIN disziplinen d ON s.Disziplin = d.DispId   
where /*m.GruppenArt = 'Kinder-Gruppe'
AND*/ m.Disziplin LIKE '%Tz%E%' ;



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