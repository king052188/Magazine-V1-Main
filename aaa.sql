CREATE DATABASE  IF NOT EXISTS `db_magazine_v1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_magazine_v1`;
-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_magazine_v1
-- ------------------------------------------------------
-- Server version	5.5.45-log

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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_sales_table`
--

LOCK TABLES `booking_sales_table` WRITE;
/*!40000 ALTER TABLE `booking_sales_table` DISABLE KEYS */;
INSERT INTO `booking_sales_table` VALUES (136,'201612181224585693E4A7881',1,126,0,2,'2016-12-18 13:49:49','2016-12-18 13:49:49');
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
  `status` tinyint(4) DEFAULT NULL,
  `synched` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_contacts_table`
--

LOCK TABLES `client_contacts_table` WRITE;
/*!40000 ALTER TABLE `client_contacts_table` DISABLE KEYS */;
INSERT INTO `client_contacts_table` VALUES (49,126,'0001','Marissa','L','Mayer','California, United States',NULL,NULL,'Oaklahoma','California','22091','marissa@yahoo.com','232-1190','09051234567','Software Engineer','Company Representative',1,2,1,'2016-12-18 13:09:33','2016-12-18 13:09:33'),(50,126,'0002','David','O','Oland','Sacramento, United States',NULL,NULL,'Fresno','Los Angeles','22019','david@yahoo.com','292-1204','09072898475','Co-Founder','Company Representative',2,2,1,'2016-12-18 13:09:33','2016-12-18 13:09:33'),(51,126,'Google Main','Larry','L','Page','Anaheim, United States',NULL,NULL,'Irvine','California','22092','larry@yahoo.com','294-2091','09872647582','Owner','Company Representative',3,2,1,'2016-12-18 13:09:33','2016-12-18 13:09:33'),(52,127,'0001','Will','O','Stanford','Sacramento, United States',NULL,NULL,'San Jose','California','22092','will@yahoo.com','292-1092','09829948275','Google Owner in Philippines','Company Chief Officer',1,2,1,'2016-12-18 13:39:15','2016-12-18 13:23:34'),(53,127,'0002','Glenn','P','Obrien','Olongapo City, Philippines',NULL,NULL,'Olongapo','Zambales','2209','glenn@yahoo.com','294-2401','09284775182','Regional Director','Company Representative',2,2,1,'2016-12-18 13:39:15','2016-12-18 13:23:34'),(54,127,'Google Main','Lawrence','T','Page','Palo Alto, California',NULL,NULL,'Palo Alto','Long Beach','22091','lpage@yahoo.com','294-2091','09872647582','Owner','Company Representative',3,2,1,'2016-12-18 13:39:15','2016-12-18 13:23:34'),(55,128,'0001','Guy','T','Kawasaki','Nagoya, kobe Japan',NULL,NULL,'Nagoya','Kobe','2981','kawasaki@yahoo.com','298-1029','09827548917','CEO of Google Japan','Company Head Representative',1,2,1,'2016-12-18 13:50:35','2016-12-18 13:50:35'),(56,128,'0002','Fujima','P','Heroshimo','Sapporo, Japan',NULL,NULL,'Takamatsu','Kitakyushu','2871','fujima@yahoo.com','292-1204','09284992817','Software Engineer','Software Engineer Head',2,2,1,'2016-12-18 13:50:35','2016-12-18 13:50:35'),(57,128,'Google Japan','Kitashie','K','Osaka','Tokyo, Japan',NULL,NULL,'Yokohama','Nara','21234','kitashie@yahoo.com','291-8291','98275821175','Accounting Head','Finance Representative',3,2,1,'2016-12-18 13:50:35','2016-12-18 13:50:35'),(58,129,'0001','Mark','P','Zuckerberg','San Francisco, California',NULL,NULL,'California City','Chicago','2938','markz@yahoo.com','298-2012','98390928154','Founder Of Facebook','Company Representative',1,2,1,'2016-12-18 14:01:54','2016-12-18 14:01:54'),(59,129,'0002','Steve','L','Orlando','Houston, United States',NULL,NULL,'Los Angeles','Austin','29810','steve@yahoo.com','322-9182','98390928175','Co-Founder of Facebook','Lead Software Engineer',2,2,1,'2016-12-18 14:01:54','2016-12-18 14:01:54'),(60,129,'Facebook Company','Shane','I','Brown','New York City, United States',NULL,NULL,'New York City','San Francisco','20981','shanebrown@yahoo.com','298-1293','28971584176','Finance Officer','Finance Representative',3,2,1,'2016-12-18 14:01:54','2016-12-18 14:01:54'),(61,130,'0001','In-Jung','K','Jaw-Kwang','Gwangju, Korea',NULL,NULL,'Suwon','Daegu','29018','injung@yahoo.com','298-1029','09287551852','I.T Manager','I.T Head',1,2,1,'2016-12-18 14:41:50','2016-12-18 14:41:50'),(62,130,'0002','Jae-Hwa','L','Jae-Eun','Ulsan Songdo, Korea',NULL,NULL,'Changwon','Daejeon','33093','jae@yahoo.com','298-2018','09289557281','Software Engineer','Company Representative',2,2,1,'2016-12-18 14:41:50','2016-12-18 14:41:50'),(63,130,'Facebook Company','Shane','I','Brown','New York City, United States',NULL,NULL,'New York City','San Francisco','20981','shanebrown@yahoo.com','294-2091','28971584176','Finance Officer','Finance Representative',3,2,1,'2016-12-18 14:41:50','2016-12-18 14:41:50'),(64,131,'0001','Steven','L','Over','Baguio City, Manila',NULL,NULL,'Baguio City','Manila','2981','steven@yahoo.com','297-2081','92087421902','Hardware Engineer','Hardware and Software Head',1,2,1,'2016-12-18 14:45:22','2016-12-18 14:45:22'),(65,131,'0002','Ronald','A','Boston','Olongapo City, Philippines',NULL,NULL,'Olongapo City','Zambales','2291','ronald@yahoo.com','281-2981','29875219857','Scripting Engineer','Javascript head',2,2,1,'2016-12-18 14:45:22','2016-12-18 14:45:22'),(66,131,'Facebook Company','Shane','I','Brown','New York City, United States',NULL,NULL,'New York City','San Francisco','20981','shanebrown@yahoo.com','294-2091','28971584176','Finance Officer','Finance Representative',3,2,1,'2016-12-18 14:45:22','2016-12-18 14:45:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_reference_table`
--

LOCK TABLES `client_reference_table` WRITE;
/*!40000 ALTER TABLE `client_reference_table` DISABLE KEYS */;
INSERT INTO `client_reference_table` VALUES (1,'Subscriber',2),(2,'Agency',2),(3,'Lead',2);
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
  `is_member` tinyint(4) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_table`
--

LOCK TABLES `client_table` WRITE;
/*!40000 ALTER TABLE `client_table` DISABLE KEYS */;
INSERT INTO `client_table` VALUES (126,'Google Main','Mountain View, California, United States','Los Angeles','San Jose','22110',1,1,2,'2016-12-18 13:09:33','2016-12-18 13:09:33'),(127,'Google Philippines','Quezon City, Manila','Quezon City','Manila','2209',1,1,2,'2016-12-18 13:39:14','2016-12-18 13:23:33'),(128,'Google Japan','Kyoto Osaka, Japan','Kyoto','Nara','20891',1,1,2,'2016-12-18 13:50:34','2016-12-18 13:50:34'),(129,'Facebook Company','Washington, D.C, United States','Stockton California','Boston','22093',1,2,2,'2016-12-18 14:01:53','2016-12-18 14:01:53'),(130,'Facebook Korea','Seoul Busan, Korea','Daegu','Ulsan','20982',1,2,2,'2016-12-18 14:41:49','2016-12-18 14:41:49'),(131,'Facebook Philippines','Baguio City, Philippines','Baguio City','Baguio','2109',1,2,2,'2016-12-18 14:45:21','2016-12-18 14:45:21');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_company_table`
--

LOCK TABLES `magazine_company_table` WRITE;
/*!40000 ALTER TABLE `magazine_company_table` DISABLE KEYS */;
INSERT INTO `magazine_company_table` VALUES (6,'20161218124758568CB7234AC','Lyceum Publisher','Subic Bay','','Olongapo','Zambales','1','sales@lyceum.com','2521234','2521234',2,'2016-12-18 13:20:38','2016-12-18 13:20:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_issue_transaction_table`
--

LOCK TABLES `magazine_issue_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_issue_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_issue_transaction_table` VALUES (128,147,1,2,1,1,29,2500.00,2,'2016-12-18 13:52:43','2016-12-18 13:52:43'),(129,147,1,2,3,2,30,2500.00,2,'2016-12-18 13:53:23','2016-12-18 13:53:23'),(130,147,3,5,3,3,30,1800.00,2,'2016-12-18 14:39:52','2016-12-18 14:39:52');
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_table`
--

LOCK TABLES `magazine_table` WRITE;
/*!40000 ALTER TABLE `magazine_table` DISABLE KEYS */;
INSERT INTO `magazine_table` VALUES (41,'20161218123958568D27B0928',6,'subic-times','Subic Times',2017,4,1,2,'2016-12-18 13:21:35','2016-12-18 13:21:35');
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
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazine_transaction_table`
--

LOCK TABLES `magazine_transaction_table` WRITE;
/*!40000 ALTER TABLE `magazine_transaction_table` DISABLE KEYS */;
INSERT INTO `magazine_transaction_table` VALUES (147,41,136,'2016-12-18 13:49:56','2016-12-18 13:49:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_discount_table`
--

LOCK TABLES `magzine_discount_table` WRITE;
/*!40000 ALTER TABLE `magzine_discount_table` DISABLE KEYS */;
INSERT INTO `magzine_discount_table` VALUES (94,29,0.025,2,2,'2016-12-18 13:22:19','2016-12-18 13:22:19'),(95,29,0.015,3,2,'2016-12-18 13:22:19','2016-12-18 13:22:19'),(96,29,0.005,4,2,'2016-12-18 13:22:19','2016-12-18 13:22:19'),(97,29,0.000,5,2,'2016-12-18 13:22:19','2016-12-18 13:22:19'),(98,30,0.025,2,2,'2016-12-18 13:22:59','2016-12-18 13:22:59'),(99,30,0.015,3,2,'2016-12-18 13:22:59','2016-12-18 13:22:59'),(100,30,0.008,4,2,'2016-12-18 13:22:59','2016-12-18 13:22:59'),(101,30,0.000,5,2,'2016-12-18 13:22:59','2016-12-18 13:22:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magzine_price_table`
--

LOCK TABLES `magzine_price_table` WRITE;
/*!40000 ALTER TABLE `magzine_price_table` DISABLE KEYS */;
INSERT INTO `magzine_price_table` VALUES (29,41,'1','2',2500.00,2,'2016-12-18 13:22:18','2016-12-18 13:22:18'),(30,41,'3','5',1800.00,2,'2016-12-18 13:22:58','2016-12-18 13:22:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
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

-- Dump completed on 2016-12-18 22:53:57
