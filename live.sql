-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: d815108
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `assessment`
--

DROP TABLE IF EXISTS `assessment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessment` (
  `assessment_id` int(10) NOT NULL AUTO_INCREMENT,
  `assessment_name` varchar(50) NOT NULL,
  `assessment_weight` int(3) NOT NULL,
  `assessment_total` int(3) NOT NULL,
  `ail_id` int(2) NOT NULL,
  `aml_id` int(2) NOT NULL,
  `atl_id` int(2) NOT NULL,
  `course_id` int(5) NOT NULL,
  PRIMARY KEY (`assessment_id`),
  KEY `ail_id` (`ail_id`),
  KEY `aml_id` (`aml_id`),
  KEY `atl_id` (`atl_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `assessment_ibfk_1` FOREIGN KEY (`ail_id`) REFERENCES `assessment_info_lookup` (`ail_id`),
  CONSTRAINT `assessment_ibfk_2` FOREIGN KEY (`aml_id`) REFERENCES `assessment_medium_lookup` (`aml_id`),
  CONSTRAINT `assessment_ibfk_3` FOREIGN KEY (`atl_id`) REFERENCES `assessment_type_lookup` (`atl_id`),
  CONSTRAINT `assessment_ibfk_4` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessment`
--

LOCK TABLES `assessment` WRITE;
/*!40000 ALTER TABLE `assessment` DISABLE KEYS */;
/*!40000 ALTER TABLE `assessment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessment_info_lookup`
--

DROP TABLE IF EXISTS `assessment_info_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessment_info_lookup` (
  `ail_id` int(2) NOT NULL AUTO_INCREMENT,
  `ail_name` varchar(10) NOT NULL,
  PRIMARY KEY (`ail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessment_info_lookup`
--

LOCK TABLES `assessment_info_lookup` WRITE;
/*!40000 ALTER TABLE `assessment_info_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `assessment_info_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessment_medium_lookup`
--

DROP TABLE IF EXISTS `assessment_medium_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessment_medium_lookup` (
  `aml_id` int(2) NOT NULL AUTO_INCREMENT,
  `aml_name` varchar(10) NOT NULL,
  PRIMARY KEY (`aml_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessment_medium_lookup`
--

LOCK TABLES `assessment_medium_lookup` WRITE;
/*!40000 ALTER TABLE `assessment_medium_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `assessment_medium_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assessment_type_lookup`
--

DROP TABLE IF EXISTS `assessment_type_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assessment_type_lookup` (
  `atl_id` int(2) NOT NULL AUTO_INCREMENT,
  `atl_name` varchar(10) NOT NULL,
  PRIMARY KEY (`atl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assessment_type_lookup`
--

LOCK TABLES `assessment_type_lookup` WRITE;
/*!40000 ALTER TABLE `assessment_type_lookup` DISABLE KEYS */;
/*!40000 ALTER TABLE `assessment_type_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `course_id` int(5) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(8) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `school_id` int(2) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `school_id` (`school_id`),
  CONSTRAINT `course_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `faculty_id` int(1) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(5) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES (1,'Comme'),(2,'Engin'),(3,'Healt'),(4,'Human'),(5,'Scien');
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mark` (
  `mark_id` int(64) NOT NULL AUTO_INCREMENT,
  `mark_total` int(3) NOT NULL,
  `user_id` int(7) NOT NULL,
  `assessment_id` int(10) NOT NULL,
  PRIMARY KEY (`mark_id`),
  KEY `user_id` (`user_id`),
  KEY `assessment_id` (`assessment_id`),
  CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`assessment_id`) REFERENCES `assessment` (`assessment_id`),
  CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mark`
--

LOCK TABLES `mark` WRITE;
/*!40000 ALTER TABLE `mark` DISABLE KEYS */;
/*!40000 ALTER TABLE `mark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipality`
--

DROP TABLE IF EXISTS `municipality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipality` (
  `mun_id` int(2) NOT NULL DEFAULT '0',
  `mun_name` varchar(20) DEFAULT NULL,
  `latitude` varchar(55) DEFAULT NULL,
  `longitude` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`mun_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipality`
--

LOCK TABLES `municipality` WRITE;
/*!40000 ALTER TABLE `municipality` DISABLE KEYS */;
INSERT INTO `municipality` VALUES (1,'city of joburg','37.22006','-122.08409'),(2,'mangaung','2','2'),(3,'ethikwini','3','3'),(4,'city of cape town','4','4'),(5,'polokwane','5','5'),(6,'nelson mandela','6','6'),(7,'sol plaatje','7','7'),(8,'mahikeng','8','8'),(9,'mbombela','9','9');
/*!40000 ALTER TABLE `municipality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `potholes`
--

DROP TABLE IF EXISTS `potholes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `potholes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(11) DEFAULT '8',
  `longitude` varchar(11) DEFAULT '8',
  `name` varchar(50) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `users_email` varchar(50) DEFAULT NULL,
  `captions` varchar(55) DEFAULT NULL,
  `flag` tinyint(1) DEFAULT '0',
  `vote` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `users_email` (`users_email`),
  CONSTRAINT `potholes_ibfk_1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `potholes`
--

LOCK TABLES `potholes` WRITE;
/*!40000 ALTER TABLE `potholes` DISABLE KEYS */;
INSERT INTO `potholes` VALUES (1,'7','7','pothole1.jpg','/home/s815108/public_html/images/pothole.jpg','2016-05-20 06:08:50','kat@gmail.com','This is pothole is very dangerous',0,1),(2,'3','3','pothole3.jpg','/home/s815108/public_html/images/pothole3.jpg','2016-05-20 10:44:49','app@me.com','I cant get to work because of this pothole',0,1),(3,'9','9','pothole4.jpg','/home/s815108/public_html/images/pothole4.jpg','2016-05-20 06:10:35','app@gmail.com','The government needs to fix this urgently',0,1),(4,'6','6','pothole5.jpg','/home/s815108/public_html/images/pothole5.jpg','2016-05-20 08:14:04','kat@gmail.com','These are hurting my car',0,1),(5,NULL,NULL,'pothole7.jpg','/home/s815108/public_html/images/pothole7.jpg','2016-05-20 08:15:34','app@gmail.com','This one might caurse an accident',0,1),(6,'5','5','pothole9.jpg','/home/s815108/public_html/images/pothole9.jpg','2016-05-20 08:17:39','kat@gmail.com','This must be taken care of',0,1),(13,'8','8','testing123.jpg','/home/s815108/public_html/images/testing123.jpg','2016-05-20 10:28:58','app@me.com',NULL,0,1),(14,'8','8','testing123.jpg','/home/s815108/public_html/images/testing123.jpg','2016-05-20 10:39:25','app@me.com',NULL,0,1),(15,'8','8','testing123.jpg','/home/s815108/public_html/images/testing123.jpg','2016-05-20 10:48:16','Pravesh@gmail.com',NULL,0,1);
/*!40000 ALTER TABLE `potholes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school` (
  `school_id` int(2) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(50) NOT NULL,
  `faculty_id` int(1) NOT NULL,
  PRIMARY KEY (`school_id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `school_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school`
--

LOCK TABLES `school` WRITE;
/*!40000 ALTER TABLE `school` DISABLE KEYS */;
/*!40000 ALTER TABLE `school` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `subject_id` int(64) NOT NULL AUTO_INCREMENT,
  `subject_enrollmentyear` int(4) NOT NULL,
  `course_id` int(5) NOT NULL,
  `user_id` int(7) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `course_id` (`course_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `token_id` int(128) NOT NULL AUTO_INCREMENT,
  `token` varchar(128) NOT NULL,
  `user_id` int(7) NOT NULL,
  PRIMARY KEY (`token_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (1,'4d937055b2cf6dc7848773cfd122bf84ccf1ef36',1234567),(2,'e818bc25d88d2bf789bc319fadce33296071b919',1234567),(3,'818338be1f82e57b442cac0f1004ab30413fc823',1234567),(4,'92c25ff26a90cd31e574d435aa6e1e0e99f8bed0',1234567);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(7) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_surname` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_yearofstudy` int(1) DEFAULT NULL,
  `faculty_id` int(1) NOT NULL,
  `utl_id` int(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `utl_id` (`utl_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`),
  CONSTRAINT `user_ibfk_2` FOREIGN KEY (`utl_id`) REFERENCES `user_type_lookup` (`utl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1234568 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1234567,'John','Doe','$2y$10$OfortCh4CUgLIoeQ5i9CHO3JJX/OSorr26wr1SCisuXLlyBST2yJW',NULL,5,3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type_lookup`
--

DROP TABLE IF EXISTS `user_type_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_type_lookup` (
  `utl_id` int(1) NOT NULL AUTO_INCREMENT,
  `utl_name` varchar(10) NOT NULL,
  PRIMARY KEY (`utl_id`),
  UNIQUE KEY `utl_name` (`utl_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type_lookup`
--

LOCK TABLES `user_type_lookup` WRITE;
/*!40000 ALTER TABLE `user_type_lookup` DISABLE KEYS */;
INSERT INTO `user_type_lookup` VALUES (3,'developer'),(2,'lecturer'),(1,'student');
/*!40000 ALTER TABLE `user_type_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `town` varchar(10) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `f_name` varchar(10) DEFAULT NULL,
  `l_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'app@me.com','c4ca4238a0b923820dcc509a6f75849b','Jozi','NiQi','Ni','Qi'),(5,'app@gmail.com','c4ca4238a0b923820dcc509a6f75849b','Calvas','Nope','Black','Nxo'),(7,'kat@gmail.com','b146a357c57fddd450f6b5c446108672',NULL,NULL,NULL,NULL),(8,'nj@i.co','c20ad4d76fe97759aa27a0c99bff6710','','','',''),(9,'Pravesh@gmail.com','202cb962ac59075b964b07152d234b70','Wits','Pravy','Pravesh','R');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-28  8:48:15
