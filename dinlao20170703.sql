-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: dinlao
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Current Database: `dinlao`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `dinlao` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `dinlao`;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
INSERT INTO `currency` VALUES (1,'LAK','Kip','ກີບ'),(2,'USD','Dollar','ໂດລາ'),(3,'THB','Baht','ບາດ');
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  `province_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  KEY `fk_table1_province_idx` (`province_id`),
  CONSTRAINT `fk_table1_province` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Chanthabuly','ຈັນທະບູລີ',1),(2,'Sisattanak','ສີສັດຕະນາກ',1),(3,'Hinboun','ຫີນບູນ',12);
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doc_type`
--

DROP TABLE IF EXISTS `doc_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doc_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doc_type`
--

LOCK TABLES `doc_type` WRITE;
/*!40000 ALTER TABLE `doc_type` DISABLE KEYS */;
INSERT INTO `doc_type` VALUES (1,'R','Real Owner','ໃບຕາດິນຂອບທອງ'),(2,'U','Using Permit','ໃບອະນຸຍາດນຳໃຊ້');
/*!40000 ALTER TABLE `doc_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `role` varchar(1) NOT NULL COMMENT 'refer to user.role',
  `parent` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'New Post','product/create&code=L','*','Favorite'),(3,'My Post','product/mypost','*','Favorite'),(4,'Update Info','user/changeinfo','*','Profile'),(5,'Update Picture','user/changeprofile','*','Profile'),(6,'Change Password','user/changepassword','*','Profile'),(7,'Products','product/index','M','Web Master'),(8,'Product Types','product-type/index','M','Web Master'),(9,'Unit','unit/index','M','Web Master'),(10,'Province','province/index','M','Web Master'),(11,'District','district','M','Web Master'),(12,'Currency','currency/index','M','Web Master'),(13,'Document','document','M','Web Master'),(14,'User','user/index','A','Administration'),(15,'Menu','menu/index','A','Administration'),(16,'Picture','picture/index','A','Administration'),(17,'Translate','source-message/index','*','Administration');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `language` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `translation` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`,`language`),
  KEY `idx_message_language` (`language`),
  CONSTRAINT `fk_message_source_message` FOREIGN KEY (`id`) REFERENCES `source_message` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (1,'la-LA','ເຂົ້າສູ່ລະບົບ'),(2,'la-LA','ລົງທະບຽນ'),(3,'la-LA','ຕິດຕໍ່ພວກເຮົາ'),(4,'la-LA','ຂໍ້ກຳນົດແລະເງື່ອນໄຂ'),(5,'la-LA','ການໂຄສະນາອະສັງຫາລິມະຊັບ'),(6,'la-LA','ລະຫັດ'),(7,'la-LA','ພາສາ'),(8,'la-LA','ແປພາສາ'),(9,'la-LA','ບ່ອນນັດພົບຜູ້ຊື້ແລະຜູ້ຂາຍ'),(10,'la-LA','ພວກເຮົາເຮັດຫຍັງ'),(11,'la-LA','ທັງໝົດໃນແຜນທີ່'),(12,'la-LA','ຄລິກໃສ່ເຂັມ'),(13,'la-LA','ເບິ່ງລາຍລະອຽດເພີ່ມເຕີມ'),(14,'la-LA','ເຟສບຸກ'),(15,'la-LA','ອີເມວ'),(16,'la-LA','ລະຫັດຜ່ານ'),(17,'la-LA','ຊື່'),(18,'la-LA','ນາມສະກຸນ'),(19,'la-LA','ວັນເດືອນປີເກີດ'),(20,'la-LA','ສະຖານະ'),(21,'la-LA','ວັນທີລົງທະບຽນ'),(22,'la-LA','ພາລະບົດບາດ'),(23,'la-LA','ຮູບພາບ'),(24,'la-LA','ຕິດຕໍ່'),(25,'la-LA','ສິ່ງທີ່ມັກ'),(26,'la-LA',NULL),(27,'la-LA',NULL),(28,'la-LA',NULL),(29,'la-LA',NULL),(30,'la-LA',NULL),(31,'la-LA',NULL),(32,'la-LA',NULL),(33,'la-LA',NULL),(34,'la-LA',NULL),(35,'la-LA',NULL),(36,'la-LA',NULL),(37,'la-LA',NULL),(38,'la-LA',NULL),(39,'la-LA',NULL),(40,'la-LA',NULL),(41,'la-LA',NULL),(42,'la-LA',NULL),(43,'la-LA',NULL),(44,'la-LA',NULL),(48,'la-LA','ອອກຈາກລະບົບ'),(92,'la-LA',NULL),(93,'la-LA',NULL),(94,'la-LA',NULL),(95,'la-LA',NULL),(96,'la-LA',NULL);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1498541823),('m150207_210500_i18n_init',1498578821);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `picture`
--

DROP TABLE IF EXISTS `picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_picture_product1_idx` (`product_id`),
  CONSTRAINT `fk_picture_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `picture`
--

LOCK TABLES `picture` WRITE;
/*!40000 ALTER TABLE `picture` DISABLE KEYS */;
INSERT INTO `picture` VALUES (2,'20170629154251828.jpg',2),(3,'20170629154251462.jpg',2),(4,'20170629154251571.jpg',2),(7,'20170629164403911.png',1),(8,'20170703115659499.png',3),(9,'20170703115659466.png',3);
/*!40000 ALTER TABLE `picture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `village` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(20,2) NOT NULL,
  `created_date` datetime NOT NULL,
  `district_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'a' COMMENT 'a:available\nh:hide\ns:sold\n',
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `line` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `wechat` varchar(255) DEFAULT NULL,
  `currency_id` int(11) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `product_type_id` int(11) NOT NULL,
  `doc_type_id` int(11) NOT NULL,
  `area` decimal(20,2) DEFAULT NULL,
  `width` decimal(20,2) DEFAULT NULL,
  `height` decimal(20,2) DEFAULT NULL,
  `urlmap` text,
  `unit_id` int(11) NOT NULL,
  `facebook_url` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_district1_idx` (`district_id`),
  KEY `fk_product_user1_idx` (`user_id`),
  KEY `fk_product_currency1_idx` (`currency_id`),
  KEY `fk_product_product_type1_idx` (`product_type_id`),
  KEY `fk_product_doc_type1_idx` (`doc_type_id`),
  KEY `fk_product_unit1_idx` (`unit_id`),
  CONSTRAINT `fk_product_currency1` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_district1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_doc_type1` FOREIGN KEY (`doc_type_id`) REFERENCES `doc_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_product_type1` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_unit1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'ສີບຸເຮືອງ','ເັກຫວ້ເ່າວສເາ່ໄຳນເວາສ',2738.00,'2017-06-28 17:18:08',1,1,'A','18.529503028087696','103.502197265625','22224071','','','','','',2,'20170629164403934.jpg',1,1,500.00,20.00,10.00,NULL,1,NULL),(2,'ບ້ານຫີນບູນໃຕ້, ມ.ຫີນບູນ, ຂ.ຄຳມ່ວນ','ຕ້ອງການຂາຍດິນ\r\n* ເນື້ອທີ່ດິນ 100ແມັດx90ແມັດ ເປັນດິນປຸກສ້າງ ຕັ້ງຢູ່ໃຈກາງເມືອງຫີນບູນ ບ້ານຫີນບູນໃຕ້ ເມືອງຫີນບູນ ແຂວງຄຳມ່ວນ\r\n* ດິນທົ່ງພຽງຕົວເມືອງ ຕິດແຄມທາງໃຫຍ່ ເຫມາະແກ່ການເຮັດທຸລະກິດເຊັ່ນ: ບ້ານພັກ ໂຮງແຮມ ປຳ້ນຳ້ມັນ ຮ້ານອາຫານ ແລະ ອື່ນໆ......\r\n* ມີໃບຕາດິນຂອບທອງພ້ອມໂອນ\r\n===>>  ສົນໃຈໂທສອບຖາມ 9999 6199. 9196 1952. 2218 4488',1500000.00,'2017-06-29 15:42:51',3,2,'A','17.592170961756967','104.62871968746185',' 0209999 6199, 9196 1952, 2218 4488','athinanh@gmail.com','','','Aorto Manivong, Atom Freedom Bigboss','',3,'20170629154251942.jpg',1,1,8839.00,100.00,90.00,NULL,1,NULL),(3,'ok','test',10000.00,'2017-06-29 10:23:07',1,1,'A','17.48691110080686','105.19426345825195','54654657','56745675','45645645','5465476547','75467567','5675467',2,'20170703115659744.png',3,1,800.00,20.00,40.00,NULL,1,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_detail`
--

DROP TABLE IF EXISTS `product_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  KEY `fk_product_detail_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_detail_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_detail`
--

LOCK TABLES `product_detail` WRITE;
/*!40000 ALTER TABLE `product_detail` DISABLE KEYS */;
INSERT INTO `product_detail` VALUES (1,3,NULL,NULL,NULL,NULL),(2,3,NULL,NULL,NULL,NULL),(3,3,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `product_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_type`
--

LOCK TABLES `product_type` WRITE;
/*!40000 ALTER TABLE `product_type` DISABLE KEYS */;
INSERT INTO `product_type` VALUES (1,'L','Land Whole Sale','ດິນຂາຍຍົກ'),(2,'H','House','ເຮືອນ'),(3,'R','Retail Sale Land','ດິນແບ່ງຂາຍ');
/*!40000 ALTER TABLE `product_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `province` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `province`
--

LOCK TABLES `province` WRITE;
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` VALUES (1,'VTE','Vientiane Capital','ນະຄອນຫຼວງວຽງຈັນ'),(2,'PSL','Phongsaly','ຜົ້ງສາລີ'),(3,'ODX','Oudomxai','ອຸດົມໄຊ'),(4,'LNT','Luangnamtha','ຫຼວງນໍ້າທາ'),(5,'BK','Bokeo','ບໍ່ແກ້ວ'),(6,'LPB','Luangprabang','ຫຼວງພະບາງ'),(7,'HP','Huaphan','ຫົວພັນ'),(8,'XK','Xiengkhuang','ຊຽງຂວາງ'),(9,'XYB','Xayabuly','ໄຊຍະບູລີ'),(10,'VT','Vientiane','ວຽງຈັນ'),(11,'BLX','Bolikhamxai','ບໍລິຄໍາໄຊ'),(12,'KM','Khammouane','ຄຳມ່ວນ'),(13,'SVN','Savannakhet','ສະຫວັນນະເຂດ'),(14,'SLV','Salavan','ສາລະວັນ'),(15,'CPS','Champasack','ຈຳປາສັກ'),(16,'XE','Xekong','ເຊກອງ'),(17,'ATP','Attapeu','ອັດຕະປື');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `source_message`
--

DROP TABLE IF EXISTS `source_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_source_message_category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source_message`
--

LOCK TABLES `source_message` WRITE;
/*!40000 ALTER TABLE `source_message` DISABLE KEYS */;
INSERT INTO `source_message` VALUES (1,'app','Sign In'),(2,'app','Register'),(3,'app','Contact Us'),(4,'app','Terms & Conditions'),(5,'app','Properties Advertisement'),(6,'app','ID'),(7,'app','Language'),(8,'app','Translation'),(9,'app','Where buyers & sellers meet'),(10,'app','What we do'),(11,'app','All in one map'),(12,'app','Click on the pin '),(13,'app',' to see more detail'),(14,'app','acebook'),(15,'app','Email'),(16,'app','Password'),(17,'app','Firstname'),(18,'app','Lastname'),(19,'app','Birthdate'),(20,'app','Status'),(21,'app','Registerd Date'),(22,'app','Role'),(23,'app','Picture'),(24,'app','Contact'),(25,'app','Favorite'),(26,'app','Profile'),(27,'app','Web Master'),(28,'app','Administration'),(29,'app','Home'),(30,'app','New Post'),(31,'app','My Post'),(32,'app','Update Info'),(33,'app','Update Picture'),(34,'app','Change Password'),(35,'app','Products'),(36,'app','Product Types'),(37,'app','Unit'),(38,'app','Province'),(39,'app','District'),(40,'app','Currency'),(41,'app','Document'),(42,'app','User'),(43,'app','Menu'),(44,'app','SQLSTATE[22007]: Invalid datetime format: 1292 Incorrect datetime value: \'619747200\' for column \'birthdate\' at row 1\nThe SQL being executed was: UPDATE `user` SET `birthdate`=\'619747200\' WHERE `id`=1'),(45,'app','Recommended'),(46,'app','More'),(47,'app','Detail'),(48,'app','Sign Out'),(49,'app','Post New Land'),(50,'app','Village'),(51,'app','Description'),(52,'app','Price'),(53,'app','Created Date'),(54,'app','Lat'),(55,'app','Lon'),(56,'app','Tel'),(57,'app','Whatsapp'),(58,'app','Line'),(59,'app','Facebook'),(60,'app','Wechat'),(61,'app','Photo'),(62,'app','Product Type'),(63,'app','Doc Type'),(64,'app','Area'),(65,'app','Width'),(66,'app','Height'),(67,'app','Urlmap'),(68,'app','Attached Photos'),(69,'app','Location'),(70,'app','Click on map to locate the location'),(71,'app','Contact Information'),(72,'app','Save'),(73,'app','Source Messages'),(74,'app','Add'),(75,'app','Actions'),(76,'app','Category'),(77,'app','Message'),(78,'app','Translate'),(79,'app','{a} {u}<sup>2</sup> ({w}{u} x {h}{u})'),(80,'app','Active'),(81,'app','Successful'),(82,'app','Update'),(83,'app','Delete'),(84,'app','Are you sure you want to delete this item?'),(85,'app','Share to '),(86,'app','Share to Facebook'),(87,'app','Address'),(88,'app','Telephone'),(89,'app','Sign in by facebook'),(90,'app','Update {modelClass}: '),(91,'app','DinLao.com - Properties Advertisement, where buyers & sellers meet'),(92,'app','Units'),(93,'app','Code'),(94,'app','Name'),(95,'app','Lao Name'),(96,'app','Provinces'),(97,'app','Please fill out the following fields to sign in'),(98,'app','Create Product Type'),(99,'app','Retails Land for Sale'),(100,'app','Remove'),(101,'app','Retails Land'),(102,'app','Retails Lands Details'),(103,'app','Districts');
/*!40000 ALTER TABLE `source_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namelao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_UNIQUE` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'m','Metre','ແມັດ'),(2,'Km','Kilo Metre','ກິໂລແມັດ');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthdate` datetime NOT NULL,
  `status` varchar(1) NOT NULL COMMENT 'A:Active\nD:Disabled',
  `registerd_date` datetime NOT NULL,
  `role` varchar(1) NOT NULL COMMENT 'A: Admin\nM: Member\nU: User',
  `picture` varchar(255) DEFAULT NULL,
  `facebookid` varchar(255) DEFAULT NULL,
  `facebookname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'1718286221533246','1718286221533246','Advin','Thepphakan','1989-08-22 00:00:00','A','2017-06-28 08:11:06','A',NULL,'1718286221533246','Advin Thepphakan'),(2,'1603386669695315','1603386669695315','Athinanh','Manivong','2017-06-28 09:11:05','A','2017-06-28 08:48:34','A',NULL,'1603386669695315','Athinanh Manivong');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dinlao'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-03 20:14:37
