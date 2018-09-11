CREATE DATABASE  IF NOT EXISTS `zavrsni_rad` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zavrsni_rad`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: zavrsni_rad
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `album` (
  `ID_ALBUMA` int(11) NOT NULL AUTO_INCREMENT,
  `NAZIV` varchar(255) NOT NULL,
  `GODINA_IZDAVANJA` varchar(4) NOT NULL,
  `OMOT` varchar(255) NOT NULL,
  `ID_TIP_ALBUMA` int(11) NOT NULL,
  `CENA` smallint(6) NOT NULL,
  PRIMARY KEY (`ID_ALBUMA`),
  KEY `fk_ALBUM_TIP_ALBUMA1_idx` (`ID_TIP_ALBUMA`),
  CONSTRAINT `fk_ALBUM_TIP_ALBUMA1` FOREIGN KEY (`ID_TIP_ALBUMA`) REFERENCES `tip_albuma` (`ID_TIP_ALBUMA`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (5,'The Upcoming Devastation','2014','the_upcoming_devastation.jpg',3,3),(6,'See the Scars','2015','see_the_scars.jpg',1,7);
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik` (
  `ID_KORISNIK` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(55) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `POSLEDNJE_LOGOVANJE` datetime DEFAULT NULL,
  `ID_ROLA` int(11) NOT NULL,
  `ID_STATUS` int(11) NOT NULL,
  PRIMARY KEY (`ID_KORISNIK`),
  KEY `fk_KORISNIK_KORISNIK_ROLA_idx` (`ID_ROLA`),
  KEY `fk_KORISNIK_KORISNIK_STATUS1_idx` (`ID_STATUS`),
  CONSTRAINT `fk_KORISNIK_KORISNIK_ROLA` FOREIGN KEY (`ID_ROLA`) REFERENCES `korisnik_rola` (`ID_ROLA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_KORISNIK_KORISNIK_STATUS1` FOREIGN KEY (`ID_STATUS`) REFERENCES `korisnik_status` (`ID_STATUS`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (1,'korisnik1','$2y$10$6BFyn7Rwxavg8NrpmqbU3en.gEYCl06kQwTr3m0ZX/VsIX/ay1xE2','korisnik1@korisnik1.com','2018-09-11 02:40:19',2,1),(2,'admin','$2y$10$UF.YRaD6TxDkY0x3daq19uQd9cXUd2yR9fg8t5.LwYSuHBH0ZwVHC','admin@admin.com','2018-09-11 03:23:01',1,1),(3,'korisnik2','$2y$10$p2dctbjknF/liXj/Jtgba.CLiNaNg7n3cTRVD7Ub19hA.5BaDowIu','korisnik2@korisnik2.com','2018-09-10 10:17:43',2,1),(4,'korisnik3','$2y$10$0nVsG27qHxmArqjBlgvqTu6OlxqO9DHKTa64vvIo8bWfkpoFVn.Vi','korisnik3@korisnik3.com','2018-09-11 02:30:15',2,1);
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik_album`
--

DROP TABLE IF EXISTS `korisnik_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik_album` (
  `ID_KORISNIK` int(11) NOT NULL,
  `ID_ALBUMA` int(11) NOT NULL,
  KEY `fk_KORISNIK_PROIZVOD_KORISNIK1_idx` (`ID_KORISNIK`),
  KEY `fk_KORISNIK_ALBUM_ALBUM1_idx` (`ID_ALBUMA`),
  CONSTRAINT `fk_KORISNIK_ALBUM_ALBUM1` FOREIGN KEY (`ID_ALBUMA`) REFERENCES `album` (`ID_ALBUMA`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_KORISNIK_PROIZVOD_KORISNIK1` FOREIGN KEY (`ID_KORISNIK`) REFERENCES `korisnik` (`ID_KORISNIK`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik_album`
--

LOCK TABLES `korisnik_album` WRITE;
/*!40000 ALTER TABLE `korisnik_album` DISABLE KEYS */;
/*!40000 ALTER TABLE `korisnik_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik_rola`
--

DROP TABLE IF EXISTS `korisnik_rola`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik_rola` (
  `ID_ROLA` int(11) NOT NULL AUTO_INCREMENT,
  `NAZIV` varchar(55) NOT NULL,
  `OPIS` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_ROLA`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik_rola`
--

LOCK TABLES `korisnik_rola` WRITE;
/*!40000 ALTER TABLE `korisnik_rola` DISABLE KEYS */;
INSERT INTO `korisnik_rola` VALUES (1,'Administrator','Administrator ima prava da dodaje albume i pregleda albume odnosno da menja sadrzaj web aplikacije'),(2,'Korisnik','Korisnik ima prava da pregleda albume i da kupi albume');
/*!40000 ALTER TABLE `korisnik_rola` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik_status`
--

DROP TABLE IF EXISTS `korisnik_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `korisnik_status` (
  `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT,
  `NAZIV` varchar(55) NOT NULL,
  `OPIS` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik_status`
--

LOCK TABLES `korisnik_status` WRITE;
/*!40000 ALTER TABLE `korisnik_status` DISABLE KEYS */;
INSERT INTO `korisnik_status` VALUES (1,'Aktivan','Korisnik je kreiran i aktivan'),(2,'Blokiran','Korisnik je blokiran');
/*!40000 ALTER TABLE `korisnik_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tip_albuma`
--

DROP TABLE IF EXISTS `tip_albuma`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tip_albuma` (
  `ID_TIP_ALBUMA` int(11) NOT NULL AUTO_INCREMENT,
  `NAZIV` varchar(55) NOT NULL,
  `OPIS` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_TIP_ALBUMA`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tip_albuma`
--

LOCK TABLES `tip_albuma` WRITE;
/*!40000 ALTER TABLE `tip_albuma` DISABLE KEYS */;
INSERT INTO `tip_albuma` VALUES (1,'Full-album','An Album usually consists of 10-12 songs focusing on one style and usually a theme that the artist decides before hand. To call it an album most people say that it has to be over 25 minutes long.'),(2,'EP','An EP is an extended play, which is more contains more songs than a single, but less songs than an full-album.EP is defined as a four or more track release with the tracks being of equal importance to one another'),(3,'Demo','Demos are usually what bands or singer songwriters create themselves using whatever tools they have available.Demos are usually 3-4 songs and consist of a mix of covers and originals.'),(4,'Single','Singles usually refer to one song that an artist is releasing. It is usually a part of the album and is released before the album is to gain exposure and a extend the fan base. '),(5,'Split','A split album (or split) is a music album which includes tracks by two or more separate artists.Split albums differ from \"various artists\" compilation albums in that they generally include several tracks of each artist'),(6,'Compilation','A compilation album comprises tracks, either previously released or unreleased, usually from several separate recordings by either one or several performers or multiple artists with only one or two tracks each.');
/*!40000 ALTER TABLE `tip_albuma` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'zavrsni_rad'
--

--
-- Dumping routines for database 'zavrsni_rad'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-11  4:28:08
