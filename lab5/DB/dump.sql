-- MySQL dump 10.13  Distrib 5.6.43, for Win32 (AMD64)
--
-- Host: localhost    Database: lab4
-- ------------------------------------------------------
-- Server version	5.6.43

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comments_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) DEFAULT NULL,
  `comments_comment` text NOT NULL,
  `comments_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_id` int(10) NOT NULL,
  PRIMARY KEY (`comments_id`),
  KEY `users_id` (`users_id`),
  KEY `fk_comments_news1` (`news_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE SET NULL,
  CONSTRAINT `fk_comments_news1` FOREIGN KEY (`news_id`) REFERENCES `news` (`news_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (11,3,'123','2019-11-15 03:55:04',8),(13,3,'Всем привет','2019-11-15 04:10:48',8);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `news_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_id` int(10) DEFAULT NULL,
  `news_detail_picture` text,
  `news_view_picture` text,
  `news_detail_text` text NOT NULL,
  `news_view_text` text NOT NULL,
  `news_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `news_name` char(200) NOT NULL,
  PRIMARY KEY (`news_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `news_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (8,NULL,'','','','ХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текст','2019-11-10 10:54:25',''),(10,NULL,'/lab4/uploads/news/detail/bez_nazvaniya.png','/lab4/uploads/news/view/','<h2>Привет</h2>\r\nРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст ','','2019-11-10 12:11:15','Вторая новость');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `themes_id` int(10) NOT NULL AUTO_INCREMENT,
  `themes_path` varchar(100) NOT NULL,
  `themes_name` varchar(100) NOT NULL,
  PRIMARY KEY (`themes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
INSERT INTO `themes` VALUES (1,'styles/themes/red.css','Красная'),(2,'styles/themes/dark_orange.css','Темно-оранжевая');
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `users_id` int(10) NOT NULL AUTO_INCREMENT,
  `users_login` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  `users_password` varchar(100) NOT NULL,
  `users_first_name` varchar(100) DEFAULT NULL,
  `users_last_name` varchar(100) DEFAULT NULL,
  `users_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `themes_id` int(10) NOT NULL DEFAULT '1',
  PRIMARY KEY (`users_id`),
  KEY `fk_users_themes1` (`themes_id`),
  CONSTRAINT `fk_users_themes1` FOREIGN KEY (`themes_id`) REFERENCES `themes` (`themes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Zhuravlev-AG','zhuravlev-ag@biryusa.ru','d46088c1f4648e16a40573c1a5cb6658','a','b','2019-11-15 02:58:15',2),(4,'Zhuravlev-AG','zhuravlev-ag@biryusa.ru','d46088c1f4648e16a40573c1a5cb6658','a','b','2019-11-15 04:46:28',2);
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

-- Dump completed on 2019-11-15 13:24:51
