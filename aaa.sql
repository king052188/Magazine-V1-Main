CREATE DATABASE  IF NOT EXISTS `db_magazine_v1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_magazine_v1`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: db_magazine_v1
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
  `status` tinyint(45) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_sales_table`
--

LOCK TABLES `booking_sales_table` WRITE;
/*!40000 ALTER TABLE `booking_sales_table` DISABLE KEYS */;
INSERT INTO `booking_sales_table` VALUES (116,'2016120212135840E5D99FB16',3,33,0,5,'2016-12-02 03:09:36','2016-12-02 03:09:36'),(117,'20161202122258412FB6C7E6C',1,34,0,1,'2016-12-02 08:24:28','2016-12-02 08:24:28'),(118,'201612101208584BCB202935B',1,34,36,1,'2016-12-10 09:30:25','2016-12-10 09:30:25');
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
  `email` varchar(50) DEFAULT NULL,
  `landline` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `synched` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_contacts_table`
--

LOCK TABLES `client_contacts_table` WRITE;
/*!40000 ALTER TABLE `client_contacts_table` DISABLE KEYS */;
INSERT INTO `client_contacts_table` VALUES (33,105,'0001','king','paulo','aquino','lot 5 block 7 Eucalyptus St. A Gordon Heights','N/A','N/A','kingpauloaquino@gmail.com','2502622','09191234567',2,1,2,'2016-12-08 17:32:37','2016-12-02 03:04:59'),(34,105,'0002','March','Jig','Tala','Olongapo','N/A','N/A','march@yahoo.com','2502622','09191234567',1,1,2,'2016-12-04 08:54:20','2016-12-02 03:08:16'),(36,113,'0001','first_name','middle_name','last_name','address_1','N/A','N/A','email@yahoo.com','landline','123-22234-123',1,1,2,'2016-12-04 07:11:36','2016-12-04 07:11:36'),(37,113,'0002','a','b','c','d','N/A','N/A','e','f','g',2,1,2,'2016-12-04 07:12:25','2016-12-04 07:12:25'),(39,105,'0003','Rody','R','Duterte','Davao, Philippines','N/A','N/A','duterte@yahoo.com','132-5643-3651','123-22234-123',2,1,2,'2016-12-04 08:54:20','2016-12-04 08:53:55');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_reference_table`
--

LOCK TABLES `client_reference_table` WRITE;
/*!40000 ALTER TABLE `client_reference_table` DISABLE KEYS */;
INSERT INTO `client_reference_table` VALUES (1,'Subscriber',2),(2,'Agency',2);
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
  `is_member` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_table`
--

LOCK TABLES `client_table` WRITE;
/*!40000 ALTER TABLE `client_table` DISABLE KEYS */;
INSERT INTO `client_table` VALUES (105,'Google',1,1,1,'2016-12-02 03:04:21','2016-12-02 03:04:21'),(113,'test 3',-1,2,1,'2016-12-04 07:11:36','2016-12-04 07:11:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_company_table`
--

LOCK TABLES `magazine_company_table` WRITE;
/*!40000 ALTER TABLE `magazine_company_table` DISABLE KEYS */;
INSERT INTO `magazine_company_table` VALUES (1,'201612121224584E722CBB2D1','Timex Company','California','','Join City','US','1','timex@yahoo.com','123123123','123123123',1,'2016-12-07 05:59:47','2016-12-07 05:59:47'),(2,'201612121224584E722CBB2F1','Solution Company','Manila','','Pasay City','','2','solution@yahoo.com','','',1,'2016-12-12 09:48:44','2016-12-12 09:48:44');
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
  `amount` decimal(18,2) DEFAULT NULL,
  `status` tinyint(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_issue_transaction_table`
--

LOCK TABLES `magazine_issue_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_issue_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_issue_transaction_table` VALUES (113,136,1,1,1,1,2295.46,2,'2016-12-12 05:55:38','2016-12-12 05:55:38');
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
  `magazine_country` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_table`
--

LOCK TABLES `magazine_table` WRITE;
/*!40000 ALTER TABLE `magazine_table` DISABLE KEYS */;
INSERT INTO `magazine_table` VALUES (1,'201612121245584E727D16112',1,'MAG-FHM','FHM',1,2,'2016-11-11 13:38:18','2016-11-11 13:38:18'),(2,'201612121245584E727D1634D',1,'MAG-TME','TIME',1,2,'2016-11-11 13:38:18','2016-11-11 13:38:18'),(3,'201612121245584E727D1634L',1,'MAG-CDY','CANDY',1,2,'2016-11-11 13:38:18','2016-11-11 13:38:18'),(4,'201612121245584E727D1634P',1,'MAG-LYC','LYCEUM',2,2,'2016-11-11 13:38:18','2016-11-11 13:38:18'),(5,'201612121245584E727D1634X',1,'MAG-VMK','VON, MARCH & KING',2,2,'2016-11-13 08:24:35','2016-11-13 08:24:35'),(16,'201612121245584E727D161B4',2,'Acer Code','Acer Name',2,2,'2016-12-12 09:50:02','2016-12-12 09:50:02'),(17,'201612121231584E7D733A9A5',2,'t2v','test 2 v',2,2,'2016-12-12 10:36:10','2016-12-12 10:36:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_transaction_table`
--

LOCK TABLES `magazine_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_transaction_table` VALUES (136,4,116,'2016-12-02 03:09:42','2016-12-02 03:09:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_discount_table`
--

LOCK TABLES `magzine_discount_table` WRITE;
/*!40000 ALTER TABLE `magzine_discount_table` DISABLE KEYS */;
INSERT INTO `magzine_discount_table` VALUES (1,1,0.200,2,1,NULL,NULL),(2,1,0.052,3,NULL,NULL,NULL),(5,1,0.023,4,NULL,NULL,NULL),(6,2,0.000,2,2,'2016-12-12 03:29:50','2016-12-12 03:29:50'),(7,2,0.000,3,2,'2016-12-12 03:29:50','2016-12-12 03:29:50'),(8,2,0.000,4,2,'2016-12-12 03:29:50','2016-12-12 03:29:50'),(9,2,0.000,5,2,'2016-12-12 03:29:50','2016-12-12 03:29:50'),(10,3,0.000,2,2,'2016-12-12 03:31:17','2016-12-12 03:31:17'),(11,3,0.000,3,2,'2016-12-12 03:31:17','2016-12-12 03:31:17'),(12,3,0.000,4,2,'2016-12-12 03:31:17','2016-12-12 03:31:17'),(13,3,0.000,5,2,'2016-12-12 03:31:17','2016-12-12 03:31:17'),(14,4,0.200,2,2,'2016-12-12 06:46:51','2016-12-12 06:46:51'),(15,4,0.000,3,2,'2016-12-12 06:46:51','2016-12-12 06:46:51'),(16,4,0.000,4,2,'2016-12-12 06:46:51','2016-12-12 06:46:51'),(17,4,0.000,5,2,'2016-12-12 06:46:51','2016-12-12 06:46:51'),(18,5,0.200,2,2,'2016-12-12 06:47:44','2016-12-12 06:47:44'),(19,5,0.000,3,2,'2016-12-12 06:47:44','2016-12-12 06:47:44'),(20,5,0.000,4,2,'2016-12-12 06:47:44','2016-12-12 06:47:44'),(21,5,0.000,5,2,'2016-12-12 06:47:44','2016-12-12 06:47:44'),(22,6,0.000,2,2,'2016-12-12 06:50:58','2016-12-12 06:50:58'),(23,6,0.000,3,2,'2016-12-12 06:50:58','2016-12-12 06:50:58'),(24,6,0.000,4,2,'2016-12-12 06:50:58','2016-12-12 06:50:58'),(25,6,0.000,5,2,'2016-12-12 06:50:58','2016-12-12 06:50:58'),(30,13,0.000,2,2,'2016-12-12 07:15:21','2016-12-12 07:15:21'),(31,13,0.000,3,2,'2016-12-12 07:15:22','2016-12-12 07:15:22'),(32,13,0.000,4,2,'2016-12-12 07:15:22','2016-12-12 07:15:22'),(33,13,0.000,5,2,'2016-12-12 07:15:22','2016-12-12 07:15:22'),(34,14,0.200,2,2,'2016-12-12 07:15:43','2016-12-12 07:15:43'),(35,14,0.000,3,2,'2016-12-12 07:15:43','2016-12-12 07:15:43'),(36,14,0.000,4,2,'2016-12-12 07:15:43','2016-12-12 07:15:43'),(37,14,0.000,5,2,'2016-12-12 07:15:43','2016-12-12 07:15:43'),(38,15,0.200,2,2,'2016-12-12 09:57:40','2016-12-12 09:57:40'),(39,15,0.000,3,2,'2016-12-12 09:57:40','2016-12-12 09:57:40'),(40,15,0.000,4,2,'2016-12-12 09:57:41','2016-12-12 09:57:41'),(41,15,0.000,5,2,'2016-12-12 09:57:41','2016-12-12 09:57:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_price_table`
--

LOCK TABLES `magzine_price_table` WRITE;
/*!40000 ALTER TABLE `magzine_price_table` DISABLE KEYS */;
INSERT INTO `magzine_price_table` VALUES (2,1,'1','2',1234.00,2,'2016-12-12 03:29:50','2016-12-12 03:29:50'),(3,1,'1','2',4200.00,2,'2016-12-12 03:31:17','2016-12-12 03:31:17'),(6,3,'1','2',2000.00,2,'2016-12-12 06:50:58','2016-12-12 06:50:58'),(13,3,'2','3',2370.00,2,'2016-12-12 07:15:21','2016-12-12 07:15:21'),(14,3,'3','2',2300.00,2,'2016-12-12 07:15:43','2016-12-12 07:15:43'),(15,16,'2','4',2370.00,2,'2016-12-12 09:57:40','2016-12-12 09:57:40');
/*!40000 ALTER TABLE `magzine_price_table` ENABLE KEYS */;
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
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_criteria_table`
--

LOCK TABLES `price_criteria_table` WRITE;
/*!40000 ALTER TABLE `price_criteria_table` DISABLE KEYS */;
INSERT INTO `price_criteria_table` VALUES (1,'4 Color',2,NULL,NULL),(2,'1 Spot Color',2,NULL,NULL),(3,'Black & White',2,NULL,NULL),(4,'Cover Positions',1,NULL,NULL);
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
  `criteria_id` varchar(50) DEFAULT NULL,
  `package_name` varchar(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `price_package_table`
--

LOCK TABLES `price_package_table` WRITE;
/*!40000 ALTER TABLE `price_package_table` DISABLE KEYS */;
INSERT INTO `price_package_table` VALUES (1,'1','Double Page Spread',2,NULL,NULL),(2,'1','1/2 DPS',2,NULL,NULL),(3,'1','Full Page',2,NULL,NULL),(4,'1','2/3 Page',2,NULL,NULL),(5,'1','1/2 Page Island',2,NULL,NULL),(6,'1','1/2 Page',2,NULL,NULL),(7,'1','1/3 Page',2,NULL,NULL),(8,'1','1/4 Page',2,NULL,NULL),(9,'1','1/6 Page',2,NULL,NULL),(10,'1','1/8 Page',2,NULL,NULL),(11,'2','Double Page Spread',2,NULL,NULL),(12,'2','1/2 DPS',2,NULL,NULL),(13,'2','Full Page',2,NULL,NULL),(14,'2','2/3 Page',2,NULL,NULL),(15,'2','1/2 Page Island',2,NULL,NULL),(16,'2','1/2 Page',2,NULL,NULL),(17,'2','1/3 Page',2,NULL,NULL),(18,'2','1/4 Page',2,NULL,NULL),(19,'2','1/6 Page',2,NULL,NULL),(20,'2','1/8 Page',2,NULL,NULL),(21,'3','Double Page Spread',2,NULL,NULL),(22,'3','1/2 DPS',2,NULL,NULL),(23,'3','Full Page',2,NULL,NULL),(24,'3','2/3 Page',2,NULL,NULL),(25,'3','1/2 Page Island',2,NULL,NULL),(26,'3','1/2 Page',2,NULL,NULL),(27,'3','1/3 Page',2,NULL,NULL),(28,'3','1/4 Page',2,NULL,NULL),(29,'3','1/6 Page',2,NULL,NULL),(30,'3','1/8 Page',2,NULL,NULL),(31,'4','2nd',2,NULL,NULL),(32,'4','3rd',2,NULL,NULL),(33,'4','4th',2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account`
--

LOCK TABLES `user_account` WRITE;
/*!40000 ALTER TABLE `user_account` DISABLE KEYS */;
INSERT INTO `user_account` VALUES (1,'king.a','eb33da6599c0243dc6215ee2891d1277','King','Paulo','Aquino','me@kpa21.info',NULL,1,2,NULL,NULL),(2,'march.t','eb33da6599c0243dc6215ee2891d1277','March','Jig','Tala','march@yahoo.com',NULL,2,2,NULL,NULL),(3,'von.b','eb33da6599c0243dc6215ee2891d1277','Von','Romson','Bayani','von@yahoo.com',NULL,3,2,NULL,NULL);
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

-- Dump completed on 2016-12-13 11:23:59
