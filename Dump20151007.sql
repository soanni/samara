-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: samara_news
-- ------------------------------------------------------
-- Server version	5.6.24

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
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `article_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `article` longtext NOT NULL,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reporter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `index_img` (`image_id`),
  CONSTRAINT `image_id_img` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (2,1,'MSF demands Kunduz war crimes probe','Aid agency MSF has urged states to invoke a never-used international body to investigate the US bombing of its hospital in the Afghan city of Kunduz.\r\nMSF said it did not trust internal military inquiries by the US into the bombing that killed at least 22 people.\r\nThe International Humanitarian Fact-Finding Commission was established in 1991 under the Geneva Conventions that regulate issues of war.\r\nThe US has said the bombing last Saturday was a mistake.\r\nOn Tuesday, Gen John Campbell , US commander of international forces in Afghanistan, said the attack had been requested by Afghan forces who were in communication with American special operations troops at the scene.\r\nThose US forces in turn were in contact with the AC-130 gunship that fired on the hospital, he said.\r\n\"We would never intentionally target a protected medical facility,\" Gen Campbell told the Senate Armed Services Committee in Washington.\r\nA number of inquiries have been ordered - by the US Department of Justice, the Pentagon, Nato and an American-Afghan team.\r\nBut MSF chief Joanne Liu told reporters in Geneva: \"We cannot rely on internal military investigation by the US, Nato and Afghan forces.\"\r\nShe clarified that International Humanitarian Fact-Finding Commission (IHFFC) was \"the only permanent body set up specifically to investigate violations on an international humanitarian law\".\r\n\"We ask signatory states to activate the Commission to establish the truth and to reassert the protected status of hospitals in conflicts,\" she added.','2015-10-07 06:48:48','2015-10-07 06:48:48',12),(3,1,'Migrant crisis: EU to begin seizing smugglers\' boats','The EU is beginning a new operation in the southern Mediterranean to intercept boats smuggling migrants.\r\nUnder Operation Sophia, naval vessels will be able to board, search, seize and divert vessels suspected of being used for human smuggling.\r\nUntil now, the EU has focused on surveillance and rescue operations.\r\nSo far this year, more than 130,000 migrants and refugees have crossed to Europe from the north African coast. More than 2,700 have drowned.\r\nHowever, many more migrants and refugees - mainly Syrians fleeing the country\'s civil war - are taking a different route, crossing overland into Turkey, before a short journey by sea to European Union member Greece and onwards to central and northern European countries, with Germany the preferred destination.\r\nThe migrant crisis is expected to be one of the issues raised when German Chancellor Angela Merkel and French President Francois Hollande make a rare joint address to the European Parliament in Strasbourg on Wednesday.\r\nThe only previous such address was in 1989 with then French President Francois Mitterrand and the German leader Helmut Kohl.','2015-10-07 06:51:57','2015-10-07 06:51:57',12),(4,1,'VW\'s Matthias Mueller: Recall to start in January','VW expects to start a recall of cars affected by its emissions scandal in January, the car giant\'s new chief executive, Matthias Mueller, has said.\r\nAll affected cars will be fixed by the end of 2016, he told German newspaper Frankfurter Allgemeine Zeitung.\r\nOnly a few employees have been involved in the scandal, he added in the interview.\r\nEurope\'s biggest carmaker has said emissions test-cheating software is present in 11 million diesel vehicles.\r\nThe firm said it would also look into its various brands and models, singling out Bugatti, its supercar marque.\r\nEarlier, Mr Mueller told employees at VW\'s Wolfsburg home plant in Germany the firm is facing changes that \"will not be painless.\"','2015-10-07 06:52:41','2015-10-07 06:52:41',12),(5,1,'Allan McNish column: Is Formula 1 losing its soul?','In the last week, there have been media reports questioning the future of the British Grand Prix and the announcement of a 21-race calendar for the 2016 season.\r\nIn combination with this weekend\'s stop on the schedule - the Russian Grand Prix - it is a reminder of the direction in which Formula 1 appears to be headed.\r\nMore of the historic European events that reflect the essence of racing are disappearing off the F1 schedule to be replaced by big state-funded projects that fail to deliver the same kind of racing and atmosphere.\r\nThat the F1 schedule is in a state of major flux is without doubt; whether that is necessarily a good thing is a different matter.','2015-10-07 06:53:28','2015-10-07 06:53:28',12);
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(25) NOT NULL,
  `caption` varchar(120) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'image.img','test_caption');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(40) NOT NULL,
  `salt` int(10) unsigned DEFAULT NULL,
  `pwd` varchar(40) DEFAULT NULL,
  `locked` int(1) DEFAULT '1',
  `email` varchar(45) NOT NULL,
  `changedate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `confirm_string` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,'soani',1444145467,'b95bb15cf41ddbaa9aeb065748fd826bcdbd795b',0,'legandr.86@gmail.com','2015-10-06 13:31:07','soani1444145232'),(12,'zvekov',NULL,NULL,1,'zvekov@mail.ru','2015-10-06 13:39:38','zvekov1444145978');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'samara_news'
--

--
-- Dumping routines for database 'samara_news'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-07 20:56:27
