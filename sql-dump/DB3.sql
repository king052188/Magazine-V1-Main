CREATE DATABASE  IF NOT EXISTS `db_magazine_v1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_magazine_v1`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_magazine_v1
-- ------------------------------------------------------
-- Server version	5.7.18-log

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
-- Table structure for table `artwork_table`
--

DROP TABLE IF EXISTS `artwork_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artwork_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `book_trans` varchar(45) DEFAULT NULL,
  `artwork` int(11) DEFAULT NULL,
  `directions` varchar(300) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artwork_table`
--

LOCK TABLES `artwork_table` WRITE;
/*!40000 ALTER TABLE `artwork_table` DISABLE KEYS */;
INSERT INTO `artwork_table` VALUES (1,'1702KG0192',4,'test31',2,'2017-02-12 08:16:15','2017-02-12 08:16:15'),(2,'1702VX9564',1,'hey thank you',2,'2017-02-12 08:59:48','2017-02-12 08:59:48'),(3,'1702MX8696',1,'asasa',2,'2017-02-12 14:15:07','2017-02-12 14:15:07'),(4,'1702BP8799',1,'Supplied',2,'2017-02-12 16:43:51','2017-02-12 16:43:51'),(5,'1702RS9761',1,'Email advertiser ',2,'2017-02-13 08:19:07','2017-02-13 08:19:07'),(6,'1702DK8329',2,'sample artwork',2,'2017-02-14 01:28:45','2017-02-14 01:28:45'),(7,'1702WA0211',3,'Repeat from previous',2,'2017-02-14 07:25:12','2017-02-14 07:25:12'),(8,'1702MU5906',1,'Email John.',2,'2017-02-15 06:47:43','2017-02-15 06:47:43'),(9,'1702EF4368',1,'lkdsjf',2,'2017-02-16 05:39:06','2017-02-16 05:39:06');
/*!40000 ALTER TABLE `artwork_table` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_sales_table`
--

LOCK TABLES `booking_sales_table` WRITE;
/*!40000 ALTER TABLE `booking_sales_table` DISABLE KEYS */;
INSERT INTO `booking_sales_table` VALUES (192,'1702DK8329',1,147,90,22,6,'2017-02-13 21:56:09','2017-02-09 07:07:13'),(193,'1702RR1428',2,146,87,21,3,'2017-02-09 07:07:44','2017-02-09 07:07:44'),(194,'1702MX8696',2,148,93,0,1,'2017-02-09 07:19:28','2017-02-09 07:19:28'),(195,'1702DL5518',2,148,93,0,1,'2017-02-09 07:30:49','2017-02-09 07:30:49'),(196,'1702SZ3143',2,148,93,0,1,'2017-02-09 07:33:31','2017-02-09 07:33:31'),(197,'1702VX9564',2,148,93,0,6,'2017-02-13 22:02:04','2017-02-09 07:36:33'),(198,'1702KG0192',2,135,67,15,1,'2017-02-09 07:51:30','2017-02-09 07:51:30'),(199,'1702XV7178',2,135,67,15,1,'2017-02-09 07:54:42','2017-02-09 07:54:42'),(200,'1702CF0501',2,129,58,1,3,'2017-02-12 16:11:33','2017-02-09 11:35:59'),(201,'1702BP8799',2,149,95,0,3,'2017-02-12 16:54:39','2017-02-12 16:43:01'),(202,'1702IS1094',2,150,97,0,1,'2017-02-13 08:16:59','2017-02-13 08:16:59'),(203,'1702RS9761',2,150,97,0,1,'2017-02-13 08:18:37','2017-02-13 08:18:37'),(204,'1702XI2087',2,150,97,0,1,'2017-02-14 07:14:58','2017-02-14 07:14:58'),(205,'1702SC2511',2,150,97,0,1,'2017-02-14 07:16:54','2017-02-14 07:16:54'),(206,'1702WA0211',2,150,97,0,6,'2017-02-14 07:32:28','2017-02-14 07:24:27'),(207,'1702PC9743',2,150,97,0,1,'2017-02-15 06:28:16','2017-02-15 06:28:16'),(208,'1702QK7281',2,150,97,0,1,'2017-02-15 06:44:38','2017-02-15 06:44:38'),(209,'1702MU5906',2,145,83,0,6,'2017-02-15 06:49:54','2017-02-15 06:47:01'),(210,'1702EF4368',2,150,97,0,6,'2017-02-16 05:43:51','2017-02-16 05:38:19'),(211,'1702QX5192',2,151,99,0,1,'2017-02-16 11:14:28','2017-02-16 11:14:28'),(212,'1702MY6119',2,151,99,0,3,'2017-02-16 11:18:49','2017-02-16 11:18:49'),(213,'1702RX0103',2,151,99,0,1,'2017-02-16 11:32:09','2017-02-16 11:32:09'),(214,'1702EJ7915',2,151,99,0,1,'2017-02-16 11:32:49','2017-02-16 11:32:49'),(215,'1702TG3108',2,151,99,0,1,'2017-02-16 11:34:22','2017-02-16 11:34:22'),(216,'1702PY2751',2,151,99,0,1,'2017-02-16 11:35:19','2017-02-16 11:35:19'),(217,'1702AC1498',2,151,99,0,6,'2017-02-17 03:27:56','2017-02-16 11:50:50'),(218,'1702WD7089',2,150,97,0,1,'2017-02-18 17:12:32','2017-02-18 17:12:32'),(219,'1702IA4742',2,151,99,0,6,'2017-02-18 17:36:48','2017-02-18 17:16:39'),(220,'1705SK9804',1,147,89,0,1,'2017-05-03 06:52:07','2017-05-03 06:52:07'),(221,'1705TG7075',1,147,0,0,1,'2017-05-03 07:09:40','2017-05-03 07:09:40'),(222,'1705MN1954',1,145,83,0,1,'2017-05-03 09:12:36','2017-05-03 09:12:36'),(223,'1705VM2955',1,0,0,0,1,'2017-05-06 23:59:41','2017-05-06 23:59:41'),(224,'1705VM2955',1,0,0,0,1,'2017-05-06 23:59:47','2017-05-06 23:59:47'),(225,'1705VM2955',1,143,0,0,1,'2017-05-06 23:59:55','2017-05-06 23:59:55'),(226,'1705YF7975',1,143,0,0,1,'2017-05-09 17:44:25','2017-05-09 17:44:25'),(227,'1705NL7124',1,0,0,0,1,'2017-05-09 17:45:33','2017-05-09 17:45:33'),(228,'1705NL7124',1,0,0,0,1,'2017-05-09 17:45:49','2017-05-09 17:45:49'),(229,'1705NP2866',1,145,83,0,1,'2017-05-09 04:08:51','2017-05-09 04:08:51'),(230,'1705GU2941',1,145,83,0,1,'2017-05-09 04:09:08','2017-05-09 04:09:08'),(231,'1705LJ6513',1,145,0,0,1,'2017-05-09 04:10:00','2017-05-09 04:10:00'),(232,'1705FA6431',1,129,55,0,1,'2017-05-09 04:15:38','2017-05-09 04:15:38'),(233,'1705FA6431',1,129,55,0,1,'2017-05-09 04:15:51','2017-05-09 04:15:51'),(234,'1705QE6130',1,145,83,0,1,'2017-05-09 04:28:33','2017-05-09 04:28:33'),(235,'1705QE6130',1,147,89,0,1,'2017-05-09 04:30:11','2017-05-09 04:30:11'),(236,'1705BD0327',1,145,83,0,1,'2017-05-09 04:47:20','2017-05-09 04:47:20'),(237,'1705CU6821',1,145,83,0,1,'2017-05-09 04:48:12','2017-05-09 04:48:12'),(238,'1705XO1684',1,145,83,0,1,'2017-05-09 05:37:24','2017-05-09 05:37:24'),(239,'1705XI4845',1,143,0,0,1,'2017-05-11 14:27:05','2017-05-11 14:27:05'),(240,'1705QH4205',1,143,0,0,1,'2017-05-11 02:58:41','2017-05-11 02:58:41');
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
  `landline` varchar(25) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `type_designation` varchar(45) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `synched` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_contacts_table`
--

LOCK TABLES `client_contacts_table` WRITE;
/*!40000 ALTER TABLE `client_contacts_table` DISABLE KEYS */;
INSERT INTO `client_contacts_table` VALUES (54,129,'0001','Gayl',NULL,'Punzalan','1688 Logan Ave.',NULL,NULL,'Winnipeg','MB','R3E 1S6','gpunzalan@lesterpublications.com','204-954-8165','204-218-4295','Digital Media Manager',NULL,1,4,2,1,'2017-01-13 03:19:00','2017-01-03 15:48:13'),(55,129,'Company Bill To','Nikki ',NULL,'Manalo','701 Henry Avenue',NULL,NULL,'Winnipeg','MB','R3E 1S6','nmanalo@lestertech.ca','204-954-8165','204-218-4295','Office Manager',NULL,2,3,2,1,'2017-01-05 03:39:41','2017-01-03 15:50:16'),(56,129,'0002','John',NULL,'Doe','701 Henry Avenue',NULL,NULL,'Winnipeg','MB','R3E 1S6','info@lesterpublications.com','204-954-8165','204-218-4295','Marketing Manager',NULL,1,2,2,1,'2017-01-03 15:56:45','2017-01-03 15:56:25'),(57,130,'','Gayl',NULL,'Punzalan','1688 Logan Ave.',NULL,NULL,'Winnipeg','MB','R3E 1S6','info@lesterpublications.com','204-954-8165','204-218-4295','Marketing Manager',NULL,1,3,2,1,'2017-01-03 18:04:35','2017-01-03 18:04:01'),(58,129,'other sample','von',NULL,'sample','sample address',NULL,NULL,'sample gapo','sef','asfsd','dsfasdf','sdafas','sdf','sdfasdf',NULL,1,4,2,1,'2017-01-05 03:32:20','2017-01-05 03:32:20'),(59,131,'0001','John ',NULL,'Smith','5565 Salter Avenue',NULL,NULL,'Anaheim','CA','32465456645','samdoe@jdfields.com','1-204-954-8165','1-204-954-8165','General Manager',NULL,1,4,2,1,'2017-01-13 03:19:00','2017-01-09 09:26:10'),(60,131,'','Jane ',NULL,'Smith','1001 Berkeley',NULL,NULL,'Anaheim','CA','T6B 0B5','janedoe@jdfields.com','1-204-954-8165','780-469-2268','Marketing Manager',NULL,2,3,2,1,'2017-01-09 09:28:41','2017-01-09 09:28:41'),(61,131,'0002','safdsdfsdf',NULL,'sadfsdf','sdfsdf',NULL,NULL,'sdfsdf','CA','sdfsdf','dcostigan@psychometrics.com','780-469-2268','780-469-2268','Digital Media',NULL,1,2,2,1,'2017-01-09 09:37:54','2017-01-09 09:37:54'),(62,133,'The Red Agency','Angel',NULL,'Ainge','oiujlskjdf ljsdflkj ',NULL,NULL,'Toronto','ON','sdfsdf','angel@blueinkmedia.ca','9080808098098','8900808','Client Services',NULL,2,3,2,1,'2017-01-12 07:02:28','2017-01-12 07:02:28'),(63,134,'Test','Shane',NULL,'Holland','California, United States',NULL,NULL,'NOne','MB','223','asd','sdaf','sdf','sadf',NULL,1,5,2,1,'2017-01-13 03:19:00','2017-01-13 03:19:00'),(64,129,'0001','John',NULL,'Holland','None',NULL,NULL,'None','NB','None','johnh@yahoo.com','None','None','None',NULL,3,1,2,1,'2017-01-16 21:43:45','2017-01-16 21:43:45'),(65,135,'0001','Juan',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','BC','sdfsdf','sdfsdf','sdfsdf','sdfsdfsdf','sdfsdfsdf',NULL,1,1,2,1,'2017-01-21 07:35:34','2017-01-21 07:35:34'),(66,135,'0002','Pedro',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','MB','sdfsdf','sdfsd','sdfsd','sdfsdf','sdfsdf',NULL,1,2,2,1,'2017-01-21 07:36:02','2017-01-21 07:36:02'),(67,135,'Agency 1','Maria',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','AB','sdfsdf','sdfsdf','sdfsdf','sdf','sdfsdfsdf',NULL,2,3,2,1,'2017-01-21 07:36:35','2017-01-21 07:36:35'),(68,135,'Bill To','Diego',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','NB','sfsdf','sdfsdf','sdf','sdfsfd','lkjslfjljksdf',NULL,2,4,2,1,'2017-01-21 07:44:47','2017-01-21 07:44:00'),(69,132,'0001','sfdsf',NULL,'sdf','sd',NULL,NULL,'s','BC','3','sdf','3','3','ssdf',NULL,1,1,2,1,'2017-01-21 07:50:04','2017-01-21 07:50:04'),(70,132,'sdf','sdfdsf',NULL,'s','sd',NULL,NULL,'s','BC','3','sdf','3','ds3','3sdf',NULL,2,3,2,1,'2017-01-21 07:50:42','2017-01-21 07:50:42'),(71,135,'Bill To','Mario',NULL,'lksdjfljks','sdfdsf',NULL,NULL,'sdfsdf','NL','sdfsdf','sdf','dsf','sdf','sdf',NULL,2,4,2,1,'2017-01-21 07:53:20','2017-01-21 07:53:20'),(72,136,'0001','Primary',NULL,'Contact','dsfsdf',NULL,NULL,'sdfsdf','ON','sdfsfd','sdfsdf','sdfsf','sdfsf','Primary',NULL,1,1,2,1,'2017-01-22 08:11:43','2017-01-22 08:11:43'),(73,136,'Blue Agency','Bill To',NULL,'Contact','sdfsfd',NULL,NULL,'sfdsfd','ON','sdfsf','sdfds','sdfsdf','sfdsfd','sfsfd',NULL,2,3,2,1,'2017-01-22 08:12:22','2017-01-22 08:12:22'),(74,136,'Bill To','Digital Bill To',NULL,'Contact','sdfsdf',NULL,NULL,'sdfsdf','ON','sdfsdf','sdfsdf','sdfsdf','sdfsf','sdfsaf',NULL,2,4,2,1,'2017-01-22 08:13:06','2017-01-22 08:13:06'),(75,138,'0001','John ',NULL,'Smith','255 St. James Avenue',NULL,NULL,'Winnipeg','MB','R3E1S6','john@hub.com','204-218-4295','204-218-4295','General Manager',NULL,1,1,2,1,'2017-01-22 08:30:34','2017-01-22 08:30:34'),(76,138,'Pringles Ad Agency','Norma',NULL,'Caldwell','255 St. James Avenue',NULL,NULL,'Winnipeg','MB','R3E1S6','norma@hub.com','204-218-4295','204-218-4295','Finance Manager',NULL,2,3,2,1,'2017-01-22 08:31:33','2017-01-22 08:31:33'),(77,138,'Bill To','Grace',NULL,'Archer','255 St. James Avenue',NULL,NULL,'Winnipeg','MB','R3E1S6','grace@hub.com','204-218-4295','204-218-4295','Digital Finance Manager',NULL,1,4,2,1,'2017-01-22 08:37:05','2017-01-22 08:37:05'),(78,139,'sdfdf','yuri',NULL,'sdf','df',NULL,NULL,'asdf','NB','asdf','sdaf','asdf','asdf','asdf',NULL,2,3,2,1,'2017-01-22 17:44:51','2017-01-22 17:44:51'),(79,140,'0001','John',NULL,'Folders','Address',NULL,NULL,'City','AL','Zipcode','Email','landline','mobile','Manager',NULL,2,1,2,1,'2017-01-23 19:31:00','2017-01-23 19:31:00'),(80,140,'0002','Ford',NULL,'Silver','Address',NULL,NULL,'city','AZ','Zipcode','Email','Landline','Mobile','Supervisor',NULL,2,2,2,1,'2017-01-23 19:31:52','2017-01-23 19:31:52'),(81,140,'Linkedin','Johnson',NULL,'Ferrari','Address',NULL,NULL,'City','CT','Zipcode','Email','Landline','Mobile','Position',NULL,3,3,2,1,'2017-01-23 19:32:44','2017-01-23 19:32:44'),(82,145,'0001','sdfsdf',NULL,'sdfdsf','sdfsdf',NULL,NULL,'sdfsdf','BC','sdfsdf','sdfsf','sdfsdf','sdfsdf','sdfsdf',NULL,1,1,2,1,'2017-01-24 08:19:38','2017-01-24 08:19:38'),(83,145,'sdfsdfsdf','sdfsdf',NULL,'sdfsdf','sdfsdf',NULL,NULL,'sdfsdf','BC','sdfsdf','sdfsdf','sdfsdf','sdfsdf','sdsdf',NULL,1,3,2,1,'2017-01-24 08:20:18','2017-01-24 08:20:18'),(84,143,'0001','Von',NULL,'Ford','Stockton California',NULL,NULL,'California','AK','22091','vford@yahoo.com','231-2312-4351-2312','322-123-5433-1231','Electrical Engineer',NULL,3,1,2,1,'2017-01-25 02:36:48','2017-01-25 02:36:48'),(85,146,'0001','Juan',NULL,'Dela Cruz','NA',NULL,NULL,'NA','AB','22091','vford@yahoo.com','1','1','1',NULL,1,1,2,1,'2017-02-09 07:06:25','2017-01-25 08:28:47'),(86,146,'0002','Pedro ',NULL,'Dela Cruz','sdfsdfsdf',NULL,NULL,'sdfsdf','AB','sdf','gpunzalan@lesterpublications.com','sdfsdf','sdf','sdf',NULL,1,3,2,1,'2017-02-09 07:06:59','2017-01-25 08:29:59'),(87,146,'Bill To','Sammy',NULL,'Punzalan','701 Henry Avenue',NULL,NULL,'Winnipeg','MB','r3e1s6','sam@trash.com','204-954-8165','204-218-4295','Finance Manager',NULL,2,4,2,1,'2017-01-25 08:54:54','2017-01-25 08:34:35'),(88,147,'0001','almond',NULL,'nut','sfsdf',NULL,NULL,'sfsdf','ON','345345','gayl@blueinkmedia.ca','5325345325','245345354','Marketing',NULL,1,1,2,1,'2017-01-26 09:28:54','2017-01-26 08:52:53'),(89,147,'0002','hazel',NULL,'nut','lkdsjfl',NULL,NULL,'lksdjf','ON','09908890','gpunzalan@lesterpublications.com','5325345325','245345354','Coordinator',NULL,2,3,2,1,'2017-01-26 09:27:56','2017-01-26 08:54:15'),(90,147,'Bill To','peanut',NULL,'butter','sf',NULL,NULL,'sfsdf','ON','098450834','info@lesterpublications.com','5325345325','245345354','Coordinator',NULL,1,4,2,1,'2017-01-26 09:29:48','2017-01-26 09:29:48'),(91,148,'0001','Greg ',NULL,'Sanders','1001 Berkeley',NULL,NULL,'Edmonton','AB','T6B 0B5','dcostigan@psychometrics.com','780-469-2268','780-469-2268','Marketing Manager',NULL,1,1,2,1,'2017-02-09 07:15:37','2017-02-09 07:15:37'),(92,148,'0002','Sarah',NULL,'Sidel','555 Stone',NULL,NULL,'Winniepg','MB','T6B 0B5','samdoe@jdfields.com','1-204-954-8165','1-204-954-8165','Communications Director',NULL,1,2,2,1,'2017-02-09 07:18:07','2017-02-09 07:18:07'),(93,148,'','Nick',NULL,'Stokes','7125-77th Avenue',NULL,NULL,'Calgary','AB','T6B 0B5','johndoe@jdfields.com','780-469-2268','780-469-2268','Finance Manager',NULL,2,3,2,1,'2017-02-09 07:19:04','2017-02-09 07:19:04'),(94,149,'0001','Wilson ',NULL,'Wong','1005 Scurfield',NULL,NULL,'Winnipeg','MB','659854','wilson@rebel.ca','204-218-4295','204-218-4295','General Manager',NULL,1,1,2,1,'2017-02-12 16:41:58','2017-02-12 16:41:58'),(95,149,'Triangle Agency','Diana ',NULL,'Ross','255 St. James Avenue',NULL,NULL,'Winnipeg','MB','3265875','angel@blueinkmedia.ca','6546464465','654654645','Finance Manager',NULL,2,3,2,1,'2017-02-12 16:42:42','2017-02-12 16:42:42'),(96,150,'0001','Lisa',NULL,'Shroeder','43779 Progressive Way',NULL,NULL,'Chilliwack','BC','V2R 0E6','lisas@fl-machinery.com','604-392-8191','604-392-8191','Manager',NULL,1,1,2,1,'2017-02-13 08:15:25','2017-02-13 08:15:25'),(97,150,'Frontline Machinery Ltd.','Lisa',NULL,'Shroeder','43779 Progressive Way',NULL,NULL,'Chilliwack','BC','V2R 0E6','lisas@fl-machinery.com','604-392-8191','604-392-8191','Manager',NULL,1,3,2,1,'2017-02-13 08:16:34','2017-02-13 08:16:34'),(98,151,'0001','Tracy',NULL,'Phifer','3841 Industrial Drive',NULL,NULL,'Birmingham','AL','35217','tracy@jeffreymachine.com','205-841-8600 ext 114','205-841-8600 ext 114','Advertiser',NULL,1,1,2,1,'2017-02-16 11:13:04','2017-02-16 11:13:04'),(99,151,'Jeffrey Machine','Cindy',NULL,'Wood','3841 Industrial Drive',NULL,NULL,'Birmingham','AL','35217','cindy@jeffreymachine.com','205-841-8600 ext 114','205-841-8600 ext 114','Billing Contact',NULL,1,3,2,1,'2017-02-16 11:14:07','2017-02-16 11:14:07');
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
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_table`
--

LOCK TABLES `client_table` WRITE;
/*!40000 ALTER TABLE `client_table` DISABLE KEYS */;
INSERT INTO `client_table` VALUES (129,'Boeing','1001 Berkeley Ave.','San Francisco','CA','10210',NULL,1,1,2,'2017-01-03 15:46:50','2017-01-03 15:46:50'),(130,'JD Fields','1005 Andrew Ave.','Atlanta','GA','10201',NULL,1,1,2,'2017-01-03 18:01:17','2017-01-03 18:01:17'),(131,'Meloche Monnex','1688 Logan Avenue','Beverly Hills','CA','10210',NULL,1,1,2,'2017-01-09 09:21:40','2017-01-09 09:21:40'),(132,'sample type','sd','sdfg','BC','sdfg',NULL,-1,1,2,'2017-01-11 00:33:04','2017-01-11 00:33:04'),(133,'Psychometrics','888 River Driver','Toronto','ON','98779797',NULL,1,1,2,'2017-01-12 06:59:53','2017-01-12 06:59:53'),(134,'Bizarre Foods Compant','Greece','NONE','NS','22019',NULL,1,1,2,'2017-01-13 03:15:56','2017-01-13 03:15:56'),(135,'Best Doctors','sdfsdfsdf','sdfsdf','AB','sdfsdfsdf',NULL,1,1,2,'2017-01-21 07:31:13','2017-01-21 07:31:13'),(136,'Queens University','909 Salter Ave','Toronto','ON','sdfsdfdsf',NULL,1,1,2,'2017-01-22 08:10:55','2017-01-22 08:10:55'),(137,'Perkins','2115 St. James Ave','Winnipeg','MB','R',NULL,1,1,2,'2017-01-22 08:27:44','2017-01-22 08:27:44'),(138,'Hub International','255 St. James Ave.','Winnipeg','MB','R3E1S6',NULL,1,1,2,'2017-01-22 08:29:40','2017-01-22 08:29:40'),(139,'Harbor Point','Olongapo City','Olongapo','MB','2200',NULL,1,1,2,'2017-01-22 17:42:13','2017-01-22 17:42:13'),(140,'Six Sigma Corporation','Warehouse 10 Victory Compound Old Cabalan','Olongapo City','AB','2209',NULL,1,1,2,'2017-01-22 21:04:01','2017-01-22 21:03:30'),(141,'fdg','dfg','dfgh','BC','fg',NULL,1,1,2,'2017-01-23 19:37:35','2017-01-23 19:37:35'),(142,'kill','rt','ert','NB','ert',NULL,1,1,2,'2017-01-23 19:45:50','2017-01-23 19:45:50'),(143,'abcde','3434','34234','AB','12323',NULL,1,1,2,'2017-01-23 19:46:38','2017-01-23 19:46:38'),(144,'df','dfsg','sdfg','MB','dfg',NULL,1,1,2,'2017-01-23 19:48:36','2017-01-23 19:48:36'),(145,'Agilec','419 King St. W, Suite 3560','Oshawa','ON','L1J 2K5',NULL,1,1,2,'2017-01-24 07:56:47','2017-01-24 07:56:47'),(146,'LiteTrax','888 Lake Mead','Winnipeg','MB','99098',NULL,1,1,2,'2017-01-25 08:37:35','2017-01-25 08:27:12'),(147,'Axis Restaurant','898 Candle Dr','Toronto','ON','909876',NULL,-1,1,2,'2017-01-26 09:07:42','2017-01-26 08:52:03'),(148,'Lulich Implements','1688 Logan Avenue','Winnipeg','MB','L1J 2K5',NULL,1,1,2,'2017-02-09 07:14:35','2017-02-09 07:14:35'),(149,'Rebel Pizza','5654 Salter Ave.','Winnipeg','MB','8795684',NULL,1,1,2,'2017-02-12 16:41:06','2017-02-12 16:41:06'),(150,'Frontline Machinery Ltd','43779 Progressive Way','Chilliwack','BC','V2R0E6',NULL,-1,1,2,'2017-02-13 08:13:18','2017-02-13 08:13:18'),(151,'Jeffrey Machine','3841 Industrial Drive','Birmingham','AL','35217',NULL,1,1,2,'2017-02-16 11:11:07','2017-02-16 11:11:07');
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
  `type` tinyint(4) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discount_transaction_table`
--

LOCK TABLES `discount_transaction_table` WRITE;
/*!40000 ALTER TABLE `discount_transaction_table` DISABLE KEYS */;
INSERT INTO `discount_transaction_table` VALUES (39,'1702DK8329','1',1000.00,2.000,'test',1,'2','2017-02-09 07:07:49','2017-02-09 07:07:49'),(40,'1702VX9564','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-09 07:37:48','2017-02-09 07:37:48'),(41,'1702VX9564','2',4845.00,10.000,'dfasdffdsa',1,'2','2017-02-09 07:39:17','2017-02-09 07:39:17'),(42,'1702SZ3143','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-09 07:46:40','2017-02-09 07:46:40'),(43,'1702KG0192','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-09 07:52:14','2017-02-09 07:52:14'),(44,'1702CF0501','2',2550.00,10.000,'valued',1,'2','2017-02-09 11:38:06','2017-02-09 11:38:06'),(45,'1702BP8799','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-12 16:44:23','2017-02-12 16:44:23'),(46,'1702WA0211','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-14 07:26:17','2017-02-14 07:26:17'),(47,'1702QK7281','2',3000.00,10.000,'dsafddsf',1,'2','2017-02-15 06:45:08','2017-02-15 06:45:08'),(48,'1702MU5906','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-15 06:47:26','2017-02-15 06:47:26'),(49,'1702EF4368','2',0.00,5.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-16 05:38:55','2017-02-16 05:38:55'),(50,'1702EF4368','2',5700.00,10.000,'lskdjflkjsdfjkljksdaf',1,'2','2017-02-16 05:39:20','2017-02-16 05:39:20'),(51,'1702QX5192','2',0.00,9.750,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-16 11:15:14','2017-02-16 11:15:14'),(52,'1702MY6119','2',0.00,9.750,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-16 11:21:07','2017-02-16 11:19:17'),(53,'1702AC1498','2',0.00,12.450,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-16 11:52:50','2017-02-16 11:51:19'),(54,'1702AC1498','2',5576.46,10.000,'Valued client',1,'2','2017-02-16 11:58:54','2017-02-16 11:58:54'),(55,'1702WD7089','2',0.00,20.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-18 17:13:09','2017-02-18 17:12:53'),(56,'1702IA4742','2',0.00,20.000,'SYSTEM AUTOMATED DISCOUNT',2,'2','2017-02-18 17:17:00','2017-02-18 17:17:00');
/*!40000 ALTER TABLE `discount_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flat_plan_table`
--

DROP TABLE IF EXISTS `flat_plan_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flat_plan_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `trans_number` varchar(100) DEFAULT NULL,
  `magazine_name` varchar(50) DEFAULT NULL,
  `magazine_year` varchar(10) DEFAULT NULL,
  `magazine_issue` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flat_plan_table`
--

LOCK TABLES `flat_plan_table` WRITE;
/*!40000 ALTER TABLE `flat_plan_table` DISABLE KEYS */;
INSERT INTO `flat_plan_table` VALUES (1,43,'201705120501591503E9F412A','Think Big',NULL,NULL,1,'2017-05-12 07:31:48','2017-05-12 07:31:48'),(2,43,'2017051205495914','Think Big',NULL,NULL,1,'2017-05-12 07:32:52','2017-05-12 07:32:52'),(3,43,'2017051205105914','Think Big',NULL,NULL,1,'2017-05-12 07:33:13','2017-05-12 07:33:13'),(4,43,'2017051205215914','Think Big',NULL,NULL,1,'2017-05-12 07:34:23','2017-05-12 07:34:23'),(5,43,'2017051205375914','Think Big',NULL,NULL,1,'2017-05-12 07:35:39','2017-05-12 07:35:39'),(6,43,'2017051205505914','Think Big',NULL,NULL,1,'2017-05-12 07:35:52','2017-05-12 07:35:52'),(7,43,'2017051205315914','Think Big',NULL,NULL,1,'2017-05-12 07:36:33','2017-05-12 07:36:33'),(8,43,'2017051205495914F5CD76D03','Think Big',NULL,NULL,1,'2017-05-12 07:37:51','2017-05-12 07:37:51'),(9,43,'2017051205295914F75DDAF0F','Think Big',NULL,NULL,1,'2017-05-12 07:44:42','2017-05-12 07:44:42'),(10,43,'2017051205255914F9ED797AB','Think Big',NULL,NULL,1,'2017-05-12 07:55:28','2017-05-12 07:55:28'),(11,43,'2017051205105914FA92442EB','Think Big',NULL,NULL,1,'2017-05-12 07:58:16','2017-05-12 07:58:16'),(12,43,'201705120546591550BAB8BF0','Think Big',NULL,NULL,1,'2017-05-12 14:05:59','2017-05-12 14:05:59');
/*!40000 ALTER TABLE `flat_plan_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `flat_plan_transaction_table`
--

DROP TABLE IF EXISTS `flat_plan_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `flat_plan_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `flat_id` int(11) DEFAULT NULL,
  `company_name` varchar(50) DEFAULT NULL,
  `page_id` varchar(45) DEFAULT NULL,
  `placeholder_id` varchar(45) DEFAULT NULL,
  `placeholder_size` varchar(45) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `flat_plan_transaction_table`
--

LOCK TABLES `flat_plan_transaction_table` WRITE;
/*!40000 ALTER TABLE `flat_plan_transaction_table` DISABLE KEYS */;
INSERT INTO `flat_plan_transaction_table` VALUES (176,1,'FB Company 47','page_5','drag_4731','FULL_DOUBLE_SPREED',2,2,'2017-05-12 11:49:30','2017-05-12 11:49:30'),(177,1,'H Company 11','page_back_inside','drag_11666','1_2_DOUBLE_SPREED',1,2,'2017-05-12 11:49:55','2017-05-12 11:49:55'),(178,1,'H Company 12','page_12','drag_12666','1_2_DOUBLE_SPREED',1,2,'2017-05-12 11:50:10','2017-05-12 11:50:10'),(179,1,'FB Company 46','page_17','drag_4631','FULL',1,2,'2017-05-12 14:22:06','2017-05-12 12:03:42'),(180,1,'H Company 15','page_19','drag_15666','1_2_DOUBLE_SPREED',2,2,'2017-05-12 12:03:54','2017-05-12 12:03:54'),(181,1,'H Company 14','page_25','drag_14666','1_2_DOUBLE_SPREED',2,2,'2017-05-12 12:06:04','2017-05-12 12:06:04'),(182,1,'FB Company 45','page_22','drag_4531','FULL_DOUBLE_SPREED',1,2,'2017-05-12 12:06:10','2017-05-12 12:06:10'),(183,1,'FB Company 41','page_3','drag_4131','DOUBLE_SPREED',2,2,'2017-05-12 14:07:43','2017-05-12 14:07:31'),(184,1,'FB Company 42','page_1','drag_4231','FULL_DOUBLE_SPREED',2,2,'2017-05-12 14:08:16','2017-05-12 14:08:16'),(185,1,'FB Company 50','page_back_cover','drag_5031','FULL',1,2,'2017-05-12 14:09:58','2017-05-12 14:08:36'),(186,1,'S 1_6_HORIZONTAL 1','page_12','drag_197','1_8_VERTICAL',0,2,'2017-05-12 14:21:41','2017-05-12 14:19:48'),(187,1,'S 1_6_HORIZONTAL 4','page_front_inside','drag_497','1_8_VERTICAL',0,2,'2017-05-12 14:20:08','2017-05-12 14:19:57'),(188,1,'S 1_6_HORIZONTAL 2','page_6','drag_297','1_8_VERTICAL',0,2,'2017-05-12 14:21:12','2017-05-12 14:20:03'),(189,1,'S 1_6_HORIZONTAL 3','page_front_inside','drag_397','1_8_HORIZONTAL',0,2,'2017-05-12 14:20:06','2017-05-12 14:20:06'),(190,1,'S 1_6_HORIZONTAL 5','page_2','drag_597','1_8_VERTICAL',0,2,'2017-05-12 14:21:30','2017-05-12 14:20:12');
/*!40000 ALTER TABLE `flat_plan_transaction_table` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_list_table`
--

LOCK TABLES `group_list_table` WRITE;
/*!40000 ALTER TABLE `group_list_table` DISABLE KEYS */;
INSERT INTO `group_list_table` VALUES (1,1,54,129,1,2,NULL,NULL),(2,1,55,129,2,2,NULL,NULL),(8,7,62,133,2,2,'2017-01-19 03:41:11','2017-01-19 03:41:11'),(9,1,58,129,3,2,'2017-01-19 03:52:21','2017-01-19 03:52:21'),(10,8,63,134,1,2,'2017-01-19 23:38:39','2017-01-19 23:38:39'),(11,9,63,134,1,2,'2017-01-20 00:56:29','2017-01-20 00:56:29'),(12,10,63,134,2,2,'2017-01-20 00:56:47','2017-01-20 00:56:47'),(13,11,63,134,1,2,'2017-01-20 01:14:14','2017-01-20 01:14:14'),(14,12,63,134,2,2,'2017-01-20 01:14:44','2017-01-20 01:14:44'),(15,2,64,129,1,2,'2017-01-20 23:25:38','2017-01-20 23:25:38'),(16,2,58,129,2,2,'2017-01-20 23:25:41','2017-01-20 23:25:41'),(17,2,55,129,3,2,'2017-01-20 23:25:46','2017-01-20 23:25:46'),(18,4,58,129,1,2,'2017-01-20 23:28:02','2017-01-20 23:28:02'),(19,4,54,129,2,2,'2017-01-20 23:28:06','2017-01-20 23:28:06'),(20,4,64,129,3,2,'2017-01-20 23:28:13','2017-01-20 23:28:13'),(21,13,68,135,3,2,'2017-01-21 07:46:47','2017-01-21 07:46:47'),(22,14,71,135,3,2,'2017-01-21 07:54:35','2017-01-21 07:54:35'),(23,15,67,135,3,2,'2017-01-21 07:58:45','2017-01-21 07:58:45'),(24,16,74,136,3,2,'2017-01-22 08:13:38','2017-01-22 08:13:38'),(25,17,77,138,3,2,'2017-01-22 08:37:34','2017-01-22 08:37:34'),(26,18,54,129,3,2,'2017-01-22 17:43:39','2017-01-22 17:43:39'),(27,18,58,129,1,2,'2017-01-22 17:43:58','2017-01-22 17:43:58'),(29,18,64,129,2,2,'2017-01-22 17:44:18','2017-01-22 17:44:18'),(30,19,78,139,1,2,'2017-01-23 03:05:02','2017-01-23 03:05:02'),(31,20,79,140,3,2,'2017-01-23 19:33:10','2017-01-23 19:33:10'),(32,20,80,140,1,2,'2017-01-23 19:33:15','2017-01-23 19:33:15'),(34,20,81,140,2,2,'2017-01-23 19:33:43','2017-01-23 19:33:43'),(35,21,87,146,3,2,'2017-01-25 08:34:52','2017-01-25 08:34:52'),(36,22,90,147,3,2,'2017-01-26 09:30:48','2017-01-26 09:30:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_table`
--

LOCK TABLES `group_table` WRITE;
/*!40000 ALTER TABLE `group_table` DISABLE KEYS */;
INSERT INTO `group_table` VALUES (1,'Group A',1,129,NULL,NULL),(2,'Group B',2,129,NULL,NULL),(3,'Group C',3,129,'2017-01-19 00:55:15','2017-01-19 00:55:15'),(4,'Group D',1,129,'2017-01-19 00:55:27','2017-01-19 00:55:27'),(5,'Group E',2,129,'2017-01-19 00:56:53','2017-01-19 00:56:53'),(6,'Sample Group',2,130,'2017-01-19 03:04:26','2017-01-19 03:04:26'),(7,'Group One',2,133,'2017-01-19 03:12:59','2017-01-19 03:12:59'),(8,'PAOPAO',1,134,'2017-01-19 23:38:32','2017-01-19 23:38:32'),(9,'KPA',2,134,'2017-01-19 23:39:12','2017-01-19 23:39:12'),(10,'MJT',3,134,'2017-01-19 23:41:41','2017-01-19 23:41:41'),(11,'xpao',2,134,'2017-01-20 00:47:38','2017-01-20 00:47:38'),(12,'ypao',1,134,'2017-01-20 01:14:37','2017-01-20 01:14:37'),(13,'Group A',2,135,'2017-01-21 07:46:27','2017-01-21 07:46:27'),(14,'Group B',2,135,'2017-01-21 07:54:21','2017-01-21 07:54:21'),(15,'Group Default',1,135,'2017-01-21 07:58:34','2017-01-21 07:58:34'),(16,'Digital 1',2,136,'2017-01-22 08:13:23','2017-01-22 08:13:23'),(17,'Digital',2,138,'2017-01-22 08:37:24','2017-01-22 08:37:24'),(18,'Sample Group',2,129,'2017-01-22 17:43:28','2017-01-22 17:43:28'),(19,'Hub 1',1,139,'2017-01-23 03:04:54','2017-01-23 03:04:54'),(20,'Youtube Developer',2,140,'2017-01-23 19:33:01','2017-01-23 19:33:01'),(21,'Digital',2,146,'2017-01-25 08:33:23','2017-01-25 08:33:23'),(22,'Digital',2,147,'2017-01-26 09:30:34','2017-01-26 09:30:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_table`
--

LOCK TABLES `invoice_table` WRITE;
/*!40000 ALTER TABLE `invoice_table` DISABLE KEYS */;
INSERT INTO `invoice_table` VALUES (26,'2017-00310','1702DK8329',1,'2017-03-15 21:56:10','1',2,'2017-02-13 21:56:10','2017-02-13 21:56:10'),(27,'2017-07478','1702VX9564',1,'2017-03-15 22:02:05','2',2,'2017-02-13 22:02:05','2017-02-13 22:02:05'),(28,'2017-06929','1702WA0211',1,'2017-03-16 07:32:28','2',2,'2017-02-14 07:32:28','2017-02-14 07:32:28'),(29,'2017-09398','1702MU5906',1,'2017-03-17 06:49:54','2',2,'2017-02-15 06:49:54','2017-02-15 06:49:54'),(30,'2017-01997','1702EF4368',1,'2017-03-18 05:43:51','2',2,'2017-02-16 05:43:51','2017-02-16 05:43:51'),(36,'2017-05270','1702AC1498',1,'2017-03-19 02:31:04','2',2,'2017-02-17 02:31:04','2017-02-17 02:31:04'),(37,'2017-09593','1702AC1498',2,'2017-03-19 02:35:07','2',2,'2017-02-17 02:35:07','2017-02-17 02:35:07'),(43,'2017-04268','1702AC1498',3,'2017-03-19 03:27:56','2',2,'2017-02-17 03:27:56','2017-02-17 03:27:56'),(44,'2017-07308','1702IA4742',1,'2017-03-20 17:36:23','2',2,'2017-02-18 17:36:23','2017-02-18 17:36:23'),(45,'2017-00644','1702IA4742',2,'2017-03-20 17:36:48','2',2,'2017-02-18 17:36:48','2017-02-18 17:36:48');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_company_table`
--

LOCK TABLES `magazine_company_table` WRITE;
/*!40000 ALTER TABLE `magazine_company_table` DISABLE KEYS */;
INSERT INTO `magazine_company_table` VALUES (11,'201701030155586BC3AFCC83E','Lyceum','NA','NA','Olongapo','Zambales','1','NA','099','099',1,'2017-01-26 07:53:32','2017-01-03 15:31:36'),(12,'201701030141586BC635711B0','Lester Communications','701 Henry Avenue','735','Winnipeg','MB','2','info@lesterpublications.com','1-204-954-8165','',2,'2017-01-16 19:09:38','2017-01-03 15:43:25'),(13,'201701030118586BE27A7A751','Lester Publications','140 Broadway ','44th Floor','New York','NY','1','gpunzalan@lesterpublications.com','1-204-954-8165','',2,'2017-02-16 12:36:11','2017-01-03 17:45:01'),(14,'20170109015858739C4A353FC','Lester Communications_v1','701 Henry Avenue','','Winniepg','Manitoba','2','info@lesterpublications.com','1-204-954-8165','',1,'2017-01-26 07:53:22','2017-01-09 06:42:08'),(15,'20170122011958855BF761625','San Miguel Corporation_1','Old Cabalan','','Olongapo City','Zambales','1','','','',1,'2017-01-26 07:53:45','2017-01-22 17:27:53'),(16,'20170122011558855CE3E8683','San Miguel Corporation','Old Cabalan','','Olongapo City','Zambales','1','marchjigtala@yahoo.com','','',1,'2017-01-26 07:53:39','2017-01-22 17:31:25'),(17,'20170122014958858249269A4','Six Sigma Corporation','Warehouse 10 Victory Compound Old Cabalan ','','Olongapo City','Zambales','2','','09052883395','232-0071',1,'2017-01-26 07:53:50','2017-01-22 20:14:12'),(18,'201702050237589742C5E7BAB','Lester Digital Publishing','9876 Drake Blvd.','','Winnipeg','MB','2','digital@lestertech.ca','204-954-8165','',2,'2017-02-05 07:23:54','2017-02-05 07:23:37');
/*!40000 ALTER TABLE `magazine_company_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_digital_transaction_table`
--

DROP TABLE IF EXISTS `magazine_digital_transaction_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_digital_transaction_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `month_id` tinyint(4) DEFAULT NULL,
  `week_id` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `mag_digital_price_id` int(11) DEFAULT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_digital_transaction_table`
--

LOCK TABLES `magazine_digital_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_digital_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_digital_transaction_table` VALUES (15,69,143,2,1,0,2017,NULL,1000.00,2,'2017-05-11 06:17:31','2017-05-11 06:17:31'),(16,69,143,2,2,0,2017,NULL,1000.00,2,'2017-05-11 06:17:35','2017-05-11 06:17:35'),(17,69,143,1,2,3,2017,NULL,500.00,2,'2017-05-11 06:17:49','2017-05-11 06:17:49'),(18,69,143,1,2,3,2018,NULL,500.00,2,'2017-05-11 06:18:09','2017-05-11 06:18:09');
/*!40000 ALTER TABLE `magazine_digital_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazine_issue_discount_table`
--

DROP TABLE IF EXISTS `magazine_issue_discount_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magazine_issue_discount_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `magazine_id` int(11) DEFAULT NULL,
  `percent` decimal(18,3) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_issue_discount_table`
--

LOCK TABLES `magazine_issue_discount_table` WRITE;
/*!40000 ALTER TABLE `magazine_issue_discount_table` DISABLE KEYS */;
INSERT INTO `magazine_issue_discount_table` VALUES (17,47,6.000,2,2,'2017-02-07 07:45:27','2017-01-31 02:21:38'),(18,45,2.000,2,2,'2017-02-04 01:29:14','2017-02-04 01:29:14'),(19,45,3.000,3,2,'2017-02-04 01:29:14','2017-02-04 01:29:14'),(20,45,4.000,4,2,'2017-02-04 01:29:14','2017-02-04 01:29:14'),(21,45,5.000,5,2,'2017-02-04 01:29:14','2017-02-04 01:29:14'),(22,48,2.000,2,2,'2017-02-04 03:38:16','2017-02-04 03:38:16'),(23,48,3.000,3,2,'2017-02-04 03:38:16','2017-02-04 03:38:16'),(24,48,4.000,4,2,'2017-02-04 03:38:16','2017-02-04 03:38:16'),(25,48,5.000,5,2,'2017-02-04 03:38:16','2017-02-04 03:38:16'),(26,52,5.000,2,2,'2017-02-05 08:55:41','2017-02-05 07:25:35'),(27,52,5.000,3,2,'2017-02-05 08:55:41','2017-02-05 07:25:35'),(28,52,15.000,4,2,'2017-02-05 08:55:41','2017-02-05 07:25:35'),(30,43,5.000,2,2,'2017-02-09 07:09:43','2017-02-09 07:09:43'),(31,43,10.000,3,2,'2017-02-09 07:09:43','2017-02-09 07:09:43'),(32,43,15.000,4,2,'2017-02-09 07:09:43','2017-02-09 07:09:43'),(33,53,5.000,2,2,'2017-02-09 07:13:24','2017-02-09 07:13:24'),(34,53,10.000,3,2,'2017-02-09 07:13:24','2017-02-09 07:13:24'),(35,53,15.000,4,2,'2017-02-09 07:13:24','2017-02-09 07:13:24'),(36,53,15.000,5,2,'2017-02-09 07:13:24','2017-02-09 07:13:24'),(37,54,5.000,2,2,'2017-02-15 08:45:00','2017-02-09 07:29:33'),(38,54,10.000,3,2,'2017-02-15 08:45:00','2017-02-09 07:29:33'),(39,54,15.000,4,2,'2017-02-15 08:45:00','2017-02-09 07:29:33'),(40,54,20.000,5,2,'2017-02-15 08:45:00','2017-02-09 07:29:33'),(41,55,5.000,2,2,'2017-02-12 16:38:38','2017-02-12 16:38:38'),(42,55,10.000,3,2,'2017-02-12 16:38:38','2017-02-12 16:38:38'),(43,55,15.000,4,2,'2017-02-12 16:38:38','2017-02-12 16:38:38'),(44,55,15.000,5,2,'2017-02-12 16:38:38','2017-02-12 16:38:38'),(45,56,5.000,2,2,'2017-02-13 08:11:34','2017-02-13 08:11:34'),(46,56,10.000,3,2,'2017-02-13 08:11:34','2017-02-13 08:11:34'),(47,56,15.000,4,2,'2017-02-13 08:11:34','2017-02-13 08:11:34'),(48,56,15.000,5,2,'2017-02-13 08:11:34','2017-02-13 08:11:34'),(49,57,5.000,2,2,'2017-02-14 07:14:26','2017-02-14 07:14:26'),(50,57,10.000,3,2,'2017-02-14 07:14:26','2017-02-14 07:14:26'),(51,57,15.000,4,2,'2017-02-14 07:14:26','2017-02-14 07:14:26'),(52,57,15.000,5,2,'2017-02-14 07:14:26','2017-02-14 07:14:26'),(53,58,5.000,2,2,'2017-02-14 07:16:40','2017-02-14 07:16:40'),(54,58,10.000,3,2,'2017-02-14 07:16:40','2017-02-14 07:16:40'),(55,58,15.000,4,2,'2017-02-14 07:16:40','2017-02-14 07:16:40'),(56,58,15.000,5,2,'2017-02-14 07:16:40','2017-02-14 07:16:40'),(57,59,5.000,2,2,'2017-02-15 06:27:53','2017-02-15 06:27:53'),(58,59,10.000,3,2,'2017-02-15 06:27:53','2017-02-15 06:27:53'),(59,59,15.000,4,2,'2017-02-15 06:27:53','2017-02-15 06:27:53'),(60,59,15.000,5,2,'2017-02-15 06:27:53','2017-02-15 06:27:53'),(61,60,5.000,2,2,'2017-02-15 06:43:26','2017-02-15 06:41:49'),(62,60,5.000,3,2,'2017-02-15 06:43:26','2017-02-15 06:41:49'),(63,60,15.000,4,2,'2017-02-15 06:43:26','2017-02-15 06:41:49'),(64,60,15.000,5,2,'2017-02-15 06:43:26','2017-02-15 06:41:49'),(65,62,5.000,2,2,'2017-02-16 05:37:44','2017-02-16 05:37:44'),(66,62,10.000,3,2,'2017-02-16 05:37:44','2017-02-16 05:37:44'),(67,62,15.000,4,2,'2017-02-16 05:37:44','2017-02-16 05:37:44'),(68,62,15.000,5,2,'2017-02-16 05:37:44','2017-02-16 05:37:44'),(69,63,5.000,3,2,'2017-02-16 11:24:06','2017-02-16 11:09:10'),(70,63,9.750,5,2,'2017-02-16 11:24:06','2017-02-16 11:09:10'),(71,63,5.000,4,2,'2017-02-16 11:24:06','2017-02-16 11:18:34'),(72,64,2.150,2,2,'2017-02-16 11:34:01','2017-02-16 11:31:47'),(73,64,10.000,3,2,'2017-02-16 11:34:01','2017-02-16 11:31:47'),(74,64,12.450,4,2,'2017-02-16 11:34:01','2017-02-16 11:31:47'),(75,64,12.450,5,2,'2017-02-16 11:34:01','2017-02-16 11:31:47'),(76,65,2.150,2,2,'2017-02-16 11:50:32','2017-02-16 11:38:14'),(77,65,10.000,3,2,'2017-02-16 11:50:32','2017-02-16 11:38:14'),(78,65,12.450,4,2,'2017-02-16 11:50:32','2017-02-16 11:38:14'),(79,65,12.450,5,2,'2017-02-16 11:50:32','2017-02-16 11:38:14'),(80,66,0.000,2,2,'2017-02-17 00:31:54','2017-02-17 00:03:39'),(81,66,0.000,3,2,'2017-02-17 00:31:56','2017-02-17 00:03:40'),(82,66,0.000,4,2,'2017-02-17 00:31:57','2017-02-17 00:03:41'),(83,66,0.000,5,2,'2017-02-17 00:31:57','2017-02-17 00:03:42'),(84,67,5.000,2,2,'2017-02-17 05:40:15','2017-02-17 05:04:54'),(85,67,10.000,3,2,'2017-02-17 05:40:16','2017-02-17 05:04:54'),(86,67,0.000,4,2,'2017-02-17 05:40:16','2017-02-17 05:04:54'),(87,67,15.000,5,2,'2017-02-17 05:40:18','2017-02-17 05:04:54'),(88,67,6.000,6,2,'2017-02-17 05:40:19','2017-02-17 05:40:19'),(89,67,7.000,7,2,'2017-02-17 05:40:20','2017-02-17 05:40:20'),(90,67,8.000,8,2,'2017-02-17 05:40:21','2017-02-17 05:40:21'),(91,67,9.000,9,2,'2017-02-17 05:40:22','2017-02-17 05:40:22'),(92,67,10.000,10,2,'2017-02-17 05:40:23','2017-02-17 05:40:23'),(93,67,11.000,11,2,'2017-02-17 05:40:24','2017-02-17 05:40:24'),(94,67,12.000,12,2,'2017-02-17 05:40:25','2017-02-17 05:40:25'),(95,68,5.000,3,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(96,68,5.000,4,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(97,68,5.000,5,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(98,68,10.000,6,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(99,68,10.000,7,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(100,68,10.000,8,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(101,68,15.000,9,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(102,68,15.000,10,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(103,68,15.000,11,2,'2017-02-18 17:11:48','2017-02-18 17:11:48'),(104,68,20.000,12,2,'2017-02-18 17:11:48','2017-02-18 17:11:48');
/*!40000 ALTER TABLE `magazine_issue_discount_table` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_issue_transaction_table`
--

LOCK TABLES `magazine_issue_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_issue_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_issue_transaction_table` VALUES (188,187,3,3,1,1,38,1000.00,3,'2017-02-13 21:56:09','2017-02-09 07:07:42'),(189,189,1,2,1,1,48,3000.00,2,'2017-02-09 07:19:49','2017-02-09 07:19:49'),(190,191,1,2,1,1,49,3000.00,2,'2017-02-09 07:33:57','2017-02-09 07:33:57'),(191,192,1,2,1,1,50,3000.00,3,'2017-02-13 22:02:04','2017-02-09 07:36:54'),(192,192,1,2,2,1,50,3000.00,2,'2017-02-09 07:37:48','2017-02-09 07:37:48'),(193,191,1,2,2,2,50,3000.00,2,'2017-02-09 07:46:40','2017-02-09 07:46:40'),(194,193,1,2,1,1,50,3000.00,2,'2017-02-09 07:51:51','2017-02-09 07:51:51'),(195,193,1,2,2,1,50,3000.00,2,'2017-02-09 07:52:14','2017-02-09 07:52:14'),(196,194,1,2,1,1,47,3000.00,2,'2017-02-12 16:11:33','2017-02-09 11:37:15'),(197,195,1,2,1,1,51,1000.00,2,'2017-02-12 16:54:39','2017-02-12 16:43:20'),(198,195,1,2,2,1,51,1000.00,2,'2017-02-12 16:44:23','2017-02-12 16:44:23'),(199,197,1,2,1,1,52,3000.00,2,'2017-02-13 08:18:55','2017-02-13 08:18:55'),(201,199,1,5,1,1,53,1500.00,3,'2017-02-14 07:32:28','2017-02-14 07:26:08'),(202,199,1,5,2,1,53,1500.00,2,'2017-02-14 07:26:17','2017-02-14 07:26:17'),(203,201,1,2,1,1,55,3000.00,2,'2017-02-15 06:44:55','2017-02-15 06:44:55'),(204,202,1,2,1,1,55,3000.00,3,'2017-02-15 06:49:54','2017-02-15 06:47:14'),(205,202,1,2,2,1,55,3000.00,2,'2017-02-15 06:47:26','2017-02-15 06:47:26'),(206,196,1,2,1,1,52,3000.00,2,'2017-02-15 07:00:31','2017-02-15 07:00:31'),(207,203,1,2,1,1,64,3000.00,3,'2017-02-16 05:43:51','2017-02-16 05:38:38'),(208,203,1,2,2,1,64,3000.00,2,'2017-02-16 05:38:55','2017-02-16 05:38:55'),(209,204,1,2,1,1,65,1831.07,2,'2017-02-16 11:14:49','2017-02-16 11:14:49'),(210,204,1,2,2,1,65,1831.07,2,'2017-02-16 11:15:14','2017-02-16 11:15:14'),(211,205,1,2,1,1,65,1831.07,2,'2017-02-16 11:19:05','2017-02-16 11:19:05'),(217,206,1,2,1,1,69,1873.37,3,'2017-02-17 02:31:03','2017-02-16 11:51:03'),(218,206,1,2,2,1,69,1873.37,3,'2017-02-17 02:35:06','2017-02-16 11:51:19'),(219,206,1,2,3,1,69,1873.37,3,'2017-02-17 03:27:55','2017-02-16 11:52:40'),(220,206,1,2,4,1,69,1873.37,2,'2017-02-17 02:21:17','2017-02-16 11:52:50'),(221,207,1,2,1,1,71,3000.00,2,'2017-02-18 17:12:44','2017-02-18 17:12:44'),(222,207,1,2,2,1,71,3000.00,2,'2017-02-18 17:12:53','2017-02-18 17:12:53'),(223,207,1,2,3,1,71,3000.00,2,'2017-02-18 17:13:09','2017-02-18 17:13:09'),(224,208,1,2,1,1,71,3000.00,3,'2017-02-18 17:36:23','2017-02-18 17:16:51'),(225,208,1,2,2,1,71,3000.00,3,'2017-02-18 17:36:48','2017-02-18 17:17:00'),(226,210,1,4,1,1,33,3500.00,2,'2017-05-03 07:09:48','2017-05-03 07:09:48');
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
  `magazine_type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_table`
--

LOCK TABLES `magazine_table` WRITE;
/*!40000 ALTER TABLE `magazine_table` DISABLE KEYS */;
INSERT INTO `magazine_table` VALUES (41,'201612271259586204C77A9BC',6,'paopao-magazine','Paopao Magazine',2018,2,1,1,1,'2017-01-02 04:27:25','2016-12-21 09:03:47'),(42,'201701030141586BC3DD4C062',11,'college-magazine','COLLEGE MAGAZINE',2017,4,1,1,2,'2017-01-03 15:32:20','2017-01-03 15:32:20'),(43,'201701030125586BC69DF2E4B',12,'think','Think Big',2017,4,2,1,2,'2017-01-03 15:44:54','2017-01-03 15:44:54'),(44,'201701030101586BE31DB172E',13,'pile-driver','Pile Driver',2017,6,1,1,2,'2017-01-03 17:47:07','2017-01-03 17:47:07'),(45,'2017010901495873A295870A9',12,'piling-canada','Piling Canada',2017,4,2,1,2,'2017-01-09 06:53:45','2017-01-09 06:53:45'),(46,'2017011301355878B65F99CDB',13,'march-magazine','March Magazine',2017,2,1,1,2,'2017-01-13 03:14:03','2017-01-13 03:14:03'),(47,'20170122013258855CF4BB04F',16,'baby-magazine','Baby Magazine',2018,2,1,1,2,'2017-01-22 17:32:57','2017-01-22 17:32:57'),(48,'2017012201475885867F75E9C',17,'beer-magazine','Beer Magazine',2017,1,2,1,2,'2017-01-22 20:29:37','2017-01-22 20:29:37'),(49,'2017012301245886C9608AFE3',16,'scorpions','Scorpions',2020,1,1,1,2,'2017-01-23 19:26:48','2017-01-23 19:26:48'),(50,'2017012501005888D0A8DF961',13,'snow-grooming','Snow Grooming',2017,3,1,1,2,'2017-01-25 08:25:52','2017-01-25 08:25:52'),(51,'201701260139588A273B15455',12,'it\'s-toronto','It\'s Toronto',2017,6,2,1,2,'2017-01-26 08:44:26','2017-01-26 08:44:26'),(52,'201702050200589743904BFF3',18,'digimag','DigiMag',2017,4,2,1,2,'2017-02-05 07:24:53','2017-02-05 07:24:53'),(53,'201702090210589C86CABB4B4',12,'its-toronto','Its Toronto',2017,6,2,1,2,'2017-02-09 07:12:59','2017-02-09 07:12:59'),(54,'201702090228589C89E83F9E8',13,'austin','Austin',2017,6,1,1,2,'2017-02-09 07:27:04','2017-02-09 07:27:04'),(55,'20170212020958A0FFB523F0A',12,'its-vancouver','its vancouver',2017,6,2,1,2,'2017-02-12 16:38:06','2017-02-12 16:38:06'),(56,'20170213021158A1D26BA4CF8',12,'shca-think-big','shca think big',2017,4,2,1,2,'2017-02-13 08:11:13','2017-02-13 08:11:13'),(57,'20170214020558A31E45E143E',12,'its-montreal','Its Montreal',2017,1,2,1,1,'2017-02-14 07:13:15','2017-02-14 07:13:15'),(58,'20170214024558A31F21336A0',12,'its-regina','Its Regina',2017,6,2,1,2,'2017-02-14 07:16:24','2017-02-14 07:16:24'),(59,'20170215025058A464B27A60D',12,'its-alberta','Its Alberta',2017,6,2,1,2,'2017-02-15 06:27:32','2017-02-15 06:27:32'),(60,'20170215022258A467A28D02C',12,'it\'s-sask','It\'s Sask',2017,6,2,1,2,'2017-02-15 06:39:06','2017-02-15 06:39:06'),(61,'20170216024658A5AA3A80442',12,'it\'s-kenora','It\'s Kenora',2017,1,2,1,1,'2017-02-16 05:34:43','2017-02-16 05:34:43'),(62,'20170216025958A5AABF4C4E4',12,'agri-magazine','Agri Magazine',2017,4,2,1,2,'2017-02-16 05:37:13','2017-02-16 05:37:13'),(63,'20170216020858A5F7306DAB4',13,'true-pile-driver','True Pile Driver',2017,6,1,1,2,'2017-02-16 11:07:55','2017-02-16 11:07:55'),(64,'20170216024358A5FD2F2E71C',12,'a-think-big-magazine','A Think Big Magazine',2017,1,2,1,1,'2017-02-16 11:28:02','2017-02-16 11:28:02'),(65,'20170216021758A5FF6DC6F79',12,'true-think-big-magazine','True Think Big Magazine',2017,4,2,1,2,'2017-02-16 11:37:40','2017-02-16 11:37:40'),(66,'20170216023458A608A26468F',13,'a1-pile-driver','A1 Pile Driver',2017,6,1,1,2,'2017-02-16 12:18:24','2017-02-16 12:18:24'),(67,'20170217021058A6F48E762AF',12,'healthy-living','Healthy Living',2017,1,2,1,1,'2017-02-17 05:04:20','2017-02-17 05:04:20'),(68,'20170218022658A8F082E1FEB',12,'it\'s-yukon','It\'s Yukon',2017,6,2,1,2,'2017-02-18 17:11:01','2017-02-18 17:11:01'),(69,'20170424040058FDA540F3473',12,'sample-king','sample-king',2017,0,2,2,2,'2017-04-24 00:12:15','2017-04-24 00:12:15'),(70,'20170424043458FDF6F2698F7',12,'dfgdfg','dfgdfg',2017,0,2,2,2,'2017-04-24 06:00:46','2017-04-24 06:00:46');
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
) ENGINE=InnoDB AUTO_INCREMENT=226 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_transaction_table`
--

LOCK TABLES `magazine_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_transaction_table` VALUES (187,46,192,'2017-02-09 07:07:17','2017-02-09 07:07:17'),(188,43,193,'2017-02-09 07:07:47','2017-02-09 07:07:47'),(189,53,194,'2017-02-09 07:19:33','2017-02-09 07:19:33'),(190,54,195,'2017-02-09 07:30:53','2017-02-09 07:30:53'),(191,54,196,'2017-02-09 07:33:45','2017-02-09 07:33:45'),(192,54,197,'2017-02-09 07:36:40','2017-02-09 07:36:40'),(193,54,198,'2017-02-09 07:51:35','2017-02-09 07:51:35'),(194,43,200,'2017-02-09 11:36:03','2017-02-09 11:36:03'),(195,55,201,'2017-02-12 16:43:06','2017-02-12 16:43:06'),(196,56,202,'2017-02-13 08:17:05','2017-02-13 08:17:05'),(197,56,203,'2017-02-13 08:18:41','2017-02-13 08:18:41'),(198,58,205,'2017-02-14 07:16:58','2017-02-14 07:16:58'),(199,58,206,'2017-02-14 07:24:30','2017-02-14 07:24:30'),(200,59,207,'2017-02-15 06:28:22','2017-02-15 06:28:22'),(201,60,208,'2017-02-15 06:44:42','2017-02-15 06:44:42'),(202,60,209,'2017-02-15 06:47:04','2017-02-15 06:47:04'),(203,62,210,'2017-02-16 05:38:26','2017-02-16 05:38:26'),(204,63,211,'2017-02-16 11:14:32','2017-02-16 11:14:32'),(205,63,212,'2017-02-16 11:18:53','2017-02-16 11:18:53'),(206,65,217,'2017-02-16 11:50:53','2017-02-16 11:50:53'),(207,68,218,'2017-02-18 17:12:36','2017-02-18 17:12:36'),(208,68,219,'2017-02-18 17:16:42','2017-02-18 17:16:42'),(209,69,220,'2017-05-03 06:52:10','2017-05-03 06:52:10'),(210,42,221,'2017-05-03 07:09:43','2017-05-03 07:09:43'),(211,69,222,'2017-05-03 09:12:39','2017-05-03 09:12:39'),(212,69,225,'2017-05-06 23:59:59','2017-05-06 23:59:59'),(213,69,226,'2017-05-09 17:44:47','2017-05-09 17:44:47'),(214,69,227,'2017-05-09 17:45:40','2017-05-09 17:45:40'),(215,70,228,'2017-05-09 17:45:52','2017-05-09 17:45:52'),(216,69,231,'2017-05-09 04:15:12','2017-05-09 04:15:12'),(217,70,232,'2017-05-09 04:15:41','2017-05-09 04:15:41'),(218,69,233,'2017-05-09 04:15:52','2017-05-09 04:15:52'),(219,69,234,'2017-05-09 04:28:38','2017-05-09 04:28:38'),(220,69,235,'2017-05-09 04:30:25','2017-05-09 04:30:25'),(221,69,236,'2017-05-09 04:47:21','2017-05-09 04:47:21'),(222,69,237,'2017-05-09 04:48:15','2017-05-09 04:48:15'),(223,69,238,'2017-05-09 05:37:26','2017-05-09 05:37:26'),(224,51,239,'2017-05-11 14:27:08','2017-05-11 14:27:08'),(225,69,240,'2017-05-11 02:58:43','2017-05-11 02:58:43');
/*!40000 ALTER TABLE `magazine_transaction_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magzine_digital_price_table`
--

DROP TABLE IF EXISTS `magzine_digital_price_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magzine_digital_price_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `mag_id` int(11) DEFAULT NULL,
  `ad_type` varchar(60) DEFAULT NULL,
  `ad_size` varchar(60) DEFAULT NULL,
  `ad_amount` decimal(18,2) DEFAULT NULL,
  `ad_issue` tinyint(4) DEFAULT NULL,
  `ad_status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_digital_price_table`
--

LOCK TABLES `magzine_digital_price_table` WRITE;
/*!40000 ALTER TABLE `magzine_digital_price_table` DISABLE KEYS */;
INSERT INTO `magzine_digital_price_table` VALUES (1,69,'Leaderboard ','468x60',500.00,2,2,'2017-05-03 06:51:29','2017-05-03 06:51:29'),(2,69,'Leaderboard ','450x230',1000.00,1,2,'2017-05-03 09:13:27','2017-05-03 09:13:27');
/*!40000 ALTER TABLE `magzine_digital_price_table` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=270 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_discount_table`
--

LOCK TABLES `magzine_discount_table` WRITE;
/*!40000 ALTER TABLE `magzine_discount_table` DISABLE KEYS */;
INSERT INTO `magzine_discount_table` VALUES (106,33,0.050,2,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(107,33,0.100,3,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(108,33,0.150,4,2,'2017-01-03 15:34:16','2017-01-03 15:34:16'),(109,33,0.000,5,2,'2017-01-03 15:34:16','2017-01-03 15:34:16'),(110,34,0.050,2,2,'2017-01-03 15:45:24','2017-01-03 15:45:24'),(111,34,0.100,3,2,'2017-01-03 15:45:24','2017-01-03 15:45:24'),(112,34,0.150,4,2,'2017-01-03 15:45:25','2017-01-03 15:45:25'),(113,34,0.000,5,2,'2017-01-03 15:45:25','2017-01-03 15:45:25'),(114,35,0.050,2,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(115,35,0.100,3,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(116,35,0.150,4,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(117,35,0.000,5,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(118,36,0.050,2,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(119,36,0.100,3,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(120,36,0.150,4,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(121,36,0.000,5,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(122,37,0.050,2,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(123,37,0.100,3,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(124,37,0.150,4,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(125,37,0.000,5,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(126,38,0.020,2,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(127,38,0.030,3,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(128,38,0.040,4,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(129,38,0.000,5,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(130,39,0.020,2,2,'2017-01-22 17:37:16','2017-01-22 17:37:16'),(131,39,0.000,3,2,'2017-01-22 17:37:16','2017-01-22 17:37:16'),(132,39,0.000,4,2,'2017-01-22 17:37:16','2017-01-22 17:37:16'),(133,39,0.000,5,2,'2017-01-22 17:37:16','2017-01-22 17:37:16'),(134,40,0.020,2,2,'2017-01-22 20:56:14','2017-01-22 20:56:14'),(135,40,0.030,3,2,'2017-01-22 20:56:14','2017-01-22 20:56:14'),(136,40,0.040,4,2,'2017-01-22 20:56:14','2017-01-22 20:56:14'),(137,40,0.050,5,2,'2017-01-22 20:56:14','2017-01-22 20:56:14'),(138,41,0.020,2,2,'2017-01-23 19:27:07','2017-01-23 19:27:07'),(139,41,0.000,3,2,'2017-01-23 19:27:07','2017-01-23 19:27:07'),(140,41,0.000,4,2,'2017-01-23 19:27:07','2017-01-23 19:27:07'),(141,41,0.000,5,2,'2017-01-23 19:27:07','2017-01-23 19:27:07'),(142,42,0.020,2,2,'2017-01-23 19:27:18','2017-01-23 19:27:18'),(143,42,0.000,3,2,'2017-01-23 19:27:18','2017-01-23 19:27:18'),(144,42,0.000,4,2,'2017-01-23 19:27:18','2017-01-23 19:27:18'),(145,42,0.000,5,2,'2017-01-23 19:27:18','2017-01-23 19:27:18'),(146,43,0.020,2,2,'2017-01-23 19:27:36','2017-01-23 19:27:36'),(147,43,0.000,3,2,'2017-01-23 19:27:36','2017-01-23 19:27:36'),(148,43,0.000,4,2,'2017-01-23 19:27:36','2017-01-23 19:27:36'),(149,43,0.000,5,2,'2017-01-23 19:27:36','2017-01-23 19:27:36'),(150,44,0.020,2,2,'2017-01-23 19:28:05','2017-01-23 19:28:05'),(151,44,0.000,3,2,'2017-01-23 19:28:05','2017-01-23 19:28:05'),(152,44,0.000,4,2,'2017-01-23 19:28:05','2017-01-23 19:28:05'),(153,44,0.000,5,2,'2017-01-23 19:28:05','2017-01-23 19:28:05'),(154,45,0.050,2,2,'2017-01-25 08:26:21','2017-01-25 08:26:21'),(155,45,0.100,3,2,'2017-01-25 08:26:21','2017-01-25 08:26:21'),(156,45,0.150,4,2,'2017-01-25 08:26:21','2017-01-25 08:26:21'),(157,45,0.000,5,2,'2017-01-25 08:26:21','2017-01-25 08:26:21'),(158,46,0.050,2,2,'2017-01-26 08:45:54','2017-01-26 08:45:54'),(159,46,0.100,3,2,'2017-01-26 08:45:54','2017-01-26 08:45:54'),(160,46,0.150,4,2,'2017-01-26 08:45:54','2017-01-26 08:45:54'),(161,46,0.000,5,2,'2017-01-26 08:45:54','2017-01-26 08:45:54'),(162,47,0.020,2,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(163,47,0.000,3,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(164,47,0.000,4,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(165,47,0.000,5,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(166,47,0.000,6,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(167,47,0.000,7,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(168,47,0.000,8,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(169,47,0.000,9,2,'2017-01-30 22:40:56','2017-01-30 22:40:56'),(170,47,0.000,2,2,'2017-02-09 07:10:00','2017-02-09 07:10:00'),(171,47,0.000,3,2,'2017-02-09 07:10:00','2017-02-09 07:10:00'),(172,47,0.000,4,2,'2017-02-09 07:10:00','2017-02-09 07:10:00'),(173,47,0.000,5,2,'2017-02-09 07:10:00','2017-02-09 07:10:00'),(174,48,0.000,2,2,'2017-02-09 07:13:33','2017-02-09 07:13:33'),(175,48,0.000,3,2,'2017-02-09 07:13:33','2017-02-09 07:13:33'),(176,48,0.000,4,2,'2017-02-09 07:13:33','2017-02-09 07:13:33'),(177,48,0.000,5,2,'2017-02-09 07:13:33','2017-02-09 07:13:33'),(178,49,0.000,2,2,'2017-02-09 07:32:36','2017-02-09 07:32:36'),(179,49,0.000,3,2,'2017-02-09 07:32:36','2017-02-09 07:32:36'),(180,49,0.000,4,2,'2017-02-09 07:32:36','2017-02-09 07:32:36'),(181,49,0.000,5,2,'2017-02-09 07:32:36','2017-02-09 07:32:36'),(182,50,0.010,2,2,'2017-02-09 07:36:03','2017-02-09 07:36:03'),(183,50,0.000,3,2,'2017-02-09 07:36:03','2017-02-09 07:36:03'),(184,50,0.000,4,2,'2017-02-09 07:36:03','2017-02-09 07:36:03'),(185,50,0.000,5,2,'2017-02-09 07:36:03','2017-02-09 07:36:03'),(186,51,0.010,2,2,'2017-02-12 16:39:39','2017-02-12 16:39:39'),(187,51,0.000,3,2,'2017-02-12 16:39:39','2017-02-12 16:39:39'),(188,51,0.000,4,2,'2017-02-12 16:39:39','2017-02-12 16:39:39'),(189,51,0.000,5,2,'2017-02-12 16:39:39','2017-02-12 16:39:39'),(190,52,0.000,2,2,'2017-02-13 08:18:15','2017-02-13 08:18:15'),(191,52,0.000,3,2,'2017-02-13 08:18:15','2017-02-13 08:18:15'),(192,52,0.000,4,2,'2017-02-13 08:18:15','2017-02-13 08:18:15'),(193,52,0.000,5,2,'2017-02-13 08:18:15','2017-02-13 08:18:15'),(194,53,0.000,2,2,'2017-02-14 07:23:35','2017-02-14 07:23:35'),(195,53,0.000,3,2,'2017-02-14 07:23:35','2017-02-14 07:23:35'),(196,53,0.000,4,2,'2017-02-14 07:23:35','2017-02-14 07:23:35'),(197,53,0.000,5,2,'2017-02-14 07:23:35','2017-02-14 07:23:35'),(198,54,0.000,2,2,'2017-02-15 06:33:10','2017-02-15 06:33:10'),(199,54,0.000,3,2,'2017-02-15 06:33:10','2017-02-15 06:33:10'),(200,54,0.000,4,2,'2017-02-15 06:33:10','2017-02-15 06:33:10'),(201,54,0.000,5,2,'2017-02-15 06:33:10','2017-02-15 06:33:10'),(202,55,0.000,2,2,'2017-02-15 06:39:45','2017-02-15 06:39:45'),(203,55,0.000,3,2,'2017-02-15 06:39:45','2017-02-15 06:39:45'),(204,55,0.000,4,2,'2017-02-15 06:39:46','2017-02-15 06:39:46'),(205,55,0.000,5,2,'2017-02-15 06:39:46','2017-02-15 06:39:46'),(206,56,0.000,2,2,'2017-02-15 06:43:53','2017-02-15 06:43:53'),(207,56,0.000,3,2,'2017-02-15 06:43:53','2017-02-15 06:43:53'),(208,56,0.000,4,2,'2017-02-15 06:43:53','2017-02-15 06:43:53'),(209,56,0.000,5,2,'2017-02-15 06:43:53','2017-02-15 06:43:53'),(210,57,0.020,2,2,'2017-02-15 06:59:23','2017-02-15 06:59:23'),(211,57,0.030,3,2,'2017-02-15 06:59:23','2017-02-15 06:59:23'),(212,57,0.040,4,2,'2017-02-15 06:59:23','2017-02-15 06:59:23'),(213,57,0.050,5,2,'2017-02-15 06:59:23','2017-02-15 06:59:23'),(214,58,0.020,2,2,'2017-02-15 07:22:14','2017-02-15 07:22:14'),(215,58,0.000,3,2,'2017-02-15 07:22:14','2017-02-15 07:22:14'),(216,58,0.050,4,2,'2017-02-15 07:22:15','2017-02-15 07:22:15'),(217,58,0.000,5,2,'2017-02-15 07:22:15','2017-02-15 07:22:15'),(218,59,0.020,2,2,'2017-02-15 07:23:10','2017-02-15 07:23:10'),(219,59,0.000,3,2,'2017-02-15 07:23:10','2017-02-15 07:23:10'),(220,59,0.050,4,2,'2017-02-15 07:23:11','2017-02-15 07:23:11'),(221,59,0.000,5,2,'2017-02-15 07:23:11','2017-02-15 07:23:11'),(222,60,0.020,2,2,'2017-02-15 07:24:09','2017-02-15 07:24:09'),(223,60,0.000,3,2,'2017-02-15 07:24:10','2017-02-15 07:24:10'),(224,60,0.050,4,2,'2017-02-15 07:24:11','2017-02-15 07:24:11'),(225,60,0.000,5,2,'2017-02-15 07:24:11','2017-02-15 07:24:11'),(226,61,0.020,2,2,'2017-02-15 07:24:37','2017-02-15 07:24:37'),(227,61,0.000,3,2,'2017-02-15 07:24:38','2017-02-15 07:24:38'),(228,61,0.050,4,2,'2017-02-15 07:24:38','2017-02-15 07:24:38'),(229,61,0.000,5,2,'2017-02-15 07:24:39','2017-02-15 07:24:39'),(230,62,0.020,2,2,'2017-02-15 07:39:10','2017-02-15 07:39:10'),(231,62,0.030,3,2,'2017-02-15 07:39:11','2017-02-15 07:39:11'),(232,62,0.040,4,2,'2017-02-15 07:39:12','2017-02-15 07:39:12'),(233,62,0.050,5,2,'2017-02-15 07:39:13','2017-02-15 07:39:13'),(234,63,0.020,2,2,'2017-02-15 07:43:32','2017-02-15 07:43:32'),(235,63,0.030,3,2,'2017-02-15 07:43:32','2017-02-15 07:43:32'),(236,63,0.040,4,2,'2017-02-15 07:43:33','2017-02-15 07:43:33'),(237,63,0.050,5,2,'2017-02-15 07:43:33','2017-02-15 07:43:33'),(238,64,0.000,2,2,'2017-02-16 05:37:51','2017-02-16 05:37:51'),(239,64,0.000,3,2,'2017-02-16 05:37:51','2017-02-16 05:37:51'),(240,64,0.000,4,2,'2017-02-16 05:37:51','2017-02-16 05:37:51'),(241,64,0.000,5,2,'2017-02-16 05:37:51','2017-02-16 05:37:51'),(242,65,0.000,2,2,'2017-02-16 11:09:13','2017-02-16 11:09:13'),(243,65,0.000,3,2,'2017-02-16 11:09:13','2017-02-16 11:09:13'),(244,65,0.000,4,2,'2017-02-16 11:09:13','2017-02-16 11:09:13'),(245,65,0.000,5,2,'2017-02-16 11:09:13','2017-02-16 11:09:13'),(246,66,0.000,2,2,'2017-02-16 11:31:50','2017-02-16 11:31:50'),(247,66,0.000,3,2,'2017-02-16 11:31:50','2017-02-16 11:31:50'),(248,66,0.000,4,2,'2017-02-16 11:31:50','2017-02-16 11:31:50'),(249,66,0.000,5,2,'2017-02-16 11:31:50','2017-02-16 11:31:50'),(250,67,0.000,2,2,'2017-02-16 11:33:42','2017-02-16 11:33:42'),(251,67,0.000,3,2,'2017-02-16 11:33:42','2017-02-16 11:33:42'),(252,67,0.000,4,2,'2017-02-16 11:33:42','2017-02-16 11:33:42'),(253,67,0.000,5,2,'2017-02-16 11:33:42','2017-02-16 11:33:42'),(254,68,0.000,2,2,'2017-02-16 11:38:17','2017-02-16 11:38:17'),(255,68,0.000,3,2,'2017-02-16 11:38:17','2017-02-16 11:38:17'),(256,68,0.000,4,2,'2017-02-16 11:38:17','2017-02-16 11:38:17'),(257,68,0.000,5,2,'2017-02-16 11:38:18','2017-02-16 11:38:18'),(258,69,0.000,2,2,'2017-02-16 11:39:41','2017-02-16 11:39:41'),(259,69,0.000,3,2,'2017-02-16 11:39:41','2017-02-16 11:39:41'),(260,69,0.000,4,2,'2017-02-16 11:39:42','2017-02-16 11:39:42'),(261,69,0.000,5,2,'2017-02-16 11:39:42','2017-02-16 11:39:42'),(262,70,0.000,2,2,'2017-02-17 05:04:44','2017-02-17 05:04:44'),(263,70,0.000,3,2,'2017-02-17 05:04:44','2017-02-17 05:04:44'),(264,70,0.000,4,2,'2017-02-17 05:04:44','2017-02-17 05:04:44'),(265,70,0.000,5,2,'2017-02-17 05:04:44','2017-02-17 05:04:44'),(266,71,0.000,2,2,'2017-02-18 17:11:51','2017-02-18 17:11:51'),(267,71,0.000,3,2,'2017-02-18 17:11:51','2017-02-18 17:11:51'),(268,71,0.000,4,2,'2017-02-18 17:11:51','2017-02-18 17:11:51'),(269,71,0.000,5,2,'2017-02-18 17:11:51','2017-02-18 17:11:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_price_table`
--

LOCK TABLES `magzine_price_table` WRITE;
/*!40000 ALTER TABLE `magzine_price_table` DISABLE KEYS */;
INSERT INTO `magzine_price_table` VALUES (33,42,'1','4',3500.00,2,'2017-01-03 15:34:15','2017-01-03 15:34:15'),(35,44,'1','2',3000.00,2,'2017-01-03 17:48:05','2017-01-03 17:48:05'),(36,44,'1','5',1500.00,2,'2017-01-03 17:49:50','2017-01-03 17:49:50'),(37,45,'1','2',3000.00,2,'2017-01-09 06:56:20','2017-01-09 06:56:20'),(38,46,'3','3',1000.00,2,'2017-01-13 03:14:22','2017-01-13 03:14:22'),(39,47,'1','3',2500.00,2,'2017-01-22 17:37:16','2017-01-22 17:37:16'),(40,48,'1','2',3000.00,2,'2017-01-22 20:56:14','2017-01-22 20:56:14'),(41,49,'1','3',1500.00,2,'2017-01-23 19:27:07','2017-01-23 19:27:07'),(42,49,'2','2',1230.00,2,'2017-01-23 19:27:17','2017-01-23 19:27:17'),(45,50,'1','2',1000.00,2,'2017-01-25 08:26:21','2017-01-25 08:26:21'),(46,51,'1','2',1000.00,2,'2017-01-26 08:45:54','2017-01-26 08:45:54'),(47,43,'1','2',3000.00,2,'2017-02-09 07:10:00','2017-02-09 07:10:00'),(48,53,'1','2',3000.00,2,'2017-02-09 07:13:33','2017-02-09 07:13:33'),(50,54,'1','2',3000.00,2,'2017-02-09 07:36:03','2017-02-09 07:36:03'),(51,55,'1','2',1000.00,2,'2017-02-12 16:39:39','2017-02-12 16:39:39'),(52,56,'1','2',3000.00,2,'2017-02-13 08:18:15','2017-02-13 08:18:15'),(53,58,'1','5',1500.00,2,'2017-02-14 07:23:35','2017-02-14 07:23:35'),(54,59,'1','2',3000.00,2,'2017-02-15 06:33:10','2017-02-15 06:33:10'),(55,60,'1','2',3000.00,2,'2017-02-15 06:39:45','2017-02-15 06:39:45'),(56,60,'2','2',2000.00,2,'2017-02-15 06:43:53','2017-02-15 06:43:53'),(57,52,'2','2',2000.00,2,'2017-02-15 06:59:23','2017-02-15 06:59:23'),(58,54,'2','3',3400.00,2,'2017-02-15 07:22:11','2017-02-15 07:22:11'),(64,62,'1','2',3000.00,2,'2017-02-16 05:37:51','2017-02-16 05:37:51'),(65,63,'1','2',1831.07,2,'2017-02-16 11:09:13','2017-02-16 11:09:13'),(67,64,'1','2',1837.37,2,'2017-02-16 11:33:42','2017-02-16 11:33:42'),(69,65,'1','2',1873.37,2,'2017-02-16 11:39:41','2017-02-16 11:39:41'),(70,67,'1','2',3000.00,2,'2017-02-17 05:04:44','2017-02-17 05:04:44'),(71,68,'1','2',3000.00,2,'2017-02-18 17:11:51','2017-02-18 17:11:51');
/*!40000 ALTER TABLE `magzine_price_table` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes_table`
--

DROP TABLE IF EXISTS `notes_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes_table` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `book_trans` varchar(60) DEFAULT NULL,
  `sales_rep` int(11) DEFAULT NULL,
  `notes` text,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes_table`
--

LOCK TABLES `notes_table` WRITE;
/*!40000 ALTER TABLE `notes_table` DISABLE KEYS */;
INSERT INTO `notes_table` VALUES (3,'1702MX8696',2,'This is note 1',2,'2017-02-19 09:32:44','2017-02-19 09:32:44'),(4,'1702MX8696',2,'This is note 2',2,'2017-02-19 09:33:02','2017-02-19 09:33:02'),(5,'1702IS1094',2,'Yes again',2,'2017-02-19 09:33:14','2017-02-19 09:33:14'),(6,'1702MX8696',2,'Hey',2,'2017-02-19 09:33:45','2017-02-19 09:33:45'),(7,'1702MX8696',2,'This is note 3',2,'2017-02-19 09:34:13','2017-02-19 09:34:13'),(8,'1702MX8696',2,'This is note 4',2,'2017-02-19 09:38:38','2017-02-19 09:38:38'),(9,'1702MX8696',2,'This is note 5',2,'2017-02-19 09:38:45','2017-02-19 09:38:45'),(10,'1702MX8696',2,'This is note 6',2,'2017-02-19 09:38:48','2017-02-19 09:38:48'),(11,'1702MX8696',2,'This is note 7',2,'2017-02-19 09:38:53','2017-02-19 09:38:53'),(12,'1702MX8696',2,'This is note 7',2,'2017-02-19 09:58:32','2017-02-19 09:58:32'),(13,'1702WD7089',2,'Check this out!',2,'2017-02-19 10:21:16','2017-02-19 10:21:16'),(14,'1702DK8329',1,'qewqe',2,'2017-02-19 19:12:42','2017-02-19 19:12:42');
/*!40000 ALTER TABLE `notes_table` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications_table`
--

LOCK TABLES `notifications_table` WRITE;
/*!40000 ALTER TABLE `notifications_table` DISABLE KEYS */;
INSERT INTO `notifications_table` VALUES (57,1,1,-1,NULL,'gives 2% discretionary discount.','/booking/add_issue/187/147',NULL,2,'2017-02-09 07:07:49','2017-02-09 07:07:49'),(58,1,1,1,NULL,'ok','/booking/add_issue/187/147',NULL,1,'2017-02-09 07:10:11','2017-02-09 07:10:11'),(59,1,2,-1,NULL,'gives 10% discretionary discount.','/booking/add_issue/192/148',NULL,2,'2017-02-09 07:39:17','2017-02-09 07:39:17'),(60,2,1,2,NULL,'easdfsdf','/booking/add_issue/192/148',NULL,2,'2017-02-09 07:40:13','2017-02-09 07:40:13'),(61,1,2,-1,NULL,'gives 10% discretionary discount.','/booking/add_issue/194/129',NULL,2,'2017-02-09 11:38:06','2017-02-09 11:38:06'),(62,2,1,2,NULL,'ok','/booking/add_issue/194/129',NULL,2,'2017-02-09 11:39:01','2017-02-09 11:39:01'),(63,1,2,-1,NULL,'gives 10% discretionary discount.','/booking/add_issue/201/150',NULL,2,'2017-02-15 06:45:08','2017-02-15 06:45:08'),(64,2,1,2,NULL,'sdfsdf','/booking/add_issue/201/150',NULL,2,'2017-02-15 06:45:26','2017-02-15 06:45:26'),(65,1,2,-1,NULL,'gives 10% discretionary discount.','/booking/add_issue/203/150',NULL,2,'2017-02-16 05:39:20','2017-02-16 05:39:20'),(66,2,1,2,NULL,'okay','/booking/add_issue/203/150',NULL,2,'2017-02-16 05:41:16','2017-02-16 05:41:16'),(67,1,2,-1,NULL,'gives 10% discretionary discount.','/booking/add_issue/206/151',NULL,2,'2017-02-16 11:58:54','2017-02-16 11:58:54'),(68,2,1,2,NULL,'Okay','/booking/add_issue/206/151',NULL,2,'2017-02-16 12:01:23','2017-02-16 12:01:23');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_transaction_table`
--

LOCK TABLES `payment_transaction_table` WRITE;
/*!40000 ALTER TABLE `payment_transaction_table` DISABLE KEYS */;
INSERT INTO `payment_transaction_table` VALUES (9,'2017-05624',197,'5567',3,'2014-03-03 22:00:00',800.00,'redsf',2,2,'2017-02-12 17:12:03','2017-02-12 17:12:03'),(10,'2017-03293',188,'test 1',1,'2014-03-03 08:00:00',100.00,'test 2',2,2,'2017-02-12 23:13:23','2017-02-12 23:13:23');
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
  `package_size` varchar(45) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_package_table`
--

LOCK TABLES `price_package_table` WRITE;
/*!40000 ALTER TABLE `price_package_table` DISABLE KEYS */;
INSERT INTO `price_package_table` VALUES (1,'1/8 HORIZONTAL','1_8_HORIZONTAL',2),(2,'1/8 VERTICAL','1_8_VERTICAL',2),(3,'1/6 HORIZONTAL','1_6_HORIZONTAL',2),(4,'1/6 VERTICAL','1_6_VERTICAL',2),(5,'1/4 HORIZONTAL','1_4_HORIZONTAL',2),(6,'1/4 VERTICAL','1_4_VERTICAL',2),(7,'1/4 BANNER','1_4_BANNER',2),(8,'1/3 SQUARE','1_3_SQUARE',2),(9,'1/3 HORIZONTAL','1_3_HORIZONTAL',2),(10,'1/3 VERTICAL','1_3_VERTICAL',2),(11,'1/2 HORIZONTAL','1_2_HORIZONTAL',2),(12,'1/2 LONG VERTICAL','1_2_LONG_VERTICAL',2),(13,'1/2 VERTICAL ISLAND','1_2_VERTICAL_ISLAND',2),(14,'1/2 DOUBLE SPREED','1_2_DOUBLE_SPREED',2),(15,'2/3 HORIZONTAL','2_3_HORIZONTAL',2),(16,'2/3 VERTICAL','2_3_VERTICAL',2),(17,'FULL DOUBLE SPREED','FULL_DOUBLE_SPREED',2),(18,'FULL BLEEDS','FULL_BLEEDS',2),(19,'FULL','FULL',2);
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
  `mobile` varchar(25) DEFAULT NULL,
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-11 23:35:05
