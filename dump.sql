-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: music_store
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `beats`
--

DROP TABLE IF EXISTS `beats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beats` (
  `beatID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `category` varchar(32) NOT NULL,
  `exclusive` bit(1) NOT NULL DEFAULT b'0',
  `deleted` bit(1) NOT NULL DEFAULT b'0',
  `fileName` varchar(128) NOT NULL,
  `orderNum` int(11) NOT NULL,
  PRIMARY KEY (`beatID`),
  KEY `orderNum` (`orderNum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beats`
--

LOCK TABLES `beats` WRITE;
/*!40000 ALTER TABLE `beats` DISABLE KEYS */;
/*!40000 ALTER TABLE `beats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `beatsAnalytics`
--

DROP TABLE IF EXISTS `beatsAnalytics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `beatsAnalytics` (
  `beatAnalyticID` int(11) NOT NULL AUTO_INCREMENT,
  `browser` varchar(128) DEFAULT NULL,
  `browserVersion` float(5,3) DEFAULT NULL,
  `os` varchar(32) DEFAULT NULL,
  `ipv4` int(10) unsigned DEFAULT NULL,
  `ipv6` binary(16) DEFAULT NULL,
  `hostname` text,
  `beatID` int(11) NOT NULL,
  `frequency` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`beatAnalyticID`),
  KEY `ipv4` (`ipv4`),
  KEY `ipv6` (`ipv6`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `beatsAnalytics`
--

LOCK TABLES `beatsAnalytics` WRITE;
/*!40000 ALTER TABLE `beatsAnalytics` DISABLE KEYS */;
/*!40000 ALTER TABLE `beatsAnalytics` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-01-14 15:17:38
