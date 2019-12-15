-- MySQL dump 10.13  Distrib 5.6.41, for Win32 (AMD64)
--
-- Host: localhost    Database: lab5
-- ------------------------------------------------------
-- Server version	5.6.41

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
  PRIMARY KEY (`comments_id`),
  KEY `users_id` (`users_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (8,2,'','','','ХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текстХА рыбныйы текст','2019-11-10 10:54:25',''),(10,2,'/lab4/uploads/news/detail/bez_nazvaniya.png','/lab4/uploads/news/view/','<h2>Привет</h2>\r\nРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текстРыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст Рыбный текст ','','2019-11-10 12:11:15','Вторая новость'),(11,3,'/lab4/uploads/news/detail/depositphotos_96432414-stock-illustration-user-icon-support-vectors-design.jpg','/lab4/uploads/news/view/depositphotos_100074264-stock-illustration-lettering-mom-and-mom-in.jpg','yiuyi','rtyrty','2019-11-16 08:22:24','первая новость');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `PRICE` decimal(19,4) DEFAULT NULL,
  `SECTION_ID` int(11) NOT NULL,
  `ACTIVE` int(1) DEFAULT '1',
  `PICTURE` text,
  PRIMARY KEY (`ID`),
  KEY `fk_product_section1_idx` (`SECTION_ID`),
  CONSTRAINT `fk_product_section1` FOREIGN KEY (`SECTION_ID`) REFERENCES `section` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Gigabyte GeForce GTX 1660 Ti GAMING OC [GV-N166TGAMING OC-6GD]',21599.0000,3,1,'/lab5/uploads/Gigabyte GeForce GTX 1660 Ti GAMING OC [GV-N166TGAMING OC-6GD].jpg');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_property`
--

DROP TABLE IF EXISTS `product_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_property` (
  `PRODUCT_ID` int(11) NOT NULL,
  `PROPERTY_ID` int(11) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`,`PROPERTY_ID`),
  KEY `fk_product_property_product1_idx` (`PRODUCT_ID`),
  KEY `fk_product_property_property1_idx` (`PROPERTY_ID`),
  CONSTRAINT `fk_product_property_product1` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_property_property1` FOREIGN KEY (`PROPERTY_ID`) REFERENCES `property` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_property`
--

LOCK TABLES `product_property` WRITE;
/*!40000 ALTER TABLE `product_property` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property_value`
--

DROP TABLE IF EXISTS `property_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `property_value` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PROPERTY_ID` int(11) NOT NULL,
  `VALUE` text,
  PRIMARY KEY (`ID`),
  KEY `fk_property_value_property1_idx` (`PROPERTY_ID`),
  CONSTRAINT `fk_property_value_property1` FOREIGN KEY (`PROPERTY_ID`) REFERENCES `property` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_value`
--

LOCK TABLES `property_value` WRITE;
/*!40000 ALTER TABLE `property_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `property_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `PICTURE` text,
  `ACTIVE` int(1) DEFAULT '1',
  `PARENT_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `parent_section_id_idx` (`PARENT_ID`),
  CONSTRAINT `parent_section_id` FOREIGN KEY (`PARENT_ID`) REFERENCES `section` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (3,'Видеокарты',NULL,1,NULL);
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
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
  KEY `fk_users_themes1_idx1` (`themes_id`),
  CONSTRAINT `fk_users_themes1` FOREIGN KEY (`themes_id`) REFERENCES `themes` (`themes_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alexandrnya','a@mail.ru','e10adc3949ba59abbe56e057f20f883e','A','b','2019-11-05 12:06:57',1),(2,'alexandrnya','a@mail.ru','e10adc3949ba59abbe56e057f20f883e','A','b','2019-11-10 10:43:03',1),(3,'Zhuravlev-AG','alexandrnya1997@gmail.com','e10adc3949ba59abbe56e057f20f883e','A','Zhuravliov','2019-11-16 08:21:38',1);
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

-- Dump completed on 2019-12-15 18:11:38
