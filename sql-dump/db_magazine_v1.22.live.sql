CREATE DATABASE  IF NOT EXISTS `db_magazine_v1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_magazine_v1`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: localhost    Database: db_magazine_v1
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Table structure for table `booking_sales_table`
--

DROP TABLE IF EXISTS `booking_sales_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `booking_sales_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_num` varchar(30) DEFAULT NULL,
  `sales_rep_code` int(45) DEFAULT NULL,
  `client_id` int(45) DEFAULT NULL,
  `agency_id` int(45) DEFAULT NULL,
  `group_id` int(45) DEFAULT NULL,
  `status` tinyint(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_sales_table`
--

LOCK TABLES `booking_sales_table` WRITE;
/*!40000 ALTER TABLE `booking_sales_table` DISABLE KEYS */;
INSERT INTO `booking_sales_table` VALUES (152,'1701KO8567',1,134,0,NULL,1,'2017-01-13 03:31:25','2017-01-13 03:31:25'),(153,'1701WA0047',1,130,57,NULL,1,'2017-01-13 03:53:32','2017-01-13 03:53:32'),(154,'1701BD5565',1,130,57,NULL,1,'2017-01-13 04:42:45','2017-01-13 04:42:45'),(155,'1701EX3986',1,132,0,NULL,1,'2017-01-13 04:46:35','2017-01-13 04:46:35'),(156,'1701ZV0653',1,129,55,NULL,1,'2017-01-17 03:10:04','2017-01-17 03:10:04'),(157,'1701JP1961',1,129,55,NULL,1,'2017-01-17 03:12:03','2017-01-17 03:12:03'),(158,'1701FG1471',1,129,55,NULL,1,'2017-01-17 03:17:40','2017-01-17 03:17:40'),(159,'1701MK2635',1,134,0,NULL,1,'2017-01-17 03:18:11','2017-01-17 03:18:11'),(160,'1701XK9035',1,134,0,NULL,1,'2017-01-18 22:47:52','2017-01-18 22:47:52'),(161,'1701PE2631',1,129,0,NULL,1,'2017-01-20 23:38:12','2017-01-20 23:38:12'),(162,'1701HS0351',2,135,67,NULL,3,'2017-01-21 07:59:26','2017-01-21 07:59:26'),(163,'1701IP6648',2,135,67,NULL,1,'2017-01-21 08:22:10','2017-01-21 08:22:10'),(164,'1701IP6648',2,135,67,NULL,1,'2017-01-21 08:22:48','2017-01-21 08:22:48'),(165,'1701AS8576',1,129,55,NULL,1,'2017-01-21 08:24:01','2017-01-21 08:24:01'),(166,'1701AS8576',1,129,55,NULL,1,'2017-01-21 08:24:24','2017-01-21 08:24:24'),(167,'1701NQ6629',1,129,55,NULL,1,'2017-01-21 08:30:00','2017-01-21 08:30:00'),(168,'1701IP6648',2,129,55,NULL,1,'2017-01-21 08:39:03','2017-01-21 08:39:03'),(169,'1701IP6648',2,129,55,NULL,1,'2017-01-21 08:39:36','2017-01-21 08:39:36'),(170,'1701PO9391',2,129,55,NULL,1,'2017-01-21 08:39:48','2017-01-21 08:39:48');
/*!40000 ALTER TABLE `booking_sales_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_contacts_table`
--

DROP TABLE IF EXISTS `client_contacts_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_contacts_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address_1` varchar(50) DEFAULT NULL,
  `address_2` varchar(50) DEFAULT NULL,
  `address_3` varchar(50) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `landline` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `type_designation` varchar(45) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `synched` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_contacts_table`
--

LOCK TABLES `client_contacts_table` WRITE;
/*!40000 ALTER TABLE `client_contacts_table` DISABLE KEYS */;
INSERT INTO `client_contacts_table` VALUES (54,129,'0001','Gayl',NULL,'Punzalan','1688 Logan Ave.',NULL,NULL,'Winnipeg','MB','R3E 1S6','gpunzalan@lesterpublications.com','204-954-8165','204-218-4295','Digital Media Manager',NULL,1,4,2,1,'2017-01-13 03:19:00','2017-01-03 15:48:13'),(55,129,'Company Bill To','Nikki ',NULL,'Manalo','701 Henry Avenue',NULL,NULL,'Winnipeg','MB','R3E 1S6','nmanalo@lestertech.ca','204-954-8165','204-218-4295','Office Manager',NULL,2,3,2,1,'2017-01-05 03:39:41','2017-01-03 15:50:16'),(56,129,'0002','John',NULL,'Doe','701 Henry Avenue',NULL,NULL,'Winnipeg','MB','R3E 1S6','info@lesterpublications.com','204-954-8165','204-218-4295','Marketing Manager',NULL,1,2,2,1,'2017-01-03 15:56:45','2017-01-03 15:56:25'),(57,130,'','Gayl',NULL,'Punzalan','1688 Logan Ave.',NULL,NULL,'Winnipeg','MB','R3E 1S6','info@lesterpublications.com','204-954-8165','204-218-4295','Marketing Manager',NULL,1,3,2,1,'2017-01-03 18:04:35','2017-01-03 18:04:01'),(58,129,'other sample','von',NULL,'sample','sample address',NULL,NULL,'sample gapo','sef','asfsd','dsfasdf','sdafas','sdf','sdfasdf',NULL,1,4,2,1,'2017-01-05 03:32:20','2017-01-05 03:32:20'),(59,131,'0001','John ',NULL,'Smith','5565 Salter Avenue',NULL,NULL,'Anaheim','CA','32465456645','samdoe@jdfields.com','1-204-954-8165','1-204-954-8165','General Manager',NULL,1,4,2,1,'2017-01-13 03:19:00','2017-01-09 09:26:10'),(60,131,'','Jane ',NULL,'Smith','1001 Berkeley',NULL,NULL,'Anaheim','CA','T6B 0B5','janedoe@jdfields.com','1-204-954-8165','780-469-2268','Marketing Manager',NULL,2,3,2,1,'2017-01-09 09:28:41','2017-01-09 09:28:41'),(61,131,'0002','safdsdfsdf',NULL,'sadfsdf','sdfsdf',NULL,NULL,'sdfsdf','CA','sdfsdf','dcostigan@psychometrics.com','780-469-2268','780-469-2268','Digital Media',NULL,1,2,2,1,'2017-01-09 09:37:54','2017-01-09 09:37:54'),(62,133,'The Red Agency','Angel',NULL,'Ainge','oiujlskjdf ljsdflkj ',NULL,NULL,'Toronto','ON','sdfsdf','angel@blueinkmedia.ca','9080808098098','8900808','Client Services',NULL,2,3,2,1,'2017-01-12 07:02:28','2017-01-12 07:02:28'),(63,134,'Test','Shane',NULL,'Holland','California, United States',NULL,NULL,'NOne','MB','223','asd','sdaf','sdf','sadf',NULL,1,5,2,1,'2017-01-13 03:19:00','2017-01-13 03:19:00'),(64,129,'0001','John',NULL,'Holland','None',NULL,NULL,'None','NB','None','johnh@yahoo.com','None','None','None',NULL,3,1,2,1,'2017-01-16 21:43:45','2017-01-16 21:43:45'),(65,135,'0001','Juan',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','BC','sdfsdf','sdfsdf','sdfsdf','sdfsdfsdf','sdfsdfsdf',NULL,1,1,2,1,'2017-01-21 07:35:34','2017-01-21 07:35:34'),(66,135,'0002','Pedro',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','MB','sdfsdf','sdfsd','sdfsd','sdfsdf','sdfsdf',NULL,1,2,2,1,'2017-01-21 07:36:02','2017-01-21 07:36:02'),(67,135,'Agency 1','Maria',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','AB','sdfsdf','sdfsdf','sdfsdf','sdf','sdfsdfsdf',NULL,2,3,2,1,'2017-01-21 07:36:35','2017-01-21 07:36:35'),(68,135,'Bill To','Diego',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','NB','sfsdf','sdfsdf','sdf','sdfsfd','lkjslfjljksdf',NULL,2,4,2,1,'2017-01-21 07:44:47','2017-01-21 07:44:00'),(69,132,'0001','sfdsf',NULL,'sdf','sd',NULL,NULL,'s','BC','3','sdf','3','3','ssdf',NULL,1,1,2,1,'2017-01-21 07:50:04','2017-01-21 07:50:04'),(70,132,'sdf','sdfdsf',NULL,'s','sd',NULL,NULL,'s','BC','3','sdf','3','ds3','3sdf',NULL,2,3,2,1,'2017-01-21 07:50:42','2017-01-21 07:50:42'),(71,135,'Bill To','Mario',NULL,'lksdjfljks','sdfdsf',NULL,NULL,'sdfsdf','NL','sdfsdf','sdf','dsf','sdf','sdf',NULL,2,4,2,1,'2017-01-21 07:53:20','2017-01-21 07:53:20');
/*!40000 ALTER TABLE `client_contacts_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_reference_table`
--

DROP TABLE IF EXISTS `client_reference_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_reference_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_reference_table`
--

LOCK TABLES `client_reference_table` WRITE;
/*!40000 ALTER TABLE `client_reference_table` DISABLE KEYS */;
INSERT INTO `client_reference_table` VALUES (1,'Advertiser',2),(2,'Agency',2),(3,'Lead',2),(4,'Artwork',2);
/*!40000 ALTER TABLE `client_reference_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_table`
--

DROP TABLE IF EXISTS `client_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip_code` varchar(45) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `is_member` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_table`
--

LOCK TABLES `client_table` WRITE;
/*!40000 ALTER TABLE `client_table` DISABLE KEYS */;
INSERT INTO `client_table` VALUES (129,'Boeing','1001 Berkeley Ave.','San Francisco','CA','10210',NULL,1,1,2,'2017-01-03 15:46:50','2017-01-03 15:46:50'),(130,'JD Fields','1005 Andrew Ave.','Atlanta','GA','10201',NULL,1,1,2,'2017-01-03 18:01:17','2017-01-03 18:01:17'),(131,'Meloche Monnex','1688 Logan Avenue','Beverly Hills','CA','10210',NULL,1,1,2,'2017-01-09 09:21:40','2017-01-09 09:21:40'),(132,'sample type','sd','sdfg','BC','sdfg',NULL,-1,1,2,'2017-01-11 00:33:04','2017-01-11 00:33:04'),(133,'Psychometrics','888 River Driver','Toronto','ON','98779797',NULL,1,1,2,'2017-01-12 06:59:53','2017-01-12 06:59:53'),(134,'Bizarre Foods Compant','Greece','NONE','NS','22019',NULL,-1,1,2,'2017-01-13 03:15:56','2017-01-13 03:15:56'),(135,'Best Doctors','sdfsdfsdf','sdfsdf','AB','sdfsdfsdf',NULL,1,1,2,'2017-01-21 07:31:13','2017-01-21 07:31:13');
/*!40000 ALTER TABLE `client_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contract_table`
--

DROP TABLE IF EXISTS `contract_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contract_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_num` varchar(30) DEFAULT NULL,
  `sales_rep_code` int(45) DEFAULT NULL,
  `client_id` int(45) DEFAULT NULL,
  `agency_id` int(45) DEFAULT NULL,
  `status` tinyint(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract_table`
--

LOCK TABLES `contract_table` WRITE;
/*!40000 ALTER TABLE `contract_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `contract_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discount_transaction_table`
--

DROP TABLE IF EXISTS `discount_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discount_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_id` varchar(45) DEFAULT NULL,
  `sales_rep_id` varchar(45) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `discount_percent` decimal(18,3) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount_transaction_table`
--

LOCK TABLES `discount_transaction_table` WRITE;
/*!40000 ALTER TABLE `discount_transaction_table` DISABLE KEYS */;
INSERT INTO `discount_transaction_table` VALUES (18,'1701KO8567','1',2000.00,0.005,'Nothing','2','2017-01-13 03:32:30','2017-01-13 03:32:30');
/*!40000 ALTER TABLE `discount_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_list_table`
--

DROP TABLE IF EXISTS `group_list_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_list_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) DEFAULT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `role_id` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_list_table`
--

LOCK TABLES `group_list_table` WRITE;
/*!40000 ALTER TABLE `group_list_table` DISABLE KEYS */;
INSERT INTO `group_list_table` VALUES (1,1,54,129,1,2,NULL,NULL),(2,1,55,129,2,2,NULL,NULL),(8,7,62,133,2,2,'2017-01-19 03:41:11','2017-01-19 03:41:11'),(9,1,58,129,3,2,'2017-01-19 03:52:21','2017-01-19 03:52:21'),(10,8,63,134,1,2,'2017-01-19 23:38:39','2017-01-19 23:38:39'),(11,9,63,134,1,2,'2017-01-20 00:56:29','2017-01-20 00:56:29'),(12,10,63,134,2,2,'2017-01-20 00:56:47','2017-01-20 00:56:47'),(13,11,63,134,1,2,'2017-01-20 01:14:14','2017-01-20 01:14:14'),(14,12,63,134,2,2,'2017-01-20 01:14:44','2017-01-20 01:14:44'),(15,2,64,129,1,2,'2017-01-20 23:25:38','2017-01-20 23:25:38'),(16,2,58,129,2,2,'2017-01-20 23:25:41','2017-01-20 23:25:41'),(17,2,55,129,3,2,'2017-01-20 23:25:46','2017-01-20 23:25:46'),(18,4,58,129,1,2,'2017-01-20 23:28:02','2017-01-20 23:28:02'),(19,4,54,129,2,2,'2017-01-20 23:28:06','2017-01-20 23:28:06'),(20,4,64,129,3,2,'2017-01-20 23:28:13','2017-01-20 23:28:13'),(21,13,68,135,3,2,'2017-01-21 07:46:47','2017-01-21 07:46:47'),(22,14,71,135,3,2,'2017-01-21 07:54:35','2017-01-21 07:54:35'),(23,15,67,135,3,2,'2017-01-21 07:58:45','2017-01-21 07:58:45');
/*!40000 ALTER TABLE `group_list_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_table`
--

DROP TABLE IF EXISTS `group_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `client_uid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_table`
--

LOCK TABLES `group_table` WRITE;
/*!40000 ALTER TABLE `group_table` DISABLE KEYS */;
INSERT INTO `group_table` VALUES (1,'Group A',1,129,NULL,NULL),(2,'Group B',2,129,NULL,NULL),(3,'Group C',3,129,'2017-01-19 00:55:15','2017-01-19 00:55:15'),(4,'Group D',1,129,'2017-01-19 00:55:27','2017-01-19 00:55:27'),(5,'Group E',2,129,'2017-01-19 00:56:53','2017-01-19 00:56:53'),(6,'Sample Group',2,130,'2017-01-19 03:04:26','2017-01-19 03:04:26'),(7,'Group One',2,133,'2017-01-19 03:12:59','2017-01-19 03:12:59'),(8,'PAOPAO',1,134,'2017-01-19 23:38:32','2017-01-19 23:38:32'),(9,'KPA',2,134,'2017-01-19 23:39:12','2017-01-19 23:39:12'),(10,'MJT',3,134,'2017-01-19 23:41:41','2017-01-19 23:41:41'),(11,'xpao',2,134,'2017-01-20 00:47:38','2017-01-20 00:47:38'),(12,'ypao',1,134,'2017-01-20 01:14:37','2017-01-20 01:14:37'),(13,'Group A',2,135,'2017-01-21 07:46:27','2017-01-21 07:46:27'),(14,'Group B',2,135,'2017-01-21 07:54:21','2017-01-21 07:54:21'),(15,'Group Default',1,135,'2017-01-21 07:58:34','2017-01-21 07:58:34');
/*!40000 ALTER TABLE `group_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_table`
--

DROP TABLE IF EXISTS `invoice_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_num` varchar(50) DEFAULT NULL,
  `booking_trans` varchar(50) DEFAULT NULL,
  `issue` tinyint(4) DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `account_executive` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_table`
--

LOCK TABLES `invoice_table` WRITE;
/*!40000 ALTER TABLE `invoice_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_company_table`
--

DROP TABLE IF EXISTS `magazine_company_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_company_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_uid` varchar(60) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `address_1` varchar(100) DEFAULT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `state` varchar(60) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `fax` varchar(15) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_company_table`
--

LOCK TABLES `magazine_company_table` WRITE;
/*!40000 ALTER TABLE `magazine_company_table` DISABLE KEYS */;
INSERT INTO `magazine_company_table` VALUES (11,'201701030155586BC3AFCC83E','Lyceum','NA','NA','Olongapo','Zambales','1','NA','099','099',2,'2017-01-03 15:31:36','2017-01-03 15:31:36'),(12,'201701030141586BC635711B0','Lester Communications','701 Henry Avenue','735','Winnipeg','MB','2','info@lesterpublications.com','1-204-954-8165','',2,'2017-01-16 19:09:38','2017-01-03 15:43:25'),(13,'201701030118586BE27A7A751','Lester Publications','140 Broadway ','44th Floor','New York','NY','1','gpunzalan@lesterpublications.com','1-204-954-8165','',2,'2017-01-03 17:45:01','2017-01-03 17:45:01'),(14,'20170109015858739C4A353FC','Lester Communications','701 Henry Avenue','','Winniepg','Manitoba','2','info@lesterpublications.com','1-204-954-8165','',2,'2017-01-09 06:42:08','2017-01-09 06:42:08');
/*!40000 ALTER TABLE `magazine_company_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_issue_transaction_table`
--

DROP TABLE IF EXISTS `magazine_issue_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_issue_transaction_table` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `magazine_trans_id` int(11) DEFAULT NULL,
  `ad_criteria_id` int(11) DEFAULT NULL,
  `ad_package_id` int(11) DEFAULT NULL,
  `quarter_issued` tinyint(4) DEFAULT NULL,
  `line_item_qty` tinyint(4) DEFAULT NULL,
  `mag_price_id` int(11) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_issue_transaction_table`
--

LOCK TABLES `magazine_issue_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_issue_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_issue_transaction_table` VALUES (140,160,3,3,1,1,38,1000.00,2,'2017-01-13 03:31:39','2017-01-13 03:31:39'),(141,160,3,3,2,1,38,1000.00,2,'2017-01-13 03:31:49','2017-01-13 03:31:49'),(142,161,1,2,3,1,35,3000.00,2,'2017-01-13 03:53:42','2017-01-13 03:53:42'),(143,161,1,2,2,2,35,3000.00,2,'2017-01-13 04:38:59','2017-01-13 04:38:59'),(144,161,1,2,4,1,35,3000.00,2,'2017-01-13 04:40:56','2017-01-13 04:40:56'),(145,161,1,2,1,1,35,3000.00,2,'2017-01-13 04:42:44','2017-01-13 04:42:44'),(146,163,1,2,2,1,37,3000.00,2,'2017-01-13 04:48:47','2017-01-13 04:48:47'),(148,160,3,3,3,4,38,1000.00,2,'2017-01-17 03:42:00','2017-01-17 03:42:00'),(149,168,1,5,1,1,36,1500.00,2,'2017-01-21 08:03:39','2017-01-21 08:03:39');
/*!40000 ALTER TABLE `magazine_issue_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_table`
--

DROP TABLE IF EXISTS `magazine_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `logo_uid` varchar(60) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `mag_code` varchar(30) DEFAULT NULL,
  `magazine_name` varchar(100) DEFAULT NULL,
  `magazine_year` int(11) DEFAULT NULL,
  `magazine_issues` tinyint(4) DEFAULT NULL,
  `magazine_country` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_table`
--

LOCK TABLES `magazine_table` WRITE;
/*!40000 ALTER TABLE `magazine_table` DISABLE KEYS */;
INSERT INTO `magazine_table` VALUES (41,'201612271259586204C77A9BC',6,'paopao-magazine','Paopao Magazine',2018,2,1,1,'2017-01-02 04:27:25','2016-12-21 09:03:47'),(42,'201701030141586BC3DD4C062',11,'college-magazine','COLLEGE MAGAZINE',2017,4,1,2,'2017-01-03 15:32:20','2017-01-03 15:32:20'),(43,'201701030125586BC69DF2E4B',12,'think','Think Big',2017,4,2,2,'2017-01-03 15:44:54','2017-01-03 15:44:54'),(44,'201701030101586BE31DB172E',13,'pile-driver','Pile Driver',2017,6,1,2,'2017-01-03 17:47:07','2017-01-03 17:47:07'),(45,'2017010901495873A295870A9',12,'piling-canada','Piling Canada',2017,4,2,2,'2017-01-09 06:53:45','2017-01-09 06:53:45'),(46,'2017011301355878B65F99CDB',13,'march-magazine','March Magazine',2017,2,1,2,'2017-01-13 03:14:03','2017-01-13 03:14:03');
/*!40000 ALTER TABLE `magazine_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_transaction_table`
--

DROP TABLE IF EXISTS `magazine_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_transaction_table`
--

LOCK TABLES `magazine_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_transaction_table` VALUES (160,46,152,'2017-01-13 03:31:30','2017-01-13 03:31:30'),(161,44,153,'2017-01-13 03:53:34','2017-01-13 03:53:34'),(162,44,154,'2017-01-13 04:42:49','2017-01-13 04:42:49'),(163,45,155,'2017-01-13 04:46:49','2017-01-13 04:46:49'),(164,43,156,'2017-01-17 03:10:06','2017-01-17 03:10:06'),(165,44,157,'2017-01-17 03:12:06','2017-01-17 03:12:06'),(166,42,158,'2017-01-17 03:17:44','2017-01-17 03:17:44'),(167,44,160,'2017-01-18 22:47:55','2017-01-18 22:47:55'),(168,44,162,'2017-01-21 07:59:33','2017-01-21 07:59:33');
/*!40000 ALTER TABLE `magazine_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magzine_discount_table`
--

DROP TABLE IF EXISTS `magzine_discount_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magzine_discount_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `mag_price_id` int(11) DEFAULT NULL,
  `percent` decimal(18,3) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_discount_table`
--

LOCK TABLES `magzine_discount_table` WRITE;
/*!40000 ALTER TABLE `magzine_discount_table` DISABLE KEYS */;
INSERT INTO `magzine_discount_table` VALUES (106,33,0.050,2,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(107,33,0.100,3,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(108,33,0.150,4,2,'2017-01-03 15:34:16','2017-01-03 15:34:16'),(109,33,0.000,5,2,'2017-01-03 15:34:16','2017-01-03 15:34:16'),(110,34,0.050,2,2,'2017-01-03 15:45:24','2017-01-03 15:45:24'),(111,34,0.100,3,2,'2017-01-03 15:45:24','2017-01-03 15:45:24'),(112,34,0.150,4,2,'2017-01-03 15:45:25','2017-01-03 15:45:25'),(113,34,0.000,5,2,'2017-01-03 15:45:25','2017-01-03 15:45:25'),(114,35,0.050,2,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(115,35,0.100,3,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(116,35,0.150,4,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(117,35,0.000,5,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(118,36,0.050,2,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(119,36,0.100,3,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(120,36,0.150,4,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(121,36,0.000,5,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(122,37,0.050,2,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(123,37,0.100,3,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(124,37,0.150,4,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(125,37,0.000,5,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(126,38,0.020,2,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(127,38,0.030,3,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(128,38,0.040,4,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(129,38,0.000,5,2,'2017-01-13 03:14:22','2017-01-13 03:14:22');
/*!40000 ALTER TABLE `magzine_discount_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magzine_price_table`
--

DROP TABLE IF EXISTS `magzine_price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magzine_price_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `mag_id` int(11) DEFAULT NULL,
  `ad_color` varchar(60) DEFAULT NULL,
  `ad_size` varchar(60) DEFAULT NULL,
  `ad_amount` decimal(18,2) DEFAULT NULL,
  `ad_status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_price_table`
--

LOCK TABLES `magzine_price_table` WRITE;
/*!40000 ALTER TABLE `magzine_price_table` DISABLE KEYS */;
INSERT INTO `magzine_price_table` VALUES (33,42,'1','4',3500.00,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(34,43,'1','2',3000.00,2,'2017-01-03 15:45:24','2017-01-03 15:45:24'),(35,44,'1','2',3000.00,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(36,44,'1','5',1500.00,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(37,45,'1','2',3000.00,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(38,46,'3','3',1000.00,2,'2017-01-13 03:14:22','2017-01-13 03:14:22');
/*!40000 ALTER TABLE `magzine_price_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications_table`
--

DROP TABLE IF EXISTS `notifications_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `role` tinyint(4) DEFAULT NULL,
  `from_user_uid` int(11) DEFAULT NULL,
  `to_user_uid` int(11) DEFAULT NULL,
  `noti_subject` varchar(50) DEFAULT NULL,
  `noti_desc` varchar(100) DEFAULT NULL,
  `noti_url` varchar(200) DEFAULT NULL,
  `noti_tagged_id` int(11) DEFAULT NULL,
  `noti_flag` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications_table`
--

LOCK TABLES `notifications_table` WRITE;
/*!40000 ALTER TABLE `notifications_table` DISABLE KEYS */;
INSERT INTO `notifications_table` VALUES (31,1,1,-1,NULL,'gives 5% discretionary discount.','/booking/add_issue/160/134',NULL,2,'2017-01-13 03:32:30','2017-01-13 03:32:30'),(32,1,1,1,NULL,'OK','/booking/add_issue/160/134',NULL,1,'2017-01-13 03:32:50','2017-01-13 03:32:50');
/*!40000 ALTER TABLE `notifications_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_transaction_table`
--

DROP TABLE IF EXISTS `payment_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_num` varchar(50) DEFAULT NULL,
  `line_item_id` int(11) DEFAULT NULL,
  `reference_number` varchar(20) DEFAULT NULL,
  `method_payment` tinyint(4) DEFAULT NULL,
  `date_payment` datetime DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `remarks` varchar(300) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_transaction_table`
--

LOCK TABLES `payment_transaction_table` WRITE;
/*!40000 ALTER TABLE `payment_transaction_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_criteria_table`
--

DROP TABLE IF EXISTS `price_criteria_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_criteria_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_criteria_table`
--

LOCK TABLES `price_criteria_table` WRITE;
/*!40000 ALTER TABLE `price_criteria_table` DISABLE KEYS */;
INSERT INTO `price_criteria_table` VALUES (1,'4 Color',2),(2,'1 Spot Color',2),(3,'Black & White',2),(4,'Cover Positions',1);
/*!40000 ALTER TABLE `price_criteria_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_package_table`
--

DROP TABLE IF EXISTS `price_package_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_package_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_package_table`
--

LOCK TABLES `price_package_table` WRITE;
/*!40000 ALTER TABLE `price_package_table` DISABLE KEYS */;
INSERT INTO `price_package_table` VALUES (1,'Double Page Spread',2),(2,'Full Page',2),(3,'1/2 DPS',2),(4,'1/2 Page Island',2),(5,'1/2 Page',2),(6,'1/3 Page',2),(7,'1/4 Page',2),(8,'1/6 Page',2),(9,'1/8 Page',2),(10,'2/3 Page',2);
/*!40000 ALTER TABLE `price_package_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `price_table`
--

DROP TABLE IF EXISTS `price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `price_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `criteria_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `amount_x1` decimal(18,2) DEFAULT NULL,
  `amount_x2_more` decimal(18,2) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_table`
--

LOCK TABLES `price_table` WRITE;
/*!40000 ALTER TABLE `price_table` DISABLE KEYS */;
INSERT INTO `price_table` VALUES (1,1,1,2295.46,2180.68,1),(2,1,2,1712.05,1626.45,1),(3,1,3,1556.41,1478.59,1),(4,1,4,1270.65,1207.12,1),(5,1,5,1044.01,991.81,1),(6,1,6,915.92,870.12,1),(7,1,7,768.10,729.70,1),(8,1,8,640.00,608.00,1),(9,1,9,551.32,523.75,1),(10,1,10,511.90,486.31,1),(11,1,1,2700.54,2565.51,2),(12,1,2,2014.18,1831.07,2),(13,1,3,1831.07,1739.52,2),(14,1,4,1494.88,1420.14,2),(15,1,5,1228.25,1166.84,2),(16,1,6,1077.55,1023.67,2),(17,1,7,903.65,858.47,2),(18,1,8,752.94,715.29,2),(19,1,9,648.61,616.18,2),(20,1,10,602.24,572.13,2),(21,2,11,2098.38,1993.46,1),(22,2,12,1603.67,1523.48,1),(23,2,13,1457.88,1384.98,1),(24,2,14,1172.12,1113.51,1),(25,2,15,965.18,916.92,1),(26,2,16,866.64,823.31,1),(27,2,17,718.85,682.91,1),(28,2,18,580.88,551.84,1),(29,2,19,502.06,476.96,1),(30,2,20,462.63,439.50,1),(31,2,11,2468.68,2345.25,2),(32,2,12,1886.67,1792.33,2),(33,2,13,1715.15,1629.39,2),(34,2,14,1378.96,1310.01,2),(35,2,15,1135.50,1078.73,2),(36,2,16,1019.58,968.60,2),(37,2,17,845.70,803.42,2),(38,2,18,683.39,649.22,2),(39,2,19,590.66,561.13,2),(40,2,20,544.27,517.06,2),(41,3,21,1832.31,1740.70,1),(42,3,22,1191.78,1132.19,1),(43,3,23,1083.43,1029.26,1),(44,3,24,817.38,776.51,1),(45,3,25,797.67,757.78,1),(46,3,26,679.41,645.44,1),(47,3,27,531.62,505.04,1),(48,3,28,403.51,383.33,1),(49,3,29,314.83,299.09,1),(50,3,30,275.42,261.65,1),(51,3,21,2155.66,2047.88,2),(52,3,22,1402.08,1331.98,2),(53,3,23,1274.62,1210.89,2),(54,3,24,961.62,913.54,2),(55,3,25,938.43,891.51,2),(56,3,26,799.31,759.34,2),(57,3,27,625.43,594.16,2),(58,3,28,474.72,450.98,2),(59,3,29,370.39,351.87,2),(60,3,30,324.02,307.82,2),(61,4,31,1832.31,1740.70,1),(62,4,32,1832.31,1740.70,1),(63,4,33,1980.13,1881.12,1),(64,4,31,2155.66,2047.88,2),(65,4,32,2155.66,2047.88,2),(66,4,33,2329.56,2213.08,2);
/*!40000 ALTER TABLE `price_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_transaction_table`
--

DROP TABLE IF EXISTS `sales_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `srepcode` varchar(15) DEFAULT NULL,
  `magcode` varchar(45) DEFAULT NULL,
  `contid` varchar(45) DEFAULT NULL,
  `clientcode` varchar(45) DEFAULT NULL,
  `agencycode` varchar(45) DEFAULT NULL,
  `dateissue` varchar(45) DEFAULT NULL,
  `contdate` varchar(45) DEFAULT NULL,
  `relsched` varchar(45) DEFAULT NULL,
  `trandate` varchar(45) DEFAULT NULL,
  `adsize` varchar(45) DEFAULT NULL,
  `charges` varchar(45) DEFAULT NULL,
  `chargedate` varchar(45) DEFAULT NULL,
  `payment` varchar(45) DEFAULT NULL,
  `refno` varchar(45) DEFAULT NULL,
  `paydate` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_transaction_table`
--

LOCK TABLES `sales_transaction_table` WRITE;
/*!40000 ALTER TABLE `sales_transaction_table` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taxes_table`
--

DROP TABLE IF EXISTS `taxes_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taxes_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `province_code` varchar(10) DEFAULT NULL,
  `province_name` varchar(50) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `tax_amount` decimal(18,3) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taxes_table`
--

LOCK TABLES `taxes_table` WRITE;
/*!40000 ALTER TABLE `taxes_table` DISABLE KEYS */;
INSERT INTO `taxes_table` VALUES (1,'AB','Alberta','CAD',0.005,2),(2,'BC','Brithish Columbia','CAD',0.005,2),(3,'MB','Manitoba','CAD',0.005,2),(4,'NB','New Brunswick','CAD',0.150,2),(5,'NL','Newfoundland & Labrador','CAD',0.150,2),(6,'NS','Nova Scotia','CAD',0.150,2),(7,'ON','Ontrio','CAD',0.130,2),(8,'PE','Prince Edward','CAD',0.150,2),(9,'QC','Quebec','CAD',0.005,2),(10,'SK','Saskatchewan','CAD',0.005,2),(11,'AL','Alabama','USA',0.000,2),(12,'AK','Alaska','USA',0.000,2),(13,'AZ','Arizona','USA',0.000,2),(14,'AR','Arkansas','USA',0.000,2),(15,'CA','California','USA',0.000,2),(16,'CO','Colorado','USA',0.000,2),(17,'CT','Connecticut','USA',0.000,2),(18,'DE','Delaware','USA',0.000,2),(19,'FL','Florida','USA',0.000,2),(20,'GA','Georgia','USA',0.000,2),(21,'HI','Hawaii','USA',0.000,2),(22,'ID','Idaho','USA',0.000,2),(23,'IL','Illinois','USA',0.000,2),(24,'IN','Indiana','USA',0.000,2),(25,'IA','Iowa','USA',0.000,2),(26,'KS','Kansas','USA',0.000,2),(27,'KY','Kentucky','USA',0.000,2),(28,'LA','Louisiana','USA',0.000,2),(29,'ME','Maine','USA',0.000,2),(30,'MD','Maryland','USA',0.000,2),(31,'MA','Massachusetts','USA',0.000,2),(32,'MI','Michigan','USA',0.000,2),(33,'MN','Minnesota','USA',0.000,2),(34,'MS','Mississippi','USA',0.000,2),(35,'MO','Missouri','USA',0.000,2),(36,'MT','Montana','USA',0.000,2),(37,'NE','Nebraska','USA',0.000,2),(38,'NV','Nevada','USA',0.000,2),(39,'NH','New Hampshire','USA',0.000,2),(40,'NJ','New Jersey','USA',0.000,2),(41,'NM','New Mexico','USA',0.000,2),(42,'NY','New York','USA',0.000,2),(43,'NC','North Carolina','USA',0.000,2),(44,'ND','North Dakota','USA',0.000,2),(45,'OH','Ohio','USA',0.000,2),(46,'OK','Oklahoma','USA',0.000,2),(47,'OR','Oregon','USA',0.000,2),(48,'PA','Pennsylvania','USA',0.000,2),(49,'RI','Rhode Island','USA',0.000,2),(50,'SC','South Carolina','USA',0.000,2),(51,'SD','South Dakota','USA',0.000,2),(52,'TN','Tennessee','USA',0.000,2),(53,'TX','Texas','USA',0.000,2),(54,'UT','Utah','USA',0.000,2),(55,'VT','Vermont','USA',0.000,2),(56,'VA','Virginia','USA',0.000,2),(57,'WA','Washington','USA',0.000,2),(58,'WV','West Virginia','USA',0.000,2),(59,'WI','Wisconsin','USA',0.000,2),(60,'WY','Wyoming','USA',0.000,2),(61,'DC','District of Columbia','USA',0.000,2),(62,'AS','American Samoa','USA',0.000,2),(63,'GU','Guam','USA',0.000,2),(64,'MP','Northern Mariana Islands','USA',0.000,2),(65,'PR','Puerto Rico','USA',0.000,2),(66,'UM','United States Minor Outlying Islands','USA',0.000,2),(67,'VI','Virgin Islands, U.S.','USA',0.000,2);
/*!40000 ALTER TABLE `taxes_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account`
--

DROP TABLE IF EXISTS `user_account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
INSERT INTO `user_account` VALUES (1,'nikki','eb33da6599c0243dc6215ee2891d1277','Nikki','-','Manalo','me@kpa21.info','1234567891000',1,2,NULL,NULL),(2,'gayl','eb33da6599c0243dc6215ee2891d1277','Gayl','-','Punzalan','march@yahoo.com','1234567891000',2,2,NULL,NULL),(3,'von.b','eb33da6599c0243dc6215ee2891d1277','Von','Romson','Bayani','von@yahoo.com','1234567891000',3,2,NULL,NULL),(4,'louise','eb33da6599c0243dc6215ee2891d1277','Louise','-','Peterson','-','-',3,2,'2016-12-13 13:52:40','2016-12-13 13:52:40'),(5,'quinn','eb33da6599c0243dc6215ee2891d1277','Quinn','-','Peterson','Quinn@yahoo.com','-',3,2,'2016-12-13 13:54:09','2016-12-13 13:54:09'),(6,'darryl','eb33da6599c0243dc6215ee2891d1277','Darryl','-','Sawchuk','darryl@yahoo.com','-',3,2,'2016-12-13 13:54:43','2016-12-13 13:54:43'),(7,'brian','eb33da6599c0243dc6215ee2891d1277','Brian','-','Saunders','brian@yahoo.com','-',3,2,'2016-12-13 13:55:09','2016-12-13 13:55:09');
/*!40000 ALTER TABLE `user_account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_magazine_v1'
--
/*!50003 DROP PROCEDURE IF EXISTS `get_magazine_discount` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_magazine_discount`(IN Mid INT(11), IN Qty TINYINT(4), OUT Discount DECIMAL(18, 3))
BEGIN
	
    DECLARE total_type INT;
    
    SET total_type = (SELECT COUNT(*) t_type FROM magzine_discount_table WHERE mag_price_id = Mid AND percent != 0);
    
    IF Qty > total_type THEN
		SET Discount = (SELECT percent FROM magzine_discount_table WHERE mag_price_id = Mid AND percent != 0 AND type = (total_type + 1));
	ELSEIF Qty = 1 THEN
		SET Discount = 0;
	ELSE
		SET Discount = (SELECT * FROM magzine_discount_table WHERE mag_price_id = Mid AND percent != 0 AND type = Qty);
    END IF;

	SELECT Discount;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-22  2:55:07
